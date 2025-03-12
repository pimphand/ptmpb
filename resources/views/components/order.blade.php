
<div class="card bg-white border-0 rounded-3 mb-4">
    <div class="card bg-white border-0 rounded-3 mb-4">
        <div class="card-body p-0">
            <div class="d-flex justify-content-between flex-wrap gap-2 p-4 align-items-center">
                <div class="d-flex align-items-center">
                    <form class="position-relative table-src-form me-2">
                        <input type="text" class="form-control ps-4" id="search" placeholder="Search here">
                        <i class="material-symbols-outlined position-absolute top-50 start-0 translate-middle-y ps-2">search</i>
                    </form>
                    <div id="button" class="ms-2"></div>
                </div>
                <a class="btn btn-primary text-white py-2 px-4 fw-semibold" href="{{route('admin.orders.create')}}">
                    {{ __('app.add') }} Order
                </a>
            </div>

            <div class="default-table-area style-two default-table-width">
                <div class="table-responsive">
                    <table class="table align-middle">
                        <thead>
                        <tr>
                            <th scope="col">
                                <div class="form-check">
                                    <input class="form-check-input position-relative top-1" type="checkbox"
                                           value="" id="flexCheckDefault7">
                                    <label class="position-relative top-2 ms-1" for="flexCheckDefault7">ID</label>
                                </div>
                            </th>
                            <th scope="col">{{ __('app.name') }}</th>
                            <th scope="col">Email</th>
                            <th scope="col">Nama Perusahaan
                            <th scope="col">Sisa Pembayaran</th>
                            <th scope="col">whatsapp</th>
                            <th scope="col">Item</th>
                            <th scope="col">Status</th>
                            <th scope="col">{{ __('app.action') }}</th>
                        </tr>
                        </thead>
                        <tbody id="dataTable"></tbody>
                    </table>
                </div>
                <div class="p-4 pt-lg-4">
                    <div
                        class="d-flex justify-content-center justify-content-sm-between align-items-center text-center flex-wrap gap-2 showing-wrap">
                        <div id="pagination-container"
                             class="d-flex justify-content-center justify-content-sm-between align-items-center text-center flex-wrap gap-2 showing-wrap">
                            <span id="showing-info" class="fs-12 fw-medium">Showing 0 of 0 Results</span>
                            <nav aria-label="Page navigation example">
                                <ul id="pagination" class="pagination mb-0 justify-content-center"></ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('css')
    <style>
        tr.return {
            background-color: #22b1c2;
        }
        tr.return label,
        tr.return a,
        tr.return span {
            color: #fff !important;
        }
    </style>

