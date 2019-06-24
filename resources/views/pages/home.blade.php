@extends ('master.layout')

@section ('main')
<v-jumbotron>
    <v-container fill-height>
        <v-layout align-center>
            <v-flex>
                <h3 class="display-3">Hello</h3>

                <span class="subheading">I am your personal manager.</span>

                <v-divider class="my-3"></v-divider>

                <v-btn class="mx-0" color="primary" large href="{{ route('summary') }}">Get Started</v-btn>
            </v-flex>
        </v-layout>
    </v-container>
</v-jumbotron>
@endsection
