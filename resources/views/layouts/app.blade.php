<!DOCTYPE HTML>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <script defer type="text/javascript" src="{{ asset('assets') }}/.rum/-adobe/helix-rum-js--2/dist/rum-standalone.js"
        data-routing="program=111718,environment=1181479,tier=publish"></script>
    <link href="{{ asset('assets') }}/content/dam/enicom/images/favicons/android-icon-192x192.png" sizes="192x192" type="image/png"
        rel="icon" />
    <link href="{{ asset('assets') }}/content/dam/enicom/images/favicons/favicon-16x16.png" sizes="16x16" type="image/png" rel="icon" />
    <link href="{{ asset('assets') }}/content/dam/enicom/images/favicons/favicon-32x32.png" sizes="32x32" type="image/png" rel="icon" />
    <link href="{{ asset('assets') }}/content/dam/enicom/images/favicons/favicon-96x96.png" sizes="96x96" type="image/png" rel="icon" />
    <link href="{{ asset('assets') }}/content/dam/enicom/images/favicons/apple-touch-icon-57x57.png" sizes="57x57" rel="apple-touch-icon" />
    <link href="{{ asset('assets') }}/content/dam/enicom/images/favicons/apple-touch-icon-60x60.png" sizes="60x60" rel="apple-touch-icon" />
    <link href="{{ asset('assets') }}/content/dam/enicom/images/favicons/apple-touch-icon-114x114.png" sizes="114x114"
        rel="apple-touch-icon" />
    <link href="{{ asset('assets') }}/content/dam/enicom/images/favicons/apple-touch-icon-120x120.png" sizes="120x120"
        rel="apple-touch-icon" />
    <link href="{{ asset('assets') }}/content/dam/enicom/images/favicons/apple-touch-icon-180x180.png" sizes="180x180"
        rel="apple-touch-icon" />
    <link href="{{ asset('assets') }}/content/dam/enicom/images/favicons/apple-touch-icon-72x72.png" sizes="72x72" rel="apple-touch-icon" />
    <link href="{{ asset('assets') }}/content/dam/enicom/images/favicons/apple-touch-icon-76x76.png" sizes="76x76" rel="apple-touch-icon" />
    <link href="{{ asset('assets') }}/content/dam/enicom/images/favicons/apple-touch-icon-144x144.png" sizes="144x144"
        rel="apple-touch-icon" />
    <link href="{{ asset('assets') }}/content/dam/enicom/images/favicons/apple-touch-icon-152x152.png" sizes="152x152"
        rel="apple-touch-icon" />
    <link href="{{ asset('assets') }}/content/dam/enicom/images/favicons/apple-touch-icon-167x167.png" sizes="167x167"
        rel="apple-touch-icon" />
    <link href="{{ asset('assets') }}/content/dam/enicom/images/favicons/apple-touch-icon.png" sizes="180x180" rel="apple-touch-icon" />
    <link href="{{ asset('assets') }}/content/dam/enicom/images/favicons/apple-touch-icon-precomposed.png"
        rel="apple-touch-icon-precomposed" />
    <link color="#333333" href="{{ asset('assets') }}/content/dam/enicom/images/favicons/safari-pinned-tab.svg" rel="mask-icon" />
    <meta content="{{ asset('assets') }}content/dam/enicom/images/favicons/ms-icon-144x144.png" name="msapplication-TileImage" />
    <title>PT Mandalika Putra Bersama</title>
    <link rel="canonical" href="{{ env('APP_NAME') }}" />
    <meta name="template" content="homepage" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <script type="text/javascript">

        function handleServerResponse(requestResult) {
            const internalVisitValue = requestResult;
            localStorage.setItem('vpnStatus', internalVisitValue);
            digitalData.push({
                "event": "pageView",
                "user": {
                    "internalVisit": internalVisitValue
                }
            });
            console.log('Esito richiesta: ' + requestResult);
        }
        function loadImage(url, timeout) {
            return new Promise((resolve, reject) => {
                const img = new Image();
                const timer = setTimeout(() => {
                    img.onload = img.onerror = null;
                    reject(new Error('Timeout'));
                }, timeout);
                img.onload = () => {
                    clearTimeout(timer);
                    resolve(img);
                };
                img.onerror = () => {
                    clearTimeout(timer);
                    reject(new Error('Load failed'));
                };
                img.src = url;
            });
        }
        // async function executeImageRequest(logOnly = false) {
        //     // Controlla se la variabile esiste e ha valore true in localStorage
        //     const vpnStatus = localStorage.getItem('vpnStatus');
        //     if (vpnStatus === 'true') {
        //         console.log('VPN status is active.');
        //         return;
        //     }
        //     const imageUrl = 'https://enicomintranet.eni.com/asset/eni-intranet-jpg.jpg';
        //     const timeoutDuration = 2000;
        //     try {
        //         await loadImage(imageUrl, timeoutDuration);
        //         if (logOnly) {
        //             console.log('Image loaded successfully.');
        //         } else {
        //             handleServerResponse(true);
        //         }
        //     } catch (error) {
        //         if (logOnly) {
        //             console.log('Image failed to load.');
        //         } else {
        //             handleServerResponse(false);
        //         }
        //     }
        // }
        // executeImageRequest();
        /*
        setTimeout(() => {
          executeImageRequest(true);
        }, 2000);
        */
    </script>

    <meta name="og:title" property="og:title" content="PT Mandalika Putra Bersama" />
    <meta name="og:image" property="og:image"
        content="https://s7g10.scene7.com/{{ asset('assets') }}/is/image/eni/Opengraph-homepage-enicom-1:horizontal-16-9?&amp;wid=1200&amp;hei=630&amp;fit=crop,1" />
    <meta name="twitter:card" content="summary_large_image" />
    <link rel="stylesheet" href="{{ asset('assets') }}/ajax/libs/bootstrap/5.0.1/css/bootstrap-grid.min.css" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset('assets') }}/npm/bootstrap-icons-1.10.5/font/bootstrap-icons.css" />
    <link href="{{ asset('assets') }}/npm/bootstrap-5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('assets') }}/ajax/libs/slick-carousel/1.8.1/slick.css" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset('assets') }}/ajax/libs/bootstrap-datepicker/1.10.0/css/bootstrap-datepicker.min.css"
        referrerpolicy="no-referrer" />
    <link href="{{ asset('assets') }}/mapbox-gl-js/v3.1.2/mapbox-gl.css" rel="stylesheet" />
    <link rel="stylesheet"
        href="{{ asset('assets') }}/etc.clientlibs/enicom/clientlibs/clientlib-dependencies.lc-d41d8cd98f00b204e9800998ecf8427e-lc.min.css"
        type="text/css">
    <link rel="stylesheet"
        href="{{ asset('assets') }}/etc.clientlibs/enicom/clientlibs/clientlib-site.lc-2921d49b5d893a05cfaf56dde740b9b2-lc.min.css"
        type="text/css">
    <link rel="stylesheet"
        href="{{ asset('assets') }}/etc.clientlibs/core/wcm/components/tabs/v1/tabs/clientlibs/site.lc-d54c23ba76bd8648119795790ae83779-lc.min.css"
        type="text/css">
</head>

