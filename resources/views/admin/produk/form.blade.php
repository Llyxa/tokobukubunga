@extends('admin.layouts.app')
@section('title')
     Form {{@$produk ? ' Ubah' : ' Tambah'}}
@endsection
@section('content')
<style>
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

    .foto-preview{
        display: none;
        width: 100%;
        border-radius: 5px;
        width: 150px;
        min-height: 200px;
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
                        <h2 class="content-header-title float-left mb-0">produk</h2>
                        <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html">Home</a>
                                </li>
                                <li class="breadcrumb-item"><a href="#">Forms</a>
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
                                <h4 class="card-title">Vertical Form</h4>
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
                                <form class="form form-vertical" action="{{@$produk ? route('produk.update',$produk->id) : route('produk.store')}}"
                                    method="POST" enctype="multipart/form-data">
                                @csrf
                                @if(@$produk)
                                    {{method_field('patch')}}
                                @endif
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="image">Cover</label>
                                                <input type="file" id="image" class="form-control" name="image" placeholder="Foto" value="{{old('image', @$produk ? $produk->image : '')}}" onchange="previewFoto()"/>
                                                {{-- <div class="preview-image">
                                                    <div class="column" id="column1">
                                                        <img src="" alt="" class="foto-preview">
                                                        <span class="text">Cover</span>
                                                    </div> 
                                                    
                                                    <input type="file" name="image" value="" class="" onchange="previewFoto()" id="image">
                                                    <div class="column" id="column1">
                                                        <img src="" alt="" class="foto-preview">
                                                        <span class="text">Cover</span>
                                                    </div>
                                                </div> --}}
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="isbn">ISBN</label>
                                                <input type="text" id="isbn" class="form-control" name="isbn" placeholder="ISBN" value="{{old('isbn', @$produk ? $produk->id : '')}}">
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="judul">Judul</label>
                                                <input type="text" id="judul" class="form-control" name="judul" placeholder="Judul" value="{{old('judul', @$produk ? $produk->judul : '')}}">
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="penulis">Penulis</label>
                                                <input type="text" id="penulis" class="form-control" name="penulis" placeholder="Penulis" value="{{old('penulis', @$produk ? $produk->id : '')}}">
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="penerbit">Penerbit</label>
                                                <select class="form-control" id="basicSelect" name="publisher_id">
                                                    @foreach ($penerbit as $item)
                                                        @if (old('penerbit', @$penerbit ? $item->id : '') == $item->id)
                                                            <option value="{{ $item->id }}" selected> {{ $item->penerbit }}</option>
                                                        @else
                                                            <option value="{{ $item->id }}"> {{ $item->penerbit }}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="sinopsis">Sinopsis</label>
                                                <input type="text" id="sinopsis" class="form-control" name="sinopsis" placeholder="Sinopsis" value="{{old('nama', @$produk ? $produk->sinopsis : '')}}">
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="harga">Harga</label>
                                                <input type="number" min="0" id="harga" class="form-control" name="harga" placeholder="Harga" value="{{old('nama', @$produk ? $produk->harga : '')}}">
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="stok">Stok</label>
                                                <input type="number" min="0" id="stok" class="form-control" name="stok" placeholder="Stok" value="{{old('nama', @$produk ? $produk->stok : '')}}">
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="kategori">Kategori</label>
                                                <select class="form-control" id="basicSelect" name="category_id">
                                                    @foreach ($kategori as $item)
                                                        @if (old('kategori', @$kategori ? $item->id : '') == $item->id)
                                                            <option value="{{ $item->id }}" selected> {{ $item->kategori }}</option>
                                                        @else
                                                            <option value="{{ $item->id }}"> {{ $item->kategori }}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="genre">Genre</label>
                                                <div class="demo-inline-spacing">
                                                    @foreach ($genre as $item)
                                                        <div class="custom-control custom-checkbox">
                                                            @if (old('genre', @$genre ? $item->id : '') == $item->id)
                                                                <input type="checkbox" class="custom-control-input" id="customCheck1" name="genre_id" value="{{ $item->id }}" checked>
                                                                <label class="custom-control-label" for="customCheck1">{{ $item->genre }}
                                                            @else
                                                                <input type="checkbox" class="custom-control-input" id="customCheck1" name="genre_id" value="{{ $item->id }}">
                                                                <label class="custom-control-label" for="customCheck1">{{ $item->genre }}</label>
                                                            @endif
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <button type="submit" class="btn btn-primary mr-1">Submit</button>
                                            <a href="{{route('produk.index')}}" type="reset" class="btn btn-outline-secondary">Cancel</a>
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
@endpush