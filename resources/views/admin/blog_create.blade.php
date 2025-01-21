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
        <h3 class="mb-0">Tambah Blog</h3>

        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb align-items-center mb-0 lh-1">
                <li class="breadcrumb-item">
                    <a href="#" class="d-flex align-items-center text-decoration-none">
                        <i class="ri-home-4-line fs-18 text-primary me-1"></i>
                        <span class="text-secondary fw-medium hover">Dashboard</span>
                    </a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    <span class="fw-medium">Blog</span>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    <span class="fw-medium">Tambah Blog</span>
                </li>
            </ol>
        </nav>
    </div>
    <div class="row">
        <div class="col-xxl-12">
            <div class="card bg-white border-0 rounded-3 mb-4">
                <div class="card-body p-4">
                    <form id="form"
                        @if ($blog) action="{{ route('admin.blogs.update', $blog->id) }}"
                        @else
                            action="{{ route('admin.blogs.store') }}" @endif>
                        @csrf
                        @if ($blog)
                            @method('PUT')
                        @endif
                        <div class="row">
                            <div class="col-lg-6 col-sm-6">
                                <div class="form-group mb-4">
                                    <label class="label text-secondary">Nama Blog</label>
                                    <input type="text" name="name" id="name" class="form-control h-55"
                                        placeholder="Masukan Nama Blog">
                                </div>
                            </div>

                            <div class="col-lg-6 col-sm-6">
                                <div class="form-group mb-4">
                                    <label class="label text-secondary">Kategori Blog</label>
                                    <select class="form-select form-control h-55" id="category"
                                        aria-label="Default select example" name="category">
                                        <option selected="">Pilih Kategori Blog</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group mb-4">
                                    <label class="label text-secondary fs-14">Deskripsi Blog</label>
                                    <textarea rows="3" class="form-control" name="content" placeholder="masukan deskripsi blog"></textarea>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group mb-4 only-file-upload">
                                    <label class="label text-secondary">Foto BLog</label>
                                    <div class="form-control h-100 text-center position-relative p-4 p-lg-5"
                                        id="upload-area">
                                        <div class="product-upload">
                                            <label for="file-upload" class="file-upload mb-0">
                                                <i
                                                    class="ri-folder-image-line bg-primary bg-opacity-10 p-2 rounded-1 text-primary"></i>
                                                <span class="d-block text-body fs-14"><span
                                                        class="text-primary text-decoration-underline">Browse Pilih
                                                        Gambar</span></span>
                                            </label>
                                            <label class="position-absolute top-0 bottom-0 start-0 end-0 cursor active"
                                                id="upload-container">
                                                <input name="image" class="form__file bottom-0" id="upload-files"
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
                        </div>

                        <div class="col-lg-12">
                            <div class="d-flex flex-wrap gap-3">
                                <a href="{{ back()->getTargetUrl() }}"
                                    class="btn btn-danger py-2 px-4 fw-medium fs-16 text-white">Cancel</a>
                                <button class="btn btn-primary py-2 px-4 fw-medium fs-16" type="button" id="save"
                                    onclick="tinyMCE.triggerSave(true,true);">
                                    <i class="ri-add-line text-white fw-medium"></i> Simpan Blog
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
    <script src="https://cdn.tiny.cloud/1/wwx0cl8afxdfv85dxbyv3dy0qaovbhaggsxpfqigxlxw8pjx/tinymce/7/tinymce.min.js"
        referrerpolicy="origin"></script>
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

            // Simpan Blog
            $('#save').click(function(e) {
                e.preventDefault();
                formSendData();
            });
        });

        function getData() {
            //redirect to the previous
            setTimeout(function() {
                window.location.href = "{{ route('admin.blogs.store') }}?status=success";
            }, 1500);
        }
        @if ($blog)
            $('#name').val('{{ $blog->title }}');
            $('#category').val('{{ $blog->category_id }}');
            const previewContainer = $('#upload-area').find('#files-preview-container');
            const imgPreview = `
                    <div class="preview-container" style="width: 290px; position: relative;">
                        <img src="{{ asset('storage') }}/{{ $blog->thumbnail }}" alt="Preview" style="width: 100%; height: 100%; object-fit: cover; border: 2px solid #ddd; border-radius: 5px;">
                    </div>`;
            previewContainer.append(imgPreview);
            tinymce.init({
                selector: 'textarea',
                plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
                toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
                browser_spellcheck: true,
                relative_urls: false,
                remove_script_host: false,
                //set Default value
                setup: function(editor) {
                    editor.on('init', function() {
                        editor.setContent(`{!! $blog->content !!}`);
                    });
                }
            });
        @else
            tinymce.init({
                selector: 'textarea',

                plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
                toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
            });
        @endif
    </script>
@endpush
