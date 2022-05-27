@extends('admin.layouts.app')
@section('listbuku','active')

@section('title', 'Detail Produk')

@section('content')
{{-- <body class="vertical-layout vertical-menu-modern  navbar-floating footer-static  " data-open="click" data-menu="vertical-menu-modern" data-col=""> --}}
    <!-- BEGIN: Content-->
    <div class="app-content content content ecommerce-application">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-left mb-0">Data produk</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.html">List Buku</a>
                                    </li>
                                    <li class="breadcrumb-item active">Detail produk
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
            <div class="content-body">
                <form id="formD" name="formD" action="" method="post" enctype="multipart/form-data">
                    <!-- app e-commerce details start -->
                    <section class="app-ecommerce-details">
                        <div class="card col-lg-12">
                            <!-- Product Details starts -->
                            <div class="card-body ">
                                <div class="row">
                                    <div class="col-12 col-md-3 align-items-center justify-content-center mb-2 mb-md-0">
                                        <div class="d-flex align-items-center justify-content-center">
                                            <img src="{{ asset ('storage/foto/'. $product->image) }}" class="img-fluid product-img" alt="cover image"/>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-7">
                                        <h4>{{$product->judul}}</h4>
                                        <span class="card-text item-company">Written by <a href="javascript:void(0)" class="company-name">{{$product->penulis}}</a></span>
                                        
                                        <div class="ecommerce-details-price d-flex flex-wrap mt-1"> 
                                            <h4 class="harga" value="{{$product->harga}}">Rp. {{number_format($product->harga)}} </h4>
                                            {{-- <h4 class="item-price mr-1 harga" id="harga" name="harga" value="{{$product->harga}}" disabled="" ></h4> --}}
                                            <ul class="unstyled-list list-inline pl-1 border-left">
                                                <li class="ratings-list-item"><i data-feather="star" class="filled-star"></i></li>
                                                <li class="ratings-list-item"><i data-feather="star" class="filled-star"></i></li>
                                                <li class="ratings-list-item"><i data-feather="star" class="filled-star"></i></li>
                                                <li class="ratings-list-item"><i data-feather="star" class="filled-star"></i></li>
                                                <li class="ratings-list-item"><i data-feather="star" class="unfilled-star"></i></li>
                                            </ul>
                                        </div>
                                        @if ($product->stok > 0)
                                            <p class="card-text">Available - <span class="text-success">{{$product->stok}}</span></p>
                                        @else
                                            <p class="card-text">Not Available
                                        @endif
                                        <p class="card-text">
                                            {{$product->sinopsis}}
                                        </p><br>
                                        <ul class="product-features list-unstyled">
                                            <li><i data-feather="shopping-cart"></i> <span>Free Shipping</span></li>
                                            <li>
                                                <i data-feather="dollar-sign"></i>
                                                <span>EMI options available</span>
                                            </li>
                                        </ul>
                                        <hr />
                                            <h6>More:</h6>
                                            <ul class="list-unstyled mb-0">
                                                <li>
                                                    <span class="card-text item-company">Penerbit: <a href="javascript:void(0)" class="company-name">{{$product->publisher->penerbit}}</a></span>
                                                </li>
    
                                                <li>
                                                    <span class="card-text item-company">Kategori: <a href="javascript:void(0)" class="company-name">{{$product->category->kategori}}</a></span>
                                                </li>
                                                <li>
                                                    <span class="card-text item-company">Genre: 
                                                        <a href="javascript:void(0)" class="company-name">
                                                            {{-- {{dd($product->genre)}} --}}
                                                            @foreach($product->genre as $genree)
                                                            {{ $genree->genre }}
                                                            @endforeach
                                                        </a>
                                                    </span>
                                                </li>
                                            </ul>
                                        @can('admin')
                                        <hr />
                                        <div class="d-flex flex-column flex-sm-row pt-1">
                                            <a href="{{route('produk.edit', $product->id)}}" class="btn btn-primary btn-cart mr-0 mr-sm-1 mb-1 mb-sm-0">
                                                <i data-feather="edit" class="mr-50"></i>
                                                <span class="">Edit</span>
                                            </a>
                                            <a href="#" data-id="{{$product->id}}" class="btn btn-danger btn-del waves-effect waves-float waves-light">Delete</a>
                                        </div>
                                        @endcan
                                        
                                    </div>
                                </div>
                            </div>
                            <!-- Product Details ends -->
                        </div>
                    
                        @can('user')
                        <!-- Transaction Card -->
                        <div class="card col-lg-6">
                            <div class="card card-transaction">
                                <div class="card-header">
                                    <h5 class="mb-0">Atur Jumlah</h5>
                                </div>
                                <div class="card-body">
                                    {{-- <div class="transaction-item">
                                        <div class="media">
                                            <div class="media-body">
                                                <h2>Kuantitas: </h2><input type="text" name="kuantitas" value="" onkeyup="OnChange(this.value)" onKeyPress="return isNumberKey(event)">
                                            </div>
                                        </div>
                                    </div> <hr /> --}}
                                    <div class="transaction-item">
                                        <div class="media">
                                            <div class="item-quantity">
                                                    {{-- @can('user') --}}
                                                    <div class="">
                                                        {{-- <label for="quantity">Kuantitas</label> --}}
                                                        <div id="tambahkurang" >
                                                            <button class="btn btn-primary btn-sm decrement-btn" > - </button>
                                                            {{-- <input type="hidden" data-id="{{$product->id}}" class="product_qty"> --}}
                                                            <input type="text" name="qty" class="text-center qty-input" value="1" style="width: 25px;" disabled>
                                                            <button class="btn btn-primary btn-sm increment-btn" > + </button>
                                                        </div>
                                                    </div>
                                                    
                                                    {{-- @endcan --}}
                                                    {{-- <div class="d-flex justify-content-end">
                                                        Total : Rp. <p class="disabled pricee d-inline-block">0</p>
                                                        <input type="hidden" id="priceee" name="price_total">
                                                    </div> --}}
                                            </div>
                                        </div>
                                    </div><hr />
                                    {{-- <div class="transaction-items">
                                        <div class="media">user
                                            <div class="media-body">
                                                <h2>Subtotal: </h2>
                                                <input type="text" name="total_harga" value="" disabled="" >
                                            </div>
                                        </div>
                                    </div><hr /> --}}
                                    <div class="transaction-item">
                                        <div class="media">
                                            <div class="media-body">
                                                {{-- @php
                                                $url =  $_SERVER["REQUEST_URI"];
                                                $url = collect(str_split($url));
                                                $url = $url->splice(9)->implode('');
                                            @endphp

                                            <input type="hidden" name="product_id" value="{{ $url }}"> --}}
                                            <input type="hidden" value="{{$product->id}}" class="product_id" >
                                            <input type="hidden" name="user_id" value="{{ @ Auth::user()->id }}" class="user_id">

                                                <button type="button" class="btn btn-primary btn-cart btn-add-to-cart" >
                                                    <i data-feather="shopping-cart" class="mr-40"></i>
                                                    <span class="add-to-cart">Add to cart</span>
                                                </button>
                                            </div>
                                        </div>
                                    {{-- </div>
                                    <div class="transaction-item"> --}}
                                        <div class="media">
                                            <div class="media-body">
                                                <a href="/transaksi" class="btn btn-primary mr-0 mr-sm-1 mb-1 mb-sm-0">
                                                    <span class="">Buy Now</span>
                                                </a>
                                            </div>
                                        </div>
                                    {{-- </div>
                                    <div class="transaction-item"> --}}
                                        <div class="media">
                                            <div class="media-body">
                                                <a href="javascript:void(0)" class="btn btn-outline-secondary btn-wishlist mr-0 mr-sm-1 mb-1 mb-sm-0">
                                                    <i data-feather="heart" class="mr-50"></i>
                                                    <span>Wishlist</span>
                                                </a>
                                                <div class="btn-group dropdown-icon-wrapper btn-share">
                                                    <button type="button" class="btn btn-icon hide-arrow btn-outline-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i data-feather="share-2"></i>
                                                    </button>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a href="javascript:void(0)" class="dropdown-item">
                                                            <i data-feather="facebook"></i> Facebook
                                                        </a>
                                                        <a href="javascript:void(0)" class="dropdown-item">
                                                            <i data-feather="twitter"></i> Twitter
                                                        </a>
                                                        <a href="javascript:void(0)" class="dropdown-item">
                                                            <i data-feather="youtube"></i> Youtube
                                                        </a>
                                                        <a href="javascript:void(0)" class="dropdown-item">
                                                            <i data-feather="instagram"></i> Instagram
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--/ Transaction Card -->
                        @endcan

                        <!-- Related Products starts -->
                            {{-- <div class="card-body">
                                <div class="mt-4 mb-2 text-center">
                                    <h4>Related Products</h4>
                                    <p class="card-text">People also search for this items</p>
                                </div>
                                <div class="swiper-responsive-breakpoints swiper-container px-4 py-2">
                                    <div class="swiper-wrapper">
                                        <div class="swiper-slide">
                                            <a href="javascript:void(0)">
                                                <div class="item-heading">
                                                    <h5 class="text-truncate mb-0">Apple Watch Series 6</h5>
                                                    <small class="text-body">by Apple</small>
                                                </div>
                                                <div class="img-container w-50 mx-auto py-75">
                                                    <img src="../../../app-assets/images/elements/apple-watch.png" class="img-fluid" alt="image" />
                                                </div>
                                                <div class="item-meta">
                                                    <ul class="unstyled-list list-inline mb-25">
                                                        <li class="ratings-list-item"><i data-feather="star" class="filled-star"></i></li>
                                                        <li class="ratings-list-item"><i data-feather="star" class="filled-star"></i></li>
                                                        <li class="ratings-list-item"><i data-feather="star" class="filled-star"></i></li>
                                                        <li class="ratings-list-item"><i data-feather="star" class="filled-star"></i></li>
                                                        <li class="ratings-list-item"><i data-feather="star" class="unfilled-star"></i></li>
                                                    </ul>
                                                    <p class="card-text text-primary mb-0">$399.98</p>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="swiper-slide">
                                            <a href="javascript:void(0)">
                                                <div class="item-heading">
                                                    <h5 class="text-truncate mb-0">Apple MacBook Pro - Silver</h5>
                                                    <small class="text-body">by Apple</small>
                                                </div>
                                                <div class="img-container w-50 mx-auto py-50">
                                                    <img src="../../../app-assets/images/elements/macbook-pro.png" class="img-fluid" alt="image" />
                                                </div>
                                                <div class="item-meta">
                                                    <ul class="unstyled-list list-inline mb-25">
                                                        <li class="ratings-list-item"><i data-feather="star" class="filled-star"></i></li>
                                                        <li class="ratings-list-item"><i data-feather="star" class="filled-star"></i></li>
                                                        <li class="ratings-list-item"><i data-feather="star" class="unfilled-star"></i></li>
                                                        <li class="ratings-list-item"><i data-feather="star" class="unfilled-star"></i></li>
                                                        <li class="ratings-list-item"><i data-feather="star" class="unfilled-star"></i></li>
                                                    </ul>
                                                    <p class="card-text text-primary mb-0">$2449.49</p>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="swiper-slide">
                                            <a href="javascript:void(0)">
                                                <div class="item-heading">
                                                    <h5 class="text-truncate mb-0">Apple HomePod (Space Grey)</h5>
                                                    <small class="text-body">by Apple</small>
                                                </div>
                                                <div class="img-container w-50 mx-auto py-75">
                                                    <img src="../../../app-assets/images/elements/homepod.png" class="img-fluid" alt="image" />
                                                </div>
                                                <div class="item-meta">
                                                    <ul class="unstyled-list list-inline mb-25">
                                                        <li class="ratings-list-item"><i data-feather="star" class="filled-star"></i></li>
                                                        <li class="ratings-list-item"><i data-feather="star" class="filled-star"></i></li>
                                                        <li class="ratings-list-item"><i data-feather="star" class="filled-star"></i></li>
                                                        <li class="ratings-list-item"><i data-feather="star" class="unfilled-star"></i></li>
                                                        <li class="ratings-list-item"><i data-feather="star" class="unfilled-star"></i></li>
                                                    </ul>
                                                    <p class="card-text text-primary mb-0">$229.29</p>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="swiper-slide">
                                            <a href="javascript:void(0)">
                                                <div class="item-heading">
                                                    <h5 class="text-truncate mb-0">Magic Mouse 2 - Black</h5>
                                                    <small class="text-body">by Apple</small>
                                                </div>
                                                <div class="img-container w-50 mx-auto py-75">
                                                    <img src="../../../app-assets/images/elements/magic-mouse.png" class="img-fluid" alt="image" />
                                                </div>
                                                <div class="item-meta">
                                                    <ul class="unstyled-list list-inline mb-25">
                                                        <li class="ratings-list-item"><i data-feather="star" class="filled-star"></i></li>
                                                        <li class="ratings-list-item"><i data-feather="star" class="filled-star"></i></li>
                                                        <li class="ratings-list-item"><i data-feather="star" class="filled-star"></i></li>
                                                        <li class="ratings-list-item"><i data-feather="star" class="filled-star"></i></li>
                                                        <li class="ratings-list-item"><i data-feather="star" class="filled-star"></i></li>
                                                    </ul>
                                                    <p class="card-text text-primary mb-0">$90.98</p>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="swiper-slide">
                                            <a href="javascript:void(0)">
                                                <div class="item-heading">
                                                    <h5 class="text-truncate mb-0">iPhone 12 Pro</h5>
                                                    <small class="text-body">by Apple</small>
                                                </div>
                                                <div class="img-container w-50 mx-auto py-75">
                                                    <img src="../../../app-assets/images/elements/iphone-x.png" class="img-fluid" alt="image" />
                                                </div>
                                                <div class="item-meta">
                                                    <ul class="unstyled-list list-inline mb-25">
                                                        <li class="ratings-list-item"><i data-feather="star" class="filled-star"></i></li>
                                                        <li class="ratings-list-item"><i data-feather="star" class="filled-star"></i></li>
                                                        <li class="ratings-list-item"><i data-feather="star" class="filled-star"></i></li>
                                                        <li class="ratings-list-item"><i data-feather="star" class="filled-star"></i></li>
                                                        <li class="ratings-list-item"><i data-feather="star" class="unfilled-star"></i></li>
                                                    </ul>
                                                    <p class="card-text text-primary mb-0">$1559.99</p>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                    <!-- Add Arrows -->
                                    <div class="swiper-button-next"></div>
                                    <div class="swiper-button-prev"></div>
                                </div>
                            </div> --}}
                        <!-- Related Products ends -->
                    </section>
                    <!-- app e-commerce details end -->
                </form>
            </div>
        </div>
    </div>
{{-- </body> --}}
@endsection

