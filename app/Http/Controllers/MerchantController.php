<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Merchants;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class MerchantController extends Controller
{
    public function edit(Merchants $merchant){
        return view('merchant.edit', compact('merchant'));
    }

    public function show(Merchants $merchant){
        $products = $merchant->products()->orderBy('created_at', 'desc')->get()->map(function ($product) {
            $product->created_at = $product->created_at->setTimezone('Asia/Manila');
            return $product;
        });

        // Needs some fixing
        $no_of_ratings = Ratings::where('user_id', $merchant->id)->count();

        return view('merchant.view-products', compact('products', 'merchant'));
    }

    public function delete(Merchants $merchant){
        try {
            // Your code that may throw an exception
            $merchant->delete();
            return redirect()->route('your-shop');
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

    public function update(Request $request, Merchants $merchant){
        try {
            $newPhotoFileName = "";
            if ($request->hasFile('photo')) {
                // Delete the previous image from storage
                $previousImagePath = 'public/merchants/' . $merchant->image_url;
                if (Storage::exists($previousImagePath)) {
                    Storage::delete($previousImagePath);
                }
    
                // Upload the new photo to storage
                $newPhotoFileName = time() . '.' . $request->photo->extension();
                $request->photo->storeAs('public/merchants', $newPhotoFileName);
                $merchant->image_url = $newPhotoFileName;
            }

            $merchant->update([
                'store_name' => $request->store_name,
                'pickup_address' => $request->pickup_address,
                'reg_address' => $request->reg_address,
                'country' => $request->country,
                'city' => $request->city,
                'state' => $request->state,
                'postal_code' => $request->postal_code,
                'tin' => $request->tin,
            ]);
            return redirect()->back();
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

    public function store(Request $request){
        $validatedData = $request->validate([
            'store_name' => 'required|max:255',
            'pickup_address' => 'required',
            'reg_address' => 'required',
            'country' => 'required|max:255',
            'city' => 'required|max:255',
            'state' => 'required|max:255',
            'postal_code' => 'required|max:5',
            'tin' => 'required|max:9',
            'photo' => 'required|mimes:jpg,png,jpeg|max:2048', // Adjust the max size as needed
        ]);
        try{
            if ($request->hasFile('photo')) {
                $photoPath = $request->file('photo')->store('merchants', 'public');
                $photoFileName = basename($photoPath);
            } else {
                $photoFileName = null;
            }
    
            $merchant = new Merchants;
            $merchant->user_id = Auth::user()->id;
            $merchant->store_name = $validatedData['store_name'];
            $merchant->no_of_products = 0;
            $merchant->merchant_rating = 0.0;
            $merchant->city = $validatedData['city'];
            $merchant->country = $validatedData['country'];
            $merchant->state = $validatedData['state'];
            $merchant->pickup_address = $validatedData['pickup_address'];
            $merchant->reg_address = $validatedData['reg_address'];
            $merchant->postal_code = $validatedData['postal_code'];
            $merchant->tin = $validatedData['tin'];
            $merchant->image_url = $photoFileName;
            $merchant->saveOrFail();

            return redirect()->back();
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

    public function getUserShops()
    {
        $user_id = Auth::user()->id;
        $shops = Merchants::where('user_id', $user_id)->get();

        return view('merchant.index', compact('shops'));
    }

    public function getProducts(Merchants $merchant)
    {
        $products = $merchant->products()->orderBy('created_at', 'desc')->get()->map(function ($product) {
            $product->created_at = $product->created_at->setTimezone('Asia/Manila');
            return $product;
        });

        return view('merchant.shop-products', compact('products', 'merchant'));
    }
}
