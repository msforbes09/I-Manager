@extends ('master.layout')

@section ('main')
    <div class="modal is-active">
        <div class="modal-background"></div>
        
        <div class="modal-card">
            <header class="modal-card-head">
                <p class="modal-card-title">Summary as of {{ date('M j, Y') }}</p>
            </header><!-- modal-card-head -->
    
            <section class="modal-card-body">
                {{ Breadcrumbs::render('summary') }}

                <div class="content">
                    <p class="subtitle">User : <strong>{{ $user->name }}</strong></p>                    

                    <p class="subtitle">Today's <a href="{{ route('income.index') }}">income</a> : <strong>Php {{$user->income}}</strong></p>                    
                    <p class="subtitle">Today's <a href="{{ route('expense.index') }}">expenses</a> : <strong>Php {{ $user->expense }}</strong></p> 

                    <p class="subtitle">Cash on hand : <strong>Php {{ $user->onhand }}</strong></p>                    
                </div>
            </section><!-- modal-card-body -->
        </div><!-- modal-card -->
    </div><!-- modal -->
@endsection
