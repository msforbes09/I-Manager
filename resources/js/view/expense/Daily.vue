<template>
    <v-dialog v-model="show" max-width="1000px">
        <v-card dark>
            <v-card-title>
                <span class="headline" v-text="date">date</span>
            </v-card-title>
            <v-data-table
                :headers="headers"
                :items="expenses"
                :loading="loading"
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
                <v-btn color="indigo" dark @click="create()">New</v-btn>
                <v-btn color="deep-orange" dark @click="show = false">Close</v-btn>
            </v-card-actions>
        </v-card>
    </v-dialog>
</template>

<script>
export default {
    computed: {
        date() {
            return this.$store.getters.date
        },
        expenses() {
            return this.$store.getters.dailyExpenses
        },
        show: {
            get() {
                return this.$store.getters.showDailyExpenses
            },
            set(arg) {
                this.$store.commit('showDailyExpenses', arg)
            }
        },
        loading() {
            return this.$store.getters.loading
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
            this.$store.commit('date', this.date)
            this.$store.commit('createExpense', true)
        },
        showExpense(id) {
            this.$store.dispatch('getExpense', id)
        }
    }
}
</script>