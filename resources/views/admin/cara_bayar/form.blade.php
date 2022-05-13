@extends('admin.layouts.app')
@section('cara_bayar', 'active')
@section('title')
     Form {{@$cara_bayar ? ' Ubah' : ' Tambah'}}
@endsection
@section('content')
<div class="app-content content ">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-9 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <h2 class="content-header-title float-left mb-0">Tambah Cara Bayar</h2>
                        <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="">Home</a>
                                </li>
                                <li class="breadcrumb-item"><a href="{{route('cara_bayar.index')}}">Cara Bayar</a>
                                </li>
                                <li class="breadcrumb-item active">Form Cara Bayar
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
            <!-- Basic Vertical form layout section start -->
            <section id="basic-vertical-layouts">
                <div class="row">
                    <div class="col-md-6 col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Form Cara Bayar</h4>
                            </div>
                            <div class="card-body">
                                @if ($errors->any())
                                        <div class="alert alert-danger" role="alert">
                                            <h4 class="alert-heading">Error!</h4>
                                            <div class="alert-body">
                                                <ul>
                                                    @foreach ($errors->all() as $error)
                                                        <li>{{ $error }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    @endif
                                <form class="form form-vertical" action="{{@$cara_bayar ? route('cara_bayar.update',$cara_bayar->id) : route('cara_bayar.store')}}"
                                    method="POST" enctype="multipart/form-data">
                                @csrf
                                @if(@$cara_bayar)
                                    {{method_field('patch')}}
                                @endif
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="cara_bayar">Cara Bayar</label>
                                                <input type="text" id="cara_bayar" class="form-control" name="cara_bayar" placeholder="cara_bayar" value="{{old('nama', @$cara_bayar ? $cara_bayar->cara_bayar : '')}}" />
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <button type="submit" class="btn btn-primary mr-1">Submit</button>
                                            <a href="{{route('cara_bayar.index')}}" type="reset" class="btn btn-outline-secondary">Cancel</a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- Basic Vertical form layout section end -->

        </div>
    </div>
</div>

@endsection

@push('styles')
@endpush

@push('scripts')
    <script>

    </script>
@endpush
