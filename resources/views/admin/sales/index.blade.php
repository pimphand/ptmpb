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
        function getData(page = 1, query = '', role = '') {
            $.get(`{{ route('admin.sales.data') }}?page=${page}&search=${query}&role=${role}`, function(response) {
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
                    let url = `{{ route('admin.sales.destroy', ':id') }}`.replace(':id', value.id);
                    let urlEdit = `{{ route('admin.sales.edit', ':id') }}`.replace(':id', value.id);
                    let detail = `{{ route('admin.sales.show', ':id') }}`.replace(':id', value.id);
                    const row = `
                    <tr>
                        <td class="text-body">
                            <img src="${value.photo ? '{{ asset('storage') }}/'+value.photo : '{{ asset('admin/assets/images/user-42.jpg') }}'}" class="wh-34 rounded-circle" alt="${value.name}">
                        </td>
                        <td class="text-body"><a href="${detail}" class="btn btn-outline-primary hover-bg">${value.name}</a></td>
                        <td class="text-body">${value.username ?? "-"}</td>
                        <td class="text-body">${value.phone ?? '-'}</td>
                        <td class="text-body">${value.orders_count	}</td>
                        <td class="text-body">${value.customers_count	}</td>
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

        //edit
        $('#dataTable').on('click', '.edit', function() {
            const id = $(this).data('id');
            const data = dataTable.find(item => item.id === id);
            const form = $('#form');
            form.attr('action', `{{ route('admin.sales.update', ':id') }}`.replace(':id', id));
            //add method put
            form.append('<input type="hidden" name="_method" value="PUT">');

            $('#id').val(data.id);
            $('#name').val(data.name);
            $('#username').val(data.username);
            $('#email').val(data.email);
            $('#phone').val(data.phone);
            $('#address').val(data.address);
            $('#photo-preview').attr('src', "{{ asset('storage') }}/" + data.photo);

            $('#role').val(data.roles[0].id);
            $('#staticBackdropLabel').text('Edit User');
            $('#staticBackdrop').modal('show');
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
