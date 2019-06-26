import Vue from 'vue'
import Vuex from 'vuex'

import income from './module/income'
import expense from './module/expense'

Vue.use(Vuex)

export default new Vuex.Store({
    modules: {
        income,
        expense
    }
})
