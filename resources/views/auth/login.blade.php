@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    {{-- <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form> --}}
                    
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <!-- Email input -->
                        
                        <div class="form-outline mb-4">
                          {{-- <input type="email" id="form2Example1" class="form-control" /> --}}
                          <label class="form-label" for="form2Example1">{{ __('Email Address') }}</label>
                          <input id="form2Example1" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>
                      
                        <!-- Password input -->
                        <div class="form-outline mb-4">
                          {{-- <input type="password" id="form2Example2" class="form-control" /> --}}
                          <label class="form-label" for="form2Example2">{{ __('Password') }}</label>
                          <input id="form2Example2" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label class="form-check-label" for="form2Example31">{{ __('Remember Me') }}</label>
                        </div>
                      
                        <!-- 2 column grid layout for inline styling -->
                        <div class="row mb-4">
                          {{-- <div class="col d-flex justify-content-center"> --}}
                            <!-- Checkbox -->
                            {{-- <div class="form-check">
                              <input class="form-check-input" type="checkbox" value="" id="form2Example31" checked />
                              <label class="form-check-label" for="form2Example31"> Remember me </label>
                              <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                              <label class="form-check-label" for="form2Example31">{{ __('Remember Me') }}</label>
                            </div> </div> --}}
                      
                          <div class="col">
                            <!-- Simple link -->
                            {{-- <a href="#!">Forgot password?</a> --}}
                            <button type="submit" class="btn btn-primary">
                                {{ __('Login') }}
                            </button>
                    
                            @if (Route::has('password.request'))
                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    {{ __('Forgot Your Password?') }}
                                </a>
                            @endif
                          </div>
                        </div>
                      
                        <!-- Submit button -->
                        {{-- <button type="button" class="btn btn-primary btn-block mb-4">Sign in</button> --}}
                      
                        <!-- Register buttons -->
                        {{-- <div class="text-center">
                          <p>Not a member? <a href="#!">Register</a></p>
                          <p>or sign up with:</p>
                          <button type="button" class="btn btn-link btn-floating mx-1">
                            <i class="fab fa-facebook-f"></i>
                          </button>
                      
                          <button type="button" class="btn btn-link btn-floating mx-1">
                            <i class="fab fa-google"></i>
                          </button>
                      
                          <button type="button" class="btn btn-link btn-floating mx-1">
                            <i class="fab fa-twitter"></i>
                          </button>
                      
                          <button type="button" class="btn btn-link btn-floating mx-1">
                            <i class="fab fa-github"></i>
                          </button>
                        </div> --}}
                      </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

