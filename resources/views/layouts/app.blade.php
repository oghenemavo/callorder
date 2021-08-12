<!DOCTYPE html>
<html lang="zxx" class="js">
    <head>
        <base href="../">
        <meta charset="utf-8">
        <meta name="author" content="Softnio">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="A powerful and conceptual apps base dashboard template that especially build for developers and programmers.">
        <!-- Fav Icon  -->
        <link rel="shortcut icon" href="{{ asset('images/grocery-icon2x.png') }}">
        <!-- Page Title  -->
        <title>{{ $page_title ?? 'Call Order' }}</title>
        <!-- StyleSheets  -->
        <link rel="stylesheet" href="{{ asset('assets/css/dashlite.css?ver=2.6.0') }}">
        <link id="skin-default" rel="stylesheet" href="{{ asset('assets/css/theme.css?ver=2.6.0') }}">

        @stack('styles')
    </head>

    <body class="nk-body bg-lighter npc-general has-sidebar ">
        <div class="nk-app-root">
            <!-- main @s -->
            <div class="nk-main ">
                <!-- sidebar @s -->
                <div class="nk-sidebar nk-sidebar-fixed is-light " data-content="sidebarMenu">
                    <div class="nk-sidebar-element nk-sidebar-head">
                        <div class="nk-sidebar-brand">
                            <a href="html/index.html" class="logo-link nk-sidebar-logo">
                                <img class="logo-light logo-img" src="{{ asset('images/grocery-light.png') }}" srcset="{{ asset('images/grocery-light2x.png') }} 2x" alt="logo">
                                <img class="logo-dark logo-img" src="{{ asset('images/grocery-dark.png') }}" srcset="{{ asset('images/grocery-dark2x.png') }} 2x" alt="logo-dark">
                                <img class="logo-small logo-img logo-img-small" src="{{ asset('images/grocery-icon2x.png') }}" srcset="{{ asset('images/grocery-icon2x.png') }} 2x" alt="logo-small">
                            </a>
                        </div>
                        <div class="nk-menu-trigger mr-n2">
                            <a href="#" class="nk-nav-toggle nk-quick-nav-icon d-xl-none" data-target="sidebarMenu"><em class="icon ni ni-arrow-left"></em></a>
                            <a href="#" class="nk-nav-compact nk-quick-nav-icon d-none d-xl-inline-flex" data-target="sidebarMenu"><em class="icon ni ni-menu"></em></a>
                        </div>
                    </div><!-- .nk-sidebar-element -->
                    <div class="nk-sidebar-element">
                        <div class="nk-sidebar-content">
                            <div class="nk-sidebar-menu" data-simplebar>

                                <!-- app sidebar -->
                                <x-app-sidebar/>
                                <!-- app sidebar -->

                            </div><!-- .nk-sidebar-menu -->
                        </div><!-- .nk-sidebar-content -->
                    </div><!-- .nk-sidebar-element -->
                </div>
                <!-- sidebar @e -->
                <!-- wrap @s -->
                <div class="nk-wrap ">
                    <!-- main header @s -->
                    <div class="nk-header nk-header-fixed is-light">
                        <div class="container-fluid">
                            <div class="nk-header-wrap">
                                <div class="nk-menu-trigger d-xl-none ml-n1">
                                    <a href="#" class="nk-nav-toggle nk-quick-nav-icon" data-target="sidebarMenu"><em class="icon ni ni-menu"></em></a>
                                </div>
                                <div class="nk-header-brand d-xl-none">
                                    <a href="html/index.html" class="logo-link">
                                        <img class="logo-light logo-img" src="{{ asset('images/grocery-light.png') }}" srcset="{{ asset('images/grocery-light2x.png') }} 2x" alt="logo">
                                        <img class="logo-dark logo-img" src="{{ asset('images/grocery-dark.png') }}" srcset="{{ asset('images/grocery-dark2x.png') }} 2x" alt="logo-dark">
                                    </a>
                                </div><!-- .nk-header-brand -->
                                <div class="nk-header-search ml-3 ml-xl-0">
                                    <em class="icon ni ni-search"></em>
                                    <input type="text" class="form-control border-transparent form-focus-none" placeholder="Search anything">
                                </div><!-- .nk-header-news -->

                                <!-- app header -->
                                <x-app-header/>
                                <!-- app header -->

                            </div><!-- .nk-header-wrap -->
                        </div><!-- .container-fliud -->
                    </div>
                    <!-- main header @e -->
                    <!-- content @s -->
                    <div class="nk-content ">
                        <div class="container-fluid">
                            <div class="nk-content-inner">
                                <div class="nk-content-body">

                                    @foreach(['primary', 'secondary', 'success', 'info', 'warning', 'danger', 'gray', 'light'] as $alert)
                                        @if(session()->has($alert))
                                            <x-alert type="{{ $alert }}" :message="session()->get($alert)"/>
                                        @endif
                                    @endforeach

                                    <!-- section content -->
                                    @yield('content')
                                    <!-- section content -->

                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- content @e -->
                    <!-- footer @s -->
                    <div class="nk-footer">
                        <div class="container-fluid">
                            <div class="nk-footer-wrap">
                                <div class="nk-footer-copyright"> &copy; 2020 DashLite. Template by <a href="https://softnio.com" target="_blank">Softnio</a>
                                </div>
                                <div class="nk-footer-links">
                                    <ul class="nav nav-sm">
                                        <li class="nav-item"><a class="nav-link" href="#">Terms</a></li>
                                        <li class="nav-item"><a class="nav-link" href="#">Privacy</a></li>
                                        <li class="nav-item"><a class="nav-link" href="#">Help</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- footer @e -->
                </div>
                <!-- wrap @e -->
            </div>
            <!-- main @e -->
        </div>
        <!-- app-root @e -->
        <!-- JavaScript -->
        <script src="{{ asset('assets/js/bundle.js?ver=2.6.0') }}"></script>
        <script src="{{ asset('assets/js/scripts.js?ver=2.6.0') }}"></script>
        <script src="{{ asset('assets/js/charts/chart-ecommerce.js?ver=2.6.0') }}"></script>

        @stack('scripts')
    </body>
</html>