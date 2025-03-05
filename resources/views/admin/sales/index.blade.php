@extends('admin.layouts.app')
@section('content')
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4">
        <h3 class="mb-0">list User </h3>
        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb align-items-center mb-0 lh-1">
                <li class="breadcrumb-item">
                    <a href="#" class="d-flex align-items-center text-decoration-none">
                        <i class="ri-home-4-line fs-18 text-primary me-1"></i>
                        <span class="text-secondary fw-medium hover">Dashboard</span>
                    </a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    <span class="fw-medium">User</span>
                </li>
            </ol>
        </nav>
    </div>

    <div class="card bg-white border-0 rounded-3 mb-4">
        <div class="card bg-white border-0 rounded-3 mb-4">
            <div class="card-body p-0">
                <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 p-4">
                    <div class="d-flex">
                        <form class="position-relative table-src-form me-0">
                            <input type="text" class="form-control" id="search" placeholder="Search here">
                            <i class="material-symbols-outlined position-absolute top-50 start-0 translate-middle-y">search</i>
                        </form>
                    </div>

                </div>

                <div class="default-table-area style-two default-table-width">
                    <div class="table-responsive">
                        <table class="table align-middle">
                            <thead>
                                <tr>
                                    <th scope="col">
                                        Foto
                                    </th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Username</th>
                                    <th scope="col">Phone</th>
                                    <th scope="col">Total Order</th>
                                    <th scope="col">Total Customer</th>
                                    <th scope="col">Target</th>
                                    <th scope="col">Sedang Berjalan</th>
                                </tr>
                            </thead>
                            <tbody id="dataTable">

                            </tbody>
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
        let table = $('#dataTable');
        function getData(page = 1, query = '', role = '') {
            $.get(`{{ route('admin.sales.data') }}?page=${page}&search=${query}&role=${role}`, function(response) {
                const {
                    data,
                    meta,
                    links
                } = response;
                dataTable = data;
                // Clear table and pagination
                table.empty();
                $('#pagination').empty();

                // Render data
                $.each(data, function(key, value) {
                    let detail = `{{ route('admin.sales.show', ':id') }}`.replace(':id', value.id);
                    const row = `
                    <tr>
                        <td class="text-body">
                            <img src="${value.photo ? '{{ asset('storage') }}/'+value.photo : '{{ asset('admin/assets/images/user-42.jpg') }}'}" class="wh-34 rounded-circle" alt="${value.name}">
                        </td>
                        <td class="text-body"><a href="${detail}?user_id=${value.id}" class="btn btn-outline-primary hover-bg">${value.name}</a></td>
                        <td class="text-body">${value.username ?? "-"}</td>
                        <td class="text-body">${value.phone ?? '-'}</td>
                        <td class="text-body">${value.orders_count	}</td>
                        <td class="text-body">${value.customers_count}</td>
                        <td class="text-body">
                            <span class="btn btn-outline-primary omzet input-${value.id}" data-id="${value.id}">
                                Rp ${parseInt(value.target_sales).toLocaleString('id-ID')}
                            </span>
                            <input class="form-control omzet-${value.id}" type="number" value="${value.target_sales}" style="display:none">
                            <p class="text-danger text-danger-${value.id}"></p>
                            <button style="display:none" data-id="${value.id}" class="omzet-${value.id} btn btn-outline-success">Simpan</button>
                            <button style="display:none" data-id="${value.id}" class="omzet-${value.id} btn btn-outline-danger">Batal</button>
                        </td>
                        <td class="text-body"><span class="badge bg-success bg-opacity-10 text-success p-2 fs-12 fw-normal">${value.achieved_sales}</span></td>
                    </tr>
                `;
                    table.append(row);
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

        //edit
        table.on('click', '.omzet', function() {
            const id = $(this).data('id');
            $('.omzet-'+id).show();
            $(this).hide();
        });

        table.on('click', '.btn-outline-danger', function() {
            const id = $(this).data('id');
            $('.omzet-'+id).hide();
            $(`.input-${id}`).show();
        });

        table.on('click', '.btn-outline-success', function() {
            const id = $(this).data('id');
            const url = `{{ route('admin.sales.update', ':id') }}`.replace(':id', id);
            const value = parseFloat($(`.omzet-${id}`).val()) || 0; // Konversi ke angka, default 0 jika NaN

            $.ajax({
                url: url,
                type: 'post',
                data: {
                    _method: 'put',
                    target_sales: value,
                    _token: '{{ csrf_token() }}',
                    omzet: true
                },
                dataType: 'json',
                success: function(response) {
                    getData();
                },
                error: function(xhr) {
                    $('.text-danger-'+id).text(xhr.responseJSON.message);
                }
            });
        });

        //add
        $('.add').click(function() {
            const form = $('#form');
            form.attr('action', `{{ route('admin.sales.store') }}`);
            form.trigger('reset');
            //Remove method put
            $('#form [name="_method"]').remove();
            $('#staticBackdropLabel').text('Tambah User');
            $('#staticBackdrop').modal('show');
        });

        //photo-preview
        $('#photo').change(function() {
            const file = this.files[0];
            const reader = new FileReader();
            reader.onload = function(e) {
                $('#photo-preview').attr('src', e.target.result);
            }
            reader.readAsDataURL(file);
        });

        //#save
        $('#save').click(function(e) {
            e.preventDefault();
            formSendData();
        });

        $('.btn-role').click(function (e) {
            e.preventDefault();
            const role = $(this).data('value');
            getData(1,$('#search').val(), role);
        })
    </script>
@endpush
