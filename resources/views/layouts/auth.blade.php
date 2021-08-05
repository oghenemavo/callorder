<!DOCTYPE html>
<html lang="zxx" class="js">
    <head>
        <base href="../../../">
        <meta charset="utf-8">
        <meta name="author" content="Softnio">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="A powerful and conceptual apps base dashboard template that especially build for developers and programmers.">
        <!-- Fav Icon  -->
        <link rel="shortcut icon" href="{{ asset('images/grocery-icon2x.png') }}">
        <!-- Page Title  -->
        <title>{{ $page_title ?? 'Login area' }}</title>
        <!-- StyleSheets  -->
        <link rel="stylesheet" href="{{ asset('assets/css/dashlite.css?ver=2.6.0') }}">
        <link id="skin-default" rel="stylesheet" href="{{ asset('assets/css/theme.css?ver=2.6.0') }}">
    </head>

    <body class="nk-body bg-white npc-default pg-auth">
        <div class="nk-app-root">
            <!-- main @s -->
            <div class="nk-main ">
                <!-- wrap @s -->
                <div class="nk-wrap nk-wrap-nosidebar">
                    <!-- content @s -->
                    <div class="nk-content ">

                        <!-- auth content -->
                        @yield('content')
                        <!-- auth content -->

                    </div>
                    <!-- wrap @e -->
                </div>
                <!-- content @e -->
            </div>
            <!-- main @e -->
        </div>
        <!-- app-root @e -->
        <!-- JavaScript -->
        <script src="{{ asset('assets/js/bundle.js?ver=2.6.0') }}"></script>
        <script src="{{ asset('assets/js/scripts.js?ver=2.6.0') }}"></script>
    </body>
</html>