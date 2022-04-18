<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use App\Models\Product;
use App\Models\Category;
use App\Models\Publisher;
use Illuminate\Http\Request;

class BukuController extends Controller
{
    public function home(){
        $produk = Product::all();
        $publisher = Publisher::all();
        $category = Category::all();
        $genre = Genre::all();
        return view('home', compact('produk', 'publisher', 'category', 'genre'));
        // return view('home', [
        //     'genre' => $genre->genre,
        //     'productsgenre' => $genre->products
        // ], 
        // [
        //     'category' => $category->kategori,
        //     'products' => $category->products
        // ],
        // compact('produk', 'publisher' ));
        // return view('home',
        // [
        //     'category' => $category->kategori,
        //     'products' => $category->products
        // ],
        // compact('produk', 'publisher' ));
    }

    public function tambah(){
        $publisher = Publisher::all();
        $category = Category::all();
        $genre = Genre::all();
        $product = Product::all();
        return view('tambah', compact('publisher', 'category', 'genre', 'product'));
    }

    public function insert(Request $request){
        // // dd($request->all());
        // if(!empty($request->input('genre'))){
        //     $checkbox = join('', $request->input('genre'));
        //     Genre::('products')->insert(['genre'=>checkbox]);
        // } else{
        //     $checkbox = '';
        // }
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
        $imageName = time() . '.' . $request->image->extension();
        $request->image->move(public_path() . '/storage/foto/', $imageName);
        Product::create([
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
        return redirect()->route('home')->with('success ',' Data Berhasi di Tambahkan. ');
    }

    public function detail($id){
        $product = Product::find($id);
        $publisher = Publisher::all();
        $category = Category::all();
        $genre = Genre::all(); 
        return view('detail', compact('product', 'publisher', 'category', 'genre'));
    }

    public function tampilkandata($id){
        $publisher = Publisher::all();
        $category = Category::all();
        $genre = Genre::all();
        $product = Product::find($id);
        return view('edit', compact('product', 'publisher', 'category', 'genre'));
    }

    public function updatedata(Request $request, $id){
        $product = Product::find($id);
        $request->validate([
            'category_id' => 'required',
            'publisher_id' => 'required',
            'genre_id' => 'required',
            'judul' => 'required|string',
            'penulis' => 'required|string',
            'sinopsis' => 'required|string',
            'harga' => 'required|numeric',
            'stok' => 'required|numeric',
            // 'image' => 'required',
            // 'image.*' => 'image|mimes:jpeg,png,jpg|max:2048'
        ]);
        $dataUpdate =  [
            'category_id' => $request['category_id'],
            'publisher_id' => $request['publisher_id'],
            'genre_id' => $request['genre_id'],
            'judul' => $request['judul'],
            'penulis' => $request['penulis'],
            'sinopsis' => $request['sinopsis'],
            'harga' => $request['harga'],
            'stok' => $request['stok']
        ];
        if($request->image){
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path() . '/storage/foto/', $imageName);
            $dataUpdate['image'] = $imageName;
        }
        $product = $product->update($dataUpdate);
        
        return redirect()->route('home')->with('success', 'Buku berhasil diedit.');
    }

    public function delete($id){
        $product = Product::find($id);
        $product->delete();
        return redirect()->route('home')->with('berhasil', 'Buku berhasil dihapus.');  
    }

    public function categories(Category $category){
        return view('categories', [
            'kategori' => $category->kategori,
            'categories' => Category::all()
        ]);
    }

    public function category(Category $category){
        return view('category', [
            'category' => $category->kategori,
            'products' => $category->products
        ]);
    }

    public function genres(Genre $genre){
        return view('genres', [
            'genre' => $genre->genre,
            'genres' => Genre::all()
        ]);
    }

    public function genre(Genre $genre){
        return view('genre', [
            'genre' => $genre->genre,
            'products' => $genre->products
        ]);
    }

    // public function checkout(){

    // }
}
