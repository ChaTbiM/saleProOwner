@extends('layouts.app')

@section('content')
<div class="container " style="height: 100%" >
    <div class="row justify-content-center align-items-center " style="height: 100%">
        <div class="col-md-5">
            <div class="card ">
                <h3 class="card-header text-center shadow pt-3 pb-3">Akeed groups</h3>

                <div class="card-body mt-4">
                    <form method="POST" action="{{ route('login') }}" aria-label="{{ __('Login') }}">
                        @csrf

                        <div class="form-group row">
                            {{-- <label for="email" class="col-sm-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label> --}}

                            <div class="col-md-9 mx-auto">
                                <input id="email" type="email" placeholder="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            {{-- <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label> --}}

                            <div class="col-md-9 mx-auto">
                                <input id="password" placeholder="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                                <div class="form-check mt-3">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>


                        <div class="form-group row mb-0">
                            <div class="col-md-12 ">
                                <button type="submit" class="btn text-white btn-login col-md-8 offset-md-2">
                                    {{ __('Login') }}
                                </button>
                                
                            </div>
                        </div>

                        <div class="form-group row mb-0 mt-2">
                            <div class="col-md-7 mx-auto ">
                                <a class="btn btn-link " href="{{ route('password.request') }}">
                                    {{ __('Forgot Your Password?') }}
                                </a>
                            </div>
                        </div>
                        
                        
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
<style>
.shadow{
    box-shadow: 5px 5px;
    background-color: white;
}
.btn-login{
    background: rgb(255,131,61);
background: linear-gradient(90deg, rgba(255,131,61,1) 0%, rgba(249,75,126,1) 100%);
}
</style>