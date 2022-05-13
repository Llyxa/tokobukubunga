<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Pengiriman extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['pengiriman'] = Delivery::all();
        return view('admin.pengiriman.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pengiriman.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Start Validation
        $rules = [
            'pengiriman' => 'required|unique:delivery',
        ];

        $customMessages = [
            'pengiriman.required' => 'pengiriman wajib diisi!',
            'pengiriman.unique' => 'pengiriman sudah digunakan!',
        ];

        $this->validate($request, $rules, $customMessages);

        //Start Input
        $input = $request->all();
        $status = Delivery::create($input);

        if ($status){
            return redirect()->route('pengiriman.index')->with('success', 'Data Warna berhasil ditambahkan');
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
        $data['pengiriman'] = Delivery::find($id);
        return view('admin.pengiriman.form', $data);
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
        //Start Validation
        $rules = [
            'pengiriman' => 'required|unique:delivery',
        ];

        $customMessages = [
            'pengiriman.required' => 'pengiriman wajib diisi!',
            'pengiriman.unique' => 'pengiriman sudah digunakan!',
        ];

        $this->validate($request, $rules, $customMessages);

        //Start Input
        $pengiriman = Delivery::find($id);
        $update = $request->all();
        $status = $pengiriman->update($update);

        if ($status){
            return redirect()->route('pengiriman.index')->with('success', 'Data berhasil diubah');
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
        $pengiriman = Delivery::find($id);
        $status = $pengiriman->delete();
        if ($status){
            return 1;
        }else{
            return 0;
        }

    }

}
