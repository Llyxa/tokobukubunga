<nav class="header-navbar navbar navbar-expand-lg align-items-center floating-nav navbar-light navbar-shadow">
    <div class="navbar-container d-flex content">
        <div class="bookmark-wrapper d-flex align-items-center">
            <ul class="nav navbar-nav d-xl-none">
                <li class="nav-item"><a class="nav-link menu-toggle" href="javascript:void(0);"><i class="ficon" data-feather="menu"></i></a></li>
            </ul>
            <ul class="nav navbar-nav bookmark-icons">
                <li class="nav-item d-none d-lg-block"><a href="{{route('produk.index')}}" class="nav-link" data-toggle="tooltip" data-placement="top" title="Produk"><i class="ficon" data-feather="bookmark"></i></a></li> {{-- Produk --}}
                <li class="nav-item d-none d-lg-block"><a href="{{route('kategori.index')}}" class="nav-link" data-toggle="tooltip" data-placement="top" title="Kategori"><i class="ficon" data-feather="grid"></i></a></li>
                <li class="nav-item d-none d-lg-block"><a href="{{route('genre.index')}}" class="nav-link" data-toggle="tooltip" data-placement="top" title="Genre"><i class="ficon" data-feather="dribbble"></i></a></li> {{-- Genre --}}
                <li class="nav-item d-none d-lg-block"><a href="{{route('penerbit.index')}}" href="nav-link" data-toggle="tooltip" data-placement="top" title="Penerbit"><i class="ficon" data-feather="feather"></i></a></li> {{-- Penerbit --}}
            </ul>
            <ul class="nav navbar-nav">
                <li class="nav-item d-none d-lg-block"><a class="nav-link bookmark-star"><i class="ficon text-warning" data-feather="star"></i></a>
                    <div class="bookmark-input search-input">
                        <div class="bookmark-input-icon"><i data-feather="search"></i></div>
                        <input class="form-control input" type="text" placeholder="Bookmark" tabindex="0" data-search="search">
                        <ul class="search-list search-list-bookmark"></ul>
                    </div>
                </li>
            </ul>
        </div>
        <ul class="nav navbar-nav align-items-center ml-auto">
            <li class="nav-item dropdown dropdown-language"><a class="nav-link dropdown-toggle" id="dropdown-flag" href="javascript:void(0);" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="flag-icon flag-icon-us"></i><span class="selected-language">English</span></a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown-flag"><a class="dropdown-item" href="javascript:void(0);" data-language="en"><i class="flag-icon flag-icon-us"></i> English</a><a class="dropdown-item" href="javascript:void(0);" data-language="fr"><i class="flag-icon flag-icon-fr"></i> French</a><a class="dropdown-item" href="javascript:void(0);" data-language="de"><i class="flag-icon flag-icon-de"></i> German</a><a class="dropdown-item" href="javascript:void(0);" data-language="pt"><i class="flag-icon flag-icon-pt"></i> Portuguese</a></div>
            </li>
            <li class="nav-item d-none d-lg-block"><a class="nav-link nav-link-style"><i class="ficon" data-feather="moon"></i></a></li>
            <li class="nav-item nav-search"><a class="nav-link nav-link-search"><i class="ficon" data-feather="search"></i></a>
                <div class="search-input">
                    <div class="search-input-icon"><i data-feather="search"></i></div>
                    <input class="form-control input" type="text" placeholder="Explore Vuexy..." tabindex="-1" data-search="search">
                    <div class="search-input-close"><i data-feather="x"></i></div>
                    <ul class="search-list search-list-main"></ul>
                </div>
            </li>
            @can('user')
            <li class="nav-item dropdown dropdown-cart mr-25"><a class="nav-link" href="javascript:void(0);" data-toggle="dropdown"><i class="ficon" data-feather="shopping-cart"></i><span class="badge badge-pill badge-primary badge-up cart-item-count" id="cart-count">
                {{-- @if (@$keranjang->count() == null)
                <span class="badge badge-pill badge-primary badge-up cart-item-count">0</span></a>
                @else --}}
                {{-- <span class="badge badge-pill badge-primary badge-up cart-item-count">{{ @$keranjang->count() }}</span></a> --}}
                {{-- @endif --}}
                @isset($keranjang)
                {{ @$keranjang->count() }}
                @endisset
                @empty($keranjang)
                0
                @endempty
    
                <ul class="dropdown-menu dropdown-menu-media dropdown-menu-right">
                    <li class="dropdown-menu-header">
                        <div class="dropdown-header d-flex">
                            <h4 class="notification-title mb-0 mr-auto">My Cart</h4>
                            <div class="badge badge-pill badge-light-primary" id="cart-count-label">
                                @isset($keranjang)
                                {{ @$keranjang->count() }}
                                @endisset
                                @empty($keranjang)
                                0
                                @endempty
                            </div>
                            {{-- @if (@$keranjang->count() == null)
                            <div class="badge badge-pill badge-light-primary">0 Items</div>
                            @else
                            <div class="badge badge-pill badge-light-primary">{{ @$keranjang->count() }} Items</div>
                            @endif --}}
                        </div>
                    </li>
                    <li class="scrollable-container media-list" id="cart-items" >
                    @if (@$keranjang && !@$keranjang->isEmpty())
                    @foreach(@$keranjang as $detail)
                        <div class="col-12 col-md-12 mb-3">
                            <div class="media align-items-center">
                                <div class="panel-heading">
                                <img class="d-block rounded mr-1" src="{{ asset('storage/foto/'.$detail->produk->image) }}" style="max-height: 90px; min-height:60px; max-width: 60px; min-width:60px; object-fit:cover;" class="image-fluid card-img-top "  alt="..." >
                            </div>
                        
                            <div class="media-body align-items-center">
                                <i class="ficon cart-item-remove btn-del" data-feather="x" data-id="{{$detail->id}}"></i>
                                <div class="media-heading" style="width: 80px;">
                                    <h6 class="cart-item-title "><a class="text-body" href="{{route('produk.show', $detail->produk->id)}}">
                                        {{$detail->produk->judul}}</a>
                                </div>
                                <div class="btn-group mr-1 ml-0" role="group">
                                    <input type="hidden" class="product_id" value="{{$detail->produk->id}}">
                                    <input type="hidden" name="param" value="kurang">
                                    <button class="btn btn-primary btn-sm btn-decrease changeQuantity align-items-center" data-id="{{$detail->id}}" data-qty="{{$detail->qty}}" {{$detail->qty<=1?'disabled':''}}>
                                    -
                                    </button>
                                    <button class="btn btn-outline-primary btn-sm qty align-items-center" disabled="true">
                                        {{ number_format($detail->qty) }}
                                    </button>
                                    <input type="hidden" name="param" value="tambah">
                                    <button class="btn btn-primary btn-sm btn-increase changeQuantity align-items-center" data-id="{{$detail->id}}" data-qty="{{$detail->qty}}">
                                    +
                                    </button>
                                    </div>
                                    {{-- <h5 class="cart-item-price">Rp{{ number_format(($detail->qty) * ($detail->produk->harga)) }}</h5> --}}
                                    <h5 class="cart-item-price" id="cart-total">Rp{{ number_format(($detail->subtotal)) }}</h5>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    
                    @else 
                        <div class="media align-items-center">
                            <div class="media-body d-flex justify-content-center">
                                <p class="text-danger">Cart is empty</p>
                            </div>
                        </div>
                    @endif 
                    </li>
                    @if (@$keranjang && @!$keranjang->isEmpty())
                    <li class="dropdown-menu-footer">
                        <div class="d-flex justify-content-between mb-1">
                            <h6 class="font-weight-bolder mb-0">Total: </h6>
                            {{-- <h6 class="text-primary font-weight-bolder mb-0" id="cart-total">Rp. {{ number_format((($detail->qty) * ($detail->produk->harga)) * ) }}</h6> --}}
                            <h6 class="text-primary font-weight-bolder mb-0" id="cart-total">Rp. {{ number_format($total) }}</h6>
                        </div><a class="btn btn-primary btn-block" href="app-ecommerce-checkout.html">Checkout</a>
                    </li>
                        
                    @endif
                </ul>
            </li>
            @endcan
            <li class="nav-item dropdown dropdown-notification mr-25"><a class="nav-link" href="javascript:void(0);" data-toggle="dropdown"><i class="ficon" data-feather="bell"></i><span class="badge badge-pill badge-danger badge-up">5</span></a>
                <ul class="dropdown-menu dropdown-menu-media dropdown-menu-right">
                    <li class="dropdown-menu-header">
                        <div class="dropdown-header d-flex">
                            <h4 class="notification-title mb-0 mr-auto">Notifications</h4>
                            <div class="badge badge-pill badge-light-primary">6 New</div>
                        </div>
                    </li>
                    <li class="scrollable-container media-list"><a class="d-flex" href="javascript:void(0)">
                            <div class="media d-flex align-items-start">
                                <div class="media-left">
                                    <div class="avatar"><img src="{{asset('assets')}}/admin/images/portrait/small/avatar-s-15.jpg" alt="avatar" width="32" height="32"></div>
                                </div>
                                <div class="media-body">
                                    <p class="media-heading"><span class="font-weight-bolder">Congratulation Sam 🎉</span>winner!</p><small class="notification-text"> Won the monthly best seller badge.</small>
                                </div>
                            </div>
                        </a><a class="d-flex" href="javascript:void(0)">
                            <div class="media d-flex align-items-start">
                                <div class="media-left">
                                    <div class="avatar"><img src="{{asset('assets')}}/admin/images/portrait/small/avatar-s-3.jpg" alt="avatar" width="32" height="32"></div>
                                </div>
                                <div class="media-body">
                                    <p class="media-heading"><span class="font-weight-bolder">New message</span>&nbsp;received</p><small class="notification-text"> You have 10 unread messages</small>
                                </div>
                            </div>
                        </a><a class="d-flex" href="javascript:void(0)">
                            <div class="media d-flex align-items-start">
                                <div class="media-left">
                                    <div class="avatar bg-light-danger">
                                        <div class="avatar-content">MD</div>
                                    </div>
                                </div>
                                <div class="media-body">
                                    <p class="media-heading"><span class="font-weight-bolder">Revised Order 👋</span>&nbsp;checkout</p><small class="notification-text"> MD Inc. order updated</small>
                                </div>
                            </div>
                        </a>
                        <div class="media d-flex align-items-center">
                            <h6 class="font-weight-bolder mr-auto mb-0">System Notifications</h6>
                            <div class="custom-control custom-control-primary custom-switch">
                                <input class="custom-control-input" id="systemNotification" type="checkbox" checked="">
                                <label class="custom-control-label" for="systemNotification"></label>
                            </div>
                        </div><a class="d-flex" href="javascript:void(0)">
                            <div class="media d-flex align-items-start">
                                <div class="media-left">
                                    <div class="avatar bg-light-danger">
                                        <div class="avatar-content"><i class="avatar-icon" data-feather="x"></i></div>
                                    </div>
                                </div>
                                <div class="media-body">
                                    <p class="media-heading"><span class="font-weight-bolder">Server down</span>&nbsp;registered</p><small class="notification-text"> USA Server is down due to hight CPU usage</small>
                                </div>
                            </div>
                        </a><a class="d-flex" href="javascript:void(0)">
                            <div class="media d-flex align-items-start">
                                <div class="media-left">
                                    <div class="avatar bg-light-success">
                                        <div class="avatar-content"><i class="avatar-icon" data-feather="check"></i></div>
                                    </div>
                                </div>
                                <div class="media-body">
                                    <p class="media-heading"><span class="font-weight-bolder">Sales report</span>&nbsp;generated</p><small class="notification-text"> Last month sales report generated</small>
                                </div>
                            </div>
                        </a><a class="d-flex" href="javascript:void(0)">
                            <div class="media d-flex align-items-start">
                                <div class="media-left">
                                    <div class="avatar bg-light-warning">
                                        <div class="avatar-content"><i class="avatar-icon" data-feather="alert-triangle"></i></div>
                                    </div>
                                </div>
                                <div class="media-body">
                                    <p class="media-heading"><span class="font-weight-bolder">High memory</span>&nbsp;usage</p><small class="notification-text"> BLR Server using high memory</small>
                                </div>
                            </div>
                        </a>
                    </li>
                    <li class="dropdown-menu-footer"><a class="btn btn-primary btn-block" href="javascript:void(0)">Read all notifications</a></li>
                </ul>
            </li>
            <li class="nav-item dropdown dropdown-user"><a class="nav-link dropdown-toggle dropdown-user-link" id="dropdown-user" href="javascript:void(0);" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <div class="user-nav d-sm-flex d-none"><span class="user-name font-weight-bolder">{{ Auth::user()->name }}</span><span class="user-status">{{ Auth::user()->role }}</span></div><span class="avatar"><img class="round" src="{{asset('assets')}}/admin/images/portrait/small/avatar-s-11.jpg" alt="avatar" height="40" width="40"><span class="avatar-status-online"></span></span>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown-user"><a class="dropdown-item" href="page-profile.html"><i class="mr-50" data-feather="user"></i> Profile</a><a class="dropdown-item" href="app-email.html"><i class="mr-50" data-feather="mail"></i> Inbox</a><a class="dropdown-item" href="app-todo.html"><i class="mr-50" data-feather="check-square"></i> Task</a><a class="dropdown-item" href="app-chat.html"><i class="mr-50" data-feather="message-square"></i> Chats</a>
                    <div class="dropdown-divider"></div><a class="dropdown-item" href="page-account-settings.html"><i class="mr-50" data-feather="settings"></i> Settings</a><a class="dropdown-item" href="page-pricing.html"><i class="mr-50" data-feather="credit-card"></i> Pricing</a><a class="dropdown-item" href="page-faq.html"><i class="mr-50" data-feather="help-circle"></i> FAQ</a><a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="mr-50" data-feather="power"></i> Logout</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>

                </div>
            </li>
        </ul>
    </div>
