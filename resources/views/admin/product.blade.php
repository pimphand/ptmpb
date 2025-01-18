@extends('admin.layouts.app')
@section('content')
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4">
        <h3 class="mb-0">Starter</h3>

        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb align-items-center mb-0 lh-1">
                <li class="breadcrumb-item">
                    <a href="#" class="d-flex align-items-center text-decoration-none">
                        <i class="ri-home-4-line fs-18 text-primary me-1"></i>
                        <span class="text-secondary fw-medium hover">Dashboard</span>
                    </a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    <span class="fw-medium">Produk</span>
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
                    <div class="btn-group" role="group" aria-label="Product Actions">
                        <a href="{{ route('admin.products.create') }}" type="button"
                           class="btn btn-primary text-white py-2 px-4 fw-semibold">
                            {{ __('app.add') }} {{ __('app.product') }}
                        </a>
                        <a href="{{ route('admin.products.create') }}" type="button" data-bs-toggle="modal" data-bs-target="#staticBackdrop"
                           class="btn btn-secondary text-white py-2 px-4 fw-semibold ml-2">
                            Upload Produk
                        </a>
                    </div>

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
                                    <th scope="col">{{ __('app.categories') }}</th>
                                    <th scope="col">Total Sub Produk</th>
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

    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Upload Produk</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="upload" action="{{route('admin.products.upload')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                           <input type="file" name="file" class="form-control">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger text-white" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-primary text-white" id="uploadBtn">Simapan</button>
                </div>
            </div>
        </div>
    </div>


@endsection

@push('js')
    <script>
        let dataTable = [];

        function getData(page = 1, query = '') {
            $.get(`{{ route('admin.products.data') }}?page=${page}&search=${query}`, function(response) {
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
                    let url = `{{ route('admin.products.destroy', ':id') }}`.replace(':id', value.id);
                    let urlEdit = `{{ route('admin.products.edit', ':id') }}`.replace(':id', value.id);
                    const row = `
                    <tr>
                        <td class="text-body">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="_${value.id}">
                                <label class="position-relative top-2 ms-1" for="_${value.id}">${key + 1}</label>
                            </div>
                        </td>
                        <td class="text-body">${value.name}</td>
                        <td class="text-body">${value.category.name}</td>

                        <td>
                            <span class="badge bg-primary bg-opacity-10 text-primary p-2 fs-12 fw-normal">${value.skus_count} Sub Produk</span>
                        </td>
                        <td>
                            <div class="d-flex align-items-center gap-1">
                                <a class="ps-0 border-0 bg-transparent lh-1 position-relative top-2" href="${urlEdit}" data-id="">
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
            $('#form').attr('action', `{{ route('admin.products.update', ':id') }}`.replace(':id', id));
            $('#id').val(data.id);
            $('#name').val(data.name);
            $('#description').val(data.description);
            $('#staticBackdropLabel').text('Edit Category');
            $('#staticBackdrop').modal('show');
        });

        $('#uploadBtn').click(function (e) {
            e.preventDefault();
            let formData = new FormData($('#upload')[0]);

            //add if format has id
            if ($('[name="id"]').val()) {
                formData.append('_method', 'PUT');
            }

            $('.error-message').remove();
            $('.is-invalid').removeClass('is-invalid');

            $.ajax({
                url: $('#upload').attr('action'),
                type: "POST",
                data: formData,
                processData: false, // Jangan memproses data
                contentType: false, // Jangan set tipe konten
                success: function(response) {
                    $('#staticBackdrop').modal('hide');
                    $('#upload')[0].reset();
                    Toast.fire({
                        icon: "success",
                        title: response.message
                    });
                    getData()
                },
                error: function(error) {
                    let errors = error.responseJSON.errors;
                    // Loop untuk menampilkan pesan error
                    $.each(errors, function(key, value) {
                        $(`[name="${key}"]`).addClass('is-invalid');
                        $(`[name="${key}"]`).after(
                            `<span class="error-message text-danger">${value[0]}</span>`
                        );
                    });
                }
            });
        });
    </script>
@endpush
