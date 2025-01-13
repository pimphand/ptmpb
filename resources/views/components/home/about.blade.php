@php
    $about = \App\Models\About::find('9df277bb-6c87-4029-b9e7-36fcde971d8b');
@endphp
<div class="section-full p-t80 p-b50 bg-gray">
    <div class="container">
        <div class="row">
            <div class="col-lg-5 col-md-8 m-b30">
                <div class="about-com-pic">
                    <img src="{{asset('assets')}}/images/about-pic.jpg" alt="" class="img-responsive">
                </div>
            </div>
            <div class="col-lg-7 col-md-12 m-b30">
                <div class="section-head text-left">
                    <h2 class="text-uppercase">Tentang Kami</h2>
                    <div class="wt-separator-outer">
                        <div class="wt-separator style-square">
                            <span class="separator-left site-bg-primary"></span>
                            <span class="separator-right site-bg-primary"></span>
                        </div>
                    </div>
                    <p class="text-justify">
                        {{$about->title ?? ''}} <br>
                    </p>
                </div>
               <h5>Program Kerja Sama
                   untuk Konsumen</h5>
                <div class="about-types row">
                    <div class="col-md-6 col-sm-6 p-tb20">
                        <div class="wt-icon-box-wraper left p-l20  bdr-1 bdr-gray-light">
                            <div class="icon-sm site-text-primary">
                                <a href="{{route('about_us')}}" class="icon-cell p-t5 center-block"><i class="fa fa-building" aria-hidden="true"></i></a>
                            </div>
                            <div class="icon-content">
                                <h5 class="wt-tilte text-uppercase m-b0">Program Langganan
                                    Bulanan dan Tahunan</h5>
                                <p class="text-justify">Pelanggan dapat memilih
                                    paket langganan untuk
                                    memperoleh produk
                                    pelumas dalam jumlah
                                    tertentu secara rutin dengan
                                    harga yang lebih hemat dan
                                    pengiriman tepat waktu.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 p-tb20 ">
                        <div class="wt-icon-box-wraper left  p-l20 bdr-1 bdr-gray-light">
                            <div class="icon-sm site-text-primary">
                                <a href="{{route('about_us')}}" class="icon-cell p-t5 center-block"><i class="fa fa-paint-brush" aria-hidden="true"></i></a>
                            </div>
                            <div class="icon-content">
                                <h5 class="wt-tilte text-uppercase m-b0">Dukungan Teknis dan
                                    Pelatihan</h5>
                                <p class="text-justify">PT Mandalika Putra
                                    Bersama menyediakan
                                    pelatihan teknis dan
                                    dukungan bagi mitra
                                    bisnis untuk
                                    meningkatkan keahlian
                                    dalam penggunaan
                                    produk kami.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 p-tb20 ">
                        <div class="wt-icon-box-wraper left  p-l20 bdr-1 bdr-gray-light">
                            <div class="icon-sm site-text-primary">
                                <a href="{{route('about_us')}}" class="icon-cell p-t5 center-block"><i class="fa fa-gavel" aria-hidden="true"></i></a>
                            </div>
                            <div class="icon-content">
                                <h5 class="wt-tilte text-uppercase m-b0 ">Program Insentif untuk
                                    Distributor</h5>
                                <p class="text-justify">Memberikan insentif menarik
                                    kepada mitra distributor
                                    berdasarkan volume
                                    pembelian per bulannya.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
