@extends ('master.layout')

@section ('main')
    <div class="modal is-active">
        <div class="modal-background"></div>
        
        <div class="modal-card">
            <header class="modal-card-head">
                <p class="modal-card-title">Income: {{ $income->subject }}</p>
            </header><!-- modal-card-head -->
    
            <section class="modal-card-body">
                {{ Breadcrumbs::render('income-show', $income) }}

                <div class="box">
                    <p class="subtitle">Date: {{ $income->date }}</p>
                    <p class="subtitle">Subject: {{ $income->subject }}</p>
                    <p class="subtitle">Amount: <strong>{{ $income->amount }}</strong></p>
                    <p class="subtitle">Details: {{ $income->details }}</p>
                </div>
            </section><!-- modal-card-body -->
            
            <footer class="modal-card-foot">
                <a href="{{ route('income.index') }}" class="button">Back</a>
            </footer><!-- modal-card-foot -->
        </div><!-- modal-card -->
    </div><!-- modal -->
@endsection
