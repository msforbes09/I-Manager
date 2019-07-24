<template>
    <div>
        <daily />
        <show />
        <search />
        <create />
        <v-layout>
            <v-spacer></v-spacer>
            <v-btn @click="create()" class="primary">Add New</v-btn>
            <v-btn @click="search" class="success">Search</v-btn>
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
                    <v-icon small class="mr-2" @click="showDaily(props.item.date)">zoom_in</v-icon>
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
            return this.$store.getters.expenses.data
        },
        totalItems() {
            return this.$store.getters.expenses.total
        },
        loading() {
            return this.$store.getters.loading
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
        create(date = new Date().toISOString().substr(0, 10)) {
            this.$store.commit('date', date)
            this.$store.commit('createExpense', true)
        },
        showDaily(date) {
            this.$store.dispatch('getDailyExpenses', date)
        },
        getExpenses() {
            this.$store.dispatch('getExpenses', this.pagination)
        },
        search() {
            this.$store.commit('showSearchedExpenses', true)
        }
    },
    watch: {
        pagination: {
            handler() {
                this.getExpenses()
            },
            deep: true
        }
    }
}
</script>
