@foreach(session()->get('cart_items',[]) as $cart_item)
<div class="col-12 col-md-12 mb-3">
    <div class="media align-items-center"><div class="panel-heading" style="text-align: center; overflow: hidden; padding: 0;">
        <img class="d-block rounded mr-1" src="{{ asset('image/foto/'.$cart_item['produk']->foto) }}" style="max-height: 60px; min-height:60px; max-width: 60px; min-width:60px; object-fit:cover;" class="image-fluid card-img-top "  alt="..." >
    </div>

        <div class="media-body">
            <i class="ficon cart-item-remove" data-feather="x" data-id="{{$cart_item['produk']->id}}"></i>
            <div class="media-heading">
                <h6 class="cart-item-title"><a class="text-body" href="app-ecommerce-details.html">
                    {{$cart_item['produk']->nama}}</a>
            </div>
            <div class="btn-group" role="group">
                <input type="hidden" name="param" value="kurang">
                <button class="btn btn-primary btn-sm btn-decrease" data-id="{{$cart_item['produk']->id}}" data-qty="{{$cart_item['qty']}}" {{$cart_item['qty']<=1?'disabled':''}}>
                -
                </button>
                <button class="btn btn-outline-primary btn-sm" disabled="true">
                {{ number_format($cart_item['qty']) }}
                </button>
                <input type="hidden" name="param" value="tambah">
                <button class="btn btn-primary btn-sm btn-increase" data-id="{{$cart_item['produk']->id}}" data-qty="{{$cart_item['qty']}}">
                +
                </button>
            </div>
            <h5 class="cart-item-price">Rp{{ number_format($cart_item['produk']->harga * $cart_item['qty']) }}</h5>
        </div>
    </div>
</div>
@endforeach