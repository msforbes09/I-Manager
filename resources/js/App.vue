<template>
    <v-app>
        <drawer v-if="loggedIn" />
        <navbar v-if="loggedIn" />
        <alert />
        <v-content class="grey lighten-5">
            <v-container>
                <router-view></router-view>
            </v-container>
        </v-content>
    </v-app>
</template>

<script>
export default {
    components: {
        drawer: require('./components/Drawer.vue').default,
        navbar: require('./components/Navbar.vue').default,
        alert: require('./components/Alert.vue').default
    },
    computed: {
        loggedIn() {
            return this.$store.getters.loggedIn
        },
        token() {
            return this.$store.getters.token
        }
    },
    watch: {
        token() {
            axios.defaults.headers.common['Authorization'] = 'Bearer ' + this.token
        }
    }
}
</script>

<style>
</style>
