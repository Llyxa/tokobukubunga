<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $itemuser = $request->user();//ambil data user
        $itemtransaksi = Transaction::where('user_id', $itemuser->id)
        ->where('status_cart', 'transactions')
        ->first();
        // dd($itemtransaksi);
        $data = array('title' => 'Shopping Cart',
                    'itemtransaksi' => $itemtransaksi);
        return view('transaksi.index', $data)->with('no', 1);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $itemtransaksi = Transaction::findOrFail($id);
        $itemtransaksi->detail()->delete();//hapus semua item di cart detail
        $itemtransaksi->updatetotal($itemtransaksi, '-'.$itemtransaksi->subtotal);
        return back()->with('success', 'Cart berhasil dikosongkan');

    }

}
