@extends('layouts.app')

@section('content')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tambah</title>
    <style>
    * {
    box-sizing: border-box;
    }

    input[type=text], select, textarea {
    width: 100%;
    padding: 12px;
    border: 1px solid #ccc;
    border-radius: 4px;
    resize: vertical;
    }

    textarea{
        height: 100px;
    }

    label {
    padding: 12px 12px 12px 0;
    display: inline-block;
    }

    input[type=submit] {
    background-color: #04AA6D;
    color: white;
    padding: 12px 20px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    float: right;
    }

    input[type=submit]:hover {
    background-color: #45a049;
    }

    .container {
    border-radius: 5px;
    background-color: #f2f2f2;
    padding: 20px;
    width: 100%;
    }

    .col-25 {
    float: left;
    width: 25%;
    margin-top: 6px;
    }

    .col-75 {
    float: left;
    width: 75%;
    margin-top: 6px;
    }

    /* Clear floats after the columns */
    .row:after {
    content: "";
    display: table;
    clear: both;
    }
    /* Responsive layout - when the screen is less than 600px wide, make the two columns stack on top of each other instead of next to each other */
    @media screen and (max-width: 600px) {
    .col-25, .col-75, input[type=submit] {
        width: 100%;
        margin-top: 0;
    }
    }
/* preview image */
.column {
        width: 150px;
        min-height: 200px;
        border: 1px solid gray;
        margin-top: 10px;
        border-radius: 5px;
        
        /* default text */
        display: flex;
        align-items: center;
        justify-content: center;
        color:gray;
        font-weight: bold;
    }

    /* .text{
        opacity: 0.1;
    } */

    .foto-preview{
        display: none;
        width: 100%;
        border-radius: 5px;
        width: 150px;
        min-height: 200px;
    }

    .Image{
        border-radius: 5px;
    }
    </style>
</head>
<body>
    <div class="container">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{url("")}}/updatedata/{{$product->id}}" method="POST" enctype="multipart/form-data"> 
            @csrf
            <div class="row">
                <div class="col-25">
                    <label for="">Foto</label>
                    @if ($product->image)
                        <img src="{{ asset ('storage/foto/'. $product->image) }}" alt="" class="foto-preview">
                    @else
                        <img src="" alt="" class="foto-preview">
                    @endif
                </div>
                <div class="col-75">
                    <input type="file" name="image" value="" class="" onchange="previewFoto()" id="image">
                    {{-- <input type="file" name="image" value="" class=" @error('image') is-invalid @enderror">
                    @error('image')
                        
                    @enderror --}}
                    {{-- <div class="column" id="column1">
                        <span class="text">Cover</span>
                    </div> --}}
                </div>
            </div>
            <div class="row">
                <div class="col-25">
                    <label for="">ISBN</label>
                </div>
                <div class="col-75">
                    <input type="text" name="isbn" value="{{ $product->id }}">
                </div>
            </div>

            <div class="row">
                <div class="col-25">
                    <label for="">Judul</label>
                </div>
                <div class="col-75">
                    <input type="text" name="judul" value="{{ $product->judul }}">
                </div>
            </div>
            <div class="row">
                <div class="col-25">
                    <label for="">Penulis</label>
                </div>
                <div class="col-75">
                    <input type="text" name="penulis" id="" value="{{ $product->penulis }}">
                </div>
            </div>

            <div class="row">
                <div class="col-25">
                    <label for="">Penerbit</label>
                </div>
                <div class="col-75">
                    <select name="publisher_id" id="">
                        @foreach ($publisher as $item)
                            @if (old('publisher_id') == $item->id)
                                <option value="{{ $item->id }}" selected> {{ $item->penerbit }}</option>
                            @else
                                <option value="{{ $item->id }}"> {{ $item->penerbit }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>    
            </div>
            <div class="row">
                <div class="col-25">
                    <label for="">Sinopsis</label>
                </div>
                <div class="col-75">
                    <textarea name="sinopsis" class="sinopsis">{{ $product->sinopsis }}</textarea>
                </div>    
            </div> 
            <div class="row">
                <div class="col-25">
                    <label for="">Harga</label>
                </div>
                <div class="col-75">
                    <input type="number" min="0" name="harga" id="" value="{{ $product->harga }}">
                </div>
            </div>
            <div class="row">
                <div class="col-25">
                    <label for="">Stok</label>
                </div>
                <div class="col-75">
                    <input type="number" min="0" name="stok" id="" value="{{ $product->stok }}">
                </div>
            </div>
            <div class="row">
                <div class="col-25">
                    <label for="">Kategori</label>
                </div>
                <div class="col-75">
                    <select name="category_id" id="">
                        @foreach ($category as $item)
                        <option value="{{ $item->id }}">{{ $item->kategori }}</option>
                        @endforeach
                    </select>
                </div>    
            </div> 
            <div class="row">
                <div class="col-25">
                    <label for="">Genre</label>
                </div>
                <div class="col-75">                
                    @foreach ($genre as $item)
                        @if (old('genre_id') == $item->id)
                            <input type="checkbox" id="" name="genre_id" value="{{ $item->id }}" selected>{{ $item->genre }}
                        @else
                            <input type="checkbox" id="" name="genre_id" value="{{ $item->id }}">{{ $item->genre }}
                        @endif
                    @endforeach
                </div> <br>
            </div>   
            <div class="row">
                <input type="submit" name="" id="" value="Submit">
            </div>

            <script>
                function previewFoto(){
                    const image = document.querySelector('#image');
                    const previewImg = document.querySelector('.foto-preview');
                    const previewText = previewFoto.querySelector('.text');
                    previewImg.style.display = 'block';
                    previewText.style.display = 'none';

                    // perintah untuk ambil data gambar
                    const oFReader = new FileReader();
                    oFReader.readAsDataURL(image.files[0]);
                    
                    oFReader.onload = function(oFREvent){
                        previewImg.src = oFREvent.target.result;
                    }
                }
                
            </script>
        </form>
    </div>
</body>
</html>
@endsection