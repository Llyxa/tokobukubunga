@extends('admin.layouts.app')
@section('listbuku', 'active')
@section('title','Data produk')

@section('content')
<style>
    .card {
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
        text-align: center;
        transition: transform .2s;
    }
    .card:hover{
        transform: scale(1.03);
    }
</style>

<div class="app-content content ">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-9 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <h2 class="content-header-title float-left mb-0">List Buku</h2>
                        <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
                                {{-- <li class="breadcrumb-item"><a href="index.html">Home</a>
                                </li> --}}
                                <li class="breadcrumb-item active">List Buku
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
                <div class="form-group breadcrumb-right">
                    <div class="dropdown">
                        <button class="btn-icon btn btn-primary btn-round btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i data-feather="grid"></i></button>
                        <div class="dropdown-menu dropdown-menu-right"><a class="dropdown-item" href="app-todo.html"><i class="mr-1" data-feather="check-square"></i><span class="align-middle">Todo</span></a><a class="dropdown-item" href="app-chat.html"><i class="mr-1" data-feather="message-square"></i><span class="align-middle">Chat</span></a><a class="dropdown-item" href="app-email.html"><i class="mr-1" data-feather="mail"></i><span class="align-middle">Email</span></a><a class="dropdown-item" href="app-calendar.html"><i class="mr-1" data-feather="calendar"></i><span class="align-middle">Calendar</span></a></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body product_data">
            @can('admin')
            <div class="header">
                <a href="{{route('produk.create')}}" class="btn btn-primary waves-effect waves-float waves-light">Tambah produk</a>
            </div>
            @endcan
            <h6 class="my-2 text-muted">Recently Added</h6>
            <section id="card-content-types">
                <div class="row row-cols-6">
                    {{-- {{dd($produk);}} --}}
                    @foreach ($produk as $item)
                    <div class="col">
                        <div class="card h-90">
                            <a href="{{route('produk.show', $item->id)}}" style="padding: 10px;">
                                <img class="card-img-top" src="{{ asset ('storage/foto/'. $item->image) }}" alt="Cover Image" style="object-fit: cover; border-radius: 6px; height:250px;"/>
                            </a>
                            <div class="card-body">
                                <p class="card-title font-weight-bolder mt-0 mb-1">{{$item->judul}}</p>
                                <p class="card-text">{{$item->penulis}}</p>
                                <p class="card-text">Rp. {{$item->harga}}</p>
                            </div>
                        </div>
                        @can('user')
                        {{-- <div class="text-center">
                            <input type="hidden" value="{{$item->id}}" class="product_id" >
                            <label for="quantity">Kuantitas</label>
                            <div id="tambahkurang" >
                                <button class="btn btn-primary btn-sm decrement-btn" data-id="{{$item->id}}"> - </button>
                                <input type="text" name="qty" class="text-center qty-input" value="1" style="width: 25px;" >
                                <button class="btn btn-primary btn-sm increment-btn" data-id="{{$item->id}}"> + </button>
                            </div>
                        </div><br> --}}
                        <button type="button" class="btn btn-primary btn-cart mr-0 mr-sm-1 mb-1 mb-sm-0 ml-2 btn-add-to-cart" >
                            <i data-feather="shopping-cart" class="mr-40"></i>
                            <span class="add-to-cart">Add to cart</span>
                        </button>
                        @endcan
                    </div>
                    @endforeach                    
                </div>
            </section>
        </div>
    </div>
</div>
@endsection

@push('styles')
@endpush

@push('scripts')
<script>
$(document).ready(function () {
    $('.btn-add-to-cart').click(function () {
        var prod_id = $('.product_id').val();
        console.log(prod_id);
        var prod_qty = $('.qty-input').val();
        console.log(prod_qty);
        $.ajax({
            url: "{{route('cart.store')}}",
            method: "POST",
            data: {
                'product_id' : prod_id,
                'qty' : prod_qty, 
                _token: '{{csrf_token()}}'
            }, success: function (response){
                console.log(response);
            }
        });
    });
});
</script>
@endpush

