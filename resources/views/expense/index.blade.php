@extends ('master.layout')

@section ('main')
    <div class="modal is-active">
        <div class="modal-background"></div>
        
        <div class="modal-card">
            <header class="modal-card-head">
                <p class="modal-card-title">Income Manager</p>
            </header><!-- modal-card-head -->
    
            <section class="modal-card-body">
                {{ Breadcrumbs::render('expense') }}

                @include ('master.notification')

                <table class="table is-fullwidth is-bordered is-hoverable is-narrow">
                    <thead>
                        <tr>
                            <th class="has-text-centered">Date</th>
                            <th class="has-text-centered">Subject</th>
                            <th class="has-text-centered">Amount</th>
                        </tr>
                    </thead>
                    
                    <tbody>
                        @foreach ($expenses as $expense)
                            <tr>
                                <td class="has-text-centered">{{ $expense->date }}</td>
                                <td class="has-text-centered">
                                    <a href="{{ route('expense.show', $expense->id) }}">
                                        {{ $expense->subject }}
                                    </a>
                                </td>
                                <td class="has-text-centered">{{ $expense->amount }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </section><!-- modal-card-body -->
            
            <footer class="modal-card-foot">
                <a href="{{ route('expense.create') }}" class="button is-primary is-outlined">New</a>

                <a href="{{ route('summary') }}" class="button">Back</a>
            </footer><!-- modal-card-foot -->
        </div><!-- modal-card -->
    </div><!-- modal -->
@endsection
