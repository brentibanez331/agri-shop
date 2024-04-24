<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;
use App\Models\Products;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Models\Merchants;
use App\Models\Ratings;
use App\Models\ShoppingCart;
use App\Models\Tag;

class ProductController extends Controller
{
    public function edit($productId, $merchantId){
        $product = Products::findOrFail($productId);
        $merchant = Merchants::findOrFail($merchantId);
        $tags = Tag::all();

        return view('product.edit', compact('product', 'merchant', 'tags'));
    }

    public function add(Merchants $merchant){
        $tags = Tag::all();

        return view('product.add', compact('merchant', 'tags'));
    }

    public function delete($productId, $merchantId){

        try {
            // Your code that may throw an exception
            $product = Products::findOrFail($productId);
            $merchant = Merchants::findOrFail($merchantId);
            $product->delete();

            $merchant = Merchants::where('id', $merchantId)->first();

            $merchant->no_of_products -= 1;
            $merchant->save();

            return redirect()->route('manage-shop', compact('merchant'));
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            // Handle the exception, for example, return a response or log it
            return response()->json(['error' => 'No Found Record'], 404);
        } catch (\Exception $e) {
            // Handle other types of exceptions
            // Log the exception or return a generic error response
            Log::error($e->getMessage());
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function update(Request $request, Products $product){
        try {
            $newPhotoFileName = "";
            if ($request->hasFile('photo')) {
                // Delete the previous image from storage
                $previousImagePath = 'public/products/' . $product->product_image_url;
                if (Storage::exists($previousImagePath)) {
                    Storage::delete($previousImagePath);
                }
    
                // Upload the new photo to storage
                $newPhotoFileName = time() . '.' . $request->photo->extension();
                $request->photo->storeAs('public/products', $newPhotoFileName);
                $product->product_image_url = $newPhotoFileName;
            }

            $product->update([
                'product_name' => $request->product_name,
                'description' => $request->description,
                'no_of_stocks' => $request->no_of_stocks,
                'price' => $request->price,
            ]);
            return redirect()->back()->with('message', 'Updated Product Successfully');;
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            // Handle the exception, for example, return a response or log it
            return response()->json(['error' => 'No Found Record'], 404);
        } catch (\Exception $e) {
            // Handle other types of exceptions
            // Log the exception or return a generic error response
            Log::error($e->getMessage());
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function storeProduct(Request $request){

        $validatedData = $request->validate([
            'merchant_id' => 'required|exists:merchants,id',
            'tag_id' => 'required|exists:tags,id',
            'product_name' => 'required|max:255',
            'description' => 'required',
            'no_of_stocks' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
            'photo' => 'required|max:2048', // Adjust the max size as needed
        ]);

        try {
            // Your code that may throw an exception
            if ($request->hasFile('photo')) {
                $photoPath = $request->file('photo')->store('products', 'public');
                $photoFileName = basename($photoPath);
            } else {
                $photoFileName = null;
            }

            $product = new Products;
            $product->merchant_id = $validatedData['merchant_id'];
            $product->product_name = $validatedData['product_name'];
            $product->tag_id = $validatedData['tag_id'];
            $product->description = $validatedData['description'];
            $product->no_of_stocks = $validatedData['no_of_stocks'];
            $product->product_rating = 0.0;
            $product->tag_id = 1; // Update this value as needed
            $product->items_sold = 0;
            $product->price = $validatedData['price'];
            $product->product_image_url = $photoFileName;
            $product->saveOrFail();

            $merchant = Merchants::where('id', $validatedData['merchant_id'])->first();

            $merchant->no_of_products += 1;
            $merchant->save();

            return redirect()->route('manage-shop', ['merchant' => $validatedData['merchant_id']]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            // Handle the exception, for example, return a response or log it
            return response()->json(['error' => 'No Found Record'], 404);
        } catch (\Exception $e) {
            // Handle other types of exceptions
            // Log the exception or return a generic error response
            Log::error($e->getMessage());
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function show(Products $product): View|RedirectResponse|JsonResponse
    {
        try {
            $ratings = Ratings::where('product_id', $product->id)
                ->selectRaw('rating, count(*) as count')
                ->groupBy('rating')
                ->get()
                ->keyBy('rating');

            $no_of_ratings = Ratings::where('product_id', $product->id)->count();
            $reviews = Ratings::where('product_id', $product->id)->get()->map(function ($review){
                $review->created_at = $review->created_at->setTimezone('Asia/Manila');
                return $review;
            });

            if(Auth::user()){
                $shopcart = ShoppingCart::where('user_id', Auth::user()->id)->first();
                return view('product.index', compact('product', 'no_of_ratings', 'ratings', 'reviews', 'shopcart'));
            }
            
            return view('product.index', compact('product', 'no_of_ratings', 'ratings', 'reviews'));
            
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            // Handle the exception, for example, return a response or log it
            return response()->json(['error' => 'No Found Record'], 404);
        } catch (\Exception $e) {
            // Handle other types of exceptions
            // Log the exception or return a generic error response
            Log::error($e->getMessage());
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
