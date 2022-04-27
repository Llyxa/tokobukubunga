<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Publisher;
use Psy\Util\Str;

class PenerbitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['penerbit'] = Publisher::all();
        return view('admin.penerbit.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.penerbit.form');
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
            'penerbit' => 'required|unique:publishers',
        ];

        $customMessages = [
            'penerbit.required' => 'penerbit wajib diisi!',
            'penerbit.unique' => 'penerbit sudah digunakan!',
        ];

        $this->validate($request, $rules, $customMessages);

        //Start Input
        $input = $request->all();
        $status = Publisher::create($input);

        if ($status){
            return redirect()->route('penerbit.index')->with('success', 'Data Warna berhasil ditambahkan');
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
        $data['penerbit'] = Publisher::find($id);
        return view('admin.penerbit.form', $data);
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
            'penerbit' => 'required|unique:publishers',
        ];

        $customMessages = [
            'penerbit.required' => 'penerbit wajib diisi!',
            'penerbit.unique' => 'penerbit sudah digunakan!',
        ];

        $this->validate($request, $rules, $customMessages);

        //Start Input
        $penerbit = Publisher::find($id);
        $update = $request->all();
        $status = $penerbit->update($update);

        if ($status){
            return redirect()->route('penerbit.index')->with('success', 'Data berhasil diubah');
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
        $penerbit = Publisher::find($id);
        $status = $penerbit->delete();
        if ($status){
            return 1;
        }else{
            return 0;
        }

    }

    
}
