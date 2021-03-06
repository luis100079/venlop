@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-end">


       <div class='col-md-7'>
         <p style='color:white; font-size:50px; background:black; opacity:0.8;'> 
           Meet <i class='fas fa-user-friends' style='color:springgreen;'></i> people from all over the world  
              <i class='fas fa-star' style='font-size:24px; color:yellow;'></i>
              <i class='fas fa-star' style='font-size:24px; color:yellow;'></i>
              <i class='fas fa-star' style='font-size:24px; color:yellow;'></i>
              <i class='fas fa-star' style='font-size:24px; color:yellow;'></i>
              <i class='fas fa-star' style='font-size:24px; color:yellow;'></i>
           
<!--
         <img width='49%' height='auto' src="https://images.pexels.com/photos/697243/pexels-photo-697243.jpeg?cs=srgb&dl=pexels-helena-lopes-697243.jpg&fm=jpg" class="rounded" alt="Cinque Terre">
         <img width='49%' height='auto' src="https://images.pexels.com/photos/346885/pexels-photo-346885.jpeg?cs=srgb&dl=pexels-porapak-apichodilok-346885.jpg&fm=jpg" class="rounded" alt="Cinque Terre">
-->         
         </p>

        <p style='color:white; font-size:50px; background:black; opacity:0.8;'>
            
        </p>

       </div>

        <div class="col-md-5">

            <div class="card text-success" style="background:black; opacity:0.8;">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body" >

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-success">
                                    {{ __('Login') }}
                                </button>

<!--                                @if (Route::has('password.request'))
                                    <a class="btn btn-link text-success" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
-->                                @endif

                              @if (Route::has('password.request'))
                                    <a class="btn btn-link text-success" href="http://venlop.com/register">
                                        {{ __('Register as new user') }}
                                    </a>
                               @endif

                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
