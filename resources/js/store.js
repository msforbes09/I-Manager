import Vue from 'vue'
import Vuex from 'vuex'

import income from './income/store'
import expense from './expense/store'

Vue.use(Vuex)

export default new Vuex.Store({
    modules: {
        income,
        expense
    }
})