@push('styles')
@endpush

@push('scripts')
<script>
    $(document).ready(function () {
        $('.btn-add-to-cart').click(function () {
        var prod_id = $('.product_id').val();
        console.log(prod_id);
        var user_id = $('.user_id').val();
        console.log(user_id);
        var qty_input = $('.qty-input').val();
        console.log(qty_input);
            $.ajax({
                url: "{{route('cart.store')}}",
                method: "POST",
                data: {
                    'product_id' : prod_id,
                    'user_id' : user_id,
                    'qty' : qty_input,
                    _token: '{{csrf_token()}}'
                }, success: function (response){
                    console.log(response);
                }
            });
        });
        $('.decrement-btn').click(function (e) {
            e.preventDefault();
            var id = $(this).data('id');
            var dec_value = $('.qty-input').val();
            var value = Number(dec_value, 1000);
            value = isNaN(value) ? 0 : value;
            if (value > 1) {
                value--;
                $('.qty-input').val(value);
            } 
            
        });

        $('.increment-btn').click(function (e) {
            e.preventDefault();
            var id = $(this).data('id');
            
            var inc_value = $('.qty-input').val();
            var value = Number(inc_value, 1000);
            value = isNaN(value) ? 0 : value;
            if (value < 1000) {
                value++;
                $('.qty-input').val(value);
            }
        });
        $('#cart-items').on('click', '.cart-item-remove', function () {
            var id = $(this).data('id');
            $.ajax({
                url: "{{url('cart')}}/"+id,
                type: "POST",
                data: {
                    _token: '{{csrf_token()}}',
                    _method: 'DELETE'
                },
                success: function (data) {
                    $('#cart-count').html(data.data.cart_item_count);
                    $('#cart-count-label').html(data.data.cart_item_count+" Items");
                    $('#cart-total').html(data.data.cart_total);
                    $('#cart-items').html(data.data.cart_items);
                    if (feather) {
                        feather.replace({
                            width: 14,
                            height: 14
                        });
                    }
                    toastr.success('Data berhasil dihapus!', 'Berhasil!', {
                        closeButton: true,
                        tapToDismiss: false
                    });
                },
                error: function (data) {
                    toastr.error('Terjadi kesalahan!', 'Gagal!', {
                        closeButton: true,
                        tapToDismiss: false
                    });
                }
            });
        });

        $(document).on('click', '.btn-del', function () {
            var id = $(this).data('id');
            Swal.fire({
                icon: 'error',
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'error',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            })
                .then((result) => {
                    if (result.value) {
                        $.ajax({
                            'url': "{{url('produk')}}/" + id,
                            'type': 'post',
                            'data': {
                                '_method': 'DELETE',
                                '_token': '{{csrf_token()}}'
                            },
                            success: function (response) {
                                if (response == 1) {
                                    toastr.error('Data gagal dihapus!', 'Gagal!', {
                                        closeButton: true,
                                        tapToDismiss: false
                                    });
                                } else {
                                    toastr.success('Data berhasil dihapus!', 'Berhasil!', {
                                        closeButton: true,
                                        tapToDismiss: false
                                    });
                                    location.reload();
                                }
                            }
                        });
                    } else {
                        console.log(`dialog was dismissed by ${result.dismiss}`)
                    }

                });
        });

    });
</script>
@endpush


