@extends('layouts.auth')

@section('content')

    <x-auth-middle>
        @section('block-title', 'Sign-In')
        @section('block-desc', 'Access the DashLite panel using your email and passcode.')

        @section('auth')
            <form action="#" class="form-validate is-alter" autocomplete="off">
                <div class="form-group">
                    <div class="form-label-group">
                        <label class="form-label" for="email-address">Email or Username</label>
                        <a class="link link-primary link-sm" tabindex="-1" href="#">Need Help?</a>
                    </div>
                    <div class="form-control-wrap">
                        <input autocomplete="off" type="text" class="form-control form-control-lg" required id="email-address" placeholder="Enter your email address or username">
                    </div>
                </div><!-- .form-group -->
                <div class="form-group">
                    <div class="form-label-group">
                        <label class="form-label" for="password">Passcode</label>
                        <a class="link link-primary link-sm" tabindex="-1" href="html/pages/auths/auth-reset.html">Forgot Code?</a>
                    </div>
                    <div class="form-control-wrap">
                        <a tabindex="-1" href="#" class="form-icon form-icon-right passcode-switch lg" data-target="password">
                            <em class="passcode-icon icon-show icon ni ni-eye"></em>
                            <em class="passcode-icon icon-hide icon ni ni-eye-off"></em>
                        </a>
                        <input autocomplete="new-password" type="password" class="form-control form-control-lg" required id="password" placeholder="Enter your passcode">
                    </div>
                </div><!-- .form-group -->
                <div class="form-group">
                    <button class="btn btn-lg btn-primary btn-block">Sign in</button>
                </div>
            </form><!-- form -->
            <div class="form-note-s2 pt-4"> New on our platform? <a href="html/pages/auths/auth-register.html">Create an account</a>
            </div>
        @endsection
    </x-auth-split>
            
@endsection