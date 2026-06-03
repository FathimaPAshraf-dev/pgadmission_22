@extends('layouts.admin.loginmaster')

@section('content')
<div class="login-box">
        <div class="login-logo">
            <a href="#"><b>SSUS</b> Admin</a>
        </div>
        <div class="card">
            <div class="card-body login-card-body">
               <p class="login-box-msg">Sign in to start your session</p>
                <form action="{{ route('admin.login') }}" method="post">
                    @csrf
                    <div class="input-group mb-3">
                        <input type="email" name="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" value="{{ old('email') }}"  placeholder="Register Number">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fa fa-envelope"></span>
                            </div>
                        </div>
                        @if ($errors->has('email'))
                            <div class="invalid-feedback">
                                {{ $errors->first('email') }}
                            </div>
                        @endif
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" name="password" class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" placeholder="password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fa fa-lock"></span>
                            </div>
                        </div>
                        @if ($errors->has('password'))
                            <div class="invalid-feedback">
                                {{ $errors->first('password') }}
                            </div>
                        @endif
                    </div>
                    <div class="row">
                        <div class="col-8">
                            <div class="icheck-primary">
                                <input type="checkbox" name="remember" id="remember">
                                <label for="remember"> {{ __('Remember Me') }}</label>
                            </div>
                        </div>
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block btn-flat">
                                   {{ __('Login') }}
                            </button>
                        </div>
                    </div>
                </form>
                @if (Route::has('password.request'))
                    <p class="mt-2 mb-1">
                        <a href="{{ route('admin.password.request') }}">
                           {{ __('Forgot Your Password?') }}
                        </a>
                    </p>
                @endif
                
            
            </div>
        </div>
    </div>
@endsection


