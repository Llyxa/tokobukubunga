<?php

// namespace App\Http\Controllers;

// use App\Models\Genre;
// use App\Models\Product;
// use App\Models\Category;
// use App\Models\Publisher;
// use Illuminate\Http\Request;

// class BukuController extends Controller
// {

    // public function tambah(){
    //     $publisher = Publisher::all();
    //     $category = Category::all();
    //     $genre = Genre::all();
    //     $product = Product::all();
    //     return view('tambah', compact('publisher', 'category', 'genre', 'product'));
    // }

    // public function insert(Request $request){
    //     // // dd($request->all());
    //     // if(!empty($request->input('genre'))){
    //     //     $checkbox = join('', $request->input('genre'));
    //     //     Genre::('products')->insert(['genre'=>checkbox]);
    //     // } else{
    //     //     $checkbox = '';
    //     // }
    //     $request->validate([
    //         'category_id' => 'required',
    //         'publisher_id' => 'required',
    //         'genre_id' => 'required',
    //         'judul' => 'required|string',
    //         'penulis' => 'required|string',
    //         'sinopsis' => 'required|string',
    //         'harga' => 'required|numeric',
    //         'stok' => 'required|numeric',
    //         'image' => 'required',
    //         'image.*' => 'image|mimes:jpeg,png,jpg|max:2048'
    //     ]);
    //     $imageName = time() . '.' . $request->image->extension();
    //     $request->image->move(public_path() . '/storage/foto/', $imageName);
    //     Product::create([
    //         'category_id' => $request['category_id'],
    //         'publisher_id' => $request['publisher_id'],
    //         'genre_id' => $request['genre_id'],
    //         'judul' => $request['judul'],
    //         'penulis' => $request['penulis'],
    //         'sinopsis' => $request['sinopsis'],
    //         'harga' => $request['harga'],
    //         'stok' => $request['stok'],
    //         'image' => $imageName
    //     ]);
    //     return redirect()->route('home')->with('success ',' Data Berhasi di Tambahkan. ');
    // }

    // public function detail($id){
    //     $product = Product::find($id);
    //     $publisher = Publisher::all();
    //     $category = Category::all();
    //     $genre = Genre::all(); 
    //     return view('detail', compact('product', 'publisher', 'category', 'genre'));
    // }

    // public function tampilkandata($id){
    //     $publisher = Publisher::all();
    //     $category = Category::all();
    //     $genre = Genre::all();
    //     $product = Product::find($id);
    //     return view('edit', compact('product', 'publisher', 'category', 'genre'));
    // }

    // public function updatedata(Request $request, $id){
    //     $product = Product::find($id);
    //     $request->validate([
    //         'category_id' => 'required',
    //         'publisher_id' => 'required',
    //         'genre_id' => 'required',
    //         'judul' => 'required|string',
    //         'penulis' => 'required|string',
    //         'sinopsis' => 'required|string',
    //         'harga' => 'required|numeric',
    //         'stok' => 'required|numeric',
    //         // 'image' => 'required',
    //         // 'image.*' => 'image|mimes:jpeg,png,jpg|max:2048'
    //     ]);
    //     $dataUpdate =  [
    //         'category_id' => $request['category_id'],
    //         'publisher_id' => $request['publisher_id'],
    //         'genre_id' => $request['genre_id'],
    //         'judul' => $request['judul'],
    //         'penulis' => $request['penulis'],
    //         'sinopsis' => $request['sinopsis'],
    //         'harga' => $request['harga'],
    //         'stok' => $request['stok']
    //     ];
    //     if($request->image){
    //         $imageName = time() . '.' . $request->image->extension();
    //         $request->image->move(public_path() . '/storage/foto/', $imageName);
    //         $dataUpdate['image'] = $imageName;
    //     }
    //     $product = $product->update($dataUpdate);
        
    //     return redirect()->route('home')->with('success', 'Buku berhasil diedit.');
    // }

    // public function delete($id){
    //     $product = Product::find($id);
    //     $product->delete();
    //     return redirect()->route('home')->with('berhasil', 'Buku berhasil dihapus.');  
    // }

    // public function categories(Category $category){
    //     return view('categories', [
    //         'kategori' => $category->kategori,
    //         'categories' => Category::all()
    //     ]);
    
    // }

    // public function category(Category $category){
    //     return view('category', [
    //         'category' => $category->kategori,
    //         'products' => $category->products
    //     ]);
    // }

    // public function genres(Genre $genre){
    //     return view('genres', [
    //         'genre' => $genre->genre,
    //         'genres' => Genre::all()
    //     ]);
    // }

    // public function genre(Genre $genre){
    //     return view('genre', [
    //         'genre' => $genre->genre,
    //         'products' => $genre->products
    //     ]);
    // }

// }

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
        $request->validate([
            'category_id' => 'required',
            'publisher_id' => 'required',
            'genre_id' => 'accepted',
            'judul' => 'required|string',
            'penulis' => 'required|string',
            'sinopsis' => 'required|string',
            'harga' => 'required|numeric',
            'stok' => 'required|numeric',
            'image' => 'required',
            'image.*' => 'image|mimes:jpeg,png,jpg|max:2048'
        ]);
        $imageName = time() . '.' . $request->image->extension();
        $request->image->move(public_path() . '/storage/foto/', $imageName);
        $produk = Product::create([
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
            return redirect()->route('produk.index')->with('success', 'Data berhasil ditambahkan');
        } else {
            return redirect()->route('produk.create')->with('error', 'Data gagal ditambahkan');
        }
        
        //Start Validation
        // $rules = [
        //     'produk' => 'required|unique:produks',
        // ];

        // $customMessages = [
        //     'produk.required' => 'Produk wajib diisi!',
        //     'produk.unique' => 'Produk sudah digunakan!',
        // ];

        // $this->validate($request, $rules, $customMessages);

        // //Start Input
        // $input = $request->all();
        // $status = Produk::create($input);

        // if ($status){
        //     return redirect()->route('produk.index')->with('success', 'Data berhasil ditambahkan');
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
        $data['product'] = Product::find($id);
        $data['publisher'] = Publisher::find($id);
        $data['category'] = Category::find($id);
        $data['genre'] = Genre::find($id);
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

}

