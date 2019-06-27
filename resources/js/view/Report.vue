<template>
    <v-card dark>
        <v-progress-linear :indeterminate="true" v-if="loading" height="5" class="ma-0"></v-progress-linear>
        <v-card-title>
            <h3 class="headline mb-0">Summary as of: {{ now }}</h3>
        </v-card-title>

        <v-card-text>
            <v-list>
                <v-divider></v-divider>
                <v-list-tile>
                    <v-list-tile-content>
                        <v-list-tile-title>
                            User:
                            <span>{{ user.name }}</span>
                        </v-list-tile-title>
                    </v-list-tile-content>
                </v-list-tile>

                <v-divider></v-divider>
                <v-list-tile>
                    <v-list-tile-content>
                        <v-list-tile-title>
                            Today's Income:
                            <span>{{ user.income }}</span>
                        </v-list-tile-title>
                    </v-list-tile-content>
                </v-list-tile>
                <v-divider></v-divider>
                <v-list-tile>
                    <v-list-tile-content>
                        <v-list-tile-title>
                            Today's Expenses:
                            <span>{{ user.expense }}</span>
                        </v-list-tile-title>
                    </v-list-tile-content>
                </v-list-tile>

                <v-divider></v-divider>
                <v-list-tile>
                    <v-list-tile-content>
                        <v-list-tile-title>
                            Cash on Hand:
                            <span>{{ user.onhand }}</span>
                        </v-list-tile-title>
                    </v-list-tile-content>
                </v-list-tile>
                <v-divider></v-divider>
            </v-list>
        </v-card-text>

        <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn flat color="yellow" router to="/income">Incomes</v-btn>
            <v-btn flat color="yellow" router to="/expense">Expenses</v-btn>
        </v-card-actions>
    </v-card>
</template>

<script>
export default {
    data() {
        return {
            loading: false,
            now: new Date().toISOString().substr(0, 10),
            user: {}
        }
    },
    methods: {
        getSummary() {
            this.loading = true
            axios.get(`${Prefix}/summary`).then(res => {
                this.user = res.data
                this.loading = false
            })
        }
    },
    mounted() {
        this.getSummary()
    }
}
</script>

<style>
</style>
