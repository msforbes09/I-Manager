<template>
    <v-app>
        <drawer/>
        <navbar/>
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
        navbar: require('./components/Navbar.vue').default
    }
}
</script>

<style>
</style>
