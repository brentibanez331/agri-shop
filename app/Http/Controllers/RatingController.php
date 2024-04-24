<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transactions;
use App\Models\Products;
use App\Models\Ratings;
use Illuminate\Support\Facades\Auth;

class RatingController extends Controller
{
    public function index(Transactions $trans){
        return view('review.add', compact('trans'));
    }

    public function edit(Products $product){
        $rating = Ratings::where('user_id', Auth::user()->id)->where('product_id', $product->id)->first();

        return view('review.edit', compact('product', 'rating'));
    }

    public function delete(Ratings $rating){
        $rating->delete();

        $rating->product->product_rating = Ratings::where('product_id', $rating->product->id)->avg('rating');
        $rating->product->saveOrFail();

        $rating->product->merchant->merchant_rating = Products::where('merchant_id', $rating->product->merchant->id)->avg('product_rating');
        $rating->product->merchant->saveOrFail();

        return redirect()->route('show-transact');
    }

    public function update(Request $request, Ratings $rating){
        $rating->update([
            'rating' => $request->star_rating,
            'review_text' => $request->review_text,
        ]);

        $rating->product->product_rating = Ratings::where('product_id', $rating->product->id)->avg('rating');
        $rating->product->saveOrFail();

        $rating->product->merchant->merchant_rating = Products::where('merchant_id', $rating->product->merchant->id)->avg('product_rating');
        $rating->product->merchant->saveOrFail();

        return redirect()->back();
    }

    public function store(Request $request, Products $product){
        $validatedData = $request->validate([
            'star_rating' => 'required',
            'review_text' => 'required|max:225',
        ]);
        try{
            $rating = new Ratings;
            $rating->user_id = Auth::user()->id;
            $rating->product_id = $product->id;
            $rating->merchant_id = $product->merchant->id;
            $rating->rating = $validatedData['star_rating'];
            $rating->review_text = $validatedData['review_text'];
            $rating->saveOrFail();

            $product->product_rating = Ratings::where('product_id', $product->id)->avg('rating');
            $product->saveOrFail();

            $product->merchant->merchant_rating = Products::where('merchant_id', $product->merchant->id)->avg('product_rating');
            $product->merchant->saveOrFail();

            $ratings = Ratings::where('product_id', $product->id)
                ->selectRaw('rating, count(*) as count')
                ->groupBy('rating')
                ->get()
                ->keyBy('rating');

            return redirect()->route('show-transact');
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e){
            return response()->json(['error' => 'No Found Record'], 404);
        } catch (\Exception $e){
            Log::error($e->getMessage());
            return response()->json(['error' => $e->getMessage()], 500);
        }

        

    }
}
