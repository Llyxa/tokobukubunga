<?php

namespace App\Http\Controllers;

use Psy\Util\Str;
use App\Models\Genre;
use App\Models\Product;
use App\Models\Category;
use App\Models\Publisher;
use App\Models\GenreProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProdukController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['produk'] = Product::all();
        return view('admin.produk.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['kategori'] = Category::all();
        $data['genre'] = Genre::all();
        $data['penerbit'] = Publisher::all();
        return view('admin.produk.form', $data );
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
        $request->validate([
            'category_id' => 'required',
            'publisher_id' => 'required',
            'judul' => 'required|string',
            'penulis' => 'required|string',
            'sinopsis' => 'required|string',
            'harga' => 'required|numeric',
            'stok' => 'required|numeric',
            'image' => 'required',
            'image.*' => 'image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $genres = implode(', ' , $request->genre_id);
        $imageName = time() . '.' . $request->image->extension();
        $request->image->move(public_path() . '/storage/foto/', $imageName);

        $produk = Product::create([
            'category_id' => $request['category_id'],
            'publisher_id' => $request['publisher_id'],
            'genre_id' => $genres,
            'judul' => $request['judul'],
            'penulis' => $request['penulis'],
            'sinopsis' => $request['sinopsis'],
            'harga' => $request['harga'],
            'stok' => $request['stok'],
            'image' => $imageName
        ]);

        $genress = $request->genre_id;
        foreach($genress as $genre){
           GenreProduct::create ([
                'product_id' => $produk->id,
                'genre_id' => $genre
            ]);
        }

        

        // Product::create($produk);

        if ($produk){
            return redirect()->route('produk.index')->with('success', 'Data berhasil ditambahkan');
        } else {
            return redirect()->route('produk.create')->with('error', 'Data gagal ditambahkan');
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
        
        $data['product'] = Product::find($id);
        $data['publisher'] = Publisher::all();
        $data['category'] = Category::all();
        // $data['genre'] = Genre::all();
        $data['genre'] = DB::table('genres')->where('genre')->get();
        // $genreArray = explode(',', $genre);
        // Genre::select("*")->whereIn('id', $genreArray)->get();
        // $genre = Genre::all();
        // Genre::where('id', 'genre')->get();

        return view('admin.produk.detail', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['produk'] = Product::find($id);
        $data['kategori'] = Category::all();
        $data['genre'] = Genre::all();
        $data['penerbit'] = Publisher::all();
        return view('admin.produk.form', $data);
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
        $request->validate([
            'category_id' => 'required',
            'publisher_id' => 'required',
            'genre_id' => 'accepted',
            'judul' => 'required|string',
            'penulis' => 'required|string',
            'sinopsis' => 'required|string',
            'harga' => 'required|numeric',
            'stok' => 'required|numeric',
        ]);
        $produk = Product::find($id);

        if ($request->image){
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path() . '/storage/foto/', $imageName);
        } else {
            $imageName = $produk->image;
        }

        $produk->update([
            'category_id' => $request['category_id'],
            'publisher_id' => $request['publisher_id'],
            'genre_id' => $request['genre_id'],
            'judul' => $request['judul'],
            'penulis' => $request['penulis'],
            'sinopsis' => $request['sinopsis'],
            'harga' => $request['harga'],
            'stok' => $request['stok'],
            'image' => $imageName
        ]);

        if ($produk){
            return redirect()->route('produk.index')->with('success', 'Data berhasil diubah');
        } else {
            return redirect()->route('produk.create')->with('error', 'Data gagal diubah');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
        $produk = Product::find($id);
        $status = $produk->delete();
        if ($status){
            return redirect()->route('produk.index')->with('success','Data berhasil dihapus');
        }else{
            return redirect()->route('produk.detail')->with('error','Data gagal dihapus');
        }
    }

    // public function checkout(Request $request, $id){
    //     dd('hai');
    // }



}

