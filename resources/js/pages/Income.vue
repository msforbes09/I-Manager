<template>
  <div>
    <v-layout>
      <v-spacer></v-spacer>
      <v-btn @click="newIncome" class="primary">Add New</v-btn>
    </v-layout>

    <v-dialog v-model="form" persistent max-width="600px">
      <v-card>
        <v-card-title>
          <span class="headline">New Income</span>
        </v-card-title>
        <v-card-text @keydown="error.clear($event.target.name)">
          <v-container grid-list-md v-if="! loading">
            <v-flex xs12>
              <v-text-field
                name="subject"
                label="Subject"
                v-model="selectedIncome.subject"
                :error-messages="error.get('subject')"
                autofocus
              ></v-text-field>
            </v-flex>

            <v-flex xs12>
              <v-dialog
                ref="dialog"
                v-model="datepicker"
                :return-value.sync="selectedIncome.date"
                persistent
                lazy
                full-width
                width="290px"
              >
                <template v-slot:activator="{ on }">
                  <v-text-field
                    v-model="selectedIncome.date"
                    label="Date"
                    :error-messages="error.get('date')"
                    readonly
                    v-on="on"
                  ></v-text-field>
                </template>
                <v-date-picker v-model="selectedIncome.date" scrollable>
                  <v-spacer></v-spacer>
                  <v-btn flat color="primary" @click="$refs.dialog.save(selectedIncome.date)">OK</v-btn>
                  <v-btn flat color="primary" @click="datepicker = false">Cancel</v-btn>
                </v-date-picker>
              </v-dialog>
            </v-flex>

            <v-flex xs12>
              <v-text-field
                label="Amount"
                name="amount"
                v-model="selectedIncome.amount"
                :error-messages="error.get('amount')"
              ></v-text-field>
            </v-flex>
            <v-flex xs12>
              <v-text-field label="Description" v-model="selectedIncome.details"></v-text-field>
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
          <v-btn color="blue darken-1" flat @click="storeIncome">Save</v-btn>
          <v-btn color="blue darken-1" flat @click="form = false">Close</v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>

    <v-dialog v-model="detail" max-width="600px">
      <v-card>
        <v-card-title>
          <span class="headline" v-text="selectedIncome.subject"></span>
        </v-card-title>

        <v-list>
          <v-divider></v-divider>
          <v-list-tile>Date : {{ selectedIncome.date }}</v-list-tile>

          <v-divider></v-divider>
          <v-list-tile>Amount : {{ selectedIncome.amount }}</v-list-tile>

          <v-divider></v-divider>
          <v-list-tile>Details : {{ selectedIncome.details }}</v-list-tile>
          <v-divider></v-divider>
        </v-list>

        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn color="blue darken-1" flat @click="detail = false">Close</v-btn>
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
      :items="incomes"
      :loading="loading"
      :pagination.sync="pagination"
      :total-items="totalIncomes"
      :rows-per-page-items="[10, 50, 100]"
      class="elevation-1"
      dark
    >
      <template v-slot:items="props">
        <td>{{props.item.date}}</td>
        <td>{{props.item.subject}}</td>
        <td>{{props.item.amount}}</td>
        <td class="text-xs-right">
          <v-icon small @click="showIncome(props.item.id)">zoom_in</v-icon>
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
      datepicker: false,
      detail: false,
      form: false,
      headers: [
        { text: "Date", align: "left", value: "date" },
        { text: "Subject", align: "left", value: "subject" },
        { text: "Amount", align: "left", value: "amount" },
        { text: "Actions", align: "right", value: "action", sortable: false }
      ],
      incomes: [],
      loading: false,
      error: new Error(),
      pagination: {
        descending: true,
        sortBy: "date"
      },
      selectedIncome: {},
      totalIncomes: 0
    };
  },
  watch: {
    pagination: {
      handler() {
        this.getAllIncomes();
      },
      deep: true
    }
  },
  methods: {
    editIncome() {},
    getAllIncomes() {
      this.loading = true;
      axios.post("/api/income", this.pagination).then(res => {
        let incomes = res.data;

        this.incomes = incomes.data;
        this.totalIncomes = incomes.total;
        this.loading = false;
      });
    },
    getIncome(income) {
      return new Promise(function(resolve, reject) {
        axios.get(`/api/income/${income}`).then(res => {
          resolve(res);
        });
      });
    },
    newIncome() {
      this.selectedIncome = {
        date: new Date().toISOString().substr(0, 10),
        subject: "",
        amount: null,
        description: ""
      };
      this.form = true;
    },
    showIncome(income) {
      this.getIncome(income).then(res => {
        console.log(res);
      });
    },
    storeIncome() {
      this.loading = true;
      axios
        .post("/api/income/store", this.selectedIncome)
        .then(res => {
          this.alert = {
            message: res.data.message,
            status: true
          };
          this.form = false;
          this.getAllIncomes();
        })
        .catch(err => {
          this.error.record(err.response.data.errors);
          this.loading = false;
        });
    }
  }
};
</script>
