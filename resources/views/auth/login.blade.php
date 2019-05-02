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
                    <button type="submit" class="button is-primary">Okay</button>

                    {{-- <a class="btn btn-link" href="{{ route('password.request') }}">
                        {{ __('Forgot Your Password?') }}
                    </a> --}}
                </footer><!-- modal-card-foot -->
            </form>
        </div><!-- modal-card -->
    </div><!-- modal -->
@endsection
