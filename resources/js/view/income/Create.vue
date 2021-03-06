<template>
    <v-dialog v-model="show" :persistent="loading" max-width="600px">
        <v-card>
            <v-card-title>
                <span class="headline">New Income</span>
            </v-card-title>
            <v-divider></v-divider>
            <form @submit.prevent="store" @keydown="error.clear($event.target.name)">
                <v-card-text>
                    <v-container grid-list-md>
                        <v-flex xs12>
                            <v-text-field
                                name="subject"
                                label="Subject"
                                v-model="newIncome.subject"
                                :error-messages="error.get('subject')"
                            ></v-text-field>
                        </v-flex>

                        <v-flex xs12>
                            <v-dialog
                                ref="dialog"
                                v-model="datepicker"
                                :return-value.sync="newIncome.date"
                                persistent
                                lazy
                                full-width
                                width="290px"
                            >
                                <template v-slot:activator="{ on }">
                                    <v-text-field
                                        v-model="newIncome.date"
                                        label="Date"
                                        :error-messages="error.get('date')"
                                        readonly
                                        v-on="on"
                                    ></v-text-field>
                                </template>
                                <v-date-picker v-model="newIncome.date" scrollable>
                                    <v-spacer></v-spacer>
                                    <v-btn
                                        flat
                                        color="primary"
                                        @click="$refs.dialog.save(newIncome.date)"
                                    >OK</v-btn>
                                    <v-btn flat color="primary" @click="datepicker = false">Cancel</v-btn>
                                </v-date-picker>
                            </v-dialog>
                        </v-flex>

                        <v-flex xs12>
                            <v-text-field
                                label="Amount"
                                name="amount"
                                v-model="newIncome.amount"
                                :error-messages="error.get('amount')"
                            ></v-text-field>
                        </v-flex>
                        <v-flex xs12>
                            <v-text-field label="Description" v-model="newIncome.details"></v-text-field>
                        </v-flex>
                    </v-container>
                </v-card-text>
                <v-divider></v-divider>

                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn type="submit" color="indigo" dark :loading="loading">Save</v-btn>
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
                return this.$store.getters.createIncome
            },
            set(arg) {
                this.$store.commit('createIncome', arg)
            }
        },
        error() {
            return this.$store.getters.error
        },
        loading() {
            return this.$store.getters.loading
        }
    },
    data() {
        return {
            datepicker: false,
            newIncome: {}
        }
    },
    methods: {
        store() {
            this.$store.dispatch('storeIncome', this.newIncome)
        },
        reset() {
            this.error.reset()
            this.newIncome = {
                date: new Date().toISOString().substr(0, 10),
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
