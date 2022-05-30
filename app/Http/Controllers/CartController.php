<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use App\Models\Transaction;
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
        // $data['keranjang'] = Cart::where('user_id', '=', Auth::user()->id)->get();
        return abort('404');
        // $data['carts'] = Cart::all();
        // return view('admin.produk.index', $data);
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
        $this->validate($request, [
            // 'user_id' => 'required',
            'product_id' => 'required',
        ]);
        $itemuser = Auth::user()->id;
        $itemproduk = Product::findOrFail($request->product_id);
        // $carts = Cart::where('user_id', Auth::user()->id);

        $cart = Transaction::where('user_id', $itemuser)
        ->where('status_cart', 'cart')
        ->first();

        if ($cart) {
            $itemtransaksi = $cart;
        } else {
            $no_invoice = Transaction::where('user_id', $itemuser)->count();
            //nyari jumlah cart berdasarkan user yang sedang login untuk dibuat no invoice
            $inputancart['user_id'] = $itemuser;
            $inputancart['no_invoice'] = 'INV '.str_pad(($no_invoice + 1),'3', '0', STR_PAD_LEFT);
            $inputancart['status_cart'] = 'cart';
            $inputancart['status_pembayaran'] = 'belum';
            $inputancart['status_pengiriman'] = 'belum';
            $itemtransaksi = Transaction::create($inputancart);
        }

        $cekdetail = Cart::where('transaction_id', $itemtransaksi->id)
                                ->where('product_id', $itemproduk->id)
                                ->first();

        // $cekdetail = Cart::where('user_id', $itemuser)
        //                         ->where('product_id', $itemproduk->id)
        //                         ->first();
        $harga = $itemproduk->harga;
        $qty = 1; // qty diupdate di cart list
        $subtotal = ($qty * $harga);

        if ($cekdetail){
            // update detail di table cart_detail
            $cekdetail->updatedetail($cekdetail, $qty, $harga);
            // update subtotal dan total di table cart
            $cekdetail->transaction->updatetotal($cekdetail->transaction, $subtotal);
        } 
        else {
            Cart::create([
            'transaction_id' => $itemtransaksi->id,
            'user_id' => $itemuser,
            'product_id' => $itemproduk->id,
            'qty' => $qty,
            'subtotal' => $subtotal
            ]);
        }
        return redirect()->route('produk.index')->with('success', 'Data berhasil ditambahkan');
        // return view('admin.produk.index')->with('success', 'Produk berhasil ditambahkan ke cart');
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
        $validatedData = $request->validate([
            'qty' => 'required',
        ]);
        $harga = $cart->find($request->id)->produk->harga;
        $priceTotal = $harga * $validatedData['qty'];
        // $priceTotal = Cart::findOrFail($request->id)->produk->harga * $validatedData['qty'];
        $cart->find($request->id)->update($validatedData);
        $cart->find($request->id)->update(['subtotal' => $priceTotal]);

        // $validatedData = $request->validate([
        //     'qty' => 'required',
        // ]);

        // // $itemproduk = Product::findOrFail($request->product_id);
        // $harga = $itemproduk->harga;
        // // $qty = $cart->qty;
        // $subtotal = $harga * $validatedData['qty'];

        // $cart->update([
        //     // 'transaction_id' => $genres,
        //     // 'product_id' => $request['category_id'],
        //     // 'user_id' => $request['publisher_id'],
        //     'qty' => $qty,
        //     'subtotal' => $subtotal
        // ]);

        // $cart->update($validatedData['qty']);
        // $cart->update([
        //     'qty' => $validatedData['qty'],
        //     'subtotal' => $subtotal,
        // ]);

        // $itemuser = $request->user();
        // $allCart = Cart::where('user_id', $itemuser->id)->first();
        // $response = [
        //     "status"=>"success",
        //     "message"=>"Qty berhasil dirubah",
        //     "data"=>$allCart
        // ];

        return response()->json("Cart updated");

        // $itemdetail = Cart::findOrFail($id);
        // $param = $request->param;
        
        // if ($param == 'tambah') {
        //     // update detail cart
        //     $qty = 1;
        //     $itemdetail->updatedetail($itemdetail, $qty);
        //     // update total cart
        //     $itemdetail->transaction->updatetotal($itemdetail->transaction, ($harga));
        //     return back()->with('success', 'Item berhasil diupdate');
        // }

        // if ($param == 'kurang') {
        //     // update detail cart
        //     $qty = 1;
        //     $itemdetail->updatedetail($itemdetail, '-'.$qty);
        //     // update total cart
        //     $itemdetail->transaction->updatetotal($itemdetail->transaction, '-'.($harga));
        //     return back()->with('success', 'Item berhasil diupdate');
        //     // return redirect(route('product.index'))->with('success', 'Successfully Update Cart');
        // }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $itemdetail = Cart::findOrFail($id);
        // update total cart dulu
        $itemdetail->transaction->updatetotal($itemdetail->transaction, '-'.$itemdetail->subtotal);
        // if ($itemdetail->delete()) {
        //     return back()->with('success', 'Item berhasil dihapus');
        // } else {
        //     return back()->with('error', 'Item gagal dihapus');
        // }
        if ($itemdetail){
            return redirect()->route('produk.index')->with('success','Produk berhasil dihapus dari cart');
        }else{
            return redirect()->route('produk.index')->with('error','Produk gagal dihapus dari cart');
        }
    }
}

