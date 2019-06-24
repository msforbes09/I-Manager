<v-toolbar app dark fixed clipped-left>
    <v-toolbar-side-icon @click.stop="drawer = !drawer"></v-toolbar-side-icon>
    <v-toolbar-title>IManager</v-toolbar-title>
    <v-spacer></v-spacer>
    <v-btn flat color="grey"
        onclick="event.preventDefault();
            document.getElementById('logout-form').submit();">
        <span>Logout</span>
        <v-icon>exit_to_app</v-icon>
    </v-btn>
</v-toolbar>

<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    @csrf
</form>
