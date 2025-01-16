@extends('admin.layouts.app')
@section('content')
    <style>
        #upload-area {
            position: relative;
            height: 250px;
        }

        #files-preview-container img {
            margin: 5px;
        }

        #files-list-container {
            margin-top: 15px;
        }
    </style>
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4">
        <h3 class="mb-0">Tambah Produk</h3>

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
                <li class="breadcrumb-item active" aria-current="page">
                    <span class="fw-medium">Tambah Produk</span>
                </li>
            </ol>
        </nav>
    </div>
    <div class="row">
        <div class="col-xxl-12">
            <div class="card bg-white border-0 rounded-3 mb-4">
                <div class="card-body p-4">
                    <form id="form"
                        @if($product)
                            action="{{route('admin.products.update', ['product' => $product])}}" method="POST" enctype="multipart/form-data"

                        @else
                              action="{{route('admin.products.store')}}" method="POST" enctype="multipart/form-data"
                        @endif
                    >
                        @csrf
                        @if($product)
                            @method('PUT')
                        @endif
                        <div class="row">
                            <div class="col-lg-6 col-sm-6">
                                <div class="form-group mb-4">
                                    <label class="label text-secondary">Nama Produk</label>
                                    <input type="text" name="name" class="form-control h-55" value="{{$product ? $product->name : ''}}"
                                           placeholder="Masukan Nama Produk">
                                </div>
                            </div>

                            <div class="col-lg-6 col-sm-6">
                                <div class="form-group mb-4">
                                    <label class="label text-secondary">Kategori Produk</label>
                                    <select class="form-select form-control h-55" aria-label="Default select example"
                                            name="category">

                                        @foreach($categories as $category)
                                            <option value="{{$category->id}}" {{$product->category_id == $category->id ? 'selected' : ''}}>{{$category->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <hr>
                        <h6>SKU</h6>
                        @if(!$product)
                            <div class="row">
                                <div class="col-lg-4 col-sm-4">
                                    <div class="form-group mb-4">
                                        <label class="label text-secondary">Nama SKU</label>
                                        <input type="text" name="name_sku[]" class="form-control h-55"
                                               placeholder="Masukan Nama SKU">
                                    </div>
                                </div>
                                <div class="col-lg-4 col-sm-4">
                                    <div class="form-group mb-4">
                                        <label class="label text-secondary">Kemasan</label>
                                        <input type="text" name="packaging[]" class="form-control h-55"
                                               placeholder="Masukan Kemasan">
                                    </div>
                                </div>

                                <div class="col-lg-4 col-sm-4">
                                    <div class="form-group mb-4">
                                        <label class="label text-secondary">Aplikasi</label>
                                        <input type="text" name="application[]" class="form-control h-55"
                                               placeholder="Masukan Aplikasi">
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group mb-4">
                                        <label class="label text-secondary fs-14">Deskripsi Produk</label>
                                        <textarea rows="3" class="form-control" name="description[]"
                                                  placeholder="masukan deskripsi produk"></textarea>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group mb-4 only-file-upload">
                                        <label class="label text-secondary">Upload Product Images</label>
                                        <div class="form-control h-100 text-center position-relative p-4 p-lg-5"
                                             id="upload-area">
                                            <div class="product-upload">
                                                <label for="file-upload" class="file-upload mb-0">
                                                    <i class="ri-folder-image-line bg-primary bg-opacity-10 p-2 rounded-1 text-primary"></i>
                                                    <span class="d-block text-body fs-14"><span
                                                            class="text-primary text-decoration-underline">Browse Pilih Gambar</span></span>
                                                </label>
                                                <label class="position-absolute top-0 bottom-0 start-0 end-0 cursor active"
                                                       id="upload-container">
                                                    <input name="image[]" class="form__file bottom-0" id="upload-files"
                                                           type="file" multiple="multiple" accept="image/*">
                                                </label>
                                            </div>
                                            <div id="files-preview-container"
                                                 class="d-flex justify-content-center align-items-center flex-wrap gap-3 position-absolute top-50 start-50 translate-middle"></div>
                                        </div>
                                        <div id="files-list-container" class="mt-3 text-center"></div>
                                    </div>
                                </div>
                            </div>
                        @else
                            @foreach($product->skus as $sku)
                                <div class="row">
                                    <div class="col-lg-3 col-sm-4">
                                        <div class="form-group mb-4">
                                            <label class="label text-secondary">Nama SKU</label>
                                            <input type="text" name="name_sku[]" class="form-control h-55" value="{{$sku->name}}"
                                                   placeholder="Masukan Nama SKU">
                                            <input type="text" name="sku_id[]" class="form-control h-55" value="{{$sku->id}}"
                                                   placeholder="Masukan Nama SKU" hidden="">
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-sm-4">
                                        <div class="form-group mb-4">
                                            <label class="label text-secondary">Kemasan</label>
                                            <input type="text" name="packaging[]" class="form-control h-55" value="{{$sku->packaging}}"
                                                   placeholder="Masukan Kemasan">
                                        </div>
                                    </div>

                                    <div class="col-lg-3 col-sm-4">
                                        <div class="form-group mb-4">
                                            <label class="label text-secondary">Aplikasi</label>
                                            <input type="text" name="application[]" class="form-control h-55" value="{{$sku->application}}"
                                                   placeholder="Masukan Aplikasi">
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-sm-4">
                                        <div class="form-group mb-4">
                                            <label class="label text-secondary">Kinerja</label>
                                            <input type="text" name="performance[]" class="form-control h-55" value="{{$sku->performance}}"
                                                   placeholder="Masukan Kinerja">
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group mb-4">
                                            <label class="label text-secondary fs-14">Deskripsi Produk</label>
                                            <textarea rows="3" class="form-control" name="description[]" placeholder="masukan deskripsi produk">{{$sku->description}}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group mb-4 only-file-upload">
                                            <label class="label text-secondary">Upload Product Images</label>
                                            <div class="form-control h-100 text-center position-relative p-4 p-lg-5"
                                                 id="upload-area">
                                                <div class="product-upload">
                                                    <label for="file-upload" class="file-upload mb-0">
                                                        <i class="ri-folder-image-line bg-primary bg-opacity-10 p-2 rounded-1 text-primary"></i>
                                                        <span class="d-block text-body fs-14"><span
                                                                class="text-primary text-decoration-underline">Browse Pilih Gambar</span></span>
                                                    </label>
                                                    <label class="position-absolute top-0 bottom-0 start-0 end-0 cursor active"
                                                           id="upload-container">
                                                        <input name="image[]" class="form__file bottom-0" id="upload-files"
                                                               type="file" multiple="multiple" accept="image/*">
                                                    </label>
                                                </div>
                                                <div id="files-preview-container"
                                                     class="d-flex justify-content-center align-items-center flex-wrap gap-3 position-absolute top-50 start-50 translate-middle"></div>
                                            </div>
                                            <div id="files-list-container" class="mt-3 text-center"></div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif

                        <div class="col-lg-12">
                            <div class="d-flex flex-wrap gap-3">
                                <button class="btn btn-primary py-2 px-4 fw-medium fs-16">
                                    <i class="ri-add-line text-white fw-medium"></i> Tambah Sku
                                </button>
                                <a href="{{back()->getTargetUrl()}}"
                                   class="btn btn-danger py-2 px-4 fw-medium fs-16 text-white">Cancel</a>
                                <button class="btn btn-primary py-2 px-4 fw-medium fs-16" type="button" id="save">
                                    <i class="ri-add-line text-white fw-medium"></i> Simpan Produk
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        $(document).ready(function () {
            let skuIndex = 1;

            // Tambah SKU
            $('.btn-primary:contains("Tambah Sku")').click(function (e) {
                e.preventDefault();
                skuIndex++;
                console.log(skuIndex);
                let newSku = `
            <div class="row sku-item" data-index="${skuIndex}">
                <div class="col-lg-4 col-sm-4">
                    <div class="form-group mb-4">
                        <label class="label text-secondary">Nama SKU</label>
                        <input type="text" name="name_sku[]" class="form-control h-55" placeholder="Masukan Nama SKU">
                    </div>
                </div>
                <div class="col-lg-4 col-sm-4">
                    <div class="form-group mb-4">
                        <label class="label text-secondary">Kemasan</label>
                        <input type="text" name="packaging[]" class="form-control h-55" placeholder="Masukan Kemasan">
                    </div>
                </div>
                <div class="col-lg-3 col-sm-3">
                    <div class="form-group mb-4">
                        <label class="label text-secondary">Aplikasi</label>
                        <input type="text" name="application[]" class="form-control h-55" placeholder="Masukan Aplikasi">
                    </div>
                </div>
                <div class="col-lg-1">
                    <div class="form-group mb-4">
                        <label class="label text-secondary">&nbsp;</label>
                        <button class="btn btn-danger remove-sku">Hapus SKU</button>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="form-group mb-4">
                        <label class="label text-secondary fs-14">Deskripsi Produk</label>
                        <textarea rows="3" class="form-control" name="description[]" placeholder="masukan deskripsi produk"></textarea>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="form-group mb-4 only-file-upload">
                        <label class="label text-secondary">Upload Product Images</label>
                        <div class="form-control h-100 text-center position-relative p-4 p-lg-5 upload-area">
                            <div class="product-upload">
                                <label for="file-upload-${skuIndex}" class="file-upload mb-0">
                                    <i class="ri-folder-image-line bg-primary bg-opacity-10 p-2 rounded-1 text-primary"></i>
                                    <span class="d-block text-body fs-14"><span class="text-primary text-decoration-underline">Pilih Gambar </span></span>
                                </label>
                                <input  name="image[]" class="form__file bottom-0 upload-files" id="file-upload-${skuIndex}" type="file" multiple="multiple" accept="image/*">
                            </div>
                            <div class="files-preview-container d-flex justify-content-center align-items-center flex-wrap gap-3 mt-3"></div>
                        </div>
                    </div>
                </div>
            </div>`;

                $(newSku).insertBefore('.col-lg-12:last');
            });

            // Hapus SKU
            $(document).on('click', '.remove-sku', function (e) {
                e.preventDefault();
                $(this).closest('.sku-item').remove();
            });

            $(document).on('change', '#upload-files', function (event) {
                const files = event.target.files;
                const previewContainer = $(this).closest('#upload-area').find('#files-preview-container');
                previewContainer.empty(); // Clear previous previews

                Array.from(files).forEach(file => {
                    if (file.type.startsWith('image/')) {
                        const reader = new FileReader();
                        reader.onload = function (e) {
                            const imgPreview = `
                        <div class="preview-container" style="width: 290px; position: relative;">
                            <img src="${e.target.result}" alt="Preview" style="width: 100%; height: 100%; object-fit: cover; border: 2px solid #ddd; border-radius: 5px;">
                        </div>`;
                            previewContainer.append(imgPreview);
                        };
                        reader.readAsDataURL(file);
                    }
                });
            });

            // Preview gambar untuk elemen dinamis
            $(document).on('change', '.upload-files', function (event) {
                const files = event.target.files;
                const previewContainer = $(this).closest('.upload-area').find('.files-preview-container');
                previewContainer.empty(); // Clear previous previews

                Array.from(files).forEach(file => {
                    if (file.type.startsWith('image/')) {
                        const reader = new FileReader();
                        reader.onload = function (e) {
                            const imgPreview = `
                        <div class="preview-container" style="width: 290px; position: relative;">
                            <img src="${e.target.result}" alt="Preview" style="width: 100%; height: 100%; object-fit: cover; border: 2px solid #ddd; border-radius: 5px;">
                        </div>`;
                            previewContainer.append(imgPreview);
                        };
                        reader.readAsDataURL(file);
                    }
                });
            });
        });

        // Simpan Produk
        $('#save').click(function (e) {
            e.preventDefault();
            formSendData();
        });

        function getData(){
            //set delay 2 seconds
        }
    </script>

@endpush
