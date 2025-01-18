@extends('admin.layouts.app')
@section('content')
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4">
        <h3 class="mb-0">List {{ $title }}</h3>

        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb align-items-center mb-0 lh-1">
                <li class="breadcrumb-item">
                    <a href="#" class="d-flex align-items-center text-decoration-none">
                        <i class="ri-home-4-line fs-18 text-primary me-1"></i>
                        <span class="text-secondary fw-medium hover">Dashboard</span>
                    </a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    <span class="fw-medium">{{ $title }}</span>
                </li>
            </ol>
        </nav>
    </div>

    <div class="card bg-white border-0 rounded-3 mb-4">
        <div class="card bg-white border-0 rounded-3 mb-4">
            <div class="card-body p-0">
                <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 p-4">
                    <form class="position-relative table-src-form me-0">
                        <input type="text" class="form-control" id="search" placeholder="Search here">
                        <i class="material-symbols-outlined position-absolute top-50 start-0 translate-middle-y">search</i>
                    </form>

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
                                    <th scope="col">Nama Perusahaan</th>
                                    <th scope="col">whatsapp</th>
                                    <th scope="col">Item</th>
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
@endsection

@push('js')
    <script>
        let dataTable = [];

        function getData(page = 1, query = '') {
            $.get(`{{ route('admin.orders.data') }}?page=${page}&search=${query}`, function(response) {
                const {
                    data,
                    meta,
                    links
                } = response;
                dataTable = data;
                // Clear table and pagination
                $('#dataTable').empty();
                $('#pagination').empty();

                // Render data
                $.each(data, function(key, value) {
                    const row = `
                    <tr>
                        <td class="text-body">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="_${value.id}">
                                <label class="position-relative top-2 ms-1" for="_${value.id}">${key + 1}</label>
                            </div>
                        </td>
                        <td class="text-body">${value.data.fullName}</td>
                        <td class="text-body">${value.data.companyEmail}</td>
                        <td class="text-body">${value.data.companyName}</td>
                        <td class="text-body">${value.data.whatsappNumber}</td>
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
                                                ${value.items.map(item => `
                                                                                        <li class="list-group-item">${item.name} - ${item.qty} pcs
                                                                                               <br>
                                                                                               <small class="text-muted">Merek: ${item.brand}</small>
                                                                                                <br>
                                                                                               <small class="text-muted">Kategori: ${item.category}</small>
                                                                                        </li>
                                                                                    `).join('')}
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td>
                            ${value.is_folow_up ? `Sudah di Folow Up` : `
                                                                    <a class="ps-0 border-0 bg-transparent lh-1 position-relative top-2 folow-up" data-id="${value.id}" data-whatsapp="${value.data.whatsappNumber}" href="javascript:void(0)">
                                                                        <i class="material-symbols-outlined fs-16 text-body">call</i> Folow Up
                                                                    </a>
                                                                `}
                        </td>
                    </tr>
                `;
                    $('#dataTable').append(row);
                });

                // Update showing info
                $('#showing-info').text(`Showing ${meta.from} to ${meta.to} of ${meta.total} Results`);

                // Render pagination
                $.each(meta.links, function(index, link) {
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
                $('#pagination .page-link').click(function(e) {
                    e.preventDefault();
                    const page = $(this).data('page');
                    if (page && page !== '#') {
                        getData(page);
                    }
                });
            });
        }

        $('#search').on('input', function() {
            const query = $(this).val();
            getData(1, query); // Fetch data from page 1 with search query
        });
        // Initial load
        getData();

        //folow up
        $('#dataTable').on('click', '.folow-up', function(e) {
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
                success: function(response) {
                    if (response.success) {
                        window.open(whatsappURL, "_blank");
                        getData();
                    }
                }
            });

        });
    </script>
@endpush
