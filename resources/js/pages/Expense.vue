<template>
  <div>
    <v-layout>
      <v-spacer></v-spacer>
      <v-btn @click="newExpense(today)" class="primary">Add New</v-btn>
    </v-layout>

    <v-dialog v-model="form" persistent max-width="600px">
      <v-card>
        <v-card-title>
          <span class="headline">New Expense</span>
        </v-card-title>
        <v-card-text @keydown="error.clear($event.target.name)">
          <v-container grid-list-md v-if="! loading">
            <v-flex xs12>
              <v-text-field
                name="subject"
                label="Subject"
                v-model="selectedExpense.subject"
                :error-messages="error.get('subject')"
                autofocus
              ></v-text-field>
            </v-flex>

            <v-flex xs12>
              <v-dialog
                ref="dialog"
                v-model="datepicker"
                :return-value.sync="selectedExpense.date"
                persistent
                lazy
                full-width
                width="290px"
              >
                <template v-slot:activator="{ on }">
                  <v-text-field
                    v-model="selectedExpense.date"
                    label="Date"
                    :error-messages="error.get('date')"
                    readonly
                    v-on="on"
                  ></v-text-field>
                </template>
                <v-date-picker v-model="selectedExpense.date" scrollable>
                  <v-spacer></v-spacer>
                  <v-btn flat color="primary" @click="$refs.dialog.save(selectedExpense.date)">OK</v-btn>
                  <v-btn flat color="primary" @click="datepicker = false">Cancel</v-btn>
                </v-date-picker>
              </v-dialog>
            </v-flex>

            <v-flex xs12>
              <v-text-field
                label="Amount"
                name="amount"
                v-model="selectedExpense.amount"
                :error-messages="error.get('amount')"
              ></v-text-field>
            </v-flex>
            <v-flex xs12>
              <v-text-field label="Description" v-model="selectedExpense.details"></v-text-field>
            </v-flex>
          </v-container>

          <v-container class="text-xs-center">
            <v-progress-circular
              v-if="loading"
              :size="100"
              width="10"
              color="primary"
              :indeterminate="true"
            ></v-progress-circular>
          </v-container>
        </v-card-text>

        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn color="blue darken-1" flat @click="storeExpense">Save</v-btn>
          <v-btn color="blue darken-1" flat @click="form = false">Close</v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>

    <v-dialog v-model="detail" max-width="600px">
      <v-card>
        <v-card-title>
          <span class="headline" v-text="selectedExpense.subject"></span>
        </v-card-title>

        <v-list>
          <v-divider></v-divider>
          <v-list-tile>Date : {{ selectedExpense.date }}</v-list-tile>

          <v-divider></v-divider>
          <v-list-tile>Amount : {{ selectedExpense.amount }}</v-list-tile>

          <v-divider></v-divider>
          <v-list-tile>Details : {{ selectedExpense.details }}</v-list-tile>
          <v-divider></v-divider>
        </v-list>

        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn color="blue darken-1" flat @click="detail = false">Close</v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>

    <v-dialog v-model="daily" max-width="800px">
      <v-card>
        <v-card-title>
          <span class="headline" v-text="selectedDaily.date"></span>
        </v-card-title>

        <v-card-text>
          <v-data-table
            :headers="selectedDaily.headers"
            :items="selectedDaily.expenses"
            :rows-per-page-items="[10]"
            class="elevation-1"
            :loading="loading"
            disable-initial-sort
            dark
          >
            <template v-slot:items="props">
              <td class="text-xs-center">{{ props.item.subject }}</td>
              <td class="text-xs-center">{{ props.item.amount }}</td>
              <td class="text-xs-right">
                <v-icon small class="mr-2" @click="getExpense(props.item.id)">zoom_in</v-icon>
              </td>
            </template>
          </v-data-table>
        </v-card-text>

        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn flat color="primary" @click="daily = false">Close</v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>

    <v-alert
      :value="alert.status"
      type="success"
      outline
      dismissible
      icon="check_circle"
    >{{alert.message}}</v-alert>

    <v-data-table
      :headers="headers"
      :items="expenses"
      :loading="loading"
      :pagination.sync="pagination"
      :total-items="totalExpenses"
      :rows-per-page-items="[10, 50, 100]"
      class="elevation-1"
      dark
    >
      <template v-slot:items="props">
        <td class="text-xs-left">{{ props.item.date }}</td>
        <td class="text-xs-left">{{ props.item.amount }}</td>
        <td class="text-xs-right">
          <v-icon small class="mr-2" @click="getDailyExpense(props.item.date)">zoom_in</v-icon>
          <v-icon small @click="newExpense(props.item.date)">add</v-icon>
        </td>
      </template>
    </v-data-table>
  </div>
</template>

<script>
import Error from "./../helper/Error.js";

export default {
  data() {
    return {
      alert: {
        status: false,
        message: ""
      },
      daily: false,
      datepicker: false,
      detail: false,
      error: new Error(),
      expenses: [],
      form: false,
      headers: [
        { text: "Date", align: "left", value: "date" },
        { text: "Amount", align: "left", value: "amount" },
        {
          text: "Action",
          align: "right",
          value: "action",
          sortable: false
        }
      ],
      loading: true,
      pagination: {
        descending: true,
        sortBy: "date"
      },
      selectedExpense: {},
      selectedDaily: {
        date: null,
        expenses: [],
        headers: [
          { text: "Subject", align: "center", value: "subject" },
          { text: "Amount", align: "center", value: "amount" },
          {
            text: "Action",
            align: "right",
            value: "action",
            sortable: false
          }
        ]
      },
      today: new Date().toISOString().substr(0, 10),
      totalExpenses: 0
    };
  },
  watch: {
    pagination: {
      handler() {
        this.getAllExpenses();
      },
      deep: true
    }
  },
  methods: {
    getAllExpenses() {
      this.loading = true;
      axios.post(`/${Prefix}/expense`, this.pagination).then(res => {
        let expenses = res.data;

        this.expenses = expenses.data;
        this.totalExpenses = expenses.total;
        this.loading = false;
      });
    },
    getDailyExpense(date) {
      this.loading = true;
      axios.get(`/${Prefix}/expense/date/${date}`).then(res => {
        this.selectedDaily.date = date;
        this.selectedDaily.expenses = res.data;
        this.daily = true;
        this.loading = false;
      });
    },
    getExpense(id) {
      this.loading = true;
      axios.get(`/${Prefix}/expense/${id}`).then(res => {
        this.selectedExpense = res.data;
        this.detail = true;
        this.loading = false;
      });
    },
    newExpense(date) {
      this.selectedExpense = {
        date,
        subject: "",
        amount: null,
        description: ""
      };
      this.form = true;
    },
    storeExpense() {
      this.loading = true;
      axios
        .post(`/${Prefix}/expense/store`, this.selectedExpense)
        .then(res => {
          this.alert = {
            message: res.data.message,
            status: true
          };
          this.form = false;
          this.getAllExpenses();
        })
        .catch(err => {
          this.error.record(err.response.data.errors);
          this.loading = false;
        });
    }
  }
};
</script>

<style>
</style>
