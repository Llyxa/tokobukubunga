<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Psy\Util\Str;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['kategori'] = Category::all();
        return view('admin.kategori.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.kategori.form');
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
            'kategori' => 'required|unique:categories',
        ];

        $customMessages = [
            'kategori.required' => 'Warna wajib diisi!',
            'kategori.unique' => 'Warna sudah digunakan!',
        ];

        $this->validate($request, $rules, $customMessages);

        //Start Input
        $input = $request->all();
        $status = Category::create($input);

        if ($status){
            return redirect()->route('kategori.index')->with('success', 'Data Warna berhasil ditambahkan');
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
        $data['kategori'] = Category::find($id);
        return view('admin.kategori.form', $data);
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
            'kategori' => 'required|unique:categories',
        ];

        $customMessages = [
            'kategori.required' => 'Kategori wajib diisi!',
            'kategori.unique' => 'Kategori sudah digunakan!',
        ];

        $this->validate($request, $rules, $customMessages);

        //Start Input
        $kategori = Category::find($id);
        $update = $request->all();
        $status = $kategori->update($update);

        if ($status){
            return redirect()->route('kategori.index')->with('success', 'Data berhasil diubah');
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
        $kategori = Category::find($id);
        $status = $kategori->delete();
        if ($status){
            return 1;
        }else{
            return 0;
        }

    }

    
}
