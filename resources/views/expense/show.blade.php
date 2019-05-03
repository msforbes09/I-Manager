@extends ('master.layout')

@section ('main')
    <div class="modal is-active">
        <div class="modal-background"></div>
        
        <div class="modal-card">
            <header class="modal-card-head">
                <p class="modal-card-title">Expense: {{ $expense->subject }}</p>
            </header><!-- modal-card-head -->
    
            <section class="modal-card-body">
                {{ Breadcrumbs::render('expense-show', $expense) }}

                <div class="box">
                    <p class="subtitle">Date: {{ $expense->date }}</p>
                    <p class="subtitle">Subject: {{ $expense->subject }}</p>
                    <p class="subtitle">Amount: <strong>{{ $expense->amount }}</strong></p>
                    <p class="subtitle">Details: {{ $expense->details }}</p>
                </div>
            </section><!-- modal-card-body -->
            
            <footer class="modal-card-foot">
                <a href="{{ route('income.index') }}" class="button">Back</a>
            </footer><!-- modal-card-foot -->
        </div><!-- modal-card -->
    </div><!-- modal -->
@endsection
