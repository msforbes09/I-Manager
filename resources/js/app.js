require('./bootstrap')

import store from './store'

Vue.component('expense', require('./pages/Expense.vue').default)
Vue.component('income', require('./income/Index.vue').default)

const app = new Vue({
    store,
    el: '#app',
    data: {
        drawer: null
    }
})
