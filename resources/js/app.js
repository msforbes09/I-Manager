require("./bootstrap");

Vue.component("expense", require("./pages/Expense.vue").default);
Vue.component("income", require("./pages/Income.vue").default);

const app = new Vue({
    el: "#app",
    data: {
        drawer: null
    }
});
