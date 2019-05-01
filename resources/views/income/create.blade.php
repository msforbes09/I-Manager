@extends ('master.layout')

@section ('main')
    <div class="modal is-active">
        <div class="modal-background"></div>
        
        <div class="modal-card">
            <header class="modal-card-head">
                <p class="subtitle">New Income Record</p>
            </header><!-- modal-card-head -->
        
            <form method="post" action="{{ route('income.store') }}">
                @csrf

                <section class="modal-card-body">
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
                            <input type="text" id="description" name="description" placeholder="Description"
                                class="input {{ $errors->has('description') ? ' is-danger' : '' }}"
                                value="{{ old('description') }}">
                    
                            <span class="icon is-small is-right">
                                <i class="fas fa-tag"></i>
                            </span><!-- icon -->
                        </div><!-- control -->
                    
                        <p class="help is-danger">{{ $errors->first('description') }}</p>
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
                </section><!-- modal-card-body -->
                
                <footer class="modal-card-foot">
                    <button type="submit" class="button is-primary is-outlined">Save</button>

                    <a href="{{ route('income.index') }}" class="button">Cancel</a>
                </footer><!-- modal-card-foot -->
            </form>
        </div><!-- modal-card -->
    </div><!-- modal -->
@endsection
