@extends('layouts.app')

@section('content')
    <div class="bg-gray-light p-tb20">
        <div class="container">
            <ul class="wt-breadcrumb breadcrumb-style-2">
                <li><a href="javascript:void(0);"><i class="fa fa-home"></i> Home</a></li>
                <li>Kontak</li>
            </ul>
        </div>
    </div>
    <div class="container">

        <!-- CONTACT DETAIL BLOCK -->
        <div class="section-content m-b30">

            <div class="row">

                <div class="col-md-4 col-sm-12 m-b30">
                    <div class="wt-icon-box-wraper center p-a30 bg-secondry">
                        <div class="icon-sm text-white m-b10"><i class="iconmoon-smartphone-1"></i></div>
                        <div class="icon-content">
                            <h5 class="text-white">Nomor Telepon</h5>
                            <p class="text-gray-dark"><a target="_blank" style="color:#fff;" href="https://wa.me/{{$contact->data['phone']}}">{{$contact->data['phone']}}</a></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-12 m-b30">
                    <div class="wt-icon-box-wraper center p-a30 bg-secondry">
                        <div class="icon-sm text-white m-b10"><i class="iconmoon-email"></i></div>
                        <div class="icon-content">
                            <h5 class="text-white">Email</h5>
                            <p class="text-gray-dark">{{$contact->data['email']}}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-12 m-b30">
                    <div class="wt-icon-box-wraper center p-a30 bg-secondry">
                        <div class="icon-sm text-white m-b10"><i class="iconmoon-travel"></i></div>
                        <div class="icon-content">
                            <h5 class="text-white">Alamat</h5>
                            <p class="text-gray-dark">{{$contact->data['address']}}</p>
                        </div>
                    </div>
                </div>

            </div>

        </div>

        <!-- GOOGLE MAP & CONTACT FORM -->
        <div class="section-content m-b50">
            <div class="row">

                <!-- LOCATION BLOCK-->
                <div class="wt-box col-md-6">

                    <h4 class="text-uppercase">Lokasi</h4>
                    <div class="wt-separator-outer m-b30">
                        <div class="wt-separator style-square">
                            <span class="separator-left site-bg-primary"></span>
                            <span class="separator-right site-bg-primary"></span>
                        </div>
                    </div>
                    <span style="color: white">&nsbp</span>
                    <div class="gmap-outline m-b30">
                        <div id="gmap_canvas" class="google-map mt">
                            {!! $contact->content!!}
                        </div>
                    </div>

                </div>

                <!-- CONTACT FORM-->
                <div class="wt-box col-md-6">

                    <h4 class="text-uppercase">Hubungi Kami</h4>
                    <span>Butuh info lebih lanjut?
Kami siap membantu anda</span>
                    <div class="wt-separator-outer m-b30">
                        <div class="wt-separator style-square">
                            <span class="separator-left site-bg-primary"></span>
                            <span class="separator-right site-bg-primary"></span>
                        </div>

                    </div>

                    <div class="p-a30 bg-gray">

                        <form class="cons-contact-form" method="post" action="{{route('contact')}}">
                            @csrf
                            <div class="row">

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                            <input name="name" type="text" required="" class="form-control" placeholder="Masukan nama lengkap">
                                            @error('name')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                                            <input name="email" type="email" class="form-control" required="" placeholder="Masukan email">
                                            @error('email')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>

                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon v-align-t"><i class="fa fa-pencil"></i></span>
                                            <textarea name="message" rows="1" class="form-control " required="" placeholder="Masukn Pesan"></textarea>
                                            @error('message')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <button name="submit" type="submit" value="Submit" class="site-button  m-r15">Submit  <i class="fa fa-angle-double-right"></i></button>
                                    <button name="Resat" type="reset" value="Reset" class="site-button ">Reset  <i class="fa fa-angle-double-right"></i></button>
                                </div>

                            </div>

                        </form>

                    </div>

                </div>

            </div>
        </div>

    </div>
@endsection

@push('js')
    <script>
        @if(session('success'))

        Toast.fire({
            icon: "success",
            title: "Data berhasil terkirim"
        });
        @endif
    </script>
@endpush
