<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Products;
use App\Models\CartItem;
use App\Models\ShoppingCart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;


class CartController extends Controller
{
    public function show(){
        $cart = ShoppingCart::where('user_id', Auth::user()->id)->first();
        $cart_items = CartItem::where('cart_id', $cart->id)->orderBy('created_at', 'desc')->get();

        return view('cart.index', compact('cart_items'));
    }

    public function delete(CartItem $item){
        try {
            // Your code that may throw an exception
            $cart = ShoppingCart::where('id', $item->cart_id)->first();
            $cart->total_items -= 1;
            $cart->save();

            $item->delete();
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

    public function minus(Request $request, $itemId, $cartId)
    {
        $cartItem = CartItem::where('id', $itemId)
                        ->where('cart_id', $cartId)
                        ->first();


        if ($cartItem) {
            $cartItem->quantity = max($cartItem->quantity - 1, 1);
            $cartItem->save();

            return response()->json([
                'quantity' => $cartItem->quantity,
                'price' => $cartItem->quantity * $cartItem->price,
            ]);
        }else{
            return response()->json([
                'error' => 'Cart item not found',
            ], 404);
        }
    }

    public function plus(Request $request, $itemId, $cartId)
    {
        
        $cartItem = CartItem::where('id', $itemId)
                        ->where('cart_id', $cartId)
                        ->first();
        $product = Products::where('id', $cartItem->product_id)->first();

        if ($cartItem) {
            $cartItem->quantity = min($cartItem->quantity + 1, $product->no_of_stocks);
            $cartItem->save();

            return response()->json([
                'quantity' => $cartItem->quantity,
                'price' => $cartItem->quantity * $cartItem->price,
            ]);
        }else{
            return response()->json([
                'error' => 'Cart item not found',
            ], 404);
        }
    }

    public function handler(Request $request, Products $product){

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

                $cart->total_items += 1;
                $cart->save();
            }

            $total_items = CartItem::where('cart_id', $cart->id)->count();

            $cart->update([
                'total_items' => $total_items,
            ]);
            
            return redirect()->back()->with('message', 'Product Added to Cart Successfully');
        }

        if($request->input('action') == 'buy_now'){
            $quantity = $validatedData['quantity'];
            $item = null;

            return view('transaction.index', compact('product', 'quantity', 'item'));
        }
    }

    
}
