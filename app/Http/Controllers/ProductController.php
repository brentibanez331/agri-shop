<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;
use App\Models\Products;
use App\Models\Merchants;
use App\Models\Ratings;

class ProductController extends Controller
{
    public function addProduct(Merchants $merchant){
        return view('add-product', compact('merchant'));
    }

            // $validated = $request->validate([
        //     'min_amt' => 'required|numeric',
        //     'max_amt' => 'required|numeric',
        //     'rates' => 'required|numeric',
        // ]);

    public function storeProduct(Request $request){

        $validatedData = $request->validate([
            'merchant_id' => 'required|exists:merchants,id',
            'product_name' => 'required|max:255',
            'description' => 'required',
            'no_of_stocks' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
            'photo' => 'required|mimes:jpg,png,jpeg|max:2048', // Adjust the max size as needed
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
            $product->description = $validatedData['description'];
            $product->no_of_stocks = $validatedData['no_of_stocks'];
            $product->product_rating = 0.0;
            $product->tag_id = 1; // Update this value as needed
            $product->items_sold = 0;
            $product->price = $validatedData['price'];
            $product->product_image_url = $photoFileName;
            $product->saveOrFail();

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
            $noOfRatings = Ratings::where('product_id', $product->id)->count();
            $reviews = Ratings::where('product_id', $product->id)->get();
            return view('product', compact('product', 'noOfRatings', 'reviews'));
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
