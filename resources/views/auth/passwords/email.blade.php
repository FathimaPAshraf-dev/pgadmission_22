@extends('layouts.login.login')

@section('content')
<div class="login-box">
        <div class="login-logo">
            <a href="#"><b>SSUS</b> Portal</a>
        </div>
        <div class="card">
            <div class="card-body login-card-body">
               <p class="login-box-msg">{{ __('Reset Password') }}</p>
               
                 @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                <form action="{{ route('password.email') }}" method="post">
                    @csrf
                    <div class="input-group mb-3">
                        <input id="stud_registerno" type="text" name="postpgapp_email" class="form-control {{ $errors->has('postpgapp_email') ? 'is-invalid' : '' }}" value="{{ old('postpgapp_email') }}"  placeholder="emailid">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fa fa-envelope"></span>
                            </div>
                        </div>
                       
                                @error('postpgapp_email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                    </div>
                 
                  
               
                @if (Route::has('password.request'))
                   <div class="form-group row mb-0">
                            <div class="col-md-12 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Send Password Reset Link') }}
                                </button>
                            </div>
                        </div>
                @endif
                 </form>
            
            </div>
            
        </div>
    </div>
@endsection



