<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Genre;
use App\Models\Category;
use App\Models\Publisher;
use Psy\Util\Str;

class ProdukController extends Controller
{
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
            'genre_id' => 'required',
            'judul' => 'required|string',
            'penulis' => 'required|string',
            'sinopsis' => 'required|string',
            'harga' => 'required|numeric',
            'stok' => 'required|numeric',
            'image' => 'required',
            'image.*' => 'image|mimes:jpeg,png,jpg|max:2048'
        ]);

        // $genres = [];
        // foreach($request->genre_id as $genre){
        //     $genres[] = [
        //         'genre_id' => $genre
        //     ];
        // }

        $genres = implode(', ' , $request->genre_id);

        $imageName = time() . '.' . $request->image->extension();
        $request->image->move(public_path() . '/storage/foto/', $imageName);

        $produk = new Product();
        $produk->category_id =$request->category_id;
        $produk->publisher_id =$request->publisher_id;
        $produk->genre_id = $genres;
        $produk->image = $imageName;
        $produk->judul =$request->judul;
        $produk->penulis =$request->penulis;
        $produk->sinopsis =$request->sinopsis;
        $produk->harga =$request->harga;
        $produk->stok = $request->stok;
        $produk->save();
        

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

        $genre = Genre::all();
        $genreArray = implode(',', $genre);
        $genres = Genre::select("*")
                        ->whereIn('id', $genreArray)
                        ->get();
    
        // dd($genres);
        return view('admin.produk.detail', $data, $genres);
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

    public function checkout(){
        $data['product'] = Product::all();
        return view('admin.checkout.index', $data);
    }



}

