<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CaraBayarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['cara_bayar'] = PaymentOption::all();
        return view('admin.cara_bayar.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.cara_bayar.form');
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
            'cara_bayar' => 'required|unique:cara_bayar',
        ];

        $customMessages = [
            'cara_bayar.required' => 'cara_bayar wajib diisi!',
            'cara_bayar.unique' => 'cara_bayar sudah digunakan!',
        ];

        $this->validate($request, $rules, $customMessages);

        //Start Input
        $input = $request->all();
        $status = PaymentOption::create($input);

        if ($status){
            return redirect()->route('cara_bayar.index')->with('success', 'Data berhasil ditambahkan');
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
        $data['cara_bayar'] = PaymentOption::find($id);
        return view('admin.cara_bayar.form', $data);
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
            'cara_bayar' => 'required|unique:cara_bayar',
        ];

        $customMessages = [
            'cara_bayar.required' => 'cara_bayar wajib diisi!',
            'cara_bayar.unique' => 'cara_bayar sudah digunakan!',
        ];

        $this->validate($request, $rules, $customMessages);

        //Start Input
        $cara_bayar = PaymentOption::find($id);
        $update = $request->all();
        $status = $cara_bayar->update($update);

        if ($status){
            return redirect()->route('cara_bayar.index')->with('success', 'Data berhasil diubah');
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
        $cara_bayar = PaymentOption::find($id);
        $status = $cara_bayar->delete();
        if ($status){
            return 1;
        }else{
            return 0;
        }

    }

}
