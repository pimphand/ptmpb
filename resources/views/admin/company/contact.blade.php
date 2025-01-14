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
                          @if($contact)
                              action="{{route('admin.about-us.update',['about_u' => $contact->id])}}"
                          @else
                              action="{{route('admin.about-us.store')}}"
                        @endif
                    >
                        @csrf
                        @if($contact)
                            @method('PUT')
                        @endif
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group mb-4">
                                    <label class="label text-secondary fs-14">Alamat Kantor</label>
                                    <input type="text" class="form-control text-dark" value="{{isset($contact->data['address']) ? $contact->data['address'] : ''}}" name="address"
                                           placeholder="Masukan alamat kantor">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group mb-4">
                                    <label class="label text-secondary fs-14">Nomor Telepon</label>
                                    <input type="text" class="form-control text-dark" value="{{isset($contact->data['phone']) ? $contact->data['phone'] : ''}}" name="phone"
                                           placeholder="Masukan Nomor Telepon">
                                </div>
                            </div>
                        </div>

                        <hr>
                        <h4>Sosial Media</h4>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group mb-4">
                                    <label class="label text-secondary fs-14">Url Instagram</label>
                                    <input type="text" class="form-control text-dark" value="{{isset($contact->data['instagram']) ? $contact->data['instagram'] : ''}}" name="instagram"
                                           placeholder="Masukan url instagram">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group mb-4">
                                    <label class="label text-secondary fs-14">Url Facebook</label>
                                    <input type="text" class="form-control text-dark" value="{{isset($contact->data['facebook']) ? $contact->data['facebook'] : ''}}" name="facebook"
                                           placeholder="Masukan url facebook">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group mb-4">
                                    <label class="label text-secondary fs-14">Url Linkdin</label>
                                    <input type="text" class="form-control text-dark" value="{{isset($contact->data['linkdin']) ? $contact->data['linkdin'] : ''}}" name="linkdin"
                                           placeholder="Masukan url Linkdin">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group mb-4">
                                    <label class="label text-secondary fs-14">Url Twitter / X</label>
                                    <input type="text" class="form-control text-dark" value="{{isset($contact->data['twitter']) ? $contact->data['twitter'] : ''}}" name="twitter"
                                           placeholder="Masukan Url Twitter / X">
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
    <script>
        $(document).ready(function () {

            // Simpan Tentang Kami
            $('#save').click(function (e) {
                e.preventDefault();
                formSendData();
            });
        });

    </script>
@endpush
