export default {
    namespaced: true,
    state: {
        activeDate: null,
        alert: '',
        expense: {},
        expensesDaily: [],
        expenses: {},
        loading: false,
        pagination: {},
        showCreate: false,
        showDaily: false,
        showExpense: false
    },
    mutations: {
        activeDate(state, payload) {
            state.activeDate = payload
        },
        alert(state, payload) {
            state.alert = ''
            state.alert = payload
        },
        expense(state, payload) {
            state.expense = payload
        },
        expensesDaily(state, payload) {
            state.expensesDaily = payload
        },
        expenses(state, payload) {
            state.expenses = payload
        },
        loading(state) {
            state.loading = !state.loading
        },
        pagination(state, payload) {
            state.pagination = payload
        },
        showCreate(state, payload) {
            state.showCreate = payload
        },
        showDaily(state, payload) {
            state.showDaily = payload
        },
        showExpense(state, payload) {
            state.showExpense = payload
        }
    },
    actions: {
        getDaily(state, payload) {
            state.commit('loading')
            axios.get(`/${Prefix}/expense/date/${payload}`).then(res => {
                state.commit('expensesDaily', res.data)
                state.commit('showDaily', true)
                state.commit('loading')
            })
        },
        getExpense(state, payload) {
            return new Promise(function(resolve, reject) {
                state.commit('loading')
                axios.get(`/${Prefix}/expense/${payload}`).then(res => {
                    state.commit('loading')
                    resolve(res)
                })
            })
        },
        getExpenses(state) {
            state.commit('loading')
            axios.post(`/${Prefix}/expense`, state.state.pagination).then(res => {
                state.commit('expenses', res.data)
                state.commit('loading')
            })
        },
        search(state, payload) {
            return new Promise(resolve => {
                axios.post(`/${Prefix}/expense/search`, payload).then(res => {
                    resolve(res.data)
                })
            })
        },
        store(state, payload) {
            return new Promise((resolve, reject) => {
                axios
                    .post(`/${Prefix}/expense/store`, payload)
                    .then(res => {
                        state.dispatch('getExpenses')
                        state.commit('activeDate', payload.date)
                        resolve(res)
                    })
                    .catch(err => {
                        reject(err)
                    })
            })
        }
    }
}
