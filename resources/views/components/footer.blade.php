<!-- FOOTER START -->
<footer class="site-footer footer-light">
    <!-- COLL-TO ACTION START -->
    <div class="call-to-action-wrap call-to-action-skew site-bg-primary bg-no-repeat" style="background-image:url(images/background/bg-4.png);">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-7">
                    <div class="call-to-action-left p-tb20 p-r50">
                        {{--                            <h4 class="text-uppercase m-b10">We are ready to build your dream tell us more about your project</h4>--}}
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
                            Hubungi Kami  <i class="fa fa-angle-double-right"></i>
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
                            <a href="/"><img src="{{asset('logo_.png')}}" width="230" height="67" alt=""></a>
                        </div>

                    </div>
                </div>
                <!-- RESENT POST -->
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="widget recent-posts-entry-date">
                        <h4 class="widget-title">Resent Post</h4>
                        <div class="widget-post-bx">

                            @foreach($blogs as $blog)
                                <div class="bdr-light-blue widget-post clearfix  bdr-b-1 m-b10 p-b10">
                                    <div class="wt-post-date text-center text-uppercase text-white p-t5">
                                        <strong>20</strong>
                                        <span>Mar</span>
                                    </div>
                                    <div class="wt-post-info">
                                        <div class="wt-post-header">
                                            <h6 class="post-title"><a href="">Blog title first </a></h6>
                                        </div>
                                        <div class="wt-post-meta">
                                            <ul>
                                                <li class="post-author"><i class="fa fa-user"></i>By Admin</li>
                                                <li class="post-comment"><i class="fa fa-comments"></i> 28</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                        </div>
                    </div>
                </div>
                <!-- USEFUL LINKS -->
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="widget widget_services">
                        <h4 class="widget-title">Useful links</h4>
                        <ul>
                            <li><a href="about-1.html">About</a></li>
                            <li><a href="faq-1.html">FAQ</a></li>
                            <li><a href="career.html">Career</a></li>
                            <li><a href="our-team.html">Our Team</a></li>
                            <li><a href="services.html">Services</a></li>
                            <li><a href="gallery-grid-1.html">Gallery</a></li>
                        </ul>
                    </div>
                </div>
                <!-- NEWSLETTER -->
                <div class="col-lg-3 col-md-6">
                    <div class="widget widget_newsletter">
                        <h4 class="widget-title">Newsletter</h4>
                        <div class="newsletter-bx">
                            <form role="search" method="post">
                                <div class="input-group">
                                    <input name="news-letter" class="form-control" placeholder="ENTER YOUR EMAIL" type="text">
                                    <span class="input-group-btn">
                                            <button type="submit" class="site-button"><i class="fa fa-paper-plane-o"></i></button>
                                        </span>
                                </div>
                            </form>
                        </div>
                    </div>
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
            <div class="row">

                <div class="col-lg-3 col-md-6 col-sm-6 p-tb20">
                    <div class="wt-icon-box-wraper left  bdr-1 bdr-gray-dark p-tb15 p-lr10 clearfix">
                        <div class="icon-md text-secondry">
                            <span class="iconmoon-travel"></span>
                        </div>
                        <div class="icon-content">
                            <h5 class="wt-tilte text-uppercase m-b0">Address</h5>
                            <p>No.123 Chalingt Gates, Supper market New York</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 p-tb20">
                    <div class="wt-icon-box-wraper left  bdr-1 bdr-gray-dark p-tb15 p-lr10 clearfix ">
                        <div class="icon-md text-secondry">
                            <span class="iconmoon-smartphone-1"></span>
                        </div>
                        <div class="icon-content">
                            <h5 class="wt-tilte text-uppercase m-b0">Phone</h5>
                            <p class="m-b0">+41 555 888 9585</p>
                            <p>+41 555 888 9585</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 p-tb20">
                    <div class="wt-icon-box-wraper left  bdr-1 bdr-gray-dark p-tb15 p-lr10 clearfix">
                        <div class="icon-md text-secondry">
                            <span class="iconmoon-fax"></span>
                        </div>
                        <div class="icon-content">
                            <h5 class="wt-tilte text-uppercase m-b0">Fax</h5>
                            <p class="m-b0">FAX: (123) 123-4567</p>
                            <p>FAX: (123) 123-4567</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 p-tb20">
                    <div class="wt-icon-box-wraper left  bdr-1 bdr-gray-dark p-tb15 p-lr10 clearfix">
                        <div class="icon-md text-secondry">
                            <span class="iconmoon-email"></span>
                        </div>
                        <div class="icon-content">
                            <h5 class="wt-tilte text-uppercase m-b0">Email</h5>
                            <p class="m-b0">info@demo.com</p>
                            <p>info@demo1234.com</p>
                        </div>
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
                    <span class="copyrights-text">© {{date('Y')}} {{env('APP_NAME')}}. All Rights Reserved. Designed By <a target="_blank" href="https://www.instagram.com/f.damri_/">DmptDev</a>.</span>
                </div>
                <div class="wt-footer-bot-right">
                    <ul class="copyrights-nav pull-right">
                        <li><a href="javascript:void(0);">Terms  & Condition</a></li>
                        <li><a href="javascript:void(0);">Privacy Policy</a></li>
                        <li><a href="contact-1.html">Contact Us</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- FOOTER END -->
