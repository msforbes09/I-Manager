require("./bootstrap");

Vue.component("expense", require("./pages/Expense.vue").default);

const app = new Vue({
    el: "#app"
});
