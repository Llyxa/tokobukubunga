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
        // $cart_items = Cart::where('user_id', Auth::id())->get();
        // return view('cart.index', compact('cart_items'));
        return abort('404');
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
            'product_id' => 'required',
        ]);
        $itemuser = $request->user();
        $itemproduk = Product::findOrFail($request->product_id);
        // cek dulu apakah sudah ada shopping cart untuk user yang sedang login
        $transaksi = Transaction::where('user_id', $itemuser->id)
                    ->where('status_cart', 'transactions')
                    ->first();
        if ($transaksi) {
            $itemtransaksi = $transaksi;
        } else {
            $no_invoice = Transaction::where('user_id', $itemuser->id)->count();
            //nyari jumlah cart berdasarkan user yang sedang login untuk dibuat no invoice
            $inputancart['user_id'] = $itemuser->id;
            $inputancart['no_invoice'] = 'INV '.str_pad(($no_invoice + 1),'3', '0', STR_PAD_LEFT);
            $inputancart['status_cart'] = 'cart';
            $inputancart['status_pembayaran'] = 'belum';
            $inputancart['status_pengiriman'] = 'belum';
            $itemtransaksi = Transaction::create($inputancart);
        }
        // cek dulu apakah sudah ada produk di shopping cart
        $cekdetail = Transaction::where('transaction_id', $itemtransaksi->id)
                                ->where('product_id', $itemproduk->id)
                                ->first();
        $qty = 1;// diisi 1, karena kita set ordernya 1
        $harga = $itemproduk->harga;//ambil harga produk
        $diskon = $itemproduk->promo != null ? $itemproduk->promo->diskon_nominal: 0;
        $subtotal = ($qty * $harga) - $diskon;
        // diskon diambil kalo produk itu ada promo, cek materi sebelumnya
        if ($cekdetail) {
            // update detail di table cart_detail
            $cekdetail->updatedetail($cekdetail, $qty, $harga, $diskon);
            // update subtotal dan total di table cart
            $cekdetail->transaction->updatetotal($cekdetail->transaction, $subtotal);
        } else {
            $inputan = $request->all();
            $inputan['transaction_id'] = $itemtransaksi->id;
            $inputan['product_id'] = $itemproduk->id;
            $inputan['qty'] = $qty;
            $inputan['harga'] = $harga;
            $inputan['diskon'] = $diskon;
            $inputan['subtotal'] = ($harga * $qty) - $diskon;
            $itemdetail = Cart::create($inputan);
            // update subtotal dan total di table cart
            $itemdetail->transaction->updatetotal($itemdetail->transaction, $subtotal);
        }
        return redirect()->route('transaksi.index')->with('success', 'Produk berhasil ditambahkan ke cart');
        // $request->validate([
        //     'product_id' => 'required',
        //     'user_id' => 'required',
        //     'qty' => 'required',
        //     'subtotal' => 'required'
        // ]);

        // $product = Product::id();
        // $user = Auth::id();

        // $produk = Product::create([
        //     'product_id' => $product,
        //     'user_id' => $user,
        //     'qty' => $request['qty'],
        //     'subtotal' => $request['subtotal']
        // ]);

        // $produk =  url()->previous();
        // $produk = collect(str_split($produk));
        // $produk = $produk->splice(26)->implode('');
        // $validatedData = $request->validate([
        //     'product_id' => 'required',
        //     'user_id' => 'required',
        //     'qty' => 'required',
        //     'subtotal' => 'required'
        // ]);
        
        // $carts = Cart::all()->where('product_id', '==', $produk)
        //                     ->where('user_id', '==', Auth::user()->id)
        //                     ->first();

        // if ($carts) {
        //     $resultQty = $carts->qty += $validatedData['qty'];
        //     $resultPriceTotal = $carts->subtotal += $validatedData['subtotal'];
        //     $tes = $cart->where('id', $carts->id)->update([
        //         'qty' => $resultQty,
        //         'subtotal' => $resultPriceTotal
        //     ]);
        //     return redirect(route('product.detail'))->with('success', 'Success Add to Cart');
        // } else {
        //     Cart::create($validatedData);
        //     return redirect(route('product.detail'))->with('success', 'Success Added a Product to Cart');
        // }

        // dd($request);
        // $produk = $request->input('id');
        // $kuantitas = $request->input('qty');
        // $prod_check = Product::where('id', $produk)->first();
        
        // if ($prod_check) {
        //     $cart_item = new Cart();
        //     $cart_item->product_id = $produk;
        //     $cart_item->user_id = Auth::id();
        //     $cart_item->qty = $kuantitas;
        //     $cart_item->save;

        //     return response()->json(['status' => $prod_check->judul. " added to cart"]);
        // } 
        // else 
        // {
        //     return response()->json(['status' => "Cannot added to cart"]);
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
        $itemdetail = Cart::findOrFail($id);
        $param = $request->param;
        
        if ($param == 'tambah') {
            // update detail cart
            $qty = 1;
            $itemdetail->updatedetail($itemdetail, $qty, $itemdetail->harga, $itemdetail->diskon);
            // update total cart
            $itemdetail->transaction->updatetotal($itemdetail->transaction, ($itemdetail->harga - $itemdetail->diskon));
            return back()->with('success', 'Item berhasil diupdate');
        }
        if ($param == 'kurang') {
            // update detail cart
            $qty = 1;
            $itemdetail->updatedetail($itemdetail, '-'.$qty, $itemdetail->harga, $itemdetail->diskon);
            // update total cart
            $itemdetail->transaction->updatetotal($itemdetail->transaction, '-'.($itemdetail->harga - $itemdetail->diskon));
            return back()->with('success', 'Item berhasil diupdate');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cart $cart)
    {
        $itemdetail = Cart::findOrFail($id);
        // update total cart dulu
        $itemdetail->transaction->updatetotal($itemdetail->transaction, '-'.$itemdetail->subtotal);
        if ($itemdetail->delete()) {
            return back()->with('success', 'Item berhasil dihapus');
        } else {
            return back()->with('error', 'Item gagal dihapus');
        }
    }

}
