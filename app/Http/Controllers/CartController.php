<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Products;
use App\Models\CartItem;
use App\Models\ShoppingCart;
use Illuminate\Support\Facades\Auth;


class CartController extends Controller
{
    public function show(){
        $cart = ShoppingCart::where('user_id', Auth::user()->id)->first();
        $cart_items = CartItem::where('cart_id', $cart->id)->get();

        return view('cart.index', compact('cart_items'));
    }

    public function store(Request $request, Products $product){

        $validatedData = $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $cart = ShoppingCart::where('user_id', Auth::user()->id)->first();

        if($request->input('action') == 'add_to_cart'){

            $existingCartItem = CartItem::where('cart_id', $cart->id)
                                        ->where('product_id', $product->id)
                                        ->first();

            if($existingCartItem){
                $existingCartItem->quantity += $validatedData['quantity'];
                $existingCartItem->save();
            }else{
                $cart_item = new CartItem;
                $cart_item->cart_id = $cart ? $cart->id : null;
                $cart_item->product_id = $product->id;
                $cart_item->quantity = $validatedData['quantity'];
                $cart_item->price = $product->price;
                $cart_item->saveOrFail();
            }

            $total_items = CartItem::where('cart_id', $cart->id)->count();

            $cart->update([
                'total_items' => $total_items,
            ]);
            
            return redirect()->back()->with('message', 'Product Added to Cart Successfully');
        }

        if($request->input('action') == 'buy_now'){
            // Handle Purchase Page
            return view('welcome');
        }
    }
}
