<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;
use App\Models\Products;
use App\Models\Ratings;

class ProductController extends Controller
{
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
