@extends('master.layout-secondary')

@section('main')
<div class="row">
    <div class="col s12 offset-m3 m6">
        <div class="card hoverable">
            <form method="post" action="{{ route('login') }}">
                @csrf
                <div class="card-content">
                    <div class="card-title">Sign In</div>

                    <div class="row">
                        <div class="input-field col s12">
                            <i class="material-icons prefix">account_circle</i>
                            <input name="email" id="email" type="email" value="{{ old('email') }}" autofocus required>
                            <label for="email">Email</label>
                            @error('email')
                                <span class="helper-text red-text">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="input-field col s12">
                            <i class="material-icons prefix">lock_open</i>
                            <input name="password" id="password" type="password" required>
                            <label for="password">Password</label>
                            @error('password')
                                <span class="helper-text red-text">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="card-action right-align">
                    <button type="submit" class="btn-small indigo">Sign In</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
