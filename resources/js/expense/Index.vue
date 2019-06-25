<template>
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
</template>

<script>
export default {
  data()
};
</script>
