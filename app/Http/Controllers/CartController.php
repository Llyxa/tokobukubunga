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
        } else {
            Cart::create([
            'transaction_id' => $itemtransaksi->id,
            'user_id' => $itemuser,
            'product_id' => $itemproduk->id,
            'qty' => $qty,
            // 'harga' => $harga,
            'subtotal' => $subtotal
            ]);
        }

        // public function updatedetail($itemdetail, $qty, $harga) {
        //     $this->attributes['qty'] = $itemdetail->qty + $qty;
        //     $this->attributes['subtotal'] = $itemdetail->subtotal + ($qty * $harga);
        //     self::save();
        // }

        // if ($carts) {
        //     $carts->updatedetail($carts, $qty, $harga, $subtotal);
        // } else {
            // $inputan = $request->all();
            // $inputan['user_id'] = $itemuser;
            // $inputan['product_id'] = $itemproduk->id;
            // $inputan['qty'] = $qty;
            // $inputan['harga'] = $harga;
            // $inputan['subtotal'] = ($harga * $qty);
            // $itemdetail = Cart::create($inputan);
        // }

        return redirect()->route('produk.index'); // ->with('success', 'Data berhasil ditambahkan');
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
    public function update(Request $request, $id)
    {
        $itemdetail = Cart::findOrFail($id);
        $param = $request->param;
        
        if ($param == 'tambah') {
            // update detail cart
            $qty = 1;
            $itemdetail->updatedetail($itemdetail, $qty, $itemdetail->harga);
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
