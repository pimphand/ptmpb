@foreach ($products as $product)
    <div class="col-lg-4 col-md-6 col-sm-6 m-b30">
        <div class="wt-box wt-product-box">
            <div class="wt-thum-bx wt-img-overlay1 wt-img-effect zoom">
                @if ($product->images->count() > 0)
                    <img src="{{ asset('storage/' . $products->images[0]->path) }}" alt="">
                @else
                    <img src="{{ asset('assets/images/products/pic-1.jpg') }}" alt="">
                @endif
                <div class="overlay-bx">
                    <div class="overlay-icon">
                        <a href="javascript:void(0);">
                            <i class="fa fa-cart-plus wt-icon-box-xs"></i>
                        </a>
                        <a class="mfp-link" href="javascript:void(0);">
                            <i class="fa fa-heart wt-icon-box-xs"></i>
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
                        <button class="site-button  m-r15" type="button">Tambah Ke Keranjang <i
                                class="fa fa-angle-double-right"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endforeach

{{ $products->links() }}
