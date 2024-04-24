<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transactions;
use App\Models\CartItem;
use App\Models\Ratings;
use App\Models\Products;
use App\Models\ShoppingCart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class TransactionController extends Controller
{
    public function confirm(Transactions $trans){
        $trans->update([
            'status' => 'Successful',
        ]);

        $trans->product->update([
            'no_of_stocks' => $trans->product->no_of_stocks - $trans->quantity,
            'items_sold' => $trans->product->items_sold + $trans->quantity,
        ]);

        return redirect()->back();
    }

    public function delete(Transactions $trans){
        $trans->delete();
        return redirect()->back();
    }

    public function cancel(Transactions $trans){
        $trans->update([
            'status' => 'Cancelled',
        ]);

        return redirect()->back();
    }

    public function store(Request $request, Products $product){
        $validatedData = $request->validate([
            'quantity' => 'required',
            'total_amount' => 'required',
            'shipping_option' => 'required|max:255',
        ]);

        try{
            $transaction = new Transactions;
            $transaction->product_id = $product->id;
            $transaction->merchant_id = $product->merchant->id;
            $transaction->user_id = Auth::user()->id;
            $transaction->selling_price = $product->price;
            $transaction->order_ref = Str::random(10);
            $transaction->quantity = $validatedData['quantity'];
            $transaction->total_amount = $validatedData['total_amount'];
            $transaction->shipping_option = $validatedData['shipping_option'];
            
            if( $validatedData['shipping_option'] == "Standard Local"){
                $startDate = now()->addDays(5)->translatedFormat('M j');
                $endDate = now()->addDays(10)->translatedFormat('M j');
                $transaction->est_arrival = $startDate . " - " . $endDate;
            }else{
                $startDate = now()->addDays(2)->translatedFormat('M j');
                $endDate = now()->addDays(4)->translatedFormat('M j');
                $transaction->est_arrival = $startDate . " - " . $endDate;
            }

            if($request->input('cart_item_id')){
                $item = CartItem::where('id', $request->input('cart_item_id'))->first();
                $cart = ShoppingCart::where('id', $item->cart_id)->first();
                $cart->total_items -= 1;
                $cart->save();

                $item->delete();
            }
            
            $transaction->saveOrFail();

            return redirect()->route('show-transact');
            
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e){
            return response()->json(['error' => 'No Found Record'], 404);
        } catch (\Exception $e){
            Log::error($e->getMessage());
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function transact(Request $request, CartItem $item){
        $product = $item->product;
        $quantity = $item->quantity;
        return view('transaction.index', compact('product', 'quantity', 'item'));
    }

    public function show(){
        $transactions = Transactions::where('user_id', Auth::user()->id)
                                    ->orderBy('created_at', 'desc')
                                    ->get()
                                    ->map(function ($transactions){
                                        $transactions->created_at = $transactions->created_at->setTimezone('Asia/Manila');
                                        return $transactions;
                                    });
        
        $ratings = Ratings::where('user_id', Auth::user()->id);
        $shopcart = ShoppingCart::where('user_id', Auth::user()->id)->first();

        return view('transaction.orders', compact('transactions', 'ratings', 'shopcart'));
    }
}
