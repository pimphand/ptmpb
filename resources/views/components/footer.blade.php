<!-- FOOTER START -->
<footer class="site-footer footer-light">
    <!-- COLL-TO ACTION START -->
    <div class="call-to-action-wrap call-to-action-skew site-bg-primary bg-no-repeat"
        style="background-image:url(images/background/bg-4.png);">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-7">
                    <div class="call-to-action-left p-tb20 p-r50">
                        {{--                            <h4 class="text-uppercase m-b10">We are ready to build your dream tell us more about your project</h4> --}}
                        <p>PT Mandalika Putra Bersama mendistribusikan Oli dan
                            Pelumas dalam jumlah besar bagi industri, pertambangan,
                            perusahaan logistic (perkapalan maupun trucking), dealer,
                            bengkel atau toko retail, serta perusahaan yang
                            membutuhkan pasokan pelumas secara berkala.</p>
                    </div>
                </div>

                <div class="col-lg-3 col-md-5">
                    <div class="call-to-action-right p-tb30">
                        <a href="/contact-us" class="site-button-secondry  m-r15 text-uppercase font-weight-600">
                            Hubungi Kami <i class="fa fa-angle-double-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- FOOTER BLOCKES START -->
    <div class="footer-top overlay-wraper">
        <div class="overlay-main"></div>
        <div class="container">
            <div class="row">
                <!-- ABOUT COMPANY -->
                <div class="col-lg-3 col-md-6">
                    <div class="widget widget_about">
                        <h4 class="widget-title">About Company</h4>
                        <div class="logo-footer clearfix p-b15">
                            <a href="/"><img src="{{ asset('logo_.png') }}" width="230" height="67"
                                    alt=""></a>
                        </div>

                    </div>
                </div>
                <!-- RESENT POST -->
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="widget recent-posts-entry-date">
                        <h4 class="widget-title">Resent Post</h4>
                        <div class="widget-post-bx">
                            @php
                                function getHariSingkat($tanggal)
                                {
                                    // Array mapping nama hari dalam bahasa Inggris ke bahasa Indonesia
                                    $hariInggris = [
                                        'Sun' => 'Minggu',
                                        'Mon' => 'Senin',
                                        'Tue' => 'Selasa',
                                        'Wed' => 'Rabu',
                                        'Thu' => 'Kamis',
                                        'Fri' => 'Jumat',
                                        'Sat' => 'Sabtu',
                                    ];

                                    // Mendapatkan nama hari dalam bahasa Inggris
                                    $hari = date('D', strtotime($tanggal));

                                    // Konversi ke nama hari dalam bahasa Indonesia
                                    $hariIndonesia = $hariInggris[$hari];

                                    // Mengambil 3 huruf pertama
                                    return substr($hariIndonesia, 0, 3);
                                }
                            @endphp
                            @foreach ($blogs as $blog)
                                <div class="bdr-light-blue widget-post clearfix  bdr-b-1 m-b10 p-b10">
                                    <div class="wt-post-date text-center text-uppercase text-white p-t5">
                                        <strong>{{ getHariSingkat($blog->created_at) }}</strong>
                                        <span>{{ date('M', strtotime($blog->created_at)) }}</span>
                                    </div>
                                    <div class="wt-post-info">
                                        <div class="wt-post-header">
                                            <h6 class="post-title"><a href="{{ route('blog', $blog->slug) }}">Blog title
                                                    first </a></h6>
                                        </div>
                                        <div class="wt-post-meta">
                                            <ul>
                                                <li class="post-author"><i class="fa fa-user"></i>By Admin</li>
                                                <li class="post-comment"><i class="fa fa-comments"></i> </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                        </div>
                    </div>
                </div>
                <!-- USEFUL LINKS -->

                <!-- NEWSLETTER -->
                <div class="col-lg-3 col-md-6">

                    <!-- SOCIAL LINKS -->
                    <div class="widget widget_social_inks">
                        <h4 class="widget-title">Social Links</h4>
                        <ul class="social-icons social-square social-darkest">
                            <li><a href="javascript:void(0);" class="fa fa-facebook"></a></li>
                            <li><a href="javascript:void(0);" class="fa fa-twitter"></a></li>
                            <li><a href="javascript:void(0);" class="fa fa-linkedin"></a></li>
                            <li><a href="javascript:void(0);" class="fa fa-rss"></a></li>
                            <li><a href="javascript:void(0);" class="fa fa-youtube"></a></li>
                            <li><a href="javascript:void(0);" class="fa fa-instagram"></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- FOOTER COPYRIGHT -->
    <div class="footer-bottom overlay-wraper">
        <div class="overlay-main"></div>
        <div class="constrot-strip"></div>
        <div class="container p-t30">
            <div class="row">
                <div class="wt-footer-bot-left">
                    <span class="copyrights-text">© {{ date('Y') }} {{ env('APP_NAME') }}. All Rights Reserved.
                        Designed By <a target="_blank" href="https://www.instagram.com/f.damri_/">DmptDev</a>.</span>
                </div>
                <div class="wt-footer-bot-right">
                    <ul class="copyrights-nav pull-right">
                        <li><a href="javascript:void(0);">Terms & Condition</a></li>
                        <li><a href="javascript:void(0);">Privacy Policy</a></li>
                        <li><a href="contact-1.html">Contact Us</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- FOOTER END -->
@php
$contact = \App\Models\About::where('type', 'contact')->first();
@endphp
@if($contact)
    <a href="https://wa.me/{{$contact?->data['phone']}}?text=" target="_blank" class="whatsapp-button">
        <img src="https://upload.wikimedia.org/wikipedia/commons/6/6b/WhatsApp.svg" alt="WhatsApp" />
    </a>
@endif
