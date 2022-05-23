<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $cart_items = Cart::where('user_id', Auth::id())->get();
        return view('cart.index', compact('cart_items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);
        $produk = $request->input('id');
        $kuantitas = $request->input('qty');

        if (Auth::check()) {
            $prod_check = Product::where('id', $produk)->first();

            if ($prod_check) {

                if (Cart::where('product_id', $produk)->where('user_id', Auth::id())->exists()) 
                {
                    return response()->json(['status' => $prod_check->judul. " already added to cart"]);
                } 
                else 
                {
                    $cart_item = new Cart();
                    $cart_item->product_id = $produk;
                    $cart_item->user_id = Auth::id();
                    $cart_item->qty = $kuantitas;
                    $cart_item->save;

                    return response()->json(['status' => $prod_check->judul. " added to cart"]);
                }

            //     $cart_item = new Cart();
            //     $cart_item->product_id = $produk;
            //     $cart_item->user_id = Auth::id();
            //     $cart_item->qty = $kuantitas;
            //     $cart_item->save;

            //     return response()->json(['status' => "Added to cart"]);
                
            // }
            } else {
                return response()->json(['status' => "Cannot added to cart"]);
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // dd('hai');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cart $cart)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cart $cart)
    {
        //
    }

}
