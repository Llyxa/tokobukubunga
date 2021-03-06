@foreach($keranjang as $detail)
<div class="col-12 col-md-12 mb-3">
    <div class="media align-items-center"><div class="panel-heading" style="text-align: center; overflow: hidden; padding: 0;">
        <img class="d-block rounded mr-1" src="{{ asset('storage/foto/'. $detail->produk->image) }}" style="max-height: 60px; min-height:60px; max-width: 60px; min-width:60px; object-fit:cover;" class="image-fluid card-img-top "  alt="..." >
    </div>
        <div class="media-body">
            <i class="ficon cart-item-remove" data-feather="x" data-id="{{$detail->produk->id}}"></i>
            <div class="media-heading">
                <h6 class="cart-item-title"><a class="text-body" href="app-ecommerce-details.html">
                    {{$detail->produk->judul}}</a>
            </div>
            <div class="btn-group" role="group">
                {{-- <input type="hidden" name="param" value="kurang">
                <button class="btn btn-primary btn-sm btn-decrease" data-id="{{$detail->id}}" data-qty="{{$detail->qty}}" {{$detail->qty<=1?'disabled':''}}>
                -
                </button>
                <button class="btn btn-outline-primary btn-sm" disabled="true">
                {{ number_format($cart_item['qty']) }}
                </button>
                <input type="hidden" name="param" value="tambah">
                <button class="btn btn-primary btn-sm btn-increase" data-id="{{$cart_item['produk']->id}}" data-qty="{{$cart_item['qty']}}">
                +
                </button> --}}
                <input type="hidden" class="product_id" value="{{$detail->produk->id}}">
                <button class="btn btn-primary btn-sm btn-decrease changeQuantity" data-id="{{$detail->id}}" data-qty="{{$detail->qty}}" 
                    {{$detail->qty<=1?'disabled':''}}>
                -
                </button>
                <button class="btn btn-outline-primary btn-sm" disabled="true">
                    {{ number_format($detail->qty) }}
                </button>
                <input type="hidden" name="param" value="tambah" id=tambah>
                <button class="btn btn-primary btn-sm btn-increase changeQuantity" data-id="{{$detail->id}}" data-qty="{{$detail->qty}}">
                +
                </button>
                </div>
            </div>
            <h5 class="cart-item-price">Rp{{ number_format($detail->subtotal) }}</h5>

        </div>
    </div>
</div>
@endforeach


