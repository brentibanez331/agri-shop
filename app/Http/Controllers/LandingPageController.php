<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Products;
use App\Models\ShoppingCart;
use Illuminate\Support\Facades\Auth;


class LandingPageController extends Controller
{
    public function index(){
        $products = Products::all();
        if(Auth::user()){
            $shopcart = ShoppingCart::where('user_id', Auth::user()->id)->first();
            return view('welcome', compact('products', 'shopcart'));
        }
        
        return view('welcome', compact('products'));
    }
}
