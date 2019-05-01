@extends ('master.layout')

@section ('main')
    <section class="hero is-link is-bold is-fullheight">
        <div class="hero-body">
            <div class="container">
                <p class="title">Hello</p>
        
                <p class="subtitle">I am your personal manager</p>

                <a href="{{ route('summary') }}" class="button is-primary is-outlined">Get Started</a>

                <a class="button is-danger" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div><!-- container -->
        </div><!-- hero-body -->
    </section><!-- hero -->
@endsection
