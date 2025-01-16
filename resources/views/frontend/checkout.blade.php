@extends('layouts.app')

@section('content')
    <style>
        #list-order {
            max-height: 400px;
            /* Sesuaikan tinggi yang diinginkan */
            overflow-y: auto;
            /* Membuat scroll vertikal */
            padding-right: 10px;
            /* Menambahkan ruang untuk scrollbar */
        }

        .cart-item {
            display: flex;
            justify-content: space-between;
            padding: 10px;
            border-bottom: 1px solid #ddd;
            margin-bottom: 10px;
        }

        .cart-item-image img {
            width: 150px;
            height: auto;
        }

        .cart-item-info {
            flex: 1;
            margin-left: 20px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .cart-item-name {
            font-weight: bold;
            font-size: 16px;
            margin-bottom: 5px;
        }

        .qty {
            width: 80px;
            margin-top: 5px;
        }

        .cart-item-actions {
            display: flex;
            align-items: center;
            justify-content: flex-end;
        }

        .deleted {
            color: red;
            text-decoration: none;
            font-size: 14px;
            margin-top: 10px;
        }

        .deleted i {
            margin-right: 5px;
        }
    </style>
    <x-banner></x-banner>
    <div class="bg-gray-light p-tb20">
        <div class="container">
            <ul class="wt-breadcrumb breadcrumb-style-1">
                <li><a href="javascript:void(0);">Home</a></li>
                <li>Checkout</li>
            </ul>
        </div>
    </div>

    <div class="container woo-entry mt-5">
        <!-- SECTION CONTENT START -->
        <div class="section-content">
            <div class="row">
                <!-- FROM STYEL 1 -->
                <div class="col-md-6 m-b30">
                    <div class="section-head">
                        <h2 class="text-uppercase">Informasi Pembeli</h2>
                        <div class="wt-separator-outer">
                            <div class="wt-separator style-square">
                                <span class="separator-left site-bg-primary"></span>
                                <span class="separator-right site-bg-primary"></span>
                            </div>
                        </div>
                    </div>

                    <div class="wt-box">
                        <form>

                            <div class="row">
                                <div class="col-md-6 col-sm-6">
                                    <div class="form-group">
                                        <label>Nama Lengkap</label>
                                        <input type="text" class="form-control" placeholder="First Name">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Nama Perusahaan</label>
                                    <input type="text" class="form-control" placeholder="Company Name">
                                </div>

                            </div>

                            <div class="row">
                                <div class="col-md-6 col-sm-6">
                                    <div class="form-group">
                                        <label>Nomor Whatsapp</label>
                                        <input type="text" class="form-control" placeholder="Enter Phone Number">
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <div class="form-group">
                                        <label>Email Perusahaan</label>
                                        <input type="email" class="form-control" placeholder="Enter email">
                                    </div>
                                </div>
                            </div>


                            <div class="form-group">
                                <label>Address</label>
                                <input type="text" class="form-control m-b30" placeholder="Address 1">
                            </div>
                            <button type="submit" value="submit" class="site-button">Save and Deliver Here</button>

                        </form>
                    </div>
                </div>

                <!-- FROM STYEL 1 WITH ICON -->
                <div class="col-md-6 m-b30">
                    <div class="section-head">
                        <h2 class="text-uppercase">List Order</h2>
                        <div class="wt-separator-outer">
                            <div class="wt-separator style-square">
                                <span class="separator-left site-bg-primary"></span>
                                <span class="separator-right site-bg-primary"></span>
                            </div>
                        </div>
                    </div>
                    <div class="wt-box your-order-list">
                        <ul id="list-order">

                        </ul>
                    </div>
                </div>
            </div>

        </div>
        <!-- SECTION CONTENT END -->
    </div>
@endsection

@push('js')
    <script>
        //get cart items from local storage
        cartItemData()

        function cartItemData() {
            let cartItems = JSON.parse(localStorage.getItem('shoppingCart'));

            //get list order element
            let listOrder = document.getElementById('list-order');

            //loop through cart items and display them in the list order
            cartItems.forEach(item => {
                let li = document.createElement('li');
                li.classList.add('cart-item', 'clearfix');
                li.innerHTML = `
                    <div class="cart-item-image">
                        <img src="${item.image}" alt="${item.name}" width="150">
                    </div>
                    <div class="cart-item-info">
                        <span class="cart-item-name">${item.name}</span>
                        <input class="qty form-control" type="number" value="${item.qty}" data-id="${item.id}">
                    </div>
                    <div class="cart-item-actions">
                        <a href="javascript:void(0);" class="deleted" onclick="deleteCartItem('${item.id}')">
                            <i class="fa fa-trash"></i> Hapus
                        </a>
                    </div>
                `;
                listOrder.appendChild(li);
            });
        }

        $('.deleted').on('click', function() {
            //remove li #list-order
            $(this).closest('li').remove();
        });

        function updateQty(el) {
            let qty = el.value;
            let id = el.getAttribute('data-id');
            let cartItems = JSON.parse(localStorage.getItem('shoppingCart'));
            //update qty in cartItems
            cartItems = cartItems.map(item => {
                if (item.id == id) {
                    item.qty = qty;
                }
                return item;
            });

            //update local storage
            localStorage.setItem('shoppingCart', JSON.stringify(cartItems));
            cartItemData();
        }
    </script>
@endpush
