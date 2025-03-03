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
                        @foreach($roles as $role)
                            <button data-value="{{$role->name}}" class="btn btn-outline-info btn-sm m-1 text-info btn-role hover-bg">{{$role->display_name}}</button>
                        @endforeach
                    </div>
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
                                    <th scope="col">
                                        Foto
                                    </th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Username</th>
                                    <th scope="col">Phone</th>
                                    <th scope="col">Role</th>
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
                                <label for="role" class="form-label">Role</label>
                                <select class="form-select form-control" name="role" id="role">
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->id }}">{{ $role->display_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-2 col-6">
                                <label for="name" class="form-label">{{ __('app.name') }}</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    placeholder="masukan nama">
                            </div>
                            <div class="mb-2 col-6">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" class="form-control" id="username" name="username"
                                    placeholder="masukan username">
                            </div>
                            <div class="mb-2 col-6">
                                <label for="email" class="form-label">Email</label>
                                <input type="text" class="form-control" id="email" name="email"
                                    placeholder="masukan email">
                            </div>
                            <div class="mb-2 col-6">
                                <label for="whatsapp" class="form-label">Nomor Whatsapp</label>
                                <input type="text" class="form-control" id="phone" name="phone"
                                    placeholder="masukan nomor whatsapp">
                            </div>
                            <div class="mb-2 col-6">
                                <label for="password" class="form-label">Password</label>
                                <input type="text" class="form-control" id="password" name="password"
                                    placeholder="masukan password">
                            </div>
                            <div class="mb-2 col-12">
                                <label for="Alamat" class="form-label">Alamat</label>
                                <input type="text" class="form-control" id="address" name="address"
                                    placeholder="masukan Alamat">
                            </div>
                            <div class="mb-2 col-6">
                                <label for="photo" class="form-label">Foto</label>
                                <input type="file" class="form-control" id="photo" name="photo"
                                    placeholder="masukan Photo">
                            </div>
                            <div class="mb-2 col-6">
                                <img src="" width="200px" alt="" id="photo-preview">
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
        function getData(page = 1, query = '', role = '') {
            $.get(`{{ route('admin.users.data') }}?page=${page}&search=${query}&role=${role}`, function(response) {
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
                    let url = `{{ route('admin.users.destroy', ':id') }}`.replace(':id', value.id);
                    let urlEdit = `{{ route('admin.users.edit', ':id') }}`.replace(':id', value.id);
                    let detail = `{{ route('admin.users.show', ':id') }}`.replace(':id', value.id);
                    const row = `
                    <tr>
                        <td class="text-body">
                            <img src="${value.photo ? '{{ asset('storage') }}/'+value.photo : '{{ asset('admin/assets/images/user-42.jpg') }}'}" class="wh-34 rounded-circle" alt="${value.name}">
                        </td>
                        <td class="text-body"><a href="${detail}" class="btn btn-outline-primary hover-bg">${value.name}</a></td>
                        <td class="text-body">${value.username ?? "-"}</td>
                        <td class="text-body">${value.phone ?? '-'}</td>
                        <td class="text-body">${value.roles[0].display_name	}</td>
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
            const form = $('#form');
            form.attr('action', `{{ route('admin.users.update', ':id') }}`.replace(':id', id));
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
            form.attr('action', `{{ route('admin.users.store') }}`);
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
