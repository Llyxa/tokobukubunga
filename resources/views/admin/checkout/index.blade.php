@extends('admin.layouts.app')
@section('listbuku','active')

@section('title', 'Checkout')

@section('content')
<div class="app-content content ">
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
                                <li class="breadcrumb-item"><a href="index.html">Home</a>
                                </li>
                                <li class="breadcrumb-item active">Detail transaksi
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

    <!-- BEGIN: Content-->

            <div class="content-body">
                <!-- Basic Tables start -->
                    <div class="row" id="basic-table">
                        <div class="col-12">
                            <div class="card">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>No.</th>
                                                {{-- <th>Foto</th> --}}
                                                <th>Nama Produk</th>
                                                <th>Harga</th>
                                                <th>Kuantitas</th>
                                                <th>Total</th>
                                                <th>Hapus</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($product as $row)
                                                <tr>
                                                    <td>{{$loop->iteration}}</td>
                                                    <td>{{$row->judul}}</td>
                                                    <td name="harga" onkeyup="OnChange(this.value)" onKeyPress="return isNumberKey(event)">{{$row->harga}}</td>
                                                    <td class="cart-product-quantity" width="160px">
                                                        <div class="cart-item-qty">
                                                            <div class="input-group">
                                                            <input class="touchspin-cart" type="number" name="kuantitas" value="1" onkeyup="OnChange(this.value)" onKeyPress="return isNumberKey(event)">
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td><input type="text" name="total_harga" value="" disabled="" ></td>
                                                    <td></td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                <!-- Basic Tables end -->

                {{-- Card Transaksi starts --}}
                    <div class="card col-lg-4">
                        <div class="card-body">
                            <div class="row">
                                    <div class="">
                                        <h3>Sub Total: </h3>
                                        <hr>
                                        <h3>Total Bayar: </h3>
                                        <hr>
                                        <a href="javascript:void(0)" class="btn btn-primary btn-cart mr-0 mr-sm-1 mb-1 mb-sm-0">
                                            <span class="add-to-cart">Bayar</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                {{-- Card Transaksi end --}}

            </div>
    <!-- END: Content-->
    </div>

@endsection

@push('styles')
@endpush

@push('scripts')
    <script>
        $(document).ready(function () {
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
                                        window.location = "http://localhost:8000/produk/";
                                    }
                                }
                            });
                        } else {
                            console.log(`dialog was dismissed by ${result.dismiss}`)
                        }

                    });
            });

        });

        
        // $('.increment-btn').click(function (e) {
        //     e.preventDefault();
        //     var incre_value = $(this).parents('.quantity').find('.qty-input').val();
        //     var value = parseInt(incre_value, 10);
        //     value = isNaN(value) ? 0 : value;
        //     if(value<10){
        //         value++;
        //         $(this).parents('.quantity').find('.qty-input').val(value);
        //     }

        // });

        // $('.decrement-btn').click(function (e) {
        //     e.preventDefault();
        //     var decre_value = $(this).parents('.quantity').find('.qty-input').val();
        //     var value = parseInt(decre_value, 10);
        //     value = isNaN(value) ? 0 : value;
        //     if(value>1){
        //         value--;
        //         $(this).parents('.quantity').find('.qty-input').val(value);
        //     }
        // });

    });

    hargasatuan = document.formD.harga.value;
        document.formD.total_harga.value = hargasatuan;

        jumlah = document.formD.kuantitas.value;
        document.formD.total_harga.value = jumlah;
        
        function OnChange(value){
            hargasatuan = document.formD.harga.value;
            jumlah = document.formD.kuantitas.value;
            total = hargasatuan * jumlah;
            document.formD.total_harga.value = total;
        }
    </script>
@endpush