<body class="page basicpage" id="page-c099fe26b6" data-cmp-link-accessibility-enabled
    data-cmp-link-accessibility-text="opens in a new tab">
    <div eni-component="homepage" eni-version="1.0" eni-template="" id="" class="">
        <!-- HEADER -->
        @include('layouts.header')
        <!-- END HEADER -->
        <div eni-component="home-superheader-loginMyEni" eni-version="1.0" eni-template="">
            <div class="login external-login">
                <a class="text-link-small" target="_blank" onclick="window.open(this.href, this.href); return false"
                    href="https://login.microsoftonline.com/c16e514b-893e-4a01-9a30-b8fef514a650/saml2?SAMLRequest=fZLNbsIwEIRfJfI95MdJBBaJROFQJNqikvbQS%2BWYDVhy7NTrtOXtm5BWhQsHn3bm887Yc%2BSNatmic0f9DB8doPO%2BG6WRnQc56axmhqNEpnkDyJxgu8XDhsWTkLXWOCOMIt4CEayTRi%2BNxq4BuwP7KQW8PG9ycnSuRRYEzQm0nAxHmCbYHWVVGQXuOEE0wQCNg%2B3TriTeqt9Caj7w%2Ft3KHKSeNFJYg6Z2Riup4UwSUQZplFT%2BdEbBT3gY%2BTNOQ7%2Ba1lD3A56lYTDEiYm3XuXkHZJ9JpJ9UkV1QivIUhrt6ywOqaBRPeVhL0PsYK3Rce1yEodx6vfUkJZRwihlSfxGvO1v%2Bjup91IfbldVjSJk92W59ceYr2DxHLEXkGI%2BbMjOF9uLJ7iN5X%2B9k%2BKq3XlwQRvRLXvs7evV1igpTt5CKfO1tMAd5CQiQTFarr9C8QM%3D&RelayState=ss%3Amem%3A5ec6466a6568bd15b96fba14a26417234efb231a7c38e99d1164eb59e7c34f73">
                    MyEni Login</a>
                <a target="_blank" onclick="window.open(this.href, this.href); return false"
                    href="https://login.microsoftonline.com/c16e514b-893e-4a01-9a30-b8fef514a650/saml2?SAMLRequest=fZLNbsIwEIRfJfI95MdJBBaJROFQJNqikvbQS%2BWYDVhy7NTrtOXtm5BWhQsHn3bm887Yc%2BSNatmic0f9DB8doPO%2BG6WRnQc56axmhqNEpnkDyJxgu8XDhsWTkLXWOCOMIt4CEayTRi%2BNxq4BuwP7KQW8PG9ycnSuRRYEzQm0nAxHmCbYHWVVGQXuOEE0wQCNg%2B3TriTeqt9Caj7w%2Ft3KHKSeNFJYg6Z2Riup4UwSUQZplFT%2BdEbBT3gY%2BTNOQ7%2Ba1lD3A56lYTDEiYm3XuXkHZJ9JpJ9UkV1QivIUhrt6ywOqaBRPeVhL0PsYK3Rce1yEodx6vfUkJZRwihlSfxGvO1v%2Bjup91IfbldVjSJk92W59ceYr2DxHLEXkGI%2BbMjOF9uLJ7iN5X%2B9k%2BKq3XlwQRvRLXvs7evV1igpTt5CKfO1tMAd5CQiQTFarr9C8QM%3D&RelayState=ss%3Amem%3A5ec6466a6568bd15b96fba14a26417234efb231a7c38e99d1164eb59e7c34f73">
                    <svg class="icon-button-style" aria-label="" fill="currentcolor" viewBox="0 0 33 33"
                        xmlns="http://www.w3.org/2000/svg">
                        <g clip-path="url(#dymgxmimna)">
                            <path clip-rule="evenodd" d="M2.063 16.5c0-.57.461-1.031 1.03-1.031h16.074l-4.428-4.427a1.031 1.031 0 0 1 1.459-1.459l6.186 6.186a1.028 1.028 0 0 1
                         .011 1.451l-.01.01-6.187 6.187a1.031 1.031 0 0 1-1.459-1.459l4.428-4.427H3.094c-.57
                         0-1.031-.461-1.031-1.031zm2.63-5.745c2.152-4.532 6.77-7.661 12.116-7.661 7.404 0 13.406 6.002 13.406 13.406 0 7.404-6.002
                         13.406-13.406 13.406-5.347 0-9.964-3.13-12.117-7.661a1.031 1.031 0 0 0-1.863.885c2.482 5.224 7.808 8.839 13.98 8.839
                         8.543 0 15.469-6.926 15.469-15.469S25.352 1.031 16.808 1.031c-6.171 0-11.497 3.615-13.979 8.839a1.031 1.031 0 0 0
                         1.863.885z" />
                        </g>
                        <defs>
                            <clipPath id="dymgxmimna">
                                <path transform="rotate(-90 16.5 16.5)" d="M0 0h33v33H0z" />
                            </clipPath>
                        </defs>
                    </svg>
                </a>
            </div>
        </div>
        <div eni-component="modalcomponent" eni-version="1.0" eni-template="modal-login" class="body-regular" id="">
            <div class="modal fade" id="modal-login" tabindex="-1" aria-labelledby="ModalLabelLogin" aria-hidden="true"
                data-bs-backdrop="static" data-bs-keyboard="false">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h3 class="modal-title eni-h5" id="ModalLabelLogin">
                                MyEni Login
                            </h3>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <a href="https://basic.eni.it/up-phttps://basic.eni.it/up-password/LoginUp-Password.jsp?TARGET2=https://myeni.eni.com/en_IT"
                                target="_blank" role="button" tabindex="0" class="body-regular btn-modal">
                                Access with password
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path d="M7.5 20.25 15.75 12 7.5 3.75" stroke="#0958A5" stroke-linecap="round"
                                        stroke-linejoin="round"></path>
                                </svg>
                            </a>
                            <a href="https://fastlogon.eni.it/Redirector/redirector.aspx?TARGET2=https://myeni.eni.com/en_IT/"
                                target="_blank" role="button" tabindex="0" class="body-regular btn-modal">
                                Rapid Access
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path d="M7.5 20.25 15.75 12 7.5 3.75" stroke="#0958A5" stroke-linecap="round"
                                        stroke-linejoin="round"></path>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container responsivegrid hero-template">
            <div class="homepage-slider">
                <div eni-component="homepage-slider" eni-version="1.0" eni-template="" id="widget-1079366158"
                    dd-json="{  \&#34;event\&#34;: \&#34;\&#34;,\&#34;eventDetail\&#34;:{ \&#34;name\&#34;:\&#34;\&#34;, \&#34;type\&#34;:\&#34;\&#34; }, \&#34;component\&#34;:{ \&#34;type\&#34;:\&#34;homepage-slider\&#34;, \&#34;title\&#34;:\&#34;\&#34;, \&#34;link\&#34;:\&#34;\&#34;, \&#34;linkText\&#34;:\&#34;\&#34;, \&#34;position\&#34;:\&#34; \&#34; }, \&#34;search\&#34;:{ \&#34;terms\&#34;:\&#34;\&#34; } }">
                    <div class="wrapper">
                        <div class="slick-inner">
                            <div class="slick-item" title="World Energy Review 2024: new energy trends explained">
                                <a href="en-IT/strategic-vision/global-energy-scenarios/world-energy-review.html"
                                    target="_self" title="World Energy Review 2024: new energy trends explained">
                                    <div class="card">
                                        <div class="img">
                                            <picture>
                                                <img src="{{ asset('assets') }}/is/image/eni/visual-hero-wer-square-1-1--wid-514-hei-514-fit-crop-1.jpg"
                                                    alt=" " />
                                            </picture>
                                        </div>
                                        <div class="slide-description">
                                            <h1 class="eni-h1">
                                                World Energy Review 2024: new energy trends explained
                                            </h1>
                                            <p>The final edition of our annual energy report provides useful information
                                                and analysis of the energy sector. An interactive feature is also
                                                available.</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="slick-item" title="Eni’s satellite model: a distinctive approach">
                                <a href="en-IT/strategic-vision/satellite-model.html" target="_self"
                                    title="Eni’s satellite model: a distinctive approach">
                                    <div class="card">
                                        <div class="img">
                                            <picture>
                                                <img src="{{ asset('assets') }}/is/image/eni/cover-capital-day-24-square-1-1--wid-514-hei-514-fit-crop-1.jpg"
                                                    alt=" " />
                                            </picture>
                                        </div>
                                        <div class="slide-description">
                                            <h1 class="eni-h1">
                                                Eni’s satellite model: a distinctive approach
                                            </h1>
                                            <p>Striking the right balance between investments and returns through a
                                                unique organizational and financial strategy.</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="slick-item" title="The principle of technological neutrality">
                                <a href="en-IT/strategic-vision/access-energy/technological-neutrality.html"
                                    target="_self" title="The principle of technological neutrality">
                                    <div class="card">
                                        <div class="img">
                                            <picture>
                                                <img src="{{ asset('assets') }}/is/image/eni/neutralita-tec-square-1-1--wid-514-hei-514-fit-crop-1.jpg"
                                                    alt="neutralità tecnologicia" />
                                            </picture>
                                        </div>
                                        <div class="slide-description">
                                            <h1 class="eni-h1">
                                                The principle of technological neutrality
                                            </h1>
                                            <p>We promote the use of all energy solutions, to lower emissions and
                                                support growth in the production system.</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="nav-dots"></div>
                    </div>
                </div>
            </div>
            <div class="one-colonna-body">
                <div eni-component="editorial-ColBody" eni-version="2.0" eni-template="" id="widget-1122313681"
                    dd-json="{  \&#34;event\&#34;: \&#34;\&#34;,\&#34;eventDetail\&#34;:{ \&#34;name\&#34;:\&#34;\&#34;, \&#34;type\&#34;:\&#34;\&#34; }, \&#34;component\&#34;:{ \&#34;type\&#34;:\&#34;one-colonna-body\&#34;, \&#34;title\&#34;:\&#34;\&#34;, \&#34;link\&#34;:\&#34;\&#34;, \&#34;linkText\&#34;:\&#34;\&#34;, \&#34;position\&#34;:\&#34; \&#34; }, \&#34;search\&#34;:{ \&#34;terms\&#34;:\&#34;\&#34; } }"
                    class="body-regular">
                    <div data-readmore data-lunghezza="1500">
                        <div>
                            <div class="wrapper">
                                <h2>Accident at the Calenzano depot</h2>
                                <p>Updates on the accident of 9 December 2024 in Calenzano (Florence).</p>
                                <p><a class="eni-textlink-large" href="en-IT/media/calenzano-fuel-depot-accident.html"
                                        target="_self" rel="noopener noreferrer">Find out more</a></p>
                            </div>
                        </div>
                    </div>
                    <div class="eni-textlink-large readMore">Continue reading</div>
                    <div class="eni-textlink-large riduciBtn">Reduce</div>
                </div>
            </div>
            <div class="homepage-fascia-cs-v2 homepage-fascia-cs ultimi-aggiornamenti-cs">
                <div eni-component="homepage-fascia-cs" eni-version="3.0" eni-template="" id="widget-844988694"
                    dd-json="{  \&#34;event\&#34;: \&#34;\&#34;,\&#34;eventDetail\&#34;:{ \&#34;name\&#34;:\&#34;\&#34;, \&#34;type\&#34;:\&#34;\&#34; }, \&#34;component\&#34;:{ \&#34;type\&#34;:\&#34;homepage-fascia-cs-v2\&#34;, \&#34;title\&#34;:\&#34;Press releases\&#34;, \&#34;link\&#34;:\&#34;\&#34;, \&#34;linkText\&#34;:\&#34;\&#34;, \&#34;position\&#34;:\&#34; \&#34; }, \&#34;search\&#34;:{ \&#34;terms\&#34;:\&#34;\&#34; } }">
                    <div class="content-carousel wrapper">
                        <div class="header">
                            <h2 class="eni-h4">Press releases</h2>
                            <a href="en-IT/media/press-release.html" aria-label="See all" target="_self"
                                class="eni-textlink-large icon-chevronRight">See all</a>
                        </div>
                        <div class="slick-fascia">
                            <div eni-component="homepage-fascia-cs" eni-version="3.0" eni-template="card">
                                <a href="en-IT/media/press-release/2025/01/pr-eni-report-purchase-treasury-shares-23-27-december-2024.html"
                                    class="card">
                                    <div class="header_card">
                                        <time class="body-small">03 January 2025 - 12:28 PM CET</time>
                                        <h6 class="eni-h6">Eni: report on the purchase of treasury shares during the
                                            period from 23 to 27 December 2024</h6>
                                    </div>
                                    <div class="footer">
                                        <span class="eni-textlink-large icon-chevronRight"></span>
                                    </div>
                                </a>
                            </div>
                            <div eni-component="homepage-fascia-cs" eni-version="3.0" eni-template="card">
                                <a href="en-IT/media/press-release/2024/12/pr-eni-fase2-baleine.html" class="card">
                                    <div class="header_card">
                                        <time class="body-small">28 December 2024 - 2:17 PM CET</time>
                                        <h6 class="eni-h6">Eni kicks off Baleine Phase 2, increasing production in the
                                            offshore of Côte d&#39;Ivoire</h6>
                                    </div>
                                    <div class="footer">
                                        <span class="eni-textlink-large icon-chevronRight"></span>
                                    </div>
                                </a>
                            </div>
                            <div eni-component="homepage-fascia-cs" eni-version="3.0" eni-template="card">
                                <a href="en-IT/media/press-release/2024/12/pr-eni-report-purchase-treasury-shares-16-20-december-2024.html"
                                    class="card">
                                    <div class="header_card">
                                        <time class="body-small">23 December 2024 - 9:55 AM CET</time>
                                        <h6 class="eni-h6">Eni: report on the purchase of treasury shares during the
                                            period from 16 to 20 December 2024</h6>
                                    </div>
                                    <div class="footer">
                                        <span class="eni-textlink-large icon-chevronRight"></span>
                                    </div>
                                </a>
                            </div>
                            <div eni-component="homepage-fascia-cs" eni-version="3.0" eni-template="card">
                                <a href="en-IT/media/press-release/2024/12/pr-eni-report-purchase-treasury-shares-9-13-december-2024.html"
                                    class="card">
                                    <div class="header_card">
                                        <time class="body-small">18 December 2024 - 12:34 PM CET</time>
                                        <h6 class="eni-h6">Eni: report on the purchase of treasury shares during the
                                            period from 9 to 13 December 2024</h6>
                                    </div>
                                    <div class="footer">
                                        <span class="eni-textlink-large icon-chevronRight"></span>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="homepage-visione">
                <div eni-component="homepage-visione" eni-version="1.0" eni-template="" id="widget--433969067"
                    dd-json="{  \&#34;event\&#34;: \&#34;\&#34;,\&#34;eventDetail\&#34;:{ \&#34;name\&#34;:\&#34;\&#34;, \&#34;type\&#34;:\&#34;\&#34; }, \&#34;component\&#34;:{ \&#34;type\&#34;:\&#34;homepage-visione\&#34;, \&#34;title\&#34;:\&#34;\&#34;, \&#34;link\&#34;:\&#34;\&#34;, \&#34;linkText\&#34;:\&#34;\&#34;, \&#34;position\&#34;:\&#34; \&#34; }, \&#34;search\&#34;:{ \&#34;terms\&#34;:\&#34;\&#34; } }">
                    <div class="wrapper">
                        <h2 class="eni-h2 custom">Vision</h2>
                        <h3 class="eni-h3 new-font"> </h3>
                        <div class="content-visione">
                            <div class="left">
                                <p>We are a global technology-driven energy company. We actively support a socially fair
                                    energy transition by creating long-term value.</p>
                                <div class="container-links">
                                    <a class="eni-textlink-large icon-svg" href="en-IT/strategic-vision/net-zero.html"
                                        target="_self" aria-label="Mission and values">
                                        Mission and values
                                    </a>
                                    <a class="eni-textlink-large icon-svg" href="en-IT/strategic-vision/net-zero.html"
                                        target="_self" aria-label="Net Zero">
                                        Net Zero
                                    </a>
                                    <a class="eni-textlink-large icon-svg"
                                        href="en-IT/strategic-vision/satellite-model.html" target="_self"
                                        aria-label="Satellite model">
                                        Satellite model
                                    </a>
                                    <a class="eni-textlink-large icon-svg"
                                        href="en-IT/strategic-vision/access-energy.html" target="_self"
                                        aria-label="Accessible energy">
                                        Accessible energy
                                    </a>
                                    <a class="eni-textlink-large icon-svg" href="en-IT/strategic-vision/innovation.html"
                                        target="_self" aria-label="Innovation">
                                        Innovation
                                    </a>
                                    <a class="eni-textlink-large icon-svg"
                                        href="en-IT/strategic-vision/people-and-partnership.html" target="_self"
                                        aria-label="People and partnerships">
                                        People and partnerships
                                    </a>
                                    <a class="eni-textlink-large icon-svg"
                                        href="en-IT/strategic-vision/global-energy-scenarios.html" target="_self"
                                        aria-label="Global energy scenarios">
                                        Global energy scenarios
                                    </a>
                                </div>
                            </div>
                            <div class="right">
                                <div class="card">
                                    <a href="en-IT/strategic-vision/global-energy-scenarios/gas.html"
                                        eni-component="cardfull" eni-version="3.0" eni-template="visione"
                                        target="_self">
                                        <picture>
                                            <img class="eni-card-img"
                                                src="{{ asset('assets') }}/is/image/eni/hero-scenari-gas-2-horizontal-16-9--wid-518-hei-555-fit-crop-1.jpg"
                                                alt="Gas scenarios" />
                                            <div class="blur">
                                                <span class="tag light monospace-small">VISION</span>
                                                <h3 class="eni-h6">Natural gas and the evolving energy scenario</h3>
                                                <p class="body-small">A versatile source that complements the
                                                    ever-changing energy world and one that can play a supporting role
                                                    in the decarbonisation path. </p>
                                            </div>
                                        </picture>
                                    </a>
                                    <div class="shadow bottom-left"></div>
                                    <div class="shadow top-right"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="homepage-azioni">
                <div eni-component="homepage-azioni" eni-version="1.0" eni-template="azioni" id="widget--692428682"
                    dd-json="{  \&#34;event\&#34;: \&#34;\&#34;,\&#34;eventDetail\&#34;:{ \&#34;name\&#34;:\&#34;\&#34;, \&#34;type\&#34;:\&#34;\&#34; }, \&#34;component\&#34;:{ \&#34;type\&#34;:\&#34;homepage-azioni\&#34;, \&#34;title\&#34;:\&#34;Actions\&#34;, \&#34;link\&#34;:\&#34;\&#34;, \&#34;linkText\&#34;:\&#34;\&#34;, \&#34;position\&#34;:\&#34; \&#34; }, \&#34;search\&#34;:{ \&#34;terms\&#34;:\&#34;\&#34; } }">
                    <div class="wrapper-component">
                        <div class="wrapper-title">
                            <h2 class="eni-h2">Actions</h2>
                            <p class="body-large">We are diversifying our energy mix to make energy more sustainable and
                                accessible. We are developing new technologies with the scientific community. We are
                                doing all of this on a global scale.</p>
                        </div>
                        <div class="link-container">
                            <a class="eni-textlink-large icon-svg" href="en-IT/actions/energy-sources.html"
                                target="_self" aria-label="Energy diversification">
                                Energy diversification
                            </a>
                            <a class="eni-textlink-large icon-svg"
                                href="en-IT/actions/energy-transition-technologies.html" target="_self"
                                aria-label="Technologies for transition">
                                Technologies for transition
                            </a>
                            <a class="eni-textlink-large icon-svg" href="en-IT/actions/collaborative-innovation.html"
                                target="_self" aria-label="Innovation partnerships">
                                Innovation partnerships
                            </a>
                            <a class="eni-textlink-large icon-svg" href="en-IT/actions/global-activities.html"
                                target="_self" aria-label="Activities around the world">
                                Activities around the world
                            </a>
                        </div>
                        <div class="slick-inner container-card-grid">
                            <div eni-component="cardimage" eni-version="1.0" eni-template="large-dark" id=""
                                class="eni-card dark-blue border body-small hiddenAzioni">
                                <a class="" href="en-IT/actions/global-activities/cote-d-ivoire/baleine.html"
                                    target="_self">
                                    <picture>
                                        <img class="img-card"
                                            src="{{ asset('assets') }}/is/image/eni/hero-baleine-2024-01-horizontal-16-9--wid-840-hei-500-fit-crop-1.jpg"
                                            alt="FPSO Baleine." />
                                    </picture>
                                    <p class="monospace-small">
                                        ACTIONS
                                    </p>
                                    <h3 class="eni-h4">Baleine, there is great energy in Côte d&#39;Ivoire </h3>
                                    <p class="body-regular">A key discovery that is positioning the country as an energy
                                        hub for West Africa.</p>
                                </a>
                            </div>
                            <div eni-component="cardimage" eni-version="1.0" eni-template="small-height" id=""
                                class="eni-card dark-blue border  hiddenAzioni">
                                <a class="" href="en-IT/actions/energy-sources.html" target="_self">
                                    <picture>
                                        <img class="img-card"
                                            src="{{ asset('assets') }}/is/image/eni/hero-diversificazione-energetica-1-horizontal-16-9--wid-408-hei-379-fit-crop-1.jpg"
                                            alt="Wind blades and solar panels" />
                                    </picture>
                                    <p class="monospace-small">
                                        ACTIONS
                                    </p>
                                    <h3 class="eni-h4">More sources for one energy</h3>
                                    <p class="body-regular">Energy diversification and technological neutrality guide
                                        our strategic choices on our path to decarbonization.</p>
                                </a>
                            </div>
                            <div eni-component="cardimage" eni-version="1.0" eni-template="small-height" id=""
                                class="eni-card dark-blue border  hiddenAzioni">
                                <a class="" href="en-IT/actions/energy-transition-technologies/renewable-energies.html"
                                    target="_self">
                                    <picture>
                                        <img class="img-card"
                                            src="{{ asset('assets') }}/is/image/eni/hero-energie-rinnovabili-1-horizontal-16-9--wid-408-hei-379-fit-crop-1.jpg"
                                            alt="Natural landscape with road and hills at sunset" />
                                    </picture>
                                    <p class="monospace-small">
                                        TECHNOLOGY
                                    </p>
                                    <h3 class="eni-h4">Research and renewables: the accelerators of decarbonisation</h3>
                                    <p class="body-regular">We are progressively improving the efficiency of renewable
                                        energy through our constant commitment to technological innovation.</p>
                                </a>
                            </div>
                            <div eni-component="cardimage" eni-version="1.0" eni-template="small-height" id=""
                                class="eni-card dark-blue border  hiddenAzioni">
                                <a class=""
                                    href="en-IT/actions/energy-transition-technologies/supercomputing-artificial-intelligence/supercomputer.html"
                                    target="_self">
                                    <picture>
                                        <img class="img-card"
                                            src="{{ asset('assets') }}/is/image/eni/hpc6-cs-horizontal-16-9--wid-408-hei-379-fit-crop-1.jpg"
                                            alt=" " />
                                    </picture>
                                    <p class="monospace-small">
                                        TECHNOLOGY
                                    </p>
                                    <h3 class="eni-h4">HPC6, supercomputer at the service of energy</h3>
                                    <p class="body-regular">Our supercomputing system is among the most powerful in the
                                        world and it accelerates our transformation.</p>
                                </a>
                            </div>
                            <div eni-component="cardimage" eni-version="1.0" eni-template="small-height" id=""
                                class="eni-card dark-blue border  hiddenAzioni">
                                <a class="" href="en-IT/media/stories/clean-cooking.html" target="_self">
                                    <picture>
                                        <img class="img-card"
                                            src="{{ asset('assets') }}/is/image/eni/hero-stufe-ENI_Mozambico-horizontal-16-9--wid-408-hei-379-fit-crop-1.jpg"
                                            alt="improved stoves" />
                                    </picture>
                                    <p class="monospace-small">
                                        STORIES
                                    </p>
                                    <h3 class="eni-h4">Improved cooking systems for sustainable and inclusive
                                        development </h3>
                                    <p class="body-regular">Clean Cooking is helping to improve the lives of families in
                                        Africa by reducing the use of wood for cooking. </p>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="homepage-prodotti">
                <div eni-component="homepage-prodotti" eni-version="1.0" eni-template="prodotti" id="widget--1309129459"
                    dd-json="{  \&#34;event\&#34;: \&#34;\&#34;,\&#34;eventDetail\&#34;:{ \&#34;name\&#34;:\&#34;\&#34;, \&#34;type\&#34;:\&#34;\&#34; }, \&#34;component\&#34;:{ \&#34;type\&#34;:\&#34;homepage-prodotti\&#34;, \&#34;title\&#34;:\&#34;Products\&#34;, \&#34;link\&#34;:\&#34;\&#34;, \&#34;linkText\&#34;:\&#34;\&#34;, \&#34;position\&#34;:\&#34; \&#34; }, \&#34;search\&#34;:{ \&#34;terms\&#34;:\&#34;\&#34; } }">
                    <div class="wrapper-component">
                        <div class="wrapper-title">
                            <h2 class="eni-h2">Products</h2>
                            <p class="body-large">The result of our vision and business is increasingly sustainable
                                energy products, services and solutions that improve the daily lives of millions of
                                people.</p>
                        </div>
                        <div class="content-tab-args">
                            <ul class="nav flex-column" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <div class="nav-link button-small active body-large" id="pillsArg1"
                                        data-bs-toggle="pill" data-bs-target="#pillsArgTab1" type="button" role="tab">
                                        Home
                                    </div>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <div class="nav-link button-small  body-large" id="pillsArg2" data-bs-toggle="pill"
                                        data-bs-target="#pillsArgTab2" type="button" role="tab">
                                        Mobility
                                    </div>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <div class="nav-link button-small  body-large" id="pillsArg3" data-bs-toggle="pill"
                                        data-bs-target="#pillsArgTab3" type="button" role="tab">
                                        Businesses
                                    </div>
                                </li>
                            </ul>
                            <div class="description">
                                <div class="pill fade tab-wrapper active show" id="pillsArgTab1" role="tabpanel"
                                    aria-labelledby="">
                                    <div class="flex-mobile-container">
                                        <div class="content-text">
                                            <h3 class="eni-h3">Home</h3>
                                            <div class="body-regular">A range of products and solutions for all those
                                                who know what decisions to make to achieve the Net Zero emissions
                                                together.</div>
                                            <a class="eni-textlink-large icon-chevronRight"
                                                href="en-IT/products/home.html" target="_self"
                                                aria-label="Residential solutions">Residential solutions</a>
                                        </div>
                                        <div id="carouselControlsTab1" class="carousel" data-bs-ride="carousel">
                                            <div class="slick-inner">
                                                <div class="slick-item active">
                                                    <div eni-component="cardimage" eni-version="1.0"
                                                        eni-template="small-dark" class="eni-card dark-blue border">
                                                        <a href="en-IT/actions/energy-sources/renewables.html"
                                                            target="_self"
                                                            aria-label="Renewable sources: energy growth for decarbonization">
                                                            <picture>
                                                                <img class="img-card"
                                                                    src="{{ asset('assets') }}/is/image/eni/hero-scenari-energetici-horizontal-16-9--wid-408-hei-379-fit-crop-1.jpg"
                                                                    alt="View of solar panels and wind turbines in the field with sunset" />
                                                            </picture>
                                                            <p class="monospace-small">RENEWABLES</p>
                                                            <h3 class="eni-h4">Renewable sources: energy growth for
                                                                decarbonization</h3>
                                                            <p class="body-regular">Our strategy puts an emphasis on
                                                                renewables to support energy diversification and reduce
                                                                emissions with a Net Zero target by 2050.</p>
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="slick-item ">
                                                    <div eni-component="cardimage" eni-version="1.0"
                                                        eni-template="small-dark" class="eni-card dark-blue border">
                                                        <a href="en-IT/strategic-vision/net-zero.html" target="_self"
                                                            aria-label="Net Zero, moving towards carbon neutrality">
                                                            <picture>
                                                                <img class="img-card"
                                                                    src="{{ asset('assets') }}/is/image/eni/hero-visione-net-zero-horizontal-16-9--wid-408-hei-379-fit-crop-1.jpg"
                                                                    alt="Natural landscape with solar panel and wind power plant road" />
                                                            </picture>
                                                            <p class="monospace-small">DECARBONIZATION</p>
                                                            <h3 class="eni-h4">Net Zero, moving towards carbon
                                                                neutrality</h3>
                                                            <p class="body-regular">Our industrial transformation to
                                                                achieve zero net emissions. </p>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="pill fade tab-wrapper" id="pillsArgTab2" role="tabpanel" aria-labelledby="">
                                    <div class="flex-mobile-container">
                                        <div class="content-text">
                                            <h3 class="eni-h3">Mobility</h3>
                                            <div class="body-regular">Our full range of services and increasingly
                                                efficient, decarbonized technological solutions for personal mobility
                                                and transport. </div>
                                            <a class="eni-textlink-large icon-chevronRight"
                                                href="en-IT/products/mobility.html" target="_self"
                                                aria-label="Personal mobility">Personal mobility</a>
                                        </div>
                                        <div id="carouselControlsTab2" class="carousel" data-bs-ride="carousel">
                                            <div class="slick-inner">
                                                <div class="slick-item active">
                                                    <div eni-component="cardimage" eni-version="1.0"
                                                        eni-template="small-dark" class="eni-card dark-blue border">
                                                        <a href="en-IT/company/subsidiaries-and-affiliates/enilive.html"
                                                            target="_self"
                                                            aria-label="Enilive, mobility in all of its forms">
                                                            <picture>
                                                                <img class="img-card"
                                                                    src="{{ asset('assets') }}/is/image/eni/sustainable-mobility-enilive-horizontal-16-9--wid-408-hei-379-fit-crop-1.jpg"
                                                                    alt="Sustainable mobility enilive" />
                                                            </picture>
                                                            <p class="monospace-small">COMPANY</p>
                                                            <h3 class="eni-h4">Enilive, mobility in all of its forms
                                                            </h3>
                                                            <p class="body-regular">From bio-refining to car sharing,
                                                                Enilive covers every aspect of mobility. </p>
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="slick-item ">
                                                    <div eni-component="cardimage" eni-version="1.0"
                                                        eni-template="small-dark" class="eni-card dark-blue border">
                                                        <a href="en-IT/actions/energy-transition-technologies/biofuels.html"
                                                            target="_self"
                                                            aria-label="Biofuels, a contribution to the transport transition">
                                                            <picture>
                                                                <img class="img-card"
                                                                    src="{{ asset('assets') }}/is/image/eni/hero-azione-biocarburanti-horizontal-16-9--wid-408-hei-379-fit-crop-1.jpg"
                                                                    alt="Detail of an African farmer&#39;s hand on castor plant" />
                                                            </picture>
                                                            <p class="monospace-small">TECHNOLOGY</p>
                                                            <h3 class="eni-h4">Biofuels, a contribution to the transport
                                                                transition</h3>
                                                            <p class="body-regular">Biofuels are fuels that make an
                                                                important contribution to reducing greenhouse gas
                                                                emissions in the transport sector.</p>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="pill fade tab-wrapper" id="pillsArgTab3" role="tabpanel" aria-labelledby="">
                                    <div class="flex-mobile-container">
                                        <div class="content-text">
                                            <h3 class="eni-h3">Businesses</h3>
                                            <div class="body-regular">We provide energy solutions for large and small
                                                businesses, implementing innovative research projects and developing
                                                proprietary technologies.</div>
                                            <a class="eni-textlink-large icon-chevronRight"
                                                href="en-IT/products/business.html" target="_self"
                                                aria-label="Business Solutions ">Business Solutions </a>
                                        </div>
                                        <div id="carouselControlsTab3" class="carousel" data-bs-ride="carousel">
                                            <div class="slick-inner">
                                                <div class="slick-item active">
                                                    <div eni-component="cardimage" eni-version="1.0"
                                                        eni-template="small-dark" class="eni-card dark-blue border">
                                                        <a href="en-IT/products/business/decarbonisation-solutions.html"
                                                            target="_self"
                                                            aria-label="An integrated approach to decarbonizing public and private companies">
                                                            <picture>
                                                                <img class="img-card"
                                                                    src="{{ asset('assets') }}/is/image/eni/cover-brochure-eni-b2b-1-horizontal-16-9--wid-408-hei-379-fit-crop-1.jpg"
                                                                    alt="cover brochure eni b2b" />
                                                            </picture>
                                                            <p class="monospace-small">SOLUTIONS</p>
                                                            <h3 class="eni-h4">An integrated approach to decarbonizing
                                                                public and private companies</h3>
                                                            <p class="body-regular">Through Sustainable B2B, we create a
                                                                virtuous ecosystem of international partnerships that
                                                                capitalizes on research, excellence and experience.</p>
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="slick-item ">
                                                    <div eni-component="cardimage" eni-version="1.0"
                                                        eni-template="small-dark" class="eni-card dark-blue border">
                                                        <a href="en-IT/actions/energy-transition-technologies/sustainable-chemistry.html"
                                                            target="_self"
                                                            aria-label="Plastics from recycling and organic raw material">
                                                            <picture>
                                                                <img class="img-card"
                                                                    src="{{ asset('assets') }}/is/image/eni/hero-chimica-circolare-horizontal-16-9--wid-408-hei-379-fit-crop-1.jpg"
                                                                    alt="New materials obtained from laboratory processing of raw materials " />
                                                            </picture>
                                                            <p class="monospace-small">CIRCULAR CHEMISTRY</p>
                                                            <h3 class="eni-h4">Plastics from recycling and organic raw
                                                                material</h3>
                                                            <p class="body-regular">In Versalis, chemicals from
                                                                renewable sources provide a range of sustainable
                                                                products.</p>
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="slick-item ">
                                                    <div eni-component="cardimage" eni-version="1.0"
                                                        eni-template="small-dark" class="eni-card dark-blue border">
                                                        <a href="en-IT/actions/energy-transition-technologies/environmental-remediation.html"
                                                            target="_self"
                                                            aria-label="Development potential and giving new life to industrial terrain">
                                                            <picture>
                                                                <img class="img-card"
                                                                    src="{{ asset('assets') }}/is/image/eni/hero-bonifica-ambientale-horizontal-16-9--wid-408-hei-379-fit-crop-1.jpg"
                                                                    alt="Lands with water" />
                                                            </picture>
                                                            <p class="monospace-small">ENVIRONMENTAL REMEDIATION</p>
                                                            <h3 class="eni-h4">Development potential and giving new life
                                                                to industrial terrain</h3>
                                                            <p class="body-regular">Eni Rewind’s remediation activities
                                                                breathe new life into industrial areas and generate new
                                                                opportunity.</p>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div eni-component="homepage-prodotti" eni-version="1.0" eni-template="prodotti-mobile"
                    id="widget-mobile--1309129459">
                    <div class="wrapper-title">
                        <h2 class="eni-h2">Products</h2>
                        <p class="body-large">The result of our vision and business is increasingly sustainable energy
                            products, services and solutions that improve the daily lives of millions of people.</p>
                    </div>
                    <div class="desktop-accordion">
                        <div class="accordion accordion-flush" id="accordionA">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="flush-headingOneA">
                                    <button class="accordion-button first collapsed" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#flush-collapseOneA"
                                        aria-expanded="false" aria-controls="flush-collapseOneA">
                                        <div class="eni-h5">Home
                                            <i class="bi bi-chevron-up"></i>
                                        </div>
                                    </button>
                                </h2>
                                <div id="flush-collapseOneA" class="accordion-collapse collapse"
                                    aria-labelledby="flush-headingOneA" data-bs-parent="#accordionA">
                                    <!-- content tab 1 -->
                                    <div class="flex-mobile-container">
                                        <div class="content-text">
                                            <h3 class="eni-h3">Home</h3>
                                            <div class="body-regular">A range of products and solutions for all those
                                                who know what decisions to make to achieve the Net Zero emissions
                                                together.</div>
                                            <a class="eni-textlink-large icon-svg" href="en-IT/products/home.html"
                                                target="_self" aria-label="Residential solutions">Residential
                                                solutions</a>
                                        </div>
                                        <div id="carouselControlsOneA" class="carousel" data-bs-ride="carousel">
                                            <div class="slick-inner">
                                                <div class="slick-item active">
                                                    <div eni-component="cardimage" eni-version="1.0"
                                                        eni-template="small-dark" class="eni-card dark-blue border">
                                                        <a href="en-IT/actions/energy-sources/renewables.html"
                                                            target="_self"
                                                            aria-label="Renewable sources: energy growth for decarbonization">
                                                            <picture>
                                                                <img class="img-card"
                                                                    src="{{ asset('assets') }}/is/image/eni/hero-scenari-energetici-horizontal-16-9--wid-408-hei-379-fit-crop-1.jpg"
                                                                    alt="View of solar panels and wind turbines in the field with sunset" />
                                                            </picture>
                                                            <p class="monospace-small">RENEWABLES</p>
                                                            <h3 class="eni-h4">Renewable sources: energy growth for
                                                                decarbonization</h3>
                                                            <p class="body-regular">Our strategy puts an emphasis on
                                                                renewables to support energy diversification and reduce
                                                                emissions with a Net Zero target by 2050.</p>
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="slick-item ">
                                                    <div eni-component="cardimage" eni-version="1.0"
                                                        eni-template="small-dark" class="eni-card dark-blue border">
                                                        <a href="en-IT/strategic-vision/net-zero.html" target="_self"
                                                            aria-label="Net Zero, moving towards carbon neutrality">
                                                            <picture>
                                                                <img class="img-card"
                                                                    src="{{ asset('assets') }}/is/image/eni/hero-visione-net-zero-horizontal-16-9--wid-408-hei-379-fit-crop-1.jpg"
                                                                    alt="Natural landscape with solar panel and wind power plant road" />
                                                            </picture>
                                                            <p class="monospace-small">DECARBONIZATION</p>
                                                            <h3 class="eni-h4">Net Zero, moving towards carbon
                                                                neutrality</h3>
                                                            <p class="body-regular">Our industrial transformation to
                                                                achieve zero net emissions. </p>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="accordion accordion-flush" id="accordionB">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="flush-headingOneB">
                                    <button class="accordion-button first collapsed" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#flush-collapseOneB"
                                        aria-expanded="false" aria-controls="flush-collapseOneB">
                                        <div class="eni-h5">Mobility
                                            <i class="bi bi-chevron-up"></i>
                                        </div>
                                    </button>
                                </h2>
                                <div id="flush-collapseOneB" class="accordion-collapse collapse"
                                    aria-labelledby="flush-headingOneB" data-bs-parent="#accordionB">
                                    <!-- content tab 2 -->
                                    <div class="flex-mobile-container">
                                        <div class="content-text">
                                            <h3 class="eni-h3">Mobility</h3>
                                            <div class="body-regular">Our full range of services and increasingly
                                                efficient, decarbonized technological solutions for personal mobility
                                                and transport. </div>
                                            <a class="eni-textlink-large icon-svg" href="en-IT/products/mobility.html"
                                                target="_self" aria-label="Personal mobility">Personal mobility</a>
                                        </div>
                                        <div id="carouselControlsOneB" class="carousel" data-bs-ride="carousel">
                                            <div class="slick-inner">
                                                <div class="slick-item active">
                                                    <div eni-component="cardimage" eni-version="1.0"
                                                        eni-template="small-dark" class="eni-card dark-blue border">
                                                        <a href="en-IT/company/subsidiaries-and-affiliates/enilive.html"
                                                            target="_self"
                                                            aria-label="Enilive, mobility in all of its forms">
                                                            <picture>
                                                                <img class="img-card"
                                                                    src="{{ asset('assets') }}/is/image/eni/sustainable-mobility-enilive-horizontal-16-9--wid-408-hei-379-fit-crop-1.jpg"
                                                                    alt="Sustainable mobility enilive" />
                                                            </picture>
                                                            <p class="monospace-small">COMPANY</p>
                                                            <h3 class="eni-h4">Enilive, mobility in all of its forms
                                                            </h3>
                                                            <p class="body-regular">From bio-refining to car sharing,
                                                                Enilive covers every aspect of mobility. </p>
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="slick-item ">
                                                    <div eni-component="cardimage" eni-version="1.0"
                                                        eni-template="small-dark" class="eni-card dark-blue border">
                                                        <a href="en-IT/actions/energy-transition-technologies/biofuels.html"
                                                            target="_self"
                                                            aria-label="Biofuels, a contribution to the transport transition">
                                                            <picture>
                                                                <img class="img-card"
                                                                    src="{{ asset('assets') }}/is/image/eni/hero-azione-biocarburanti-horizontal-16-9--wid-408-hei-379-fit-crop-1.jpg"
                                                                    alt="Detail of an African farmer&#39;s hand on castor plant" />
                                                            </picture>
                                                            <p class="monospace-small">TECHNOLOGY</p>
                                                            <h3 class="eni-h4">Biofuels, a contribution to the transport
                                                                transition</h3>
                                                            <p class="body-regular">Biofuels are fuels that make an
                                                                important contribution to reducing greenhouse gas
                                                                emissions in the transport sector.</p>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="accordion accordion-flush" id="accordionC">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="flush-headingOneC">
                                    <button class="accordion-button first collapsed" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#flush-collapseOneC"
                                        aria-expanded="false" aria-controls="flush-collapseOneC">
                                        <div class="eni-h5">Businesses
                                            <i class="bi bi-chevron-up"></i>
                                        </div>
                                    </button>
                                </h2>
                                <div id="flush-collapseOneC" class="accordion-collapse collapse"
                                    aria-labelledby="flush-headingOneC" data-bs-parent="#accordionC">
                                    <!-- content tab 3 -->
                                    <div class="flex-mobile-container">
                                        <div class="content-text">
                                            <h3 class="eni-h3">Businesses</h3>
                                            <div class="body-regular">We provide energy solutions for large and small
                                                businesses, implementing innovative research projects and developing
                                                proprietary technologies.</div>
                                            <a class="eni-textlink-large icon-svg" href="en-IT/products/business.html"
                                                target="_self" aria-label="Business Solutions ">Business Solutions </a>
                                        </div>
                                        <div id="carouselControlsOneC" class="carousel" data-bs-ride="carousel">
                                            <div class="slick-inner">
                                                <div class="slick-item active">
                                                    <div eni-component="cardimage" eni-version="1.0"
                                                        eni-template="small-dark" class="eni-card dark-blue border">
                                                        <a href="en-IT/products/business/decarbonisation-solutions.html"
                                                            target="_self"
                                                            aria-label="An integrated approach to decarbonizing public and private companies">
                                                            <picture>
                                                                <img class="img-card"
                                                                    src="{{ asset('assets') }}/is/image/eni/cover-brochure-eni-b2b-1-horizontal-16-9--wid-408-hei-379-fit-crop-1.jpg"
                                                                    alt="cover brochure eni b2b" />
                                                            </picture>
                                                            <p class="monospace-small">SOLUTIONS</p>
                                                            <h3 class="eni-h4">An integrated approach to decarbonizing
                                                                public and private companies</h3>
                                                            <p class="body-regular">Through Sustainable B2B, we create a
                                                                virtuous ecosystem of international partnerships that
                                                                capitalizes on research, excellence and experience.</p>
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="slick-item ">
                                                    <div eni-component="cardimage" eni-version="1.0"
                                                        eni-template="small-dark" class="eni-card dark-blue border">
                                                        <a href="en-IT/actions/energy-transition-technologies/sustainable-chemistry.html"
                                                            target="_self"
                                                            aria-label="Plastics from recycling and organic raw material">
                                                            <picture>
                                                                <img class="img-card"
                                                                    src="{{ asset('assets') }}/is/image/eni/hero-chimica-circolare-horizontal-16-9--wid-408-hei-379-fit-crop-1.jpg"
                                                                    alt="New materials obtained from laboratory processing of raw materials " />
                                                            </picture>
                                                            <p class="monospace-small">CIRCULAR CHEMISTRY</p>
                                                            <h3 class="eni-h4">Plastics from recycling and organic raw
                                                                material</h3>
                                                            <p class="body-regular">In Versalis, chemicals from
                                                                renewable sources provide a range of sustainable
                                                                products.</p>
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="slick-item ">
                                                    <div eni-component="cardimage" eni-version="1.0"
                                                        eni-template="small-dark" class="eni-card dark-blue border">
                                                        <a href="en-IT/actions/energy-transition-technologies/environmental-remediation.html"
                                                            target="_self"
                                                            aria-label="Development potential and giving new life to industrial terrain">
                                                            <picture>
                                                                <img class="img-card"
                                                                    src="{{ asset('assets') }}/is/image/eni/hero-bonifica-ambientale-horizontal-16-9--wid-408-hei-379-fit-crop-1.jpg"
                                                                    alt="Lands with water" />
                                                            </picture>
                                                            <p class="monospace-small">ENVIRONMENTAL REMEDIATION</p>
                                                            <h3 class="eni-h4">Development potential and giving new life
                                                                to industrial terrain</h3>
                                                            <p class="body-regular">Eni Rewind’s remediation activities
                                                                breathe new life into industrial areas and generate new
                                                                opportunity.</p>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="hp-iframe">
                <div eni-component="hp-iframe" eni-version="1.0" eni-template="" id="widget--368853049">
                    <style>
                        [eni-component="editorial-ColBody"][eni-version="2.0"] {
                            .wrapper {
                                padding: 64px 0 !important;

                                @media screen and (max-width: 1024px) {
                                    padding: 40px 16px !important;
                                }
                            }
                        }
                    </style>
                </div>
            </div>
        </div>
        <div class="container responsivegrid hero-template">
        </div>
        <div eni-component="interattivi-dettaglio-condividi" eni-version="1.0" eni-template=""
            dd-json="{  \&#34;event\&#34;: \&#34;\&#34;,\&#34;eventDetail\&#34;:{ \&#34;name\&#34;:\&#34;\&#34;, \&#34;type\&#34;:\&#34;\&#34; }, \&#34;component\&#34;:{ \&#34;type\&#34;:\&#34;share-modal\&#34;, \&#34;title\&#34;:\&#34;\&#34;, \&#34;link\&#34;:\&#34;\&#34;, \&#34;linkText\&#34;:\&#34;\&#34;, \&#34;position\&#34;:\&#34; \&#34; }, \&#34;search\&#34;:{ \&#34;terms\&#34;:\&#34;\&#34; } }">
            <div class="align">
                <div class="share-box" data-url="">
                    <button class="icon" id="shareLinkedIn" aria-label="Share Linkedin">
                        <img src="{{ asset('assets') }}/etc.clientlibs/enicom/clientlibs/clientlib-site/resources/assets/linkedin.svg"
                            alt="Share Linkedin" />
                    </button>
                    <button class="icon" id="shareFacebook" aria-label="Share Facebook">
                        <img src="{{ asset('assets') }}/etc.clientlibs/enicom/clientlibs/clientlib-site/resources/assets/facebook.svg"
                            alt="Share Facebook" />
                    </button>
                    <button class="icon" id="shareTwitter" aria-label="Share Twitter">
                        <img src="{{ asset('assets') }}/etc.clientlibs/enicom/clientlibs/clientlib-site/resources/assets/twitter.svg"
                            alt="Share Twitter" />
                    </button>
                    <button class="icon" id="shareMail" aria-label="Share link mail">
                        <img src="{{ asset('assets') }}/etc.clientlibs/enicom/clientlibs/clientlib-site/resources/assets/LetterMail.svg"
                            alt="Share link mail" />
                    </button>
                    <button class="icon" id="copyLink" aria-label="Copy link" data-text-tooltip="Link copied">
                        <img src="{{ asset('assets') }}/etc.clientlibs/enicom/clientlibs/clientlib-site/resources/assets/Copylink.svg"
                            alt="Copy link" />
                    </button>
                </div>
            </div>
        </div>
        <!-- FOOTER -->
        <div eni-component="footer" id="" class="overline" eni-template="" eni-version="1.0"
            dd-json="{  \&#34;event\&#34;: \&#34;\&#34;,\&#34;eventDetail\&#34;:{ \&#34;name\&#34;:\&#34;\&#34;, \&#34;type\&#34;:\&#34;\&#34; }, \&#34;component\&#34;:{ \&#34;type\&#34;:\&#34;footer\&#34;, \&#34;title\&#34;:\&#34;\&#34;, \&#34;link\&#34;:\&#34;\&#34;, \&#34;linkText\&#34;:\&#34;\&#34;, \&#34;position\&#34;:\&#34; \&#34; }, \&#34;search\&#34;:{ \&#34;terms\&#34;:\&#34;\&#34; } }">
            <div class="wrapper-component">
                <div class="footer-fascia1">
                    <picture>
                        <img src="{{ asset('assets') }}/content/dam/enicom/images/loghi/logoEniFooter.svg" class="eni-card-img"
                            alt="Icon eni.com" />
                    </picture>
                    <div class="container-icons">
                        <a href="https://www.linkedin.com/company/eni/" target="_blank" aria-label="Link "
                            title="Link ">
                            <img class="icon-social" src="{{ asset('assets') }}/content/dam/enicom/images/icone/LinkedIn_new_footer.svg"
                                alt="Icon " />
                        </a>
                        <a href="https://www.instagram.com/eni/" target="_blank" aria-label="Link " title="Link ">
                            <img class="icon-social" src="{{ asset('assets') }}/content/dam/enicom/images/icone/Instagram_new_footer.png"
                                alt="Icon " />
                        </a>
                        <a href="https://www.youtube.com/user/enivideochannel" target="_blank" aria-label="Link "
                            title="Link ">
                            <img class="icon-social" src="{{ asset('assets') }}/content/dam/enicom/images/icone/YouTube_new_footer.png"
                                alt="Icon " />
                        </a>
                        <a href="https://www.facebook.com/EniItalia" target="_blank" aria-label="Link " title="Link ">
                            <img class="icon-social" src="{{ asset('assets') }}/content/dam/enicom/images/icone/Facebook_new_footer.png"
                                alt="Icon " />
                        </a>
                        <a href="https://twitter.com/eni" target="_blank" aria-label="Link " title="Link ">
                            <img class="icon-social" src="{{ asset('assets') }}/content/dam/enicom/images/icone/X_new_footer.svg"
                                alt="Icon " />
                        </a>
                    </div>
                </div>
                <hr />
                <div class="footer-fascia2">
                    <div class="text-fascia2 col-lg-4 col-md-5 col-sm-12">
                        <p class="overline">Eni.com is a digitally designed platform that offers an immediate overview
                            of Eni&#39;s activities. It addresses everyone, recounting in a transparent and accessible
                            way the values, commitment and perspectives of a global technology company for the energy
                            transition.</p>
                        <a class="text-link-small" target="_self" href="en-IT/strategic-vision/mission.html">Discover
                            our mission</a>
                    </div>
                    <div class="text-grid-fascia2">
                        <p class="text-gold">POLICIES</p>
                        <div class="link-row">
                            <a class="eni-textlink-large " href="en-IT/terms-and-conditions.html" target="_self">Terms
                                and Conditions</a>
                            <a class="eni-textlink-large " href="en-IT/privacy.html" target="_self">Privacy Policy</a>
                            <a class="eni-textlink-large " href="en-IT/cookies.html" target="_self">Cookie Policy</a>
                            <a class="eni-textlink-large " href="en-IT/reserved-area.html" target="_self">Info Reserved
                                Area</a>
                        </div>
                    </div>
                </div>
                <hr />
                <div class="footer-fascia2">
                    <div class="text-fascia3 col-lg-4 col-md-5 col-sm-12">
                        <div class="link-column">
                            <div>
                                <div class="text-gold">Registered Head Office</div>
                                <div>Piazzale Enrico Mattei,1 00144 Rome, Italy</div>
                            </div>
                            <div>
                                <div class="text-gold">Company Share Capital</div>
                                <div>€ 4,005,358,876.00 paid up</div>
                            </div>
                            <div>
                                <div class="text-gold">Tax Identification Number</div>
                                <div>VAT Number 00905811006</div>
                            </div>
                        </div>
                        <div class="link-column">
                            <div>
                                <div class="text-gold">Branches</div>
                                <div>Via Emilia, 1 and Piazza Ezio Vanoni, 1 20097 San Donato Milanese, Milan, Italy
                                </div>
                            </div>
                            <div>
                                <div class="text-gold">Rome Company Register</div>
                                <div>00484960588</div>
                            </div>
                        </div>
                    </div>
                    <div class="text-grid-fascia2">
                        <p class="text-gold">OTHER LINKS</p>
                        <div class="link-row">
                            <a class="eni-textlink-large " href="en-IT/calendar.html" target="_self">Calendar</a>
                            <a class="eni-textlink-large " href="en-IT/contacts.html" target="_self">Contacts</a>
                            <a class="eni-textlink-large " href="en-IT/newsletter.html" target="_self">Newsletter</a>
                            <a class="eni-textlink-large box-icon-before" href="enispace-sub/index.html"
                                target="_blank">eniSpace</a>
                            <a class="eni-textlink-large " href="en-IT/scams-phishing.html" target="_self">Scams and
                                Phishing</a>
                            <a class="eni-textlink-large box-icon-before" href="eniremit-sub/umm-power.html"
                                target="_blank">Remit</a>
                            <a class="eni-textlink-large box-icon-before"
                                href="{{ asset('assets') }}/content/dam/enicom/documents/eng/sustainability/2023/Slavery-and-Human-Trafficking-Statement-2023.pdf"
                                target="_blank">Modern Slavery Statement</a>
                            <a class="eni-textlink-large " href="en-IT/accessibility.html"
                                target="_self">Accessibility</a>
                            <a class="eni-textlink-large " href="en-IT/faq.html" target="_self">FAQ</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('assets') }}/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('assets') }}/ui/1.13.0/jquery-ui.min.js"></script>
    <script src="{{ asset('assets') }}/npm/bootstrap-5.0.1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('assets') }}/ajax/libs/slick-carousel/1.8.1/slick.min.js" referrerpolicy="no-referrer"></script>
    <script src="{{ asset('assets') }}/ajax/libs/bootstrap-datepicker/1.10.0/js/bootstrap-datepicker.min.js"
        referrerpolicy="no-referrer"></script>

    <script src="{{ asset('assets') }}/mapbox-gl-js/v3.1.2/mapbox-gl.js"></script>
    <script
        src="{{ asset('assets') }}/etc.clientlibs/enicom/clientlibs/clientlib-dependencies.lc-d41d8cd98f00b204e9800998ecf8427e-lc.min.js"></script>
    <script
        src="{{ asset('assets') }}/etc.clientlibs/enicom/clientlibs/clientlib-site.lc-17c584594ea81f64d3f2bfb759ba4138-lc.min.js"></script>
    <script
        src="{{ asset('assets') }}/etc.clientlibs/core/wcm/components/commons/site/clientlibs/container.lc-0a6aff292f5cc42142779cde92054524-lc.min.js"></script>
    <script
        src="{{ asset('assets') }}/etc.clientlibs/core/wcm/components/tabs/v1/tabs/clientlibs/site.lc-d4879c10895df177b4a4e333c1d53e2c-lc.min.js"></script>
    <div eni-component="interattivi-floating-back-to-top" eni-version="1.0" eni-template="light" id="">
        <div class="back-to-top" tabindex="0" role="button" aria-pressed="false" aria-label="Back to top">
            <img src="{{ asset('assets') }}/etc.clientlibs/enicom/clientlibs/clientlib-site/resources/assets/ArrowUp_white.svg"
                alt="Back to top" />
        </div>
    </div>
    <div eni-component="interattivi-floating-back-to-top" eni-version="1.0" eni-template="dark" id="">
        <div class="back-to-top" tabindex="0" role="button" aria-pressed="false" aria-label="Back to top">
            <img src="{{ asset('assets') }}/etc.clientlibs/enicom/clientlibs/clientlib-site/resources/assets/ArrowUp_blue.svg"
                alt="Back to top" />
        </div>
    </div>
    <div eni-component="modulari-carousel-documenti" eni-version="1.0" eni-template="box">
        <div class="align">
            <div class="option-box-documenti" data-url="">
                <a href="#" class="text-link-regular download" download>
                    <img src="{{ asset('assets') }}/etc.clientlibs/enicom/clientlibs/clientlib-site/resources/assets/downloadBlack.svg"
                        alt="Download document" />
                    Download document
                </a>
            </div>
        </div>
    </div>
    <div eni-component="modalcomponent" eni-version="1.0" eni-template="modal-disclaimer" class="body-regular" id=""
        dd-json="{  \&#34;event\&#34;: \&#34;\&#34;,\&#34;eventDetail\&#34;:{ \&#34;name\&#34;:\&#34;\&#34;, \&#34;type\&#34;:\&#34;\&#34; }, \&#34;component\&#34;:{ \&#34;type\&#34;:\&#34;modal-disclaimer\&#34;, \&#34;title\&#34;:\&#34;\&#34;, \&#34;link\&#34;:\&#34;\&#34;, \&#34;linkText\&#34;:\&#34;\&#34;, \&#34;position\&#34;:\&#34; \&#34; }, \&#34;search\&#34;:{ \&#34;terms\&#34;:\&#34;\&#34; } }">
        <div class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" id="modal-disclaimer" tabindex="-1"
            aria-labelledby="ModalLabelDisclaimer" aria-hidden="true" style="display: none;" data-nosnippet>
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title eni-h5" id="disclaimerTitle">
                            Modal Disclaimer
                        </h3>
                        <div id="disclaimerCloseSectionForPDF">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div id="disclaimerCloseSectionForCS">
                            <a id="disclaimerCloseRedirect" href=""><button type="button" class="btn-close"
                                    aria-label="Close"></button></a>
                        </div>
                    </div>
                    <div class="modal-body">
                        <div id="disclaimerBoxedSection" eni-component="eni-editoriali-disclaimer" eni-version="1.0"
                            eni-template="">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="eni-disclaimer-icon"
                                aria-label="" viewBox="0 0 16 16">
                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"></path>
                                <path
                                    d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z">
                                </path>
                            </svg>
                            <div>
                                <p id="disclaimerBoxedTitle" class="text-link-regular">Titolo messaggio</p>
                                <p id="disclaimerBoxedDesc" class="body-small">
                                    &nbsp;
                                </p>
                            </div>
                        </div>
                        <div id="disclaimerBody">
                            <p>
                                &nbsp;
                            </p>
                        </div>
                        <div id="checkbox-section">
                            <div class="eni-input-text-large">
                                <label id="checkboxLabel" class="body-small">The thing they’re turning on when they
                                    check this box</label>
                                <input type="checkbox" class="" id="checkboxPdf"
                                    onchange="document.getElementById('check-disabled-pdf').disabled = !this.checked;" />
                                <input type="checkbox" class="" id="checkboxCS"
                                    onchange="document.getElementById('check-disabled-cs').disabled = !this.checked;" />
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div id="modalDisclaimerFooterWithButtons">
                            <div id="buttonsForCS">
                                <a id="notAcceptCSWithButtons" href=""><button id="modalDisclaimerButtonNCB"
                                        type="button" class="eni-btn-tertiary button-regular">ANNULLA</button></a>
                                <button id="modalDisclaimerButtonYCB" data-bs-dismiss="modal" type="button"
                                    class="eni-btn-primary button-regular">
                                    Azione principale
                                </button>
                            </div>
                            <div id="buttonsForPDF">
                                <button data-bs-dismiss="modal" id="modalDisclaimerButtonNPB" type="button"
                                    class="eni-btn-tertiary button-regular">ANNULLA</button>
                                <a id="acceptPDFWithButtons" href=""><button id="modalDisclaimerButtonYPB" type="button"
                                        class="eni-btn-primary button-regular">Azione Principale</button></a>
                            </div>
                        </div>
                        <div id="modalDisclaimerFooterWithCheckbox">
                            <div id="buttonForCS">
                                <button data-bs-dismiss="modal" type="button" class="eni-btn-primary button-regular"
                                    id="check-disabled-cs" disabled>
                                    Azione principale
                                </button>
                            </div>
                            <div id="buttonForPDF">
                                <a id="acceptPDFWithCheckbox" href="">
                                    <button type="button" class="eni-btn-primary button-regular" id="check-disabled-pdf"
                                        disabled>
                                        Azione principale
                                    </button>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
