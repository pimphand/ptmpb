@extends('admin.layouts.app')
@section('content')
    <style>
        #files-preview-container img {
            margin: 5px;
        }
    </style>
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4">
        <h3 class="mb-0">Tambah Tentang Kami</h3>

        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb align-items-center mb-0 lh-1">
                <li class="breadcrumb-item">
                    <a href="#" class="d-flex align-items-center text-decoration-none">
                        <i class="ri-home-4-line fs-18 text-primary me-1"></i>
                        <span class="text-secondary fw-medium hover">Dashboard</span>
                    </a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    <span class="fw-medium">Tentang Kami</span>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    <span class="fw-medium">Tambah Tentang Kami</span>
                </li>
            </ol>
        </nav>
    </div>
    <div class="row">
        <div class="col-xxl-12">
            <div class="card bg-white border-0 rounded-3 mb-4">
                <div class="card-body p-4">
                    <form id="form" method="POST" enctype="multipart/form-data"
                          @if($about)
                              action="{{route('admin.about-us.update',['about_u' => $about->id])}}"
                          @else
                              action="{{route('admin.about-us.store')}}"
                        @endif
                    >
                        @csrf
                        @if($about)
                            @method('PUT')
                        @endif
                        <div class="row">
                            <div class="col-lg-12 col-sm-12">
                                <div class="form-group mb-4">
                                    <label class="label text-secondary">Deskripsi singkat</label>
                                    <input type="text" name="title" class="form-control h-55" value="{{$about ? $about->title : ''}}"
                                           placeholder="Masukan judul Tentang Kami">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group mb-4">
                                    <label class="label text-secondary fs-14">Deskripsi Tentang Kami</label>
                                    <textarea rows="3" class="form-control" name="content"
                                              placeholder="masukan deskripsi"></textarea>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <span>Data</span>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group mb-4">
                                    <label class="label text-secondary fs-14">Akte Pendirian</label>
                                    <input type="text" class="form-control text-dark" value="{{isset($about->data['deed_of_establishment']) ? $about->data['deed_of_establishment'] : ''}}" name="deed_of_establishment"
                                           placeholder="Masukan Akte No Pendirian">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group mb-4">
                                    <label class="label text-secondary fs-14">SK Kumham RI</label>
                                    <input type="text" class="form-control text-dark" value="{{isset($about->data['kumham_decree']) ? $about->data['kumham_decree'] : ''}}" name="kumham_decree"
                                           placeholder="Masukan Akte No SK Kumham RI">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group mb-4">
                                    <label class="label text-secondary fs-14">NPWP</label>
                                    <input type="text" class="form-control text-dark" value="{{isset($about->data['npwp']) ? $about->data['npwp'] : ''}}" name="npwp"
                                           placeholder="Masukan NPWP">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group mb-4">
                                    <label class="label text-secondary fs-14">NIB</label>
                                    <input type="text" class="form-control text-dark" value="{{isset($about->data['nib']) ? $about->data['nib'] : ''}}" name="nib"
                                           placeholder="Masukan NIB">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group mb-4">
                                    <label class="label text-secondary fs-14">Upload Profile Perusahaan</label>
                                    <input type="file" class="form-control text-dark" name="profile"
                                           placeholder="Masukan NIB">
                                </div>
                            </div>

                        </div>
                        <div class="col-lg-12">
                            <div class="d-flex flex-wrap gap-3">
                                <a href="{{back()->getTargetUrl()}}"
                                   class="btn btn-danger py-2 px-4 fw-medium fs-16 text-white">Cancel</a>
                                <button class="btn btn-primary py-2 px-4 fw-medium fs-16" type="button" id="save" onclick="tinyMCE.triggerSave(true,true);">
                                    <i class="ri-add-line text-white fw-medium"></i> Simpan Tentang Kami
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
    <script src="https://cdn.tiny.cloud/1/wwx0cl8afxdfv85dxbyv3dy0qaovbhaggsxpfqigxlxw8pjx/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        $(document).ready(function () {

            $(document).on('change', '#upload-files', function (event) {
                const files = event.target.files;
                const previewContainer = $(this).closest('#upload-area').find('#files-preview-container');
                previewContainer.empty();

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

            // Simpan Tentang Kami
            $('#save').click(function (e) {
                e.preventDefault();
                formSendData();
            });
        });

        tinymce.init({
            selector: 'textarea',
            plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
            toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
            setup: (editor) => {
                editor.on('init', () => {
                    editor.setContent(`{!! $about ? $about->content : '' !!}`);
                });
            },
        });

    </script>
@endpush
