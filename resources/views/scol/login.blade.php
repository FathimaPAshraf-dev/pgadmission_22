
   
            <div class="card card-info card-outline card-body login-card-body">
                <p class="login-box-msg"><b>Sign in to start your session</b></p>
                <form action="{{ route('login') }}" method="post">
                    @csrf
                    <div class="input-group mb-3">
                        <input id="postpgapp_appid" type="text" name="pgapp_id" class="form-control {{ $errors->has('pgapp_id') ? 'is-invalid' : '' }}" value="{{ old('pgapp_id') }}"  placeholder="Application Number">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fa fa-user"></span>
                            </div>
                        </div>
                        @if ($errors->has('pgapp_id'))
                            <div class="invalid-feedback">
                                {{ $errors->first('pgapp_id') }}
                            </div>
                        @endif
                    </div>
                    <div class="input-group mb-3">
                        <input id="password" type="password" name="password" class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" placeholder="Password">
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
                                <!--<input type="checkbox" name="remember" id="remember">-->
                                <!--<label for="remember"> {{ __('Remember Me') }}</label>-->
                            </div>
                        </div>
                        <div class="col-4">
                            <button type="submit" class="btn btn-info btn-block btn-flat"  >
                                   {{ __('Login') }}
                            </button>
                        </div>
                    </div>
                </form>
                @if (Route::has('password.request'))
<!--                    <p class="mt-2 mb-1">
                        <a href="{{ route('password.request') }}">
                           {{ __('Forgot Your Password?') }}
                        </a>
                    </p>-->
                    
                @endif
                
              @if (Route::has('scol.register'))   
                <p class="mb-0">
                <a href="scolregister" class="text-center">New Candidate ? Register Now</a>
              </p>
              
              @endif
              <br>
              <marquee><font style="color: red">Check your registered email id for application number and password</marquee>
            </div>
            
      
     


