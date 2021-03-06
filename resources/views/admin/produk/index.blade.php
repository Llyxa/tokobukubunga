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
    div.a{
        white-space: nowrap; 
        overflow: hidden;
        text-overflow: ellipsis;
    }
    div.a:hover{
        overflow: visible;
        /* white-space: pre; */
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
                        @can('admin')
                        <div class="card h-90">
                            <a href="{{route('produk.show', $item->id)}}">
                                <img class="card-img-top" src="{{ asset ('storage/foto/'. $item->image) }}" alt="Cover Image" style="object-fit: cover; border-radius: 6px; height:250px; padding: 10px;"/>
                            </a>
                            <div class="card-body">
                                <div class="card-text a">{{$item->penulis}}</div>
                                <div class="card-title font-weight-bolder mt-0 mb-1 a">{{$item->judul}}</div>
                                <p class="card-text">Rp. {{ number_format($item->harga) }}</p>
                            </div>
                        </div>
                        @endcan
                        @can('user')
                        <div class="card h-90">
                            <img class="card-img-top" src="{{ asset ('storage/foto/'. $item->image) }}" alt="Cover Image" style="object-fit: cover; border-radius: 6px; height:250px; padding: 10px;"/>
                            <div class="card-body">
                                <div class="card-text a">{{$item->penulis}}</div>
                                <div class="card-title font-weight-bolder mt-0 mb-1 a">{{$item->judul}}</div>
                                <p class="card-text">Rp. {{ number_format($item->harga) }}</p>
                            </div>
                        </div>
                        <div class="text-center">
                            <input type="hidden" name="user_id" value="{{ @ Auth::user()->id }}" class="user_id">
                            <button type="button" class="btn btn-primary btn-cart btn-add-to-cart" data-id="{{$item->id}}">
                                <i data-feather="shopping-cart" class="mr-40"></i>
                                <span class="add-to-cart">Add to cart</span>
                            </button>
                        </div>
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
        // e.preventDefault();
        var id = $(this).data('id');
        $.ajax({
            url: "{{route('cart.store')}}",
            type: "POST",
            data: {
                product_id: id,
                _token: '{{csrf_token()}}'
            }, 
            success: function (response) {
                toastr.success(response.message, 'Berhasil!', {
                        closeButton: true,
                        tapToDismiss: false
                    });
                    $('#cart-items').html('');
                    let rows = ''
                    $.each(response.data.cart, function (idx, d) { 
                        let disabled = "";
                        if(d.qty <= 1)
                            disabled = "disabled";
                            rows += '<div class="col-12 col-md-12 mb-3">'+
                                        '<div class="media align-items-center"><div class="panel-heading" style="text-align: center; overflow: hidden; padding: 0;">'+
                                            '<img class="d-block rounded mr-1" src="{{asset("storage/foto")}}/'+d.produk.image +'" style="max-height: 60px;min-height:60px; max-width: 60px; min-width:60px; object-fit:cover;" class="image-fluid card-img-top "  alt="..." >'+
                                        '</div>'+
                                            '<div class="media-body">'+
                                                '<i class="ficon cart-item-remove" data-feather="x" data-id="'+d.produk.id+'"></i>'+
                                                '<div class="media-heading">'+
                                                ' <h6 class="cart-item-title"><a class="text-body" href="app-ecommerce-details.html">'+d.produk.judul+'</a>'+
                                                '</div>'+
                                            ' <div class="btn-group" role="group">'+
                                                '<input type="hidden" class="product_id" value="'+d.id+'">'+
                                                    '<input type="hidden" name="param" value="kurang">'+
                                                    '<button class="btn btn-primary btn-sm btn-decrease" data-id="'+d.id+'" data-qty="'+d.qty+'" '+disabled+'>-'+
                                                    '</button>'+
                                                    '<button class="btn btn-outline-primary btn-sm" id="qty" disabled="true">'+d.qty+
                                                    '</button>'+
                                                    '<input type="hidden" name="param" value="tambah">'+
                                                    '<button class="btn btn-primary btn-sm btn-increase" data-id="'+d.id+'" data-qty="'+d.produk.id+'">'+
                                                    '+</button>'+
                                                    '</div>'+
                                                    '<h5 class="cart-item-price">Rp'+numberWithCommas(d.subtotal)+'</h5>'+
                                            '</div>'+
                                        '</div>'+
                                    '</div>';
                    })
                    $('#cart-total').html('Rp'+(response.total));
                    $('#cart-items').html(rows);
                        
                    if (feather) {
                        feather.replace({
                            width: 14,
                            height: 14
                        });
                    }
            },
            error: function (data) {
                toastr.error('Produk gagal ditambahkan', 'Gagal!', {
                    closeButton: true,
                    tapToDismiss: false
                });
            }
        });
    });

    $('#cart-items').on('click', '.btn-decrease', function () {
        var id = $(this).data('id');
        var qty = Number($(this).parent().find('.qty').text())-1; 
        $.ajax({
            url: "{{url('cart')}}/"+id,
            type: "POST",
            data: {
                qty: qty,
                _token: '{{csrf_token()}}',
                _method: 'PUT'
            },
            success: function (response) {
                toastr.success(response.message, 'Berhasil!', {
                        closeButton: true,
                        tapToDismiss: false
                    });
                    $('#cart-items').html('');
                    let rows = ''
                    $.each(response.data.cart, function (idx, d) { 
                        let disabled = "";
                        if(d.qty <= 1)
                            disabled = "disabled";
                            rows += '<div class="col-12 col-md-12 mb-3">'+
                                        '<div class="media align-items-center"><div class="panel-heading" style="text-align: center; overflow: hidden; padding: 0;">'+
                                            '<img class="d-block rounded mr-1" src="{{asset("storage/foto")}}/'+d.produk.image +'" style="max-height: 60px;min-height:60px; max-width: 60px; min-width:60px; object-fit:cover;" class="image-fluid card-img-top "  alt="..." >'+
                                        '</div>'+
                                            '<div class="media-body">'+
                                                '<i class="ficon cart-item-remove" data-feather="x" data-id="'+d.produk.id+'"></i>'+
                                                '<div class="media-heading">'+
                                                ' <h6 class="cart-item-title"><a class="text-body" href="app-ecommerce-details.html">'+d.produk.judul+'</a>'+
                                                '</div>'+
                                            ' <div class="btn-group" role="group">'+
                                                '<input type="hidden" class="product_id" value="'+d.id+'">'+
                                                    '<input type="hidden" name="param" value="kurang">'+
                                                    '<button class="btn btn-primary btn-sm btn-decrease" data-id="'+d.id+'" data-qty="'+d.qty+'" '+disabled+'>-'+
                                                    '</button>'+
                                                    '<button class="btn btn-outline-primary btn-sm" id="qty" disabled="true">'+d.qty+
                                                    '</button>'+
                                                    '<input type="hidden" name="param" value="tambah">'+
                                                    '<button class="btn btn-primary btn-sm btn-increase" data-id="'+d.id+'" data-qty="'+d.produk.id+'">'+
                                                    '+</button>'+
                                                    '</div>'+
                                                    '<h5 class="cart-item-price">Rp'+numberWithCommas(d.subtotal)+'</h5>'+
                                            '</div>'+
                                        '</div>'+
                                    '</div>';
                    })
                    $('#cart-total').html('Rp'+(response.total));
                    $('#cart-items').html(rows);
                        
                    if (feather) {
                        feather.replace({
                            width: 14,
                            height: 14
                        });
                    }
            },
            error: function (data) {
                toastr.error('Produk gagal ditambahkan', 'Gagal!', {
                    closeButton: true,
                    tapToDismiss: false
                });
            }
        });
    });

    $('#cart-items').on('click', '.btn-increase', function () {
        var id = $(this).data('id');
        var qty = Number($(this).parent().find('.qty').text())+1;
        $.ajax({
            url: "{{url('cart')}}/"+id,
            type: "POST",
            data: {
                qty: qty,
                _token: '{{csrf_token()}}',
                _method: 'PUT'
            },
            success: function (response) {
                toastr.success(response.message, 'Berhasil!', {
                        closeButton: true,
                        tapToDismiss: false
                    });
                    $('#cart-items').html('');
                    let rows = ''
                    $.each(response.data.detail, function (idx, d) { 
                        let disabled = "";
                        if(d.qty <= 1)
                            disabled = "disabled";
                            rows += '<div class="col-12 col-md-12 mb-3">'+
                                        '<div class="media align-items-center"><div class="panel-heading" style="text-align: center; overflow: hidden; padding: 0;">'+
                                            '<img class="d-block rounded mr-1" src="{{asset("storage/foto")}}/'+d.produk.image +'" style="max-height: 60px;min-height:60px; max-width: 60px; min-width:60px; object-fit:cover;" class="image-fluid card-img-top "  alt="..." >'+
                                        '</div>'+
                                            '<div class="media-body">'+
                                                '<i class="ficon cart-item-remove" data-feather="x" data-id="'+d.produk.id+'"></i>'+
                                                '<div class="media-heading">'+
                                                ' <h6 class="cart-item-title"><a class="text-body" href="app-ecommerce-details.html">'+d.produk.judul+'</a>'+
                                                '</div>'+
                                            ' <div class="btn-group" role="group">'+
                                                '<input type="hidden" class="product_id" value="'+d.id+'">'+
                                                    '<input type="hidden" name="param" value="kurang">'+
                                                    '<button class="btn btn-primary btn-sm btn-decrease" data-id="'+d.id+'" data-qty="'+d.qty+'" '+disabled+'>-'+
                                                    '</button>'+
                                                    '<button class="btn btn-outline-primary btn-sm" id="qty" disabled="true">'+d.qty+
                                                    '</button>'+
                                                    '<input type="hidden" name="param" value="tambah">'+
                                                    '<button class="btn btn-primary btn-sm btn-increase" data-id="'+d.id+'" data-qty="'+d.produk.id+'">'+
                                                    '+</button>'+
                                                    '</div>'+
                                                    '<h5 class="cart-item-price">Rp'+number_format(d.subtotal)+'</h5>'+
                                            '</div>'+
                                        '</div'+
                                    '</div>';
                    })
                    $('#cart-total').html('Rp'+(response.total));
                    $('#cart-items').html(rows);
                        
                    if (feather) {
                        feather.replace({
                            width: 14,
                            height: 14
                        });
                    }
            },
            error: function (data) {
                toastr.error('Produk gagal ditambahkan', 'Gagal!', {
                    closeButton: true,
                    tapToDismiss: false
                });
            }
        });
    });

    $('#cart-items').on('click', '.btn-del', function () {
        var id = $(this).data('id');
        $.ajax({
            url: "{{url('cart')}}/"+id,
            type: "POST",
            data: {
                _token: '{{csrf_token()}}',
                _method: 'DELETE'
            },
            success: function (response) {
                toastr.success(response.message, 'Berhasil!', {
                        closeButton: true,
                        tapToDismiss: false
                    });
                    $('#cart-items').html('');
                    let rows = ''
                    $.each(response.data.detail, function (idx, d) { 
                        let disabled = "";
                        if(d.qty <= 1)
                            disabled = "disabled";
                            rows += '<div class="col-12 col-md-12 mb-3">'+
                                        '<div class="media align-items-center"><div class="panel-heading" style="text-align: center; overflow: hidden; padding: 0;">'+
                                            '<img class="d-block rounded mr-1" src="{{asset("image/foto")}}/'+d.produk.foto +'" style="max-height: 60px;min-height:60px; max-width: 60px; min-width:60px; object-fit:cover;" class="image-fluid card-img-top "  alt="..." >'+
                                        '</div>'+
                                            '<div class="media-body">'+
                                                '<i class="ficon cart-item-remove" id="btn-del" data-feather="x" data-id="'+d.id+'"></i>'+
                                                '<div class="media-heading">'+
                                                ' <h6 class="cart-item-title"><a class="text-body" href="app-ecommerce-details.html">'+d.produk.nama+'</a>'+
                                                '</div>'+
                                            ' <div class="btn-group" role="group">'+
                                                '<input type="hidden" class="product_id" value="'+d.id+'">'+
                                                    '<input type="hidden" name="param" value="kurang">'+
                                                    '<button class="btn btn-primary btn-sm btn-decrease" data-id="'+d.id+'" data-qty="'+d.qty+'" '+disabled+'>-'+
                                                    '</button>'+
                                                    '<button class="btn btn-outline-primary btn-sm" id="qty" disabled="true">'+d.qty+
                                                    '</button>'+
                                                    '<input type="hidden" name="param" value="tambah">'+
                                                    '<button class="btn btn-primary btn-sm btn-increase" data-id="'+d.id+'" data-qty="'+d.produk.id+'">'+
                                                    '+</button>'+
                                                    '</div>'+
                                                    '<h5 class="cart-item-price">Rp'+numberWithCommas(d.subtotal)+'</h5>'+
                                            '</div>'+
                                        '</div>'+
                                    '</div>';
                    })
                    $('#cart-total').html('Rp'+(response.total)); console.log(response);
                    $('#cart-count').html((response.count));
                    $('#cart-items').html(rows);
                        
                    if (feather) {
                        feather.replace({
                            width: 14,
                            height: 14
                        });
                    }
            },
            error: function (data) {
                toastr.error('Produk gagal dihapus', 'Gagal!', {
                    closeButton: true,
                    tapToDismiss: false
                });
            }
        });
    });


});
</script>
@endpush