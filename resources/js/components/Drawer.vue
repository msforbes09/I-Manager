<template>
    <v-navigation-drawer dark fixed clipped app class="blue-grey darken-2" v-model="drawer">
        <v-list>
            <v-list-tile router to="/">
                <v-list-tile-action>
                    <v-icon>home</v-icon>
                </v-list-tile-action>

                <v-list-tile-content>
                    <v-list-tile-title>Home</v-list-tile-title>
                </v-list-tile-content>
            </v-list-tile>

            <v-list-tile router to="/summary">
                <v-list-tile-action>
                    <v-icon>dashboard</v-icon>
                </v-list-tile-action>

                <v-list-tile-content>
                    <v-list-tile-title>Summary</v-list-tile-title>
                </v-list-tile-content>
            </v-list-tile>

            <v-list-tile router to="/income">
                <v-list-tile-action>
                    <v-icon>attach_money</v-icon>
                </v-list-tile-action>

                <v-list-tile-content>
                    <v-list-tile-title>Income Manager</v-list-tile-title>
                </v-list-tile-content>
            </v-list-tile>

            <v-list-tile router to="/expense">
                <v-list-tile-action>
                    <v-icon>attach_money</v-icon>
                </v-list-tile-action>

                <v-list-tile-content>
                    <v-list-tile-title>Expense Manager</v-list-tile-title>
                </v-list-tile-content>
            </v-list-tile>
        </v-list>
    </v-navigation-drawer>
</template>

<script>
export default {
    data() {
        return {
            drawer: true
        }
    }
}
</script>

<style>
</style>
