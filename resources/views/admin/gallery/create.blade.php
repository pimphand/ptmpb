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
        <h3 class="mb-0">Tambah Galeri</h3>

        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb align-items-center mb-0 lh-1">
                <li class="breadcrumb-item">
                    <a href="#" class="d-flex align-items-center text-decoration-none">
                        <i class="ri-home-4-line fs-18 text-primary me-1"></i>
                        <span class="text-secondary fw-medium hover">Dashboard</span>
                    </a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    <span class="fw-medium">Galeri</span>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    <span class="fw-medium">Tambah Galeri</span>
                </li>
            </ol>
        </nav>
    </div>
    <div class="row">
        <div class="col-xxl-12">
            <div class="card bg-white border-0 rounded-3 mb-4">
                <div class="card-body p-4">
                    <form id="form"
                        @if ($gallery) action="{{ route('admin.galleries.update', $gallery->id) }}"
                          @else
                              action="{{ route('admin.galleries.store') }}" @endif>
                        @csrf
                        @if ($gallery)
                            @method('PUT')
                        @endif
                        <div class="row">
                            <div class="col-lg-4 col-sm-6">
                                <div class="form-group mb-4">
                                    <label class="label text-secondary">Nama Galeri</label>
                                    <input type="text" name="title" value="{{ $gallery->title ?? '' }}"
                                        class="form-control h-55" placeholder="Masukan Nama Galeri">
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-6">
                                <div class="form-group mb-4">
                                    <label class="label text-secondary">Type</label>
                                    <select type="text" name="type" class="form-control h-55" id="type">
                                        <option value="gallery">Gallery</option>
                                        <option value="banner">Banner</option>
                                        <option value="slide-banner">Slide Banner</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-6 url"
                                style="display: {{ isset($gallery->type) == 'slide-banner' ? '' : 'none' }}">
                                <div class="form-group mb-4">
                                    <label class="label text-secondary">Url</label>
                                    <input type="text" name="url" value="{{ $gallery->url ?? '' }}"
                                        class="form-control h-55" placeholder="Masukan Url">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group mb-4">
                                    <label class="label text-secondary fs-14">Deskripsi Singkat</label>
                                    <textarea rows="3" class="form-control" name="description" placeholder="masukan deskripsi singkat">{{ $gallery->description ?? '' }}</textarea>
                                </div>
                            </div>
                            @if ($gallery)
                                @foreach ($gallery->images as $key => $image)
                                    <div class="col-lg-11">
                                        <div class="form-group mb-4 only-file-upload">
                                            <label class="label text-secondary">Gambar</label>
                                            <div class="form-control h-100 text-center position-relative p-4 p-lg-5"
                                                id="upload-area">
                                                <div class="product-upload">
                                                    <label for="file-upload" class="file-upload mb-0">
                                                        <i
                                                            class="ri-folder-image-line bg-primary bg-opacity-10 p-2 rounded-1 text-primary"></i>
                                                        <span class="d-block text-body fs-14"><span
                                                                class="text-primary text-decoration-underline">Pilih
                                                                Gambar</span></span>
                                                    </label>
                                                    <label
                                                        class="position-absolute top-0 bottom-0 start-0 end-0 cursor active"
                                                        id="upload-container">
                                                        <input name="image[]" class="form__file bottom-0" id="upload-files"
                                                            type="file" multiple="multiple" accept="image/*">
                                                    </label>
                                                </div>
                                                <div
                                                    class="d-flex justify-content-center align-items-center flex-wrap gap-3 position-absolute top-50 start-50 translate-middle">
                                                    <div class="preview-container" style="max-width: 50%; width: 400px;">
                                                        <img src="{{ asset('storage/' . $image->path) }}"
                                                            class="rounded-3 img-fluid" alt="Preview">
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-1">
                                        <button class="btn btn-danger btn-sm mt-2 delete"
                                            onclick="deleteDataNoRedirect('{{ route('admin.images.destroy', $image->id) }}','Photo {{ $key + 1 }}')"
                                            type="button" style="color: #fff">
                                            Hapus Gambar
                                        </button>
                                    </div>
                                @endforeach
                            @else
                                <div class="col-lg-11">
                                    <div class="form-group mb-4 only-file-upload">
                                        <label class="label text-secondary">Gambar</label>
                                        <div class="form-control h-100 text-center position-relative p-4 p-lg-5"
                                            id="upload-area">
                                            <div class="product-upload">
                                                <label for="file-upload" class="file-upload mb-0">
                                                    <i
                                                        class="ri-folder-image-line bg-primary bg-opacity-10 p-2 rounded-1 text-primary"></i>
                                                    <span class="d-block text-body fs-14"><span
                                                            class="text-primary text-decoration-underline">Pilih
                                                            Gambar</span></span>
                                                </label>
                                                <label class="position-absolute top-0 bottom-0 start-0 end-0 cursor active"
                                                    id="upload-container">
                                                    <input name="image[]" class="form__file bottom-0" id="upload-files"
                                                        type="file" multiple="multiple" accept="image/*">
                                                </label>
                                            </div>
                                            <div id="files-preview-container"
                                                class="d-flex justify-content-center align-items-center flex-wrap gap-3 position-absolute top-50 start-50 translate-middle">
                                            </div>
                                        </div>
                                        <div id="files-list-container" class="mt-3 text-center"></div>
                                    </div>
                                </div>
                                <div class="col-lg-1">
                                    <button class="btn btn-primary btn-sm" type="button">
                                        Tambah Gambar
                                    </button>
                                </div>
                            @endif

                        </div>

                        <div class="col-lg-12">
                            <div class="d-flex flex-wrap gap-3">
                                <button class="btn btn-primary btn-sm add" type="button" style="display: none">
                                    Tambah Gambar
                                </button>
                                <a href="{{ back()->getTargetUrl() }}"
                                    class="btn btn-danger py-2 px-4 fw-medium fs-16 text-white">Cancel</a>
                                <button class="btn btn-primary py-2 px-4 fw-medium fs-16" type="button" id="save">
                                    <i class="ri-add-line text-white fw-medium"></i> Simpan Galeri
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
        $(document).ready(function() {
            $(document).on('change', '#upload-files', function(event) {
                const files = event.target.files;
                const previewContainer = $(this).closest('#upload-area').find('#files-preview-container');
                previewContainer.empty(); // Clear previous previews

                Array.from(files).forEach(file => {
                    if (file.type.startsWith('image/')) {
                        const reader = new FileReader();
                        reader.onload = function(e) {
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

            // Simpan Galeri
            $('#save').click(function(e) {
                e.preventDefault();
                formSendData();
            });

            $(document).ready(function() {
                let skuIndex = 1;

                // Tambah SKU
                $('.btn-primary:contains("Tambah Gambar")').click(function(e) {
                    e.preventDefault();
                    skuIndex++;
                    console.log(skuIndex);
                    let newSku = `
                    <div class="row sku-item" data-index="${skuIndex}">
                        <div class="col-lg-11">
                            <div class="form-group mb-4 only-file-upload">
                                <label class="label text-secondary">Gambar-${skuIndex}</label>
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
                        <div class="col-lg-1">
                            <div class="form-group mb-4">
                                <button class="btn btn-danger btn-sm remove-sku" style="color:#fff">Hapus Gambar</button>
                            </div>
                    </div>`;

                    $(newSku).insertBefore('.col-lg-12:last');
                });

                // Hapus SKU
                $(document).on('click', '.remove-sku', function(e) {
                    e.preventDefault();
                    $(this).closest('.sku-item').remove();
                });

                // Preview gambar untuk elemen dinamis
                $(document).on('change', '.upload-files', function(event) {
                    const files = event.target.files;
                    const previewContainer = $(this).closest('.upload-area').find(
                        '.files-preview-container');
                    previewContainer.empty(); // Clear previous previews

                    Array.from(files).forEach(file => {
                        if (file.type.startsWith('image/')) {
                            const reader = new FileReader();
                            reader.onload = function(e) {
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
        });

        $('#type').change(function() {
            const selectedValue = $(this).val();

            if (selectedValue === 'banner' || selectedValue === 'slide-banner') {
                $('.add').hide();
            } else {
                $('.add').show();
            }

            if (selectedValue === 'slide-banner') {
                $('.url').show();
            } else {
                $('.url').hide();
            }
        });

        $('#type').val('{{ $gallery->type ?? 'gallery' }}');

        function getData() {
            //redirect to the previous
            setTimeout(function() {
                window.location.href = "{{ route('admin.galleries.index') }}";
            }, 1500);
        }
    </script>
@endpush
