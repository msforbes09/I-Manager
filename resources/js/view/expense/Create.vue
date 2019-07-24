<template>
    <v-dialog v-model="show" :persistent="loading" max-width="600px">
        <v-card>
            <v-card-title>
                <span class="headline">New Expense</span>
            </v-card-title>
            <v-divider></v-divider>
            <form @submit.prevent="store" @keydown="error.clear($event.target.name)">
                <v-card-text>
                    <v-container grid-list-md>
                        <v-flex xs12>
                            <v-text-field
                                name="subject"
                                label="Subject"
                                v-model="newExpense.subject"
                                :error-messages="error.get('subject')"
                            ></v-text-field>
                        </v-flex>

                        <v-flex xs12>
                            <v-dialog
                                ref="dialog"
                                v-model="datepicker"
                                :return-value.sync="newExpense.date"
                                persistent
                                lazy
                                full-width
                                width="290px"
                            >
                                <template v-slot:activator="{ on }">
                                    <v-text-field
                                        v-model="newExpense.date"
                                        label="Date"
                                        :error-messages="error.get('date')"
                                        readonly
                                        v-on="on"
                                    ></v-text-field>
                                </template>
                                <v-date-picker v-model="newExpense.date" scrollable>
                                    <v-spacer></v-spacer>
                                    <v-btn
                                        flat
                                        color="primary"
                                        @click="$refs.dialog.save(newExpense.date)"
                                    >OK</v-btn>
                                    <v-btn flat color="primary" @click="datepicker = false">Cancel</v-btn>
                                </v-date-picker>
                            </v-dialog>
                        </v-flex>

                        <v-flex xs12>
                            <v-text-field
                                label="Amount"
                                name="amount"
                                v-model="newExpense.amount"
                                :error-messages="error.get('amount')"
                            ></v-text-field>
                        </v-flex>
                        <v-flex xs12>
                            <v-text-field label="Description" v-model="newExpense.details"></v-text-field>
                        </v-flex>
                    </v-container>
                </v-card-text>
                <v-divider></v-divider>
                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn color="indigo" type="submit" dark :loading="loading">Save</v-btn>
                    <v-btn color="deep-orange" dark :disabled="loading" @click="show = false">Close</v-btn>
                </v-card-actions>
            </form>
        </v-card>
    </v-dialog>
</template>

<script>
import Error from './../../helper/Error.js'

export default {
    computed: {
        show: {
            get() {
                return this.$store.getters.createExpense
            },
            set(arg) {
                this.$store.commit('createExpense', arg)
            }
        },
        error() {
            return this.$store.getters.error
        },
        loading() {
            return this.$store.getters.loading
        },
        date() {
            return this.$store.getters.date
        },
        error() {
            return this.$store.getters.error
        }
    },
    data() {
        return {
            datepicker: false,
            newExpense: {}
        }
    },
    methods: {
        store() {
            this.$store.dispatch('storeExpense', this.newExpense)
        },
        reset() {
            this.error.reset()
            this.newExpense = {
                date: this.date,
                subject: '',
                amount: null,
                description: ''
            }
        }
    },
    watch: {
        show(val) {
            if (val) this.reset()
        }
    }
}
</script>
