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
                        {{-- @can('user')
                        <div class="text-center">
                            <input type="hidden" value="{{$item->id}}" class="product_id" >
                            <label for="quantity">Kuantitas</label>
                            <div id="tambahkurang" >
                                <button class="btn btn-primary btn-sm decrement-btn" data-id="{{$item->id}}"> - </button>
                                <input type="hidden" data-id="{{$item->id}}" class="product_qty">
                                <input type="text" name="qty" class="text-center qty-input" value="1" style="width: 25px;" >
                                <button class="btn btn-primary btn-sm increment-btn" data-id="{{$item->id}}"> + </button>
                            </div>
                        </div><br>
                        <button type="button" class="btn btn-primary btn-cart mr-0 mr-sm-1 mb-1 mb-sm-0 ml-2 btn-add-to-cart" >
                            <i data-feather="shopping-cart" class="mr-40"></i>
                            <span class="add-to-cart">Add to cart</span>
                        </button>
                        @endcan --}}
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
                var prod_id = $(this).closest('.product_data').find('.product_id').val();
                var prod_qty = $(this).closest('.product_data').find('.qty-input').val();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: "{{route('cart.store')}}",
                    method: "POST",
                    data: {
                        'product_id' : prod_id,
                        'qty' : prod_qty, 
                        _token: '{{csrf_token()}}'
                    }, success: function (response){
                        alert(response.status);
                    }
                });

                
            });

            // $('#tambahkurang').on('click', '.decrement-btn', function () {
            $('.decrement-btn').click(function () {
                // var id = $(this).data('id');
                // var kuantitas = parseInt($(this).data('qty'))-1;
                // $.ajax({
                //     url: "{{url('cart')}}/" + id,
                //     type: "POST",
                //     data: {
                //         'qty': kuantitas,
                //         _token: '{{csrf_token()}}',
                //         _method: 'PUT'
                //     }
                // });
                var dec_value = $('.qty-input').val();
                var value = parseInt(dec_value, 10);
                value = isNaN(value) ? 0 : value;
                if (value > 1) {
                    value--;
                    $('.qty-input').val(value);
                } else {
                    
                }
            });

            // $('#tambahkurang').on('click', '.increment-btn', function () {
            $('.increment-btn').click(function () {
                // var id = $(this).data('id');
                // var kuantitas = parseInt($(this).data('qty'))+1;
                // $.ajax({
                //     url: "{{url('cart')}}/" + id,
                //     type: "POST",
                //     data: {
                //         'qty': kuantitas,
                //         _token: '{{csrf_token()}}',
                //         _method: 'PUT'
                //     }
                // });
                var inc_value = $('.qty-input').val();
                var value = parseInt(inc_value, 10);
                value = isNaN(value) ? 0 : value;
                if (value < 10) {
                    value++;
                    $('.qty-input').val(value);
                } else {
                    
                }
            });

            $('#cart-items').on('click', '.cart-item-remove', function () {
                var id = $(this).data('id');
                $.ajax({
                    url: "{{url('cart-session')}}/"+id,
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
                                'url': '{{url('produk')}}/' + id,
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

