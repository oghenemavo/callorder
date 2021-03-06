<div class="nk-split nk-split-page nk-split-md">
    <div class="nk-split-content nk-block-area nk-block-area-column nk-auth-container bg-white">
        <div class="absolute-top-right d-lg-none p-3 p-sm-5">
            <a href="#" class="toggle btn-white btn btn-icon btn-light" data-target="athPromo"><em class="icon ni ni-info"></em></a>
        </div>
        <div class="nk-block nk-block-middle nk-auth-body">
            <div class="brand-logo pb-5">

                @include('shared.logo')

            </div>
            
            <div class="nk-block-head">
                <div class="nk-block-head-content">
                    <h5 class="nk-block-title">@yield('block-title')</h5>
                    <div class="nk-block-des">
                        <p>@yield('block-desc')</p>
                    </div>
                </div>
            </div><!-- .nk-block-head -->

            <!-- authentication -->
            @yield('auth')
            <!-- authentication -->

        </div><!-- .nk-block -->
        <div class="nk-block nk-auth-footer">
            <div class="nk-block-between">
                <ul class="nav nav-sm">
                    <li class="nav-item">
                        <a class="nav-link" href="#">Terms & Condition</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Privacy Policy</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Help</a>
                    </li>
                    <li class="nav-item dropup">
                        <a class="dropdown-toggle dropdown-indicator has-indicator nav-link" data-toggle="dropdown" data-offset="0,10"><small>English</small></a>
                        <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                            <ul class="language-list">
                                <li>
                                    <a href="#" class="language-item">
                                        <img src="./images/flags/english.png" alt="" class="language-flag">
                                        <span class="language-name">English</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="language-item">
                                        <img src="./images/flags/spanish.png" alt="" class="language-flag">
                                        <span class="language-name">Espa??ol</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="language-item">
                                        <img src="./images/flags/french.png" alt="" class="language-flag">
                                        <span class="language-name">Fran??ais</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="language-item">
                                        <img src="./images/flags/turkey.png" alt="" class="language-flag">
                                        <span class="language-name">T??rk??e</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                </ul><!-- .nav -->
            </div>
            <div class="mt-3">
                <p>&copy; 2019 DashLite. All Rights Reserved.</p>
            </div>
        </div><!-- .nk-block -->
    </div>

    <!-- .nk-split-content -->
    <div class="nk-split-content nk-split-stretch bg-lighter d-flex toggle-break-lg toggle-slide toggle-slide-right" data-content="athPromo" data-toggle-screen="lg" data-toggle-overlay="true">
        <div class="slider-wrap w-100 w-max-550px p-3 p-sm-5 m-auto">
            <div class="slider-init" data-slick='{"dots":true, "arrows":false}'>
                <div class="slider-item">
                    <div class="nk-feature nk-feature-center">
                        <div class="nk-feature-img">
                            <img class="round" src="./images/slides/promo-a.png" srcset="./images/slides/promo-a2x.png 2x" alt="">
                        </div>
                        <div class="nk-feature-content py-4 p-sm-5">
                            <h4>Dashlite</h4>
                            <p>You can start to create your products easily with its user-friendly design & most completed responsive layout.</p>
                        </div>
                    </div>
                </div><!-- .slider-item -->
                <div class="slider-item">
                    <div class="nk-feature nk-feature-center">
                        <div class="nk-feature-img">
                            <img class="round" src="./images/slides/promo-b.png" srcset="./images/slides/promo-b2x.png 2x" alt="">
                        </div>
                        <div class="nk-feature-content py-4 p-sm-5">
                            <h4>Dashlite</h4>
                            <p>You can start to create your products easily with its user-friendly design & most completed responsive layout.</p>
                        </div>
                    </div>
                </div><!-- .slider-item -->
                <div class="slider-item">
                    <div class="nk-feature nk-feature-center">
                        <div class="nk-feature-img">
                            <img class="round" src="./images/slides/promo-c.png" srcset="./images/slides/promo-c2x.png 2x" alt="">
                        </div>
                        <div class="nk-feature-content py-4 p-sm-5">
                            <h4>Dashlite</h4>
                            <p>You can start to create your products easily with its user-friendly design & most completed responsive layout.</p>
                        </div>
                    </div>
                </div><!-- .slider-item -->
            </div><!-- .slider-init -->
            <div class="slider-dots"></div>
            <div class="slider-arrows"></div>
        </div><!-- .slider-wrap -->
    </div><!-- .nk-split-content -->
    
</div><!-- .nk-split -->