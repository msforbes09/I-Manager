@extends ('master.layout')

@section ('main')
    <div class="modal is-active">
        <div class="modal-background"></div>
        
        <div class="modal-card">
            <header class="modal-card-head">
                <p class="subtitle">New Income Record</p>
            </header><!-- modal-card-head -->
        
            <section class="modal-card-body">
                {{ Breadcrumbs::render('income-create') }}

                <form id="form" method="post" action="{{ route('income.store') }}">
                    @csrf

                    <div class="field">
                        <div class="control has-icons-right">
                            <input type="date" id="date" name="date"
                                class="input {{ $errors->has('date') ? ' is-danger' : '' }}"
                                value="{{ old('date') }}" autofocus>
                    
                            <span class="icon is-small is-right">
                                <i class="fas fa-calendar"></i>
                            </span><!-- icon -->
                        </div><!-- control -->
                    
                        <p class="help is-danger">{{ $errors->first('date') }}</p>
                    </div><!-- field -->

                    <div class="field">
                        <div class="control has-icons-right">
                            <input type="text" id="subject" name="subject" placeholder="Subject"
                                class="input {{ $errors->has('subject') ? ' is-danger' : '' }}"
                                value="{{ old('subject') }}">
                    
                            <span class="icon is-small is-right">
                                <i class="fas fa-tag"></i>
                            </span><!-- icon -->
                        </div><!-- control -->
                    
                        <p class="help is-danger">{{ $errors->first('subject') }}</p>
                    </div><!-- field -->

                    <div class="field">
                        <div class="control has-icons-right">
                            <input type="text" id="amount" name="amount" placeholder="Amount"
                                class="input {{ $errors->has('amount') ? ' is-danger' : '' }}"
                                value="{{ old('amount') }}">
                    
                            <span class="icon is-small is-right">
                                <i class="fas fa-dollar-sign"></i>
                            </span><!-- icon -->
                        </div><!-- control -->
                    
                        <p class="help is-danger">{{ $errors->first('amount') }}</p>
                    </div><!-- field -->

                    <div class="field">
                        <div class="control has-icons-right">
                            <input type="text" id="details" name="details" placeholder="Details"
                                class="input {{ $errors->has('details') ? ' is-danger' : '' }}"
                                value="{{ old('details') }}">
                    
                            <span class="icon is-small is-right">
                                <i class="fas fa-list"></i>
                            </span><!-- icon -->
                        </div><!-- control -->
                    </div><!-- field -->
                </form>
            </section><!-- modal-card-body -->
            
            <footer class="modal-card-foot">
                <a href="{{ route('income.store') }}" type="submit" class="button is-primary is-outlined"
                    onclick="event.preventDefault();
                    document.getElementById('form').submit();">Save</a>

                <a href="{{ route('income.index') }}" class="button">Cancel</a>
            </footer><!-- modal-card-foot -->
        </div><!-- modal-card -->
    </div><!-- modal -->
@endsection
