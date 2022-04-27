@extends('layouts.app')
@section('content')
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Genre</title>
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
        <h1>{{$genre}}</h1>
        @foreach ($products as $item)
        <div class="column">
            <div class="card">
            <a href="/detail/{{$item->id}}">
                <img src="{{ asset ('storage/foto/'.$item->image) }}" alt="" class="box">
            </a>
            <p>{{$item->judul}}</p>
            <p>{{$item->penulis}}</p>
            </div>
        </div>
        @endforeach
    </body>
</html>
@endsection