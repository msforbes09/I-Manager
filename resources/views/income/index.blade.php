@extends ('master.layout')

@section ('main')
    <div class="modal is-active">
        <div class="modal-background"></div>
        
        <div class="modal-card">
            <header class="modal-card-head">
                <p class="modal-card-title">Income Manager</p>
            </header><!-- modal-card-head -->
    
            <section class="modal-card-body">
                @include ('master.success')
                
                <table class="table is-fullwidth is-bordered is-hoverable is-narrow">
                    <thead>
                        <tr">
                            <th class="has-text-centered">Date</th>
                            <th class="has-text-centered">Description</th>
                            <th class="has-text-centered">Amount</th>
                        </tr>
                    </thead>
                
                    <tbody>
                        @foreach ($incomes as $income)
                            <tr>
                                <td class="has-text-centered">{{ $income->date }}</td>
                                <td class="has-text-centered">{{ $income->description }}</td>
                                <td class="has-text-centered">{{ $income->amount }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                
            </section><!-- modal-card-body -->
            
            <footer class="modal-card-foot">
                <a href="{{ route('income.create') }}" class="button is-primary is-outlined">New</a>

                <a href="{{ route('summary') }}" class="button">Back</a>
            </footer><!-- modal-card-foot -->
        </div><!-- modal-card -->
    </div><!-- modal -->
@endsection
