@extends('layouts.app')
@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home</title>
    <style>
    body{
        background-color: #ffffff;
    }
    .container {
        color: rgb(0, 0, 0);
        padding: 10px;
    }
    h1{
        font-size: 65px;
        margin: 10px;
    }
    a.button{
        display:inline-block;
        padding:0.35em 1.2em;
        border:0.1em solid #000000;
        margin: 10px;
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

    /* Float four columns side by side */
    .column {
        float: left;
        padding: 15px 15px 15px 15px;

    }

    /* Remove extra left and right margins, due to padding */
    .row {margin: 0 -5px;}

    /* Clear floats after the columns */
    .row:after {
        content: "";
        display: table;
        clear: both;
    }

    /* Responsive columns */
    @media screen and (max-width: 600px) {
        .column {
            width: 100%;
            display: block;
            margin-bottom: 20px;
        }
    }

    /* Style the counter cards */
    .card {
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
        padding: 16px;
        text-align: center;
        background-color: #ffffff;
        width: 200px;
        height: 100%;
        border-radius: 10px;
        position: flex;
        transition: transform .2s;
    }
    .card:hover{
        transform: scale(1.1);
    }
    .card .nama{
        font-size: 30px;
        margin: 20px;
    }
    .card img{
        width: 100%;
        height: 245px;
    }
    .card p{
        font-size: 16px;
        margin: 10px;
    }
    img .box {
        width: 100px;
        height: 500px;
    }
    /* .apa {
        margin: 10px 10px 10px 10px;
        position: absolute;
        border: 1px solid rgb(34, 34, 34);
    } */
    </style>
</head>
<body>
    {{-- @if (auth()->user()->level == "admin") --}}
    <a href="/tambah" class="button">Tambah</a>
    {{-- @endif --}}
    {{-- Recently Uppload --}}
    {{-- <h1>Recently Upload</h1> --}}
    <center><div class="apa">
        @foreach ($produk as $item)
        <div class="column">
            <div class="card">
                <a href="/detail/{{$item->id}}">
                    <img src="{{ asset ('storage/foto/'. $item->image) }}" alt="" class="box">
                </a>
                <p>{{$item->judul}}</p>
                <p>{{$item->penulis}}</p>
            </div>
        </div>
        @endforeach
    </div></center>

    {{-- <br>
    <h1>Novel Update</h1>
    <div class="apa">
        @foreach ($products as $kategorii)
        <div class="column">
            <div class="card">
            <a href="/detail/{{$kategorii->id}}">
                <img src="{{ asset ('storage/foto/'.$kategorii->image) }}" alt="" class="box">
            </a>
            <p>{{$kategorii->judul}}</p>
            <p>{{$kategorii->penulis}}</p>
        
            </div>
        </div>
        @endforeach
    </div> --}}

    {{-- <br>
    <h1>Fantasi Upload</h1>
    <div class="apa">
        @foreach ($genre as $genree)
        <div class="column">
            <div class="card">
            <a href="/detail/{{$genree->id}}">
                <img src="{{ asset ('storage/foto/'.$genree->image) }}" alt="" class="box">
            </a>
            <p>{{$genree->judul}}</p>
            <p>{{$genree->penulis}}</p>
            </div>
        </div>
        @endforeach
    </div> --}}

</body>
</html>
@endsection