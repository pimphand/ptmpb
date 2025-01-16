@foreach ($products as $product)
    <div class="col-lg-4 col-md-6 col-sm-6 m-b30">
        <div class="wt-box wt-product-box">
            <div class="wt-thum-bx wt-img-overlay1 wt-img-effect zoom">
                @if (isset($product->images) && count($product->images) > 0)
                    <img src="{{ asset('storage/' . $product->images[0]->path) }}" alt="">
                @else
                    <img src="{{ asset('assets/images/products/pic-1.jpg') }}" alt="">
                @endif
                <div class="overlay-bx">
                    <div class="overlay-icon">
                        <a href="javascript:void(0);" class="add_to_cart" data-id="{{ $product->id }}"
                            data-name="{{ $product->name }}" data-category="{{ $product->product->category->name }}"
                            data-product="{{ $product->product->name }}"
                            @if (isset($product->images) && count($product->images) > 0) data-image="{{ asset('storage/' . $product->images[0]->path) }}"
                            @else
                              data-image="{{ asset('assets/images/products/pic-1.jpg') }}" @endif>
                            <i class="fa fa-cart-plus wt-icon-box-xs"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="wt-info  text-center">
                <div class="p-a10 bg-white">
                    <h4 class="wt-title">
                        <a href="javascript:;">{{ $product->name }}</a>
                    </h4>
                    <span class="price">
                        {{ $product->product->name }} <br>

                        {{ $product->product->category->name }}
                    </span>
                    <div class="p-t10">
                        <button class="site-button add_to_cart m-r15" type="button" data-id="{{ $product->id }}"
                            data-name="{{ $product->name }}" data-category="{{ $product->product->category->name }}"
                            data-product="{{ $product->product->name }}"
                            @if (isset($product->images) && count($product->images) > 0) data-image="{{ asset('storage/' . $product->images[0]->path) }}"
                            @else
                              data-image="{{ asset('assets/images/products/pic-1.jpg') }}" @endif>Tambah
                            Ke Keranjang <i class="fa fa-angle-double-right"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endforeach

{{ $products->links() }}
