<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['cart_items'] = Cart::all();
        return view('cart.index', $data );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $this->validate($request, [
        //     'product_id' => 'required',
        // ]);

        // $produk = Product::findOrFail($request->product_id);
        // $cart_items = Cart::all();

        // if($cart_items){
        //     $cart_items['qty'] += 1;
        // }else{
        //     $cart_items = [
        //     'produk' => $produk,
        //     'qty' => 1,
        //     ];
        // }

        // try{
        //     $produk = Product::findOrFail($request->product_id);
        //     $cart_items = session()->get('cart_items', []);
        //     $cart_items = Cart::all();
        //     $cart_total = 0;



        //     if(array_key_exists($request->product_id, $cart_items)){
        //         $cart_items[$request->product_id]['qty'] += 1;
        //     }else{
        //         $cart_items[$request->product_id] = [
        //             'produk' => $produk,
        //             'qty' => 1,
        //         ];
        //     }

        //     foreach($cart_items as $item){
        //         $cart_total += $item['produk']->harga * $item['qty'];
        //     }

        //     session()->put('cart_items', $cart_items);
        //     session()->put('cart_total', $cart_total);
        //     session()->put('cart_count', count($cart_items));

        //     return response()->json([
        //         'status' => 'success',
        //         'message' => 'Produk berhasil ditambahkan ke keranjang',
        //         'data' => [
        //             'cart_items' => view('cart.cart_items')->render(),
        //             'cart_total' => 'Rp '.number_format($cart_total),
        //             'cart_item_count' => count($cart_items),
        //         ],
        //     ]);
        // }catch(\Exception $e){
        //     return response()->json([
        //         'status' => 'error',
        //         'message' => $e->getMessage(),
        //     ], 500);
        // }

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
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'qty' => 'required',
        ]);

        try{
            $cart_items = session()->get('cart_items', []);
            $cart_total = 0;

            if(array_key_exists($id, $cart_items)){
                $cart_items[$id]['qty'] = $request->qty;
            }

            foreach($cart_items as $item){
                $cart_total += $item['produk']->harga * $item['qty'];
            }

            session()->put('cart_items', $cart_items);
            session()->put('cart_total', $cart_total);
            session()->put('cart_count', count($cart_items));

            return response()->json([
                'status' => 'success',
                'message' => 'Produk berhasil ditambahkan ke keranjang',
                'data' => [
                    'cart_items' => view('cart.cart_items')->render(),
                    'cart_total' => 'Rp '.number_format($cart_total),
                    'cart_item_count' => count($cart_items),
                ],
            ]);
        }catch(\Exception $e){
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ], 500);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            $cart_items = session()->get('cart_items', []);
            $cart_total = 0;

            if(array_key_exists($id, $cart_items)){
                unset($cart_items[$id]);
            }

            foreach($cart_items as $item){
                $cart_total += $item['produk']->harga * $item['qty'];
            }

            session()->put('cart_items', $cart_items);
            session()->put('cart_total', $cart_total);
            session()->put('cart_count', count($cart_items));

            return response()->json([
                'status' => 'success',
                'message' => 'Produk berhasil ditambahkan ke keranjang',
                'data' => [
                    'cart_items' => view('cart.cart_items')->render(),
                    'cart_total' => 'Rp '.number_format($cart_total),
                    'cart_item_count' => count($cart_items),
                ],
            ]);
        }catch(\Exception $e){
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ], 500);
        }
    }

}
