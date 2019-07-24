<template>
    <v-dialog v-model="show" max-width="600px">
        <v-card>
            <v-card-title>
                <span class="headline" v-text="income.subject"></span>
            </v-card-title>

            <v-list>
                <v-divider></v-divider>
                <v-list-tile>Date : {{ income.date }}</v-list-tile>

                <v-divider></v-divider>
                <v-list-tile>Amount : {{ income.amount }}</v-list-tile>

                <v-divider></v-divider>
                <v-list-tile>Details : {{ income.details }}</v-list-tile>
                <v-divider></v-divider>
            </v-list>

            <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn color="deep-orange" dark @click="show = false">Close</v-btn>
            </v-card-actions>
        </v-card>
    </v-dialog>
</template>

<script>
export default {
    computed: {
        income() {
            return this.$store.getters.income
        },
        show: {
            get() {
                return this.$store.getters.showIncome
            },
            set(arg) {
                this.$store.commit('showIncome', arg)
            }
        }
    }
}
</script>
