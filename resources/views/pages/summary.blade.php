@extends ('master.layout')

@section ('main')
    <section class="section">
        <div class="container">
            {{ Breadcrumbs::render('summary') }}

            <article class="message">
                <div class="message-header">
                    <p>Summary as of {{ date('M j, Y') }}</p>
                </div><!-- message-header -->
            
                <div class="message-body">
                    <div class="content">
                        <p class="subtitle">Today's <a href="{{ route('income.index') }}">income</a> : <strong>1000</strong></p>                    

                        <p class="subtitle">Today's expenses : <strong>1000</strong></p>                    

                        <p class="subtitle">Cash on hand : <strong>1000</strong></p>                    
                    </div>
                </div><!-- message-body -->
            </article><!-- message -->
        </div><!-- container -->
    </section><!-- section -->
@endsection
