<template>
    <div>
        <v-btn @click="show = true" class="success">Search</v-btn>

        <v-dialog v-model="show" persistent max-width="1000px">
            <v-card dark>
                <v-card-title>
                    <v-spacer></v-spacer>
                    <v-text-field
                        v-model="searchItem"
                        append-icon="search"
                        label="Search"
                        single-line
                        hide-details
                    ></v-text-field>
                </v-card-title>

                <v-data-table
                    :headers="headers"
                    :items="expenses"
                    :loading="loading"
                    :pagination.sync="pagination"
                    :total-items="totalItems"
                    disable-initial-sort
                    :rows-per-page-items="[10]"
                >
                    <template v-slot:no-data>
                        <v-alert
                            :value="true"
                            color="error"
                            icon="warning"
                        >Your search for "{{ searchItem }}" found no results.</v-alert>
                    </template>
                    <template v-slot:items="props">
                        <td class="text-xs-left">{{ props.item.date }}</td>
                        <td class="text-xs-left">{{ props.item.subject }}</td>
                        <td class="text-xs-left">{{ props.item.amount }}</td>
                        <td class="text-xs-right">{{ props.item.details }}</td>
                    </template>
                </v-data-table>

                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn color="blue darken-1" flat @click="show = false">Close</v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
    </div>
</template>

<script>
export default {
    created() {
        this.debouncedSearch = _.debounce(this.search, 500)
    },
    data() {
        return {
            headers: [
                { text: 'Date', align: 'left', value: 'date' },
                { text: 'Subject', align: 'left', value: 'subject' },
                { text: 'Amount', align: 'left', value: 'amount' },
                { text: 'Desc', align: 'right', value: 'details', sortable: false }
            ],
            expenses: [],
            loading: false,
            pagination: {},
            searchItem: '',
            show: false,
            totalItems: 0
        }
    },
    methods: {
        search() {
            this.$store
                .dispatch('expense/search', {
                    search: this.searchItem,
                    page: this.pagination.page,
                    sortBy: this.pagination.sortBy,
                    descending: this.pagination.descending
                })
                .then(res => {
                    this.expenses = res.data
                    this.totalItems = res.total
                    this.loading = false
                })
        }
    },
    watch: {
        pagination: {
            handler() {
                this.loading = true
                this.search()
            },
            deep: true
        },
        searchItem: {
            handler() {
                this.loading = true
                this.debouncedSearch()
            },
            deep: true
        }
    }
}
</script>

<style>
</style>
