@extends('admin.layouts.app')
@section('content')
    <div class="card bg-white border-0 rounded-3 mb-4">
        <div class="card-body p-4">
            <form class="mb-4">
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <div class="mb-0 border p-4 rounded-3 position-relative">
                            <p class="mb-4 text-secondary fw-medium">Sales:</p>
                            <ul class="list-group" style="max-height: 300px; overflow-y: auto;" id="sales">
                                @foreach($sales as $sale)
                                    <li class="list-group-item cursor sales"
                                        data-id="{{$sale->id}}">{{$sale->name}}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="mt-4 mt-md-0 border p-4 rounded-3 position-relative h-md-100">
                            <p class="mb-4 text-secondary fw-medium">Customer:</p>
                            <ul class="list-group" style="max-height: 300px; overflow-y: auto;" id="customer"></ul>
                        </div>
                    </div>
                </div>
            </form>
            <div class="card bg-white border-0 rounded-3 mb-4">
                <div class="card-body p-0">
                    @include('components.skus', ['order' => true])
                </div>
            </div>
            <div class="default-table-area all-products">
                <div class="table-responsive">
                    <table class="table align-middle">
                        <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Item Deskripsi</th>
                            <th scope="col">Ukuran</th>
                            <th scope="col">Harga</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Total</th>
                            <th scope="col">Action</th>
                        </tr>
                        </thead>
                        <tbody id="cartTable">

                        </tbody>
                        <tbody>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>
                                <span class="text-secondary label">Diskon</span>
                                <input type="text" class="form-control h-55 discount" placeholder="0.00">
                            </td>
                            <td>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="discountPersen" >
                                    <label class="form-check-label" for="discountPersen">
                                        Diskon Persen
                                    </label>
                                </div>
                            </td>
                            <td></td>

                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td class="text-body">Sub total:</td>
                            <td class="text-body" id="subTotal">Rp. 0</td>
                            <td></td>
                        </tr>

                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td class="text-body">Discount (0%)</td>
                            <td class="text-body" id="discount">- Rp. 0</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td class="fw-medium text-secondary">Grand Total</td>
                            <td class="text-secondary" id="grand_total">Rp. 0</td>
                            <td></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="d-flex flex-wrap gap-3 justify-content-center mt-4">
                <a href="{{route('admin.orders.index')}}" class="btn btn-danger py-2 px-4 fw-medium fs-16 text-white">Cancel</a>
                <button  class="btn btn-primary py-2 px-4 fw-medium fs-16" id="save"><i
                        class="ri-add-line text-white fw-medium"></i> Simpan
                </button>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script>
        let salesId = 0;
        $('.sales').click(function (e) {
            let id = $(this).data('id');
            if (salesId !== id) {
                $('.sales').removeClass('list-group-item-success');
                let url = '{{ route('admin.orders.customer', ':id') }}'.replace(':id', $(this).data('id'));
                $('#customer').empty();
                $.get(url, function (response) {
                    $.each(response, function (index, value) {
                        $('#customer').append('<li class="mb-1 list-group-item cursor customer" data-name="' + value.name + '" data-id="' + value.id + '">' + value.name + '</li>');
                    });
                });

                $(this).addClass('list-group-item-success');
                salesId = id;
            }

            //save to local storage
            localStorage.setItem('sales_id', id);
        })

        $(document).on('click', '.customer', function () {
            let customerId = $(this).data('id');
            let customerName = $(this).text();

            $('.customer').removeClass('list-group-item-success');
            $(this).addClass('list-group-item-success');

            localStorage.setItem('customer_id', JSON.stringify({
                id: customerId,
                name: customerName
            }));
        });

        $(document).on('click', '.skus', function () {
            let id = $(this).data('id');
            let data = dataTable.find(item => item.id === id);
            saveSku(data)
        });

        function saveSku(data, qty = 1, price = 0) {
            //save to local storage
            let cart = localStorage.getItem('cart');
            if (cart) {
                cart = JSON.parse(cart);
                let index = cart.findIndex(item => item.id === data.id);
                if (index === -1) {
                    cart.push({
                        id: data.id,
                        name: data.name,
                        price: price,
                        packaging: data.packaging,
                        qty: qty,
                        total: price,
                        brand: data.product.name,
                        category: data.product.category.name
                    });
                } else {
                    cart[index].qty += qty;
                    cart[index].total += price;
                }
            } else {
                cart = [{
                    id: data.id,
                    name: data.name,
                    price: price,
                    packaging: data.packaging,
                    qty: qty,
                    total: price,
                    brand: data.product.name,
                    category: data.product.category.name
                }];
            }
            localStorage.setItem('cart', JSON.stringify(cart));
            updateItem()
        }

        updateItem()

        function updateItem() {
            let cart = localStorage.getItem('cart');
            $('#cartTable').empty();
            let total = 0;
            $.each(JSON.parse(cart), function (key, value) {
                const row = `
                    <tr>
                        <td>${key + 1}</td>
                        <td> ${value.brand} - ${value.name}</td>
                        <td>
                            <input type="text" class="form-control ukuran h-55" value="${value.packaging}" id="qty_${value.id}">
                        </td>
                        <td><input type="number" class="form-control input_price h-55" value="${value.price ?? "0"}" id="price_${value.id}"></td>
                        <td>
                            <input type="number" class="form-control input_qty h-55" value="${value.qty}" id="qty_${value.id}">
                        </td>
                        <td>${formatRupiah(value.total)}</td>
                        <td>
                            <button class="btn btn-danger" onclick="deleteItem('${value.id}')">Delete</button>
                        </td>
                    </tr>
                `;
                $('#cartTable').append(row);
                total += value.total;
            });
            $('#subTotal').text(`${formatRupiah(total)}`);
            let discount = localStorage.getItem('discount') ?? 0;
            $('#discount').text(`- ${formatRupiah(discount)}`);
            $('#grand_total').text(`${formatRupiah(total - discount)}`);

            let salesId = localStorage.getItem('sales_id');
            let customerData = localStorage.getItem('customer_id');

            if (salesId) {
                $(`.sales[data-id="${salesId}"]`).addClass('list-group-item-success');
            }

            if (customerData) {
                customerData = JSON.parse(customerData); // Konversi dari JSON ke objek
                $('#customer').html(`
                    <li class="mb-1 list-group-item cursor customer list-group-item-success"
                        data-name="${customerData.name}" data-id="${customerData.id}">
                        ${customerData.name}
                    </li>
                `);
            }
        }

        $(document).on('change', '.discount', function () {
            let discountValue = $(this).val().trim();
            discountValue = discountValue ? parseFloat(discountValue) : 0;
            localStorage.setItem('discount', discountValue);
            if ($('#discountPersen').prop('checked')) {
                let cart = JSON.parse(localStorage.getItem('cart'));
                let total = cart.reduce((acc, item) => acc + item.total, 0);
                discountValue = total * discountValue / 100;
                $('#discount').text(`- ${formatRupiah(discountValue)}`);
            } else {
                $('#discount').text(`- ${formatRupiah(discountValue)}`);
            }
            updateItem()
        });

        $(document).on('change', '.discount, #discountPersen', function () {
            let discountValue = $('.discount').val().trim();
            discountValue = discountValue ? parseFloat(discountValue) : 0;

            let cart = JSON.parse(localStorage.getItem('cart')) || [];
            let total = cart.reduce((acc, item) => acc + item.total, 0);

            let discountAmount = discountValue;
            if ($('#discountPersen').prop('checked')) {
                discountAmount = total * discountValue / 100;
            }
            localStorage.setItem('discount', discountAmount);

            $('#discount').text(`- ${formatRupiah(discountAmount)}`);
            $('#discount').prev().text(`Discount (${discountValue}%)`);

            updateItem();
        });


        $(document).on('change', '.input_qty', function () {
            let id = $(this).attr('id').split('_')[1];
            let qty = $(this).val();
            let cart = JSON.parse(localStorage.getItem('cart'));
            let index = cart.findIndex(item => item.id === id);
            let price = $(`#price_${id}`).val() ?? 0;
            cart[index].qty = qty;
            cart[index].total = qty * price;
            localStorage.setItem('cart', JSON.stringify(cart));
            updateItem()
        });

        $(document).on('change', '.input_price', function () {
            let id = $(this).attr('id').split('_')[1];
            let price = $(this).val();
            let cart = JSON.parse(localStorage.getItem('cart'));
            let index = cart.findIndex(item => item.id === id);
            cart[index].price = price;
            cart[index].total = cart[index].qty * price;
            localStorage.setItem('cart', JSON.stringify(cart));
            updateItem()
        });

        function deleteItem(id) {
            let cart = JSON.parse(localStorage.getItem('cart')) || []; // Pastikan cart selalu berupa array

            // Temukan indeks item berdasarkan ID
            let index = cart.findIndex(item => item.id === id);

            if (index !== -1) { // Hanya hapus jika item ditemukan
                cart.splice(index, 1);
                localStorage.setItem('cart', JSON.stringify(cart));
                updateItem();
            } else {
                console.warn("Item tidak ditemukan dalam keranjang.");
            }
        }

        $('#save').click(function (e) {
            e.preventDefault();

            let cart = JSON.parse(localStorage.getItem('cart')) || [];
            let salesId = localStorage.getItem('sales_id') || null;
            let customerData = localStorage.getItem('customer_id');
            let discount = localStorage.getItem('discount') ?? 0;

            if (!customerData) {
                Toast.fire({
                    icon: "error",
                    title: "Customer harus dipilih!"
                });
                return;
            }

            customerData = JSON.parse(customerData);

            if (cart.length === 0) {
                Toast.fire({
                    icon: "error",
                    title: "Keranjang tidak boleh kosong!"
                });
                return;
            }

            let formData = new FormData();
            formData.append('customer_id', customerData.id);
            if (salesId) formData.append('sales_id', salesId);
            formData.append('discount', discount);

            cart.forEach((item, index) => {
                formData.append(`items[${index}][product_id]`, item.id);
                formData.append(`items[${index}][quantity]`, item.qty);
                formData.append(`items[${index}][price]`, item.price);
                formData.append(`items[${index}][total]`, item.price * item.qty);
            });

            $.ajax({
                url: '{{route('api.orders.store')}}', // Sesuaikan dengan endpoint backend
                method: 'POST',
                data: formData,
                processData: false, // Jangan proses data FormData
                contentType: false, // Jangan set content-type agar FormData dapat bekerja dengan benar
                headers: {
                    'Authorization': 'Bearer {{session('bearerToken')}}', // Sesuaikan dengan cara penyimpanan token
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Jika Laravel menggunakan CSRF protection
                },
                success: function (response) {
                    Toast.fire({
                        icon: "success",
                        title: "Order berhasil disimpan!"
                    });
                    localStorage.removeItem('cart');
                    localStorage.removeItem('sales_id');
                    localStorage.removeItem('customer_id');
                    localStorage.removeItem('discount');

                    updateItem()
                    $('.list-group-item-success').removeClass('list-group-item-success');
                    $('#customer').empty();
                },
                error: function (xhr) {
                    let error = xhr.responseJSON.errors;
                    Toast.fire({
                        icon: "error",
                        title: error.message
                    });
                }
            });
        });

    </script>
@endpush
