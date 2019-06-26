require('./bootstrap')

import store from './store/index'

Vue.component('income', require('./view/income/Index.vue').default)
Vue.component('expense', require('./view/expense/Index.vue').default)

const app = new Vue({
    store,
    el: '#app',
    data: {
        drawer: null
    }
})
