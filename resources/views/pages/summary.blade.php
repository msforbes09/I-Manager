@extends ('master.layout')

@section ('main')
<v-card dark>
    <v-card-title>
        <h3 class="headline mb-0">Summary as of: {{ date('M j, Y') }}</h3>
    </v-card-title>

    <v-list>
        <v-divider></v-divider>
        <v-list-tile>
            <v-list-tile-content>
                <v-list-tile-title>
                    User:
                    <span>{{ $user->name }}</span>
                </v-list-tile-title>
            </v-list-tile-content>
        </v-list-tile>

        <v-divider></v-divider>
        <v-list-tile>
            <v-list-tile-content>
                <v-list-tile-title>
                    Today's Income:
                    <span>{{ $user->income }}</span>
                </v-list-tile-title>
            </v-list-tile-content>
        </v-list-tile>
        <v-divider></v-divider>
        <v-list-tile>
            <v-list-tile-content>
                <v-list-tile-title>
                    Today's Expenses:
                    <span>{{ $user->expense }}</span>
                </v-list-tile-title>
            </v-list-tile-content>
        </v-list-tile>

        <v-divider></v-divider>
        <v-list-tile>
            <v-list-tile-content>
                <v-list-tile-title>
                    Cash on Hand:
                    <span>{{ $user->onhand }}</span>
                </v-list-tile-title>
            </v-list-tile-content>
        </v-list-tile>
        <v-divider></v-divider>
    </v-list>

    <v-card-actions>
        <v-spacer></v-spacer>
        <v-btn flat color="yellow" href="{{ route('income') }}">Incomes</v-btn>
        <v-btn flat color="yellow" href="{{ route('expense') }}">Expenses</v-btn>
    </v-card-actions>
</v-card>
@endsection
