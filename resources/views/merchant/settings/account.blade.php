@extends('layouts.app')

@section('content')
    <div class="nk-block-head">
        <div class="nk-block-head-content">
            <h4 class="title nk-block-title">Account Settings</h4>
            <div class="nk-block-des">
                <p>Edit & Change <strong>Account</strong> settings</p>
            </div>
        </div>
    </div>
    <div class="card card-preview">
        <div class="card-inner">

            <form action="{{ route('supermarket.update.password') }}" method="post">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <div class="form-label-group">
                        <label class="form-label" for="current">Current Password</label>
                    </div>
                    <div class="form-control-wrap">
                        <input type="password" class="form-control form-control-lg  @error('current') is-invalid @enderror"
                        id="current" name="current" autofocus>
                        
                        @error('current')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <div class="form-label-group">
                        <label class="form-label" for="password">New Password</label>
                    </div>
                    <div class="form-control-wrap">
                        <input type="password" class="form-control form-control-lg  @error('password') is-invalid @enderror"
                        id="password" name="password" autofocus>
                        
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <div class="form-label-group">
                        <label class="form-label" for="repeat">Repeat Password</label>
                    </div>
                    <div class="form-control-wrap">
                        <input type="password" class="form-control form-control-lg  @error('repeat') is-invalid @enderror"
                        id="repeat" name="repeat" autofocus>
                        
                        @error('repeat')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <button type="submit" class="btn btn-lg btn-primary">Update Password</button>
            </form>
        </div>
    </div><!-- .card-preview -->
@endsection