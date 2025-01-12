<div>
    <div class="main-slider style-two default-banner">
        <div class="tp-banner-container">
            <div class="tp-banner" >
                <!-- START REVOLUTION SLIDER 5.4.1 -->
                <div id="rev_slider_1014_1_wrapper" class="rev_slider_wrapper fullscreen-container" data-alias="typewriter-effect" data-source="gallery">
                    <div id="rev_slider_1014_1" class="rev_slider fullscreenbanner" style="display:none;" data-version="5.4.1">
                        <ul>
                            <!-- SLIDE 1 -->
                           @foreach($banners as $banner)
                                <li data-index="rs-2000" data-transition="slidingoverlayhorizontal" data-slotamount="default" data-hideafterloop="0" data-hideslideonmobile="off"  data-easein="default" data-easeout="default" data-masterspeed="default"  data-thumb="images/main-slider/slider2/slide2.jpg"  data-rotate="0"  data-saveperformance="off"  data-title="Slide" data-param1="" data-param2="" data-param3="" data-param4="" data-param5="" data-param6="" data-param7="" data-param8="" data-param9="" data-param10="" data-description="">
                                    <!-- MAIN IMAGE -->
                                    <img src="{{asset('storage/'.$banner->images[0]->path)}}"  alt=""  data-bgposition="center bottom" data-bgfit="cover" data-bgrepeat="no-repeat" class="rev-slidebg" data-no-retina>
                                    <!-- LAYERS -->

                                    <!-- LAYER NR. 1 [ for overlay ] -->
                                    <div class="tp-caption tp-shape tp-shapewrapper "
                                         id="slide-200-layer-1"
                                         data-x="['center','center','center','center']" data-hoffset="['0','0','0','0']"
                                         data-y="['middle','middle','middle','middle']" data-voffset="['0','0','0','0']"
                                         data-width="full"
                                         data-height="full"
                                         data-whitespace="nowrap"
                                         data-type="shape"
                                         data-basealign="slide"
                                         data-responsive_offset="off"
                                         data-responsive="off"
                                         data-frames='[
                                        {"from":"opacity:0;","speed":1000,"to":"o:1;","delay":0,"ease":"Power4.easeOut"},
                                        {"delay":"wait","speed":1000,"to":"opacity:0;","ease":"Power4.easeOut"}
                                        ]'
                                         data-textAlign="['left','left','left','left']"
                                         data-paddingtop="[0,0,0,0]"
                                         data-paddingright="[0,0,0,0]"
                                         data-paddingbottom="[0,0,0,0]"
                                         data-paddingleft="[0,0,0,0]"

                                         style="z-index: 12;background-color:rgba(0, 0, 0, 0.10);border-color:rgba(0, 0, 0, 0);border-width:0px;">
                                    </div>

                                    <!-- LAYER NR. 2 [ for title ] -->
                                    <div class="tp-caption   tp-resizeme"
                                         id="slide-200-layer-2"
                                         data-x="['left','left','left','left']" data-hoffset="['48','30','30','100']"
                                         data-y="['top','top','top','top']" data-voffset="['300','300','300','300']"
                                         data-fontsize="['60','60','60','50']"
                                         data-lineheight="['70','70','70','60']"
                                         data-width="['700','700','700','700']"
                                         data-height="['none','none','none','none']"
                                         data-whitespace="['normal','normal','normal','normal']"

                                         data-type="text"
                                         data-responsive_offset="on"
                                         data-frames='[
                                        {"from":"y:100px(R);opacity:0;","speed":2000,"to":"o:1;","delay":500,"ease":"Power4.easeOut"},
                                        {"delay":"wait","speed":1000,"to":"y:-50px;opacity:0;","ease":"Power2.easeInOut"}
                                        ]'
                                         data-textAlign="['left','left','left','left']"
                                         data-paddingtop="[0,0,0,0]"
                                         data-paddingright="[0,0,0,0]"
                                         data-paddingbottom="[0,0,0,0]"
                                         data-paddingleft="[0,0,0,0]"

                                         style="z-index: 13;
                                        white-space: normal;
                                        font-weight: 700;
                                        color: rgba(255, 255, 255, 1.00);
                                        border-width:0px;">
                                        <span class="text-uppercase" style="font-family:'Roboto' ;">{{$banner->title}}</span>
                                    </div>

                                    <!-- LAYER NR. 3 [ for paragraph] -->
                                    <div class="tp-caption  tp-resizeme"
                                         id="slide-200-layer-3"
                                         data-x="['left','left','left','left']" data-hoffset="['48','30','30','100']"
                                         data-y="['top','top','top','top']" data-voffset="['400','400','400','400']"
                                         data-fontsize="['18','18','18','30']"
                                         data-lineheight="['30','30','30','40']"
                                         data-width="['650','650','650','650']"
                                         data-height="['none','none','none','none']"
                                         data-whitespace="['normal','normal','normal','normal']"

                                         data-type="text"
                                         data-responsive_offset="on"
                                         data-frames='[
                                        {"from":"y:100px(R);opacity:0;","speed":2000,"to":"o:1;","delay":1000,"ease":"Power4.easeOut"},
                                        {"delay":"wait","speed":1000,"to":"y:-50px;opacity:0;","ease":"Power2.easeInOut"}
                                        ]'
                                         data-textAlign="['left','left','left','left']"
                                         data-paddingtop="[0,0,0,0]"
                                         data-paddingright="[0,0,0,0]"
                                         data-paddingbottom="[0,0,0,0]"
                                         data-paddingleft="[0,0,0,0]"

                                         style="z-index: 13;
                                        font-weight: 500;
                                        color: rgba(255, 255, 255, 0.85);
                                        border-width:0px;">
                                        <span style="font-family:'Roboto';">{{$banner->description}}</span>
                                    </div>

                                    <!-- LAYER NR. 4 [ for readmore botton ] -->
                                    <div class="tp-caption tp-resizeme"
                                         id="slide-200-layer-4"
                                         data-x="['left','left','left','left']" data-hoffset="['48','30','30','100']"
                                         data-y="['top','top','top','top']" data-voffset="['530','530','530','630']"
                                         data-lineheight="['none','none','none','none']"
                                         data-width="['300','300','300','300']"
                                         data-height="['none','none','none','none']"
                                         data-whitespace="['normal','normal','normal','normal']"

                                         data-type="text"
                                         data-responsive_offset="on"
                                         data-frames='[
                                        {"from":"y:100px(R);opacity:0;","speed":2000,"to":"o:1;","delay":1500,"ease":"Power4.easeOut"},
                                        {"delay":"wait","speed":1000,"to":"y:-50px;opacity:0;","ease":"Power2.easeInOut"}
                                        ]'
                                         data-textAlign="['left','left','left','left']"
                                         data-paddingtop="[0,0,0,0]"
                                         data-paddingright="[0,0,0,0]"
                                         data-paddingbottom="[0,0,0,0]"
                                         data-paddingleft="[0,0,0,0]"

                                         style="z-index:13; text-transform:uppercase; font-weight:700;">
                                        @if($banner->url)
                                            <a href="{{$banner->url}}" class="site-button">Baca Lebih Lengkap</a>
                                        @endif
                                    </div>

                                    <!-- LAYER NR. 5 [ for worker pic 1 big] -->
                                    <div class="tp-caption tp-resizeme"
                                         id="slide-200-layer-5"
                                         data-x="['right','right','right','right']" data-hoffset="['50','50','50','50']"
                                         data-y="['bottom','bottom','bottom','bottom']" data-voffset="['0','0','0','0']"

                                         data-frames='[
                                        {"from":"y:100px(R);opacity:0;","speed":2000,"to":"o:1;","delay":3000,"ease":"Power4.easeOut"},
                                        {"delay":"wait","speed":1000,"to":"y:-50px;opacity:0;","ease":"Power2.easeInOut"}
                                        ]'

                                         style="z-index: 13;">
                                    </div>

                                    <!-- LAYER NR. 6 [ for worker pic 2 small ] -->
                                    <div class="tp-caption tp-resizeme"
                                         id="slide-200-layer-6"
                                         data-x="['right','right','right','right']" data-hoffset="['-250','-250','-250','-250']"
                                         data-y="['top','top','top','top']" data-voffset="['320','280','280','280']"

                                         data-frames='[
                                        {"from":"y:100px(R);opacity:0;","speed":2000,"to":"o:1;","delay":4000,"ease":"Power4.easeOut"},
                                        {"delay":"wait","speed":1000,"to":"y:-50px;opacity:0;","ease":"Power2.easeInOut"}
                                        ]'

                                         style="z-index: 13;">

                                    </div>

                                    <!-- LAYER NR. 7 [ for worker pic road white line] -->
                                    <div class="tp-caption tp-resizeme"
                                         id="slide-200-layer-7"
                                         data-x="['right','right','right','right']" data-hoffset="['-150','-150','-150','-150']"
                                         data-y="['bottom','bottom','bottom','bottom']" data-voffset="['100','100','100','100']"

                                         data-frames='[
                                        {"from":"y:0px(R);opacity:0;","speed":3000,"to":"o:1;","delay":5000,"ease":"Power4.easeOut"},
                                        {"delay":"wait","speed":1000,"to":"y:-50px;opacity:0;","ease":"Power2.easeInOut"}
                                        ]'

                                         style="z-index: 13;">

                                    </div>


                                </li>
                           @endforeach
                        </ul>
                        <div class="tp-bannertimer tp-bottom" style="visibility: hidden !important;"></div>
                    </div>
                </div>
                <!-- END REVOLUTION SLIDER -->
            </div>
        </div>
    </div>
</div>
