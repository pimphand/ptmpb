@extends('layouts.app')

@section('content')
    @php
        $contact = \App\Models\About::where('type', 'contact')->first();
    @endphp
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
                        <div class="row">
                            <div class="col-md-12 col-sm-6">
                                <div class="form-group">
                                    <label>Nama Lengkap</label>
                                    <input type="text" class="form-control" id="name"
                                        placeholder="masukan nama lengkap">
                                    <div id="nameError" class="error-message" style="display:none; color: red;"></div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Nama Perusahaan</label>
                                <input type="text" class="form-control" id="company"
                                    placeholder="masukan nama perusahaan">
                                <div id="companyError" class="error-message" style="display:none; color: red;"></div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 col-sm-6">
                                <div class="form-group">
                                    <label>Nomor Whatsapp</label>
                                    <input type="text" class="form-control" id="whatsapp"
                                        placeholder="contoh : 628123456789">
                                    <div id="whatsappError" class="error-message" style="display:none; color: red;"></div>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6">
                                <div class="form-group">
                                    <label>Email Perusahaan</label>
                                    <input type="email" class="form-control" id="email"
                                        placeholder="masukan email perusahaan">
                                    <div id="emailError" class="error-message" style="display:none; color: red;"></div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group m-b30">
                            <label>Alamat Lengkap</label>
                            <input type="text" class="form-control" id="address" placeholder="masukan alamat lengkap">
                            <div id="addressError" class="error-message" style="display:none; color: red;"></div>
                        </div>
                        <button type="submit" value="submit" class="site-button" onclick="sendToWhatsApp()">Simpan</button>
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
        let cartItems = JSON.parse(localStorage.getItem('shoppingCart'));

        function cartItemData() {
            let cartItems = JSON.parse(localStorage.getItem('shoppingCart')) || [];
            if (cartItems.length == 0) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Keranjang belanja masih kosong!',
                    //clicking outside the modal will also close it
                    allowOutsideClick: false,
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = "{{ route('products') }}";
                    }
                });
            }
            //get list order element
            let listOrder = document.getElementById('list-order');
            //clear list order
            listOrder.innerHTML = '';

            //loop through cart items and display them in the list order
            cartItems.forEach(item => {
                let li = document.createElement('li');
                li.classList.add('cart-item', 'clearfix');
                li.innerHTML = `
                    <div class="cart-item-image">
                        <img src="${item.image}" alt="${item.name}" width="80">
                    </div>
                    <div class="cart-item-info">
                        <span class="cart-item-name">${item.name}</span>
                        <input class="form-control" type="number" value="${item.qty}" hidden>
                        <input class="qty form-control" type="text" value="${item.qty}" data-id="${item.id}" onchange="updateQty(this)">
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

        function sendToWhatsApp() {
            let cartItems = JSON.parse(localStorage.getItem('shoppingCart'));

            // Validasi: Cek apakah cart kosong
            if (!cartItems || cartItems.length === 0) {
                Toast.fire({
                    icon: 'error',
                    title: 'Keranjang kosong. Silakan tambahkan produk ke keranjang sebelum melanjutkan.'
                });
                return;
            }

            // Validasi: Pastikan semua kolom diisi
            let isValid = true;
            const fields = ['name', 'company', 'whatsapp', 'email', 'address'];
            fields.forEach(field => {
                const value = $('#' + field).val();
                if (!value || value.trim() === '') {
                    $('#' + field + 'Error').text('Harap isi kolom ini.').show();
                    isValid = false;
                } else {
                    $('#' + field + 'Error').hide();
                }
            });

            // Validasi: Pastikan fullName, companyName, dan fullAddress diisi
            const fullName = $('#name').val();
            const companyName = $('#company').val();
            const fullAddress = $('#address').val();

            if (!fullName || fullName.trim() === '') {
                $('#nameError').text('Nama Lengkap harus diisi.').show();
                isValid = false;
            } else {
                $('#nameError').hide();
            }

            if (!companyName || companyName.trim() === '') {
                $('#companyError').text('Nama Perusahaan harus diisi.').show();
                isValid = false;
            } else {
                $('#companyError').hide();
            }

            if (!fullAddress || fullAddress.trim() === '') {
                $('#addressError').text('Alamat Lengkap harus diisi.').show();
                isValid = false;
            } else {
                $('#addressError').hide();
            }

            if (!isValid) {
                Toast.fire({
                    icon: 'error',
                    title: 'Harap isi semua kolom yang diperlukan.'
                });
                return;
            }

            // Validasi: Cek apakah email valid
            const email = $('#email').val();
            const emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
            if (email !== 'N/A' && !emailPattern.test(email)) {
                Toast.fire({
                    icon: 'error',
                    title: 'Harap masukkan alamat email yang valid.'
                });
                return;
            }

            // Validasi: Cek apakah nomor WhatsApp dimulai dengan '62'
            const whatsappNumber = $('#whatsapp').val();
            if (whatsappNumber !== 'N/A' && !whatsappNumber.startsWith('62')) {
                Toast.fire({
                    icon: 'error',
                    title: 'Nomor WhatsApp harus dimulai dengan 62.'
                });
                return;
            }

            let orderDetails = 'Detail Pesanan:\n\n';

            // Loop untuk menampilkan item dalam keranjang ke format WhatsApp
            cartItems.forEach(item => {
                orderDetails +=
                    `\nKategori: ${item.category}\nProduk: ${item.name}\nMerek: ${item.brand}\nJumlah: ${item.qty}\n\n`;
            });

            // Menambahkan informasi pembeli
            const companyEmail = email || 'N/A';

            orderDetails +=
                `\nInformasi Pembeli:\nNama Lengkap: ${fullName}\nPerusahaan: ${companyName}\nWhatsApp: ${whatsappNumber}\nEmail: ${companyEmail}\nAlamat: ${fullAddress}`;

            // Format URL WhatsApp untuk mengirim pesan
            let whatsappURL = `https://wa.me/{{ $contact->data['phone'] }}?text=${encodeURIComponent(orderDetails)}`;

            // Kirim data ke server (pastikan data checkout route di server Anda benar)
            $.ajax({
                type: "post",
                url: "{{ route('checkout') }}",
                data: {
                    _token: "{{ csrf_token() }}",
                    buyerInfo: {
                        fullName: fullName,
                        companyName: companyName,
                        whatsappNumber: whatsappNumber,
                        companyEmail: companyEmail,
                        fullAddress: fullAddress
                    },
                    orderDetails: cartItems
                },
                dataType: "json",
                success: function(response) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: 'Pesanan Anda telah kami terima. Kami akan segera menghubungi Anda.'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Hapus keranjang belanja dari local storage
                            localStorage.removeItem('shoppingCart');
                            //remove li #list-order
                            $('#list-order').html('');

                            const fields = ['name', 'company', 'whatsapp', 'email', 'address'];
                            fields.forEach(field => {
                                $('#' + field).val('');
                            });

                            // Redirect ke halaman produk
                            window.location.href = "{{ route('products') }}";
                        }
                    });
                },
                error: function(xhr, status, error) {
                    Toast.fire({
                        icon: 'error',
                        title: 'Terjadi kesalahan saat mengirim data: ' + error
                    });
                }
            });

            // Buka WhatsApp dengan detail pesanan
            window.open(whatsappURL, '_blank');
        }
    </script>
@endpush
