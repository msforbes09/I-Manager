@extends('master.layout')

@section('main')
    <div class="modal is-active">
        <div class="modal-background"></div>
        
        <div class="modal-card">
            <header class="modal-card-head">
                <p class="subtitle">Sign In</p>
            </header><!-- modal-card-head -->
            
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <section class="modal-card-body">
                    <div class="field">
                        <div class="control has-icons-right">
                            <input type="text" id="email" name="email" placeholder="Email Address"
                                class="input {{ $errors->has('email') ? ' is-danger' : '' }}"
                                value="{{ old('email') }}" autofocus>
                    
                            <span class="icon is-small is-right">
                                <i class="fas fa-user"></i>
                            </span><!-- icon -->
                        </div><!-- control -->
                    
                        <p class="help is-danger">{{ $errors->first('email') }}</p>
                    </div><!-- field -->

                    <div class="field">
                         <div class="control has-icons-right">
                             <input type="password" id="password" name="password" placeholder="Password"
                                 class="input {{ $errors->has('password') ? ' is-danger' : '' }}"
                                 value="{{ old('password') }}">
                     
                             <span class="icon is-small is-right">
                                 <i class="fas fa-lock"></i>
                             </span><!-- icon -->
                         </div><!-- control -->
                     
                         <p class="help is-danger">{{ $errors->first('password') }}</p>
                     </div><!-- field -->         
                </section><!-- modal-card-body -->
                
                <footer class="modal-card-foot">
                    <button type="submit" class="button">Okay</button>
                </footer><!-- modal-card-foot -->
            </form>
        </div><!-- modal-card -->
    </div><!-- modal -->

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
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
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
