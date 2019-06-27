<template>
    <div>
        <v-btn @click="create" class="primary">Add New</v-btn>

        <v-dialog v-model="show" persistent max-width="600px">
            <v-card>
                <v-card-title>
                    <span class="headline">New Expense</span>
                </v-card-title>
                <v-card-text @keydown="error.clear($event.target.name)">
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

                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn color="blue darken-1" flat @click="store">Save</v-btn>
                    <v-btn color="blue darken-1" flat @click="show = false">Close</v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
    </div>
</template>

<script>
import Error from './../../helper/Error.js'

export default {
    computed: {
        show: {
            get() {
                return this.$store.state.expense.showCreate
            },
            set(arg) {
                this.$store.commit('expense/showCreate', arg)
            }
        }
    },
    data() {
        return {
            datepicker: false,
            error: new Error(),
            newExpense: {}
        }
    },
    methods: {
        create() {
            this.$store.commit('expense/activeDate', new Date().toISOString().substr(0, 10))
            this.show = true
        },
        reset() {
            this.error.reset()
            this.newExpense = {
                date: this.$store.state.expense.activeDate,
                subject: '',
                amount: null,
                description: ''
            }
        },
        store() {
            this.$store
                .dispatch('expense/store', this.newExpense)
                .then(res => {
                    this.show = false
                    this.$store.dispatch('expense/getDaily', this.newExpense.date)
                    this.$store.commit('expense/alert', {
                        message: res.data.message,
                        status: true
                    })
                })
                .catch(err => {
                    this.error.record(err.response.data.errors)
                })
        }
    },
    watch: {
        show: {
            handler(value) {
                if (value) {
                    this.reset()
                }
            }
        }
    }
}
</script>
