export default {
    namespaced: true,
    state: {
        alert: {},
        incomes: [],
        income: {},
        loading: false,
        pagination: {
            descending: true,
            sortBy: 'date'
        },
        showIncome: false
    },
    mutations: {
        alert(state, payload) {
            state.alert = payload
            setTimeout(() => (state.alert = {}), 5000)
        },
        income(state, payload) {
            state.income = payload
        },
        incomes(state, payload) {
            state.incomes = payload
        },
        loading(state) {
            state.loading = !state.loading
        },
        pagination(state, payload) {
            state.pagination = payload
        },
        showIncome(state) {
            state.showIncome = !state.showIncome
        }
    },
    actions: {
        getIncome(state, payload) {
            state.commit('loading')
            axios.get(`/${Prefix}/income/${payload}`).then(res => {
                state.commit('income', res.data)
                state.commit('loading')
                state.commit('showIncome')
            })
        },
        getIncomes(state, payload) {
            state.commit('loading')
            axios.post(`/${Prefix}/income`, state.state.pagination).then(res => {
                state.commit('incomes', res.data)
                state.commit('loading')
            })
        },
        store(state, payload) {
            return new Promise(function(resolve, reject) {
                axios
                    .post(`/${Prefix}/income/store`, payload)
                    .then(res => {
                        state.commit('alert', {
                            message: res.data.message,
                            status: true
                        })
                        state.dispatch('getIncomes')
                        resolve(res)
                    })
                    .catch(err => {
                        reject(err)
                    })
            })
        }
    }
}
