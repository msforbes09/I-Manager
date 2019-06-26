<template>
    <div>
        <v-toolbar app dark fixed clipped-left>
            <v-toolbar-side-icon @click.stop="drawer"></v-toolbar-side-icon>
            <v-toolbar-title>IManager</v-toolbar-title>
            <v-spacer></v-spacer>
            <v-btn flat color="grey" onclick="document.getElementById('logout-form').submit();">
                <span>Logout</span>
                <v-icon>exit_to_app</v-icon>
            </v-btn>
        </v-toolbar>
    </div>
</template>

<script>
export default {
    methods: {
        drawer() {
            this.$store.commit('drawer', !this.$store.state.drawer)
        }
    }
}
</script>