@endpush
@push('js')
    <script>
        let dataTable = [];
        let statusId = {
            'pending': 'Pending',
            'process': 'Proses',
            'success': 'Selesai',
            'cancel': 'Batal',
            'done': 'Selesai'
        };
        let status = {
            'pending': 'primary',
            'process': 'warning',
            'success': 'success',
            'cancel': 'danger',
            'done': 'success'
        };
        $.each(status, function (key, value) {
            if (key !== 'done') {
                $('#button').append(`<button data-value="${key}" class="btn btn-${value} btn-sm me-2 text-white btn-status">${statusId[key]}</button>`);
            }
        });


        $(document).on('click', '.btn-status', function () {
            const status = $(this).data('value');
            getData(1, $('#search').val(), status);
        });

        function getData(page = 1, query = '', status = '') {
            $.get(`{{ route('admin.orders.data') }}?page=${page}&search=${query}&status=${status}&user_id={{request()->user_id ?? ''}}`, function (response) {
                const {
                    data,
                    meta,
                    links
                } = response;
                dataTable = data;
                // Clear table and pagination
                $('#dataTable').empty();
                $('#pagination').empty();
                let statusId = {
                    'pending': 'Pending',
                    'process': 'Proses',
                    'success': 'Selesai',
                    'cancel': 'Batal',
                    'done': 'Selesai'
                };
                let status = {
                    'pending': 'primary',
                    'process': 'warning',
                    'success': 'success',
                    'cancel': 'danger',
                    'done': 'success'
                };

                // Render data
                $.each(data, function (key, value) {
                    let detail = "{{ route('admin.orders.show', ':id') }}".replace(':id', value.id);
                    let sales = "{{ route('admin.sales.show', ':id') }}?user_id=:userId".replace(':id', value.sales.id).replace(':userId', value.sales.id);
                    const row = `
                    <tr class="${value.is_return ? 'return' : ''}">
                        <td class="text-body">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="_${value.id}">
                                <label class="position-relative top-2 ms-1" for="_${value.id}">${value.id}</label>
                            </div>
                        </td>
                        <td class="text-body"><a>${value.data.fullName}</a> <br>
                           <a href="${sales}" class="hover-bg btn btn-outline-success text-${value.sales.name ? "success" : ''}"> Sales : ${value.sales.name ?? "-"}</a>
                        </td>
                        <td class="text-body"><span>${value.data.companyEmail}</span></td>
                        <td class="text-body"><span>${value.data.companyName}</span></td>
                        <td class="text-body"><span class="badge bg-opacity-10 bg-danger py-1 px-2 text-danger fw-medium fs-12">- ${formatRupiah(value.payment)}</span></td>
                        <td class="text-body"><span>${value.data.whatsappNumber}</span></td>

                        <td class="text-body">
                            <div class="accordion faq-wrapper" id="accordionExample">
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree-${value.id}" aria-expanded="false" aria-controls="collapseThree-${value.id}">
                                            Total ${value.items.length} Produk
                                        </button>
                                    </h2>
                                    <div id="collapseThree-${value.id}" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            <ul class="list-group">
                                                ${value.items.map(item => `<li class="list-group-item">${item.name} - ${item.quantity} pcs<br><small class="text-muted">Merek: ${item.brand}</small><br><small class="text-muted">Kategori: ${item.category}</small></li>`).join('')}
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td class="text-body ">
                            <button style="color:#fff" class="${value.status != 'cancel'?  'editStatus' : ''} btn-sm btn btn-${status[value.status]}" data-id="${value.id}" data-status="${value.status}">${statusId[value.status] ?? "-"} </button>
                        </td>
                        <td>
                            <a href="${detail}" class="ml-3 btn btn-primary btn-sm">Detail</a>
                        </td>
                    </tr>
                `;
                    // ${value.is_folow_up ? `Sudah di Folow Up` : `<a class="ps-0 border-0 bg-transparent lh-1 position-relative top-2 folow-up" data-id="${value.id}" data-whatsapp="${value.data.whatsappNumber}" href="javascript:void(0)"><i class="material-symbols-outlined fs-16 text-body">call</i> Folow Up </a>`}
                    $('#dataTable').append(row);
                });

                // Update showing info
                $('#showing-info').text(`Showing ${meta.from} to ${meta.to} of ${meta.total} Results`);

                // Render pagination
                $.each(meta.links, function (index, link) {
                    const activeClass = link.active ? 'active' : '';
                    const disabledClass = link.url ? '' : 'disabled';
                    const listItem = `
                <li class="page-item ${activeClass} ${disabledClass}">
                    <a class="page-link" href="#" data-page="${link.url ? new URL(link.url).searchParams.get('page') : '#'}">
                        ${link.label}
                    </a>
                </li>
            `;
                    $('#pagination').append(listItem);
                });

                // Add click event for pagination links
                $('#pagination .page-link').click(function (e) {
                    e.preventDefault();
                    const page = $(this).data('page');
                    if (page && page !== '#') {
                        getData(page);
                    }
                });
            });
        }

        $('#search').on('input', function () {
            const query = $(this).val();
            getData(1, query); // Fetch data from page 1 with search query
        });
        // Initial load
        getData();

        //folow up
        $('#dataTable').on('click', '.folow-up', function (e) {
            const data = dataTable.find(item => item.id == $(this).data('id'));
            const items = data.items;
            const buyer = data.data;

            const createAt = new Date().toLocaleDateString("id-ID", {
                year: "numeric",
                month: "long",
                day: "numeric"
            });

            function generateWhatsAppMessage(items, buyer, createAt) {
                let message =
                    "Halo kak, kami dari PT MANDALIKA PUTRA BERSAMA mau mem-follow up pesanan Anda. Berikut detailnya:\n\n";

                message += "Order Details:\n\n";

                items.forEach((item, index) => {
                    message += `Kategori: ${item.category}\n`;
                    message += `Produk: ${item.name}\n`;
                    message += `Merek: ${item.brand}\n`;
                    message += `Jumlah: ${item.qty}\n\n`;
                });

                message += "*Informasi Pembeli:*\n";
                message += `*Nama Lengkap:* ${buyer.fullName}\n`;
                message += `*Perusahaan:* ${buyer.companyName}\n`;
                message += `*WhatsApp:* ${buyer.whatsappNumber}\n`;
                message += `*Email:* ${buyer.companyEmail}\n`;
                message += `*Address:* ${buyer.fullAddress}\n`;
                message += `*Tanggal Order:* ${createAt}`;

                return encodeURIComponent(message); // Pastikan semua teks ter-encode dengan benar
            }

            const whatsappNumber = buyer.whatsappNumber;
            const whatsappMessage = generateWhatsAppMessage(items, buyer, createAt);
            const whatsappURL = `https://wa.me/${whatsappNumber}?text=${whatsappMessage}`;
            $.ajax({
                type: "POST",
                url: "{{ route('admin.orders.update', ':id') }}".replace(':id', data.id),
                data: {
                    _token: "{{ csrf_token() }}",
                    _method: "PUT",
                },
                success: function (response) {
                    if (response.success) {
                        window.open(whatsappURL, "_blank");
                        getData();
                    }
                }
            });

        });
        $(document).ready(function () {
            $('#dataTable').on('click', '.editStatus', async function (e) {
                let status = $(this).data('status');
                if (status === 'success'){
                    return;
                }
                let id = $(this).data('id');
                let url = "{{ route('admin.orders.updateStatus', ':id') }}".replace(':id', id);
                const {value: pending, isConfirmed} = await Swal.fire({
                    title: "Pilih Status",
                    input: "select",
                    inputOptions: {
                        "pending": "Pending",
                        "process": "Proses",
                        "success": "Selesai",
                        "cancel": "Batal"
                    },
                    inputPlaceholder: "Pilih Status",
                    showCancelButton: true,
                    inputValue: status, // Set the default value to the current status
                    inputValidator: (value) => {
                        return new Promise((resolve) => {
                            $.ajax({
                                type: "post",
                                url: url,
                                data: {
                                    _token: "{{ csrf_token() }}",
                                    status: value,
                                    _method: "PUT"
                                },
                                success: function (response) {
                                    if (response.success) {
                                        resolve();
                                        getData();
                                    } else {
                                        resolve(response.message);
                                    }
                                }
                            });
                        });
                    }
                });
            });
        });
    </script>
@endpush