</nav>
<ul class="main-search-list-defaultlist d-none">
    <li class="d-flex align-items-center"><a href="javascript:void(0);">
            <h6 class="section-label mt-75 mb-0">Files</h6>
        </a></li>
    <li class="auto-suggestion"><a class="d-flex align-items-center justify-content-between w-100" href="app-file-manager.html">
            <div class="d-flex">
                <div class="mr-75"><img src="{{asset('assets')}}/admin/images/icons/xls.png" alt="png" height="32"></div>
                <div class="search-data">
                    <p class="search-data-title mb-0">Two new item submitted</p><small class="text-muted">Marketing Manager</small>
                </div>
            </div><small class="search-data-size mr-50 text-muted">&apos;17kb</small>
        </a></li>
    <li class="auto-suggestion"><a class="d-flex align-items-center justify-content-between w-100" href="app-file-manager.html">
            <div class="d-flex">
                <div class="mr-75"><img src="{{asset('assets')}}/admin/images/icons/jpg.png" alt="png" height="32"></div>
                <div class="search-data">
                    <p class="search-data-title mb-0">52 JPG file Generated</p><small class="text-muted">FontEnd Developer</small>
                </div>
            </div><small class="search-data-size mr-50 text-muted">&apos;11kb</small>
        </a></li>
    <li class="auto-suggestion"><a class="d-flex align-items-center justify-content-between w-100" href="app-file-manager.html">
            <div class="d-flex">
                <div class="mr-75"><img src="{{asset('assets')}}/admin/images/icons/pdf.png" alt="png" height="32"></div>
                <div class="search-data">
                    <p class="search-data-title mb-0">25 PDF File Uploaded</p><small class="text-muted">Digital Marketing Manager</small>
                </div>
            </div><small class="search-data-size mr-50 text-muted">&apos;150kb</small>
        </a></li>
    <li class="auto-suggestion"><a class="d-flex align-items-center justify-content-between w-100" href="app-file-manager.html">
            <div class="d-flex">
                <div class="mr-75"><img src="{{asset('assets')}}/admin/images/icons/doc.png" alt="png" height="32"></div>
                <div class="search-data">
                    <p class="search-data-title mb-0">Anna_Strong.doc</p><small class="text-muted">Web Designer</small>
                </div>
            </div><small class="search-data-size mr-50 text-muted">&apos;256kb</small>
        </a></li>
    <li class="d-flex align-items-center"><a href="javascript:void(0);">
            <h6 class="section-label mt-75 mb-0">Members</h6>
        </a></li>
    <li class="auto-suggestion"><a class="d-flex align-items-center justify-content-between py-50 w-100" href="app-user-view.html">
            <div class="d-flex align-items-center">
                <div class="avatar mr-75"><img src="{{asset('assets')}}/admin/images/portrait/small/avatar-s-8.jpg" alt="png" height="32"></div>
                <div class="search-data">
                    <p class="search-data-title mb-0">John Doe</p><small class="text-muted">UI designer</small>
                </div>
            </div>
        </a></li>
    <li class="auto-suggestion"><a class="d-flex align-items-center justify-content-between py-50 w-100" href="app-user-view.html">
            <div class="d-flex align-items-center">
                <div class="avatar mr-75"><img src="{{asset('assets')}}/admin/images/portrait/small/avatar-s-1.jpg" alt="png" height="32"></div>
                <div class="search-data">
                    <p class="search-data-title mb-0">Michal Clark</p><small class="text-muted">FontEnd Developer</small>
                </div>
            </div>
        </a></li>
    <li class="auto-suggestion"><a class="d-flex align-items-center justify-content-between py-50 w-100" href="app-user-view.html">
            <div class="d-flex align-items-center">
                <div class="avatar mr-75"><img src="{{asset('assets')}}/admin/images/portrait/small/avatar-s-14.jpg" alt="png" height="32"></div>
                <div class="search-data">
                    <p class="search-data-title mb-0">Milena Gibson</p><small class="text-muted">Digital Marketing Manager</small>
                </div>
            </div>
        </a></li>
    <li class="auto-suggestion"><a class="d-flex align-items-center justify-content-between py-50 w-100" href="app-user-view.html">
            <div class="d-flex align-items-center">
                <div class="avatar mr-75"><img src="{{asset('assets')}}/admin/images/portrait/small/avatar-s-6.jpg" alt="png" height="32"></div>
                <div class="search-data">
                    <p class="search-data-title mb-0">Anna Strong</p><small class="text-muted">Web Designer</small>
                </div>
            </div>
        </a></li>
</ul>
<ul class="main-search-list-defaultlist-other-list d-none">
    <li class="auto-suggestion justify-content-between"><a class="d-flex align-items-center justify-content-between w-100 py-50">
            <div class="d-flex justify-content-start"><span class="mr-75" data-feather="alert-circle"></span><span>No results found.</span></div>
        </a></li>
</ul>

@push('scripts')
<script>


</script>
@endpush