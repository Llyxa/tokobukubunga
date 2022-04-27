@extends('admin.layouts.app')
@section('listbuku', 'active')
@section('title','Data produk')

@section('content')

<style>
     #fotofoto {
        width: 100%;
    }
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
                        <h2 class="content-header-title float-left mb-0">Data produk</h2>
                        <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html">Home</a>
                                </li>
                                <li class="breadcrumb-item active">Data produk
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
            <h6 class="my-2 text-muted">Recently Added</h6>
            <section id="card-content-types">
                <div class="row row-cols-5">
                    @foreach ($produk as $item)
                    <div class="col">
                        <div class="card h-90">
                            <a href="{{route('produk.show', $item->id)}}" style="padding: 10px;">
                                <img class="card-img-top" src="{{ asset ('storage/foto/'. $item->image) }}" alt="Cover Image" style="object-fit: cover; border-radius: 6px;"/>
                            </a>
                            <div class="card-body">
                                <p class="card-title font-weight-bolder mt-0 mb-1">{{$item->judul}}</p>
                                <p class="card-text">{{$item->penulis}}</p>
                            </div>
                            {{-- <div class="card-body">
                                <a href="{{route('produk.edit', $item->id)}}" class="card-link">Edit</a>
                                <a href="#" data-id="{{$item->id}}" class="card-link">Delete</a>
                            </div> --}}
                        </div>
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
