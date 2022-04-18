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
        border-radius: 5px;
        /* resize: vertical; */
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
    border-radius: 5px;
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
    /* width: 100%; */
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
    <br><div class="container">
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <form action="/insert" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-25">
                    <label for="">Foto</label>
                </div>
                <div class="col-75">
                    <input type="file" name="image" value="" class="" onchange="previewFoto()" id="image">
                    {{-- @error('image')
                        @if ($errors->image())
                        <div class="alert alert-danger">
                            {{$errors->image()}}
                        </div>
                        @endif
                    @enderror --}}
                    <div class="column" id="column1">
                        <img src="" alt="" class="foto-preview">
                        <span class="text">Cover</span>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-25">
                    <label for="">ISBN</label>
                </div>
                <div class="col-75">
                    <input type="text" name="isbn">
                </div>
            </div>
            <div class="row">
                <div class="col-25">
                    <label for="">Judul</label>
                </div>
                <div class="col-75">
                    <input type="text" name="judul">
                </div>
            </div>
            
            <div class="row">
                <div class="col-25">
                    <label for="">Penulis</label>
                </div>
                <div class="col-75">
                    <input type="text" name="penulis" id="">
                </div>
            </div>
            <div class="row">
                <div class="col-25">
                    <label for="">Penerbit</label>
                </div>
                <div class="col-75">
                    <select name="publisher_id" id="">
                        @foreach ($publisher as $item)
                            <option value="{{ $item->id }}"> {{ $item->penerbit }}</option>
                        @endforeach
                    </select>
                </div>    
            </div> 
            <div class="row">
                <div class="col-25">
                    <label for="">Sinopsis</label>
                </div>
                <div class="col-75">
                    <textarea name="sinopsis" id="" cols="30" rows="10"></textarea>
                </div>    
            </div>
            <div class="row">
                <div class="col-25">
                    <label for="">Harga</label>
                </div>
                <div class="col-75">
                    <input type="number" name="harga" id="" min="0">
                </div>
            </div>
            <div class="row">
                <div class="col-25">
                    <label for="">Stok</label>
                </div>
                <div class="col-75">
                    <input type="number" name="stok" id="" min="0">
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
                        <label for=""><input type="checkbox" id="genre_id" name="genre_id" value="{{ $item->id }}">{{ $item->genre }}</label>
                    @endforeach
                </div><br>
            </div>        
            <div class="row">
                <input type="submit" name="" id="" value="Submit">
            </div>
        </form>
    </div><br>
    <script>
        function previewFoto(){
            const image = document.querySelector('#image');
            const previewFoto = document.querySelector('#column1')
            const previewImg = previewFoto.querySelector('.foto-preview');
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
</body>
</html>
@endsection