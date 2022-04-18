@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="inicss/style.css">
    <title>Detail</title>
    <style>
        body{
            background-color: #ffffff;
        }
        .container {
            color: rgb(0, 0, 0);
            padding: 10px;
        }
        h1{
            font-size: 55px;
        }
        h2{
            font-size: 20px;
        }
        a.button{
            display:inline-block;
            padding:0.35em 1.2em;
            border:0.1em solid #000000;
            margin-left: 10px;
            border-radius:0.12em; 
            box-sizing: border-box;
            text-decoration:none;
            font-weight:300;
            color:#000000;
            text-align:center;
            transition: all 0.1s;
            font-size: 17px;
            border-radius: 15px;
        }
        a.button:hover{
            color:white;
            background-color:#000000;
        }
    
        .card img{
            width: 15%;
            float: left;
            border-radius: 10px;
            margin: 10px;
        }
        .card .nama{
            font-size: 30px;
            margin: 20px;
            float: left;
        }
        .card p{
            font-size: 16px;
            margin: 10px;
            color: #000000;
        }

        /* Style the counter cards */
        .card {
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
            padding: 16px;
            text-align: left;
            background-color: #ffffff;
            width: 90%;
            border-radius: 10px;
        }

        .info{
            float: left;
            text-align: left;
        }
        .a {
        color: #000000;
        text-decoration:none;
        
        }
        #link:hover{
            color: gray;
        }  
    </style>
</head>
<body>
    <br>
    <center><div class="apa">
        <div class="card">
            <img src="{{ asset ('storage/foto/'.$product->image) }}" alt="" class="box">
            <div class="info">
                <h1 class="a">{{$product->judul}}</h1>
                <h2 class="a">{{$product->penulis}}</h2>
                <p class="a">{{$product->sinopsis}}</p><br>
                <p>Informasi Lainnya </p>
                    <p>Penerbit:
                        <a href="/penerbit/{{$product->publisher->penerbit}}" class="a" id="link">{{$product->publisher->penerbit}}</a><br>
                    </p>
                    {{-- <li>Tanggal terbit</li> --}}
                    {{-- <li>{{$product->id}}</li> ISBN --}}
                    <p>Kategori:
                        <a href="/category/{{$product->category->kategori}}" class="a" id="link">{{$product->category->kategori}}</a><br>
                    </p>
                    <p>Genre:
                        <a href="/genre/{{$product->genre->genre}}" class="a" id="link">{{$product->genre->genre}}</a> <br>
                    </p>
                    <p>
                        <a href="{{URL('/keranjang')}}" class="button" style="margin-left: 0;">Masukkan Keranjang +</a>
                        <a href="{{URL('/checkout')}}" class="button">Checkout</a>
                    </p>
                    {{-- @foreach($genre->genre as $value)
                        <a href="">{{$value}}</a>
                    @endforeach --}}
                    {{-- @if (auth()->user()->level == "admin") --}}
                    <a href="/tampilkandata/{{ $product->id }}" class="button">Edit</a>
                    <a href="/delete/{{ $product->id }}" class="button">Hapus</a> 
                    {{-- @endif                 --}}
            </div>
        </div>
    </div></center><br>
</body>
</html>
@endsection