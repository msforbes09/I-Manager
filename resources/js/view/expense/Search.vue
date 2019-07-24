<template>
    <v-dialog v-model="show" max-width="1000px">
        <v-card dark>
            <v-card-title>
                <v-text-field
                    v-model="searchItem"
                    append-icon="search"
                    label="Search"
                    single-line
                    hide-details
                    outline
                ></v-text-field>
                <v-spacer></v-spacer>
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
                <v-btn color="deep-orange" dark @click="show = false">Close</v-btn>
            </v-card-actions>
        </v-card>
    </v-dialog>
</template>

<script>
export default {
    computed: {
        expenses() {
            return this.$store.getters.searchedExpenses.data
        },
        totalItems() {
            return this.$store.getters.searchedExpenses.total
        },
        loading() {
            return this.$store.getters.loading
        },
        show: {
            get() {
                return this.$store.getters.showSearchedExpenses
            },
            set(arg) {
                this.$store.commit('showSearchedExpenses', arg)
            }
        }
    },
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
            pagination: {},
            searchItem: ''
        }
    },
    methods: {
        search() {
            this.$store.dispatch('searchExpenses', {
                search: this.searchItem,
                page: this.pagination.page,
                sortBy: this.pagination.sortBy,
                descending: this.pagination.descending
            })
        }
    },
    watch: {
        pagination: {
            handler() {
                this.search()
            },
            deep: true
        },
        searchItem() {
            this.debouncedSearch()
        }
    }
}
</script>

<style>
</style>
