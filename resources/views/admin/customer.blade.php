@extends('admin.layouts.app')
@section('content')
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4">
        <h3 class="mb-0">list Customer </h3>

        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb align-items-center mb-0 lh-1">
                <li class="breadcrumb-item">
                    <a href="#" class="d-flex align-items-center text-decoration-none">
                        <i class="ri-home-4-line fs-18 text-primary me-1"></i>
                        <span class="text-secondary fw-medium hover">Dashboard</span>
                    </a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    <span class="fw-medium">Customer</span>
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
                    <a href="javascript:void(0)" type="button"
                       class="btn btn-primary text-white py-2 px-4 fw-semibold add">
                        {{ __('app.add') }} {{ $title }}
                    </a>
                </div>

                <div class="default-table-area style-two default-table-width">
                    <div class="table-responsive">
                        <table class="table align-middle">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nama Pemilik</th>
                                <th scope="col">Nama Toko</th>
                                <th scope="col">Alamat</th>
                                <th scope="col">No Whatsapp</th>
                                <th scope="col">NPWP</th>
                                <th scope="col">{{ __('app.action') }}</th>
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
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
         aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel"></h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="form">
                        @csrf
                        <input type="hidden" name="id" id="id">
                        <div class="row">
                            <div class="mb-2 col-6">
                                <label for="user_id" class="form-label">Sales</label>
                                <select class="form-select form-control" name="user_id" id="user_id">
                                    @foreach ($sales as $sale)
                                        <option value="{{ $sale->id }}">{{ $sale->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-2 col-6">
                                <label for="name" class="form-label">{{ __('app.name') }}</label>
                                <input type="text" class="form-control" id="name" name="name"
                                       placeholder="masukan nama">
                            </div>
                            <div class="mb-2 col-6">
                                <label for="phone" class="form-label">Nomor Whatsapp</label>
                                <input type="text" class="form-control" id="phone" name="phone"
                                       placeholder="masukan nomor whatsapp">
                            </div>
                            <div class="mb-2 col-6">
                                <label for="address" class="form-label">Alamat Lengkap</label>
                                <input type="text" class="form-control" id="address" name="address"
                                       placeholder="masukan alamat lengkap">
                            </div>
                            <div class="mb-2 col-6">
                                <label for="store_name" class="form-label">Nama Toko</label>
                                <input type="text" class="form-control" id="store_name" name="store_name"
                                       placeholder="masukan alamat lengkap">
                            </div>
                            <div class="mb-2 col-6">
                                <label for="npwp" class="form-label">NPWP (optional)</label>
                                <input type="text" class="form-control" id="npwp" name="npwp"
                                       placeholder="masukan alamat lengkap">
                            </div>

                            <div class="mb-2 col-6">
                                <label for="store_photo" class="form-label">Foto Toko</label>
                                <input type="file" class="form-control" id="store_photo" name="store_photo">
                            </div>
                            <div class="mb-2 col-6">
                                <img src="" width="200px" alt="" id="store_photo-preview">
                            </div>
                            <div class="mb-2 col-6">
                                <label for="owner_photo" class="form-label">Foto Pemilik</label>
                                <input type="file" class="form-control" id="owner_photo" name="owner_photo">
                            </div>
                            <div class="mb-2 col-6">
                                <img src="" width="200px" alt="" id="owner_photo-preview">
                            </div>
                            <div class="mb-2 col-6">
                                <label for="is_blacklist" class="form-label">Blacklist</label>
                                <select class="form-select form-control" name="is_blacklist" id="is_blacklist">
                                    <option value="0">Tidak</option>
                                    <option value="1">Ya</option>
                                </select>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger text-white"
                            data-bs-dismiss="modal">{{ __('app.close') }}</button>
                    <button type="button" class="btn btn-primary text-white"
                            id="save">{{ __('app.save') }}</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        let dataTable = [];

        function getData(page = 1, query = '') {
            $.get(`{{ route('admin.customers.data') }}?page=${page}&search=${query}`, function(response) {
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
                    let url = `{{ route('admin.customers.destroy', ':id') }}`.replace(':id', value.id);
                    let urlEdit = `{{ route('admin.customers.edit', ':id') }}`.replace(':id', value.id);
                    const row = `
                    <tr class="align-middle" style="background-color: ${value.is_blacklist != "0" ? '#f8d7da' : ''}">
                        <td class="text-body">
                            ${key + 1}
                        </td>
                        <td class="text-body flex"><img src="${value.store_photo ? '{{ asset('storage') }}/'+value.store_photo : '{{ asset('admin/assets/images/user-42.jpg') }}'}" class="wh-34 rounded-circle" alt="${value.name}"> ${value.name}</td>
                        <td class="text-body">${value.store_name ?? '-'}</td>
                        <td class="text-body">${value.address ?? '-'}</td>
                        <td class="text-body">${value.phone ?? '-'}</td>
                        <td class="text-body">${value.npwp ?? '-'}</td>
                        <td>
                            <div class="d-flex align-items-center gap-1">
                                <a class="ps-0 border-0 bg-transparent lh-1 position-relative top-2 edit" href="javascript:void(0)" data-url="${urlEdit}" data-id="${value.id}">
                                    <i class="material-symbols-outlined fs-16 text-body">edit</i>
                                </a>
                                <button class="ps-0 border-0 bg-transparent lh-1 position-relative top-2" onclick="deleteData('${url}','${value.name}')">
                                    <i class="material-symbols-outlined fs-16 text-danger">delete</i>
                                </button>
                            </div>
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

        //edit
        $('#dataTable').on('click', '.edit', function() {
            const id = $(this).data('id');
            const data = dataTable.find(item => item.id === id);
            let form = $('#form');
            form.attr('action', `{{ route('admin.customers.update', ':id') }}`.replace(':id', id));
            //add method put
            form.append('<input type="hidden" name="_method" value="PUT">');

            $('#id').val(data.id);
            $('#name').val(data.name);
            $('#phone').val(data.phone);
            $('#address').val(data.address);
            $('#store_name').val(data.store_name);
            $('#npwp').val(data.npwp);
            $('#user_id').val(data.user_id);
            $('#store_photo-preview').attr('src', data.store_photo ? `{{ asset('storage') }}/${data.store_photo}` : '');
            $('#owner_photo-preview').attr('src', data.owner_photo ? `{{ asset('storage') }}/${data.owner_photo}` : '');
            $('#is_blacklist').val(data.is_blacklist);
            $('#staticBackdropLabel').text('Edit Customer');
            $('#staticBackdrop').modal('show');
        });

        //add
        $('.add').click(function() {
            $('#form').attr('action', `{{ route('admin.customers.store') }}`);
            $('#form').trigger('reset');
            $('#store_photo-preview').attr('src','');
            $('#owner_photo-preview').attr('src','');
            //Remove method put
            $('#form [name="_method"]').remove();
            $('#staticBackdropLabel').text('Tambah User');
            $('#staticBackdrop').modal('show');
        });

        //photo-preview
        $('#store_photo').change(function() {
            const file = this.files[0];
            const reader = new FileReader();
            reader.onload = function(e) {
                $('#store_photo-preview').attr('src', e.target.result);
            }
            reader.readAsDataURL(file);
        });

        //photo-preview
        $('#owner_photo').change(function() {
            const file = this.files[0];
            const reader = new FileReader();
            reader.onload = function(e) {
                $('#owner_photo-preview').attr('src', e.target.result);
            }
            reader.readAsDataURL(file);
        });

        //#save
        $('#save').click(function(e) {
            e.preventDefault();
            formSendData();
        });
    </script>
@endpush
