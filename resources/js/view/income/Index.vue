<template>
    <div>
        <showIncome />
        <create />
        <v-layout class="mb-2">
            <v-text-field
                v-model="searchItem"
                append-icon="search"
                label="Search"
                single-line
                hide-details
                outline
                clearable
                autofocus
            ></v-text-field>
            <v-spacer></v-spacer>
            <v-btn @click="create" class="primary">Add New</v-btn>
        </v-layout>

        <v-card dark>
            <v-data-table
                :headers="headers"
                :items="incomes"
                :loading="loading"
                :pagination.sync="pagination"
                :total-items="totalItems"
                :rows-per-page-items="[10, 50, 100]"
            >
                <template v-slot:no-data>
                    <v-alert
                        :value="true"
                        color="error"
                        icon="warning"
                    >Your search for "{{ searchItem }}" found no results.</v-alert>
                </template>
                <template v-slot:items="props">
                    <td>{{props.item.date}}</td>
                    <td>{{props.item.subject}}</td>
                    <td>{{props.item.amount}}</td>
                    <td class="text-xs-right">
                        <v-icon small @click="showIncome(props.item.id)">zoom_in</v-icon>
                    </td>
                </template>
            </v-data-table>
        </v-card>
    </div>
</template>

<script>
export default {
    components: {
        create: require('./Create.vue').default,
        showIncome: require('./Show.vue').default
    },
    computed: {
        incomes() {
            return this.$store.getters.incomes.data
        },
        loading() {
            return this.$store.getters.loading
        },
        totalItems() {
            return this.$store.state.incomes.total
        }
    },
    created() {
        this.search = _.debounce(this.getIncomes, 500)
    },
    data() {
        return {
            headers: [
                { text: 'Date', align: 'left', value: 'date' },
                { text: 'Subject', align: 'left', value: 'subject' },
                { text: 'Amount', align: 'left', value: 'amount' },
                { text: 'Actions', align: 'right', value: 'action', sortable: false }
            ],
            pagination: { descending: true, sortBy: 'date' },
            searchItem: ''
        }
    },
    methods: {
        create() {
            this.$store.commit('createIncome', true)
        },
        showIncome(id) {
            this.$store.dispatch('showIncome', id)
        },
        getIncomes() {
            this.$store.dispatch('getIncomes', {
                search: this.searchItem,
                page: this.pagination.page,
                sortBy: this.pagination.sortBy,
                descending: this.pagination.descending,
                rowsPerPage: this.pagination.rowsPerPage
            })
        }
    },
    watch: {
        pagination: {
            handler() {
                this.getIncomes()
            },
            deep: true
        },
        searchItem() {
            this.search()
        }
    }
}
</script>
