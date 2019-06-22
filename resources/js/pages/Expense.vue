<template>
  <v-data-table
    :headers="headers"
    :items="expenses"
    class="elevation-1"
    :loading="loading"
    :pagination.sync="pagination"
    :total-items="totalExpenses"
    :rows-per-page-items="[10, 50, 100]"
    dark
  >
    <template v-slot:items="props">
      <td class="text-xs-center">{{ props.item.date }}</td>
      <td class="text-xs-center">{{ props.item.amount }}</td>
    </template>
  </v-data-table>
</template>

<script>
export default {
  data() {
    return {
      pagination: {},
      loading: true,
      totalExpenses: 0,
      headers: [
        {
          text: "Date",
          align: "center",
          value: "date"
        },
        { text: "Amount", align: "center", value: "amount" }
      ],
      expenses: []
    };
  },
  watch: {
    pagination: {
      handler() {
        this.getExpenses();
      },
      deep: true
    }
  },
  methods: {
    getExpenses() {
      this.loading = true;
      axios.post("/api/expense", this.pagination).then(res => {
        let expenses = res.data;

        this.expenses = expenses.data;
        this.totalExpenses = expenses.total;
        this.loading = false;
      });
    },
    showItem(date) {
      alert(date);
    }
  }
};
</script>

<style>
</style>
