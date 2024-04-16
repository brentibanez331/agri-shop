<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Products;

class LandingPageController extends Controller
{
    public function index(){
        $products = Products::all();
        return view('welcome', compact('products'));
    }
}
