<template>
    <v-navigation-drawer dark fixed clipped app class="blue-grey darken-2" v-model="visible">
        <v-list dense v-for="route in routes" :key="route.path">
            <v-list-tile router :to="route.path" active-class="blue-grey">
                <v-list-tile-action>
                    <v-icon>{{ route.icon }}</v-icon>
                </v-list-tile-action>

                <v-list-tile-content>
                    <v-list-tile-title>{{ route.label }}</v-list-tile-title>
                </v-list-tile-content>
            </v-list-tile>
        </v-list>
    </v-navigation-drawer>
</template>

<script>
export default {
    computed: {
        visible: {
            get() {
                return this.$store.state.drawer
            },
            set(arg) {
                this.$store.commit('drawer', arg)
            }
        }
    },
    data() {
        return {
            routes: [
                { path: '/', label: 'Home', icon: 'home' },
                { path: '/summary', label: 'Summary', icon: 'dashboard' },
                { path: '/income', label: 'Income', icon: 'attach_money' },
                { path: '/expense', label: 'Expense', icon: 'attach_money' }
            ]
        }
    }
}
</script>

<style>
</style>
