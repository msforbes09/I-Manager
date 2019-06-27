<template>
    <v-dialog v-model="show" max-width="1000px" persistent>
        <v-card dark>
            <v-card-title>
                <span class="headline" v-text="date"></span>
            </v-card-title>
            <alert/>
            <v-data-table
                :headers="headers"
                :loading="loading"
                :items="expenses"
                :rows-per-page-items="[10]"
                disable-initial-sort
            >
                <template v-slot:items="props">
                    <td class="text-xs-left">{{ props.item.date }}</td>
                    <td class="text-xs-left">{{ props.item.subject }}</td>
                    <td class="text-xs-left">{{ props.item.amount }}</td>
                    <td class="text-xs-right">
                        <v-icon small class="mr-2" @click="showExpense(props.item.id)">zoom_in</v-icon>
                    </td>
                </template>
            </v-data-table>
            <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn color="yellow" flat @click="create">New</v-btn>
                <v-btn color="yellow" flat @click="show = false">Close</v-btn>
            </v-card-actions>
        </v-card>
    </v-dialog>
</template>

<script>
export default {
    components: {
        alert: require('./Alert.vue').default
    },
    computed: {
        date() {
            return this.$store.state.expense.activeDate
        },
        expenses() {
            return this.$store.state.expense.expensesDaily
        },
        loading() {
            return this.$store.state.expense.loading
        },
        show: {
            get() {
                return this.$store.state.expense.showDaily
            },
            set(arg) {
                this.$store.commit('expense/showDaily', arg)
            }
        }
    },
    data() {
        return {
            headers: [
                { text: 'Date', align: 'left', value: 'date' },
                { text: 'Subject', align: 'left', value: 'subject' },
                { text: 'Amount', align: 'left', value: 'amount' },
                { text: 'Action', align: 'right', value: 'action', sortable: false }
            ]
        }
    },
    methods: {
        create() {
            this.$store.commit('expense/showCreate', true)
        },
        showExpense(id) {
            this.$store.dispatch('expense/getExpense', id).then(res => {
                this.$store.commit('expense/expense', res.data)
                this.$store.commit('expense/showExpense', true)
            })
        }
    }
}
</script>