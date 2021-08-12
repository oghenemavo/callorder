@extends('layouts.auth')

@section('content')

    <x-auth-split>
        @section('block-title', 'Sign-In')
        @section('block-desc', 'Access the DashLite panel using your email and passcode.')

        @section('auth')
            <form action="{{ route('supermarket.authenticate') }}" method="post" class="form-validate is-alter" autocomplete="off">
                @csrf
                <div class="form-group">
                    <div class="form-label-group">
                        <label class="form-label" for="email-address">Email</label>
                    </div>
                    <div class="form-control-wrap">
                        <input type="email" class="form-control form-control-lg @error('email') is-invalid @enderror" id="email-address" value="{{ old('email') }}" name="email" autocomplete="off" required placeholder="Enter your email address">
                        
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
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
                        <input autocomplete="new-password" type="password" class="form-control form-control-lg" name="password" required id="password" placeholder="Enter your passcode">
                    </div>
                </div><!-- .form-group -->
                <div class="form-group">
                    <button class="btn btn-lg btn-primary btn-block">Sign in</button>
                </div>
            </form><!-- form -->
        @endsection
    </x-auth-split>
            
@endsection