<template>
    <v-dialog v-model="show" max-width="600px">
        <v-card>
            <v-card-title>
                <span class="headline" v-text="expense.subject"></span>
            </v-card-title>

            <v-list>
                <v-divider></v-divider>
                <v-list-tile>Date : {{ expense.date }}</v-list-tile>

                <v-divider></v-divider>
                <v-list-tile>Amount : {{ expense.amount }}</v-list-tile>

                <v-divider></v-divider>
                <v-list-tile>Details : {{ expense.details }}</v-list-tile>
                <v-divider></v-divider>
            </v-list>

            <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn color="blue darken-1" flat @click="show = false">Close</v-btn>
            </v-card-actions>
        </v-card>
    </v-dialog>
</template>

<script>
export default {
    computed: {
        expense() {
            return this.$store.state.expense.expense
        },
        show: {
            get() {
                return this.$store.state.expense.showExpense
            },
            set(arg) {
                this.$store.commit('expense/showExpense', arg)
            }
        }
    }
}
</script>
