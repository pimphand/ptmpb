<div class="default-table-area style-two default-table-width">
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 p-4">
        <form class="position-relative table-src-form me-0">
            <input type="text" class="form-control" id="search" placeholder="Search here">
            <i class="material-symbols-outlined position-absolute top-50 start-0 translate-middle-y">search</i>
        </form>
        <div id="button" class="ms-2"></div>
    </div>
    <div class="table-responsive" @if($order === true) style="max-height: 300px; overflow-y: auto;" @endif>
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
                <th scope="col">Merek</th>
                <th scope="col">Ukuran</th>
                <th scope="col">{{ __('app.categories') }}</th>
            </tr>
            </thead>
            <tbody id="dataTable" @if($order === true)style="max-height: 300px; overflow-y: auto;" @endif>

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
                    <ul id="pagination_" class="pagination mb-0 justify-content-center"></ul>
                </nav>
            </div>
        </div>
    </div>
</div>
@push('js')
    <script>
        let dataTable = [];
        let brand = '';
        function getData(page = 1, query = '', brand = '') {
            $.get(`{{ route('admin.products.skus') }}?page=${page}&search=${query}&brand=${brand}`, function (response) {
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
                $.each(data, function (key, value) {
                    const row = `
                    <tr class="skus" data-id="${value.id}">
                        <td class="text-body">
                            <div class="form-check">
                                <label class="position-relative top-2 ms-1" for="_${value.id}">${key + 1}</label>
                            </div>
                        </td>
                        <td class="text-body">${value.name}</td>
                        <td class="text-body">${value.product.name}</td>
                        <td class="text-body">${value.packaging}</td>
                        <td class="text-body">${value.product.category.name}</td>
                    </tr>
                `;
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
                            <a class="page-link" href="#" data-page="${link.url}">
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
            getData(1, query,brand);
        });
        // Initial load
        getData();

        //edit
        $('#dataTable').on('click', '.edit', function () {
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
                success: function (response) {
                    $('#staticBackdrop').modal('hide');
                    $('#upload')[0].reset();
                    Toast.fire({
                        icon: "success",
                        title: response.message
                    });
                    getData()
                },
                error: function (error) {
                    let errors = error.responseJSON.errors;
                    // Loop untuk menampilkan pesan error
                    $.each(errors, function (key, value) {
                        let  input = $(`[name="${key}"]`);
                        input.addClass('is-invalid');
                        input.after(
                            `<span class="error-message text-danger">${value[0]}</span>`
                        );
                    });
                }
            });
        });
        $.get(`{{ route('admin.brands.data') }}`, function (response) {
            $.each(response.data, function (key, value) {
                if (key !== 'done') {
                    $('#button').append(`<button data-value="${value.name}" class="btn btn-outline-info btn-sm me-2 text-info btn-brand hover-bg">${value.name}</button>`);
                }
            });
        });

        $('#button').on('click', '.btn-brand', function () {
            brand = $(this).data('value');
            $('.btn-brand').removeClass('bg-info text-white');
            $(this).addClass('bg-info text-white');
            getData(page = 1, $('#search').val(), brand)
        });
    </script>
@endpush

