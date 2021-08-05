<div class="nk-block nk-block-middle nk-auth-body  wide-xs">
    <div class="brand-logo pb-4 text-center">
        @include('shared.logo')
    </div>
    <div class="card">
        <div class="card-inner card-inner-lg">
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
            
        </div>
    </div>
</div>
<div class="nk-footer nk-auth-footer-full">
    <div class="container wide-lg">
        <div class="row g-3">
            <div class="col-lg-6 order-lg-last">
                <ul class="nav nav-sm justify-content-center justify-content-lg-end">
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
                        <a class="dropdown-toggle dropdown-indicator has-indicator nav-link" data-toggle="dropdown" data-offset="0,10"><span>English</span></a>
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
                                        <span class="language-name">Español</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="language-item">
                                        <img src="./images/flags/french.png" alt="" class="language-flag">
                                        <span class="language-name">Français</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="language-item">
                                        <img src="./images/flags/turkey.png" alt="" class="language-flag">
                                        <span class="language-name">Türkçe</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="col-lg-6">
                <div class="nk-block-content text-center text-lg-left">
                    <p class="text-soft">&copy; 2019 CryptoLite. All Rights Reserved.</p>
                </div>
            </div>
        </div>
    </div>
</div>