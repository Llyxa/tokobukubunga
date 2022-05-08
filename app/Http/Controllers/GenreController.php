<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Genre;
use Psy\Util\Str;

class GenreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['genre'] = Genre::all();
        return view('admin.genre.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // return "Hello World";
        return view('admin.genre.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        //Start Validation
        $rules = [
            'genre' => 'required|unique:genres',
        ];

        $customMessages = [
            'genre.required' => 'Genre wajib diisi!',
            'genre.unique' => 'Genre sudah digunakan!',
        ];

        $this->validate($request, $rules, $customMessages);

        //Start Input
        $input = $request->all();
        $status = Genre::create($input);

        if ($status){
            return redirect()->route('genre.index')->with('success', 'Data berhasil ditambahkan');
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
        $data['genre'] = Genre::find($id);
        return view('admin.genre.form', $data);
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
            'genre' => 'required|unique:genres',
        ];

        $customMessages = [
            'genre.required' => 'Genre wajib diisi!',
            'genre.unique' => 'Genre sudah digunakan!',
        ];

        $this->validate($request, $rules, $customMessages);

        //Start Input
        $genre = Genre::find($id);
        $update = $request->all();
        $status = $genre->update($update);

        if ($status){
            return redirect()->route('genre.index')->with('success', 'Data berhasil diubah');
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
        $genre = Genre::find($id);
        $status = $genre->delete();
        if ($status){
            return 1;
        } else {
            return 0;
        }
    }

}
