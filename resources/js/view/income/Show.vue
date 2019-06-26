<template>
  <v-dialog :value="show" max-width="600px" persistent>
    <v-card>
      <v-card-title>
        <span class="headline" v-text="income.subject"></span>
      </v-card-title>

      <v-list>
        <v-divider></v-divider>
        <v-list-tile>Date : {{ income.date }}</v-list-tile>

        <v-divider></v-divider>
        <v-list-tile>Amount : {{ income.amount }}</v-list-tile>

        <v-divider></v-divider>
        <v-list-tile>Details : {{ income.details }}</v-list-tile>
        <v-divider></v-divider>
      </v-list>

      <v-card-actions>
        <v-spacer></v-spacer>
        <v-btn color="blue darken-1" flat @click="close">Close</v-btn>
      </v-card-actions>
    </v-card>
  </v-dialog>
</template>

<script>
export default {
  computed: {
    income() {
      return this.$store.state.income.income;
    },
    show() {
      return this.$store.state.income.showIncome;
    }
  },
  methods: {
    close() {
      this.$store.commit("income/showIncome");
    }
  }
};
</script>
