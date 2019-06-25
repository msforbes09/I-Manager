<template>
  <div>
    <create/>
    <showincome/>
    <alert/>
    <v-data-table
      :headers="headers"
      :items="incomes"
      :loading="loading"
      :pagination.sync="pagination"
      :total-items="totalItems"
      :rows-per-page-items="[10, 50, 100]"
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
export default {
  components: {
    alert: require("./Alert.vue").default,
    create: require("./Create.vue").default,
    showincome: require("./Show.vue").default
  },
  computed: {
    incomes() {
      return this.$store.state.income.incomes.data;
    },
    loading() {
      return this.$store.state.income.loading;
    },
    totalItems() {
      return this.$store.state.income.incomes.total;
    }
  },
  data() {
    return {
      headers: [
        { text: "Date", align: "left", value: "date" },
        { text: "Subject", align: "left", value: "subject" },
        { text: "Amount", align: "left", value: "amount" },
        { text: "Actions", align: "right", value: "action", sortable: false }
      ],
      pagination: {
        descending: true,
        sortBy: "date"
      }
    };
  },
  methods: {
    showIncome(id) {
      this.$store.dispatch("income/getIncome", id);
    }
  },
  watch: {
    pagination: {
      handler() {
        this.$store.commit("income/pagination", this.pagination);
        this.$store.dispatch("income/getIncomes");
      },
      deep: true
    }
  }
};
</script>
