<template>
    <div>
        <daily/>
        <show/>
        <v-layout>
            <v-spacer></v-spacer>
            <create/>
            <search/>
        </v-layout>
        <v-data-table
            :headers="headers"
            :items="expenses"
            :loading="loading"
            :pagination.sync="pagination"
            :total-items="totalItems"
            :rows-per-page-items="[10, 50, 100]"
            class="elevation-1"
            dark
        >
            <template v-slot:items="props">
                <td class="text-xs-left">{{ props.item.date }}</td>
                <td class="text-xs-left">{{ props.item.amount }}</td>
                <td class="text-xs-right">
                    <v-icon small class="mr-2" @click="daily(props.item.date)">zoom_in</v-icon>
                    <v-icon small @click="create(props.item.date)">add</v-icon>
                </td>
            </template>
        </v-data-table>
    </div>
</template>

<script>
export default {
    components: {
        create: require('./Create.vue').default,
        daily: require('./Daily.vue').default,
        search: require('./search.vue').default,
        show: require('./show.vue').default
    },
    computed: {
        expenses() {
            return this.$store.state.expense.expenses.data
        },
        loading() {
            return this.$store.state.expense.loading
        },
        totalItems() {
            return this.$store.state.expense.expenses.total
        }
    },
    data() {
        return {
            headers: [
                { text: 'Date', align: 'left', value: 'date' },
                { text: 'Amount', align: 'left', value: 'amount' },
                { text: 'Action', align: 'right', value: 'action', sortable: false }
            ],
            pagination: { descending: true, sortBy: 'date' }
        }
    },
    methods: {
        create(date) {
            this.$store.commit('expense/activeDate', date)
            this.$store.commit('expense/showCreate', true)
        },
        daily(date) {
            this.$store.commit('expense/activeDate', date)
            this.$store.dispatch('expense/getDaily', date)
        }
    },
    watch: {
        pagination: {
            handler() {
                this.$store.commit('expense/pagination', this.pagination)
                this.$store.dispatch('expense/getExpenses')
            },
            deep: true
        }
    }
}
</script>
