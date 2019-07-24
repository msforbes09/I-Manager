import Vue from 'vue'
import Vuex from 'vuex'
import Error from './../helper/Error'

Vue.use(Vuex)

export default new Vuex.Store({
    state: {
        alert: {},
        showAlert: false,
        error: new Error(),
        date: new Date().toISOString().substr(0, 10),
        drawer: true,
        loading: false,
        user: {},
        token: localStorage.getItem('access_token') || null,
        incomes: {},
        income: {},
        showIncome: false,
        createIncome: false,
        expenses: {},
        showDailyExpenses: false,
        dailyExpenses: [],
        expense: {},
        showExpense: false,
        searchedExpenses: {},
        showSearchedExpenses: false,
        createExpense: false,
        pagination: null
    },
    mutations: {
        alert(state, payload) {
            state.alert = payload
            state.showAlert = true
        },
        showAlert(state, payload) {
            state.showAlert = payload
        },
        drawer(state, payload) {
            state.drawer = payload
        },
        setToken(state, token) {
            state.token = token
        },
        loading(state, payload) {
            state.loading = payload
        },
        setUser(state, payload) {
            state.user = payload
        },
        incomes(state, payload) {
            state.incomes = payload
        },
        income(state, payload) {
            state.income = payload
        },
        showIncome(state, payload) {
            state.showIncome = payload
        },
        createIncome(state, payload) {
            state.createIncome = payload
        },
        expenses(state, payload) {
            state.expenses = payload
        },
        showDailyExpenses(state, payload) {
            state.showDailyExpenses = payload
        },
        dailyExpenses(state, payload) {
            state.dailyExpenses = payload
        },
        date(state, payload) {
            state.date = payload
        },
        expense(state, payload) {
            state.expense = payload
        },
        showExpense(state, payload) {
            state.showExpense = payload
        },
        searchedExpenses(state, payload) {
            state.searchedExpenses = payload
        },
        showSearchedExpenses(state, payload) {
            state.showSearchedExpenses = payload
        },
        createExpense(state, payload) {
            state.createExpense = payload
        },
        pagination(state, payload) {
            state.pagination = payload
        }
    },
    actions: {
        login(context, credential) {
            context.commit('loading', true)
            axios
                .post('/api/login', credential)
                .then(res => {
                    const token = res.data.access_token
                    localStorage.setItem('access_token', token)
                    context.commit('setToken', token)
                    router.push({ name: 'home' })
                    context.commit('alert', { message: 'Successfully logged in.', color: 'blue' })
                })
                .finally(() => {
                    context.commit('loading', false)
                })
        },
        logout(context) {
            axios.post('api/logout').then(res => {
                context.dispatch('clearToken')
                router.push({ name: 'login' })
            })
        },
        clearToken(context) {
            localStorage.removeItem('access_token')
            context.commit('setToken', null)
            router.push({ name: 'login' })
        },
        getSummary(context) {
            context.commit('loading', true)
            axios.get('/api/summary').then(res => {
                context.commit('setUser', res.data)
                context.commit('loading', false)
            })
        },
        getIncomes(context, pagination) {
            context.commit('loading', true)
            axios.post('/api/income', pagination).then(res => {
                context.commit('incomes', res.data)
                context.commit('loading', false)
                context.commit('pagination', pagination)
            })
        },
        showIncome(context, id) {
            context.commit('loading', true)
            axios.get('/api/income/' + id).then(res => {
                context.commit('loading', false)
                context.commit('income', res.data)
                context.commit('showIncome', true)
            })
        },
        storeIncome(context, income) {
            context.commit('loading', true)
            axios
                .post('/api/income/store', income)
                .then(res => {
                    context.commit('createIncome', false)
                    context.dispatch('getIncomes', context.getters.pagination)
                    context.getters.error.reset()
                })
                .finally(() => {
                    context.commit('loading', false)
                })
        },
        getExpenses(context, pagination) {
            context.commit('loading', true)
            axios.post('/api/expense', pagination).then(res => {
                context.commit('expenses', res.data)
                context.commit('loading', false)
                context.commit('pagination', pagination)
            })
        },
        getDailyExpenses(context, date) {
            context.commit('loading', true)
            axios.get('/api/expense/date/' + date).then(res => {
                context.commit('loading', false)
                context.commit('showDailyExpenses', true)
                context.commit('dailyExpenses', res.data)
                context.commit('date', date)
            })
        },
        getExpense(context, id) {
            context.commit('loading', true)
            axios.get('/api/expense/' + id).then(res => {
                context.commit('loading', false)
                context.commit('expense', res.data)
                context.commit('showExpense', true)
            })
        },
        searchExpenses(context, pagination) {
            context.commit('loading', true)
            axios.post('/api/expense/search', pagination).then(res => {
                context.commit('loading', false)
                context.commit('searchedExpenses', res.data)
            })
        },
        storeExpense(context, expense) {
            context.commit('loading', true)
            axios
                .post('/api/expense/store', expense)
                .then(res => {
                    context.commit('createExpense', false)
                    context.dispatch('getExpenses', context.getters.pagination)
                    context.getters.error.reset()
                    context.dispatch('getDailyExpenses', expense.date)
                })
                .finally(() => {
                    context.commit('loading', false)
                })
        }
    },
    getters: {
        alert(state) {
            return state.alert
        },
        showAlert(state) {
            return state.showAlert
        },
        loggedIn(state) {
            return state.token !== null
        },
        token(state) {
            return state.token
        },
        loading(state) {
            return state.loading
        },
        user(state) {
            return state.user
        },
        incomes(state) {
            return state.incomes
        },
        income(state) {
            return state.income
        },
        showIncome(state) {
            return state.showIncome
        },
        createIncome(state) {
            return state.createIncome
        },
        expenses(state) {
            return state.expenses
        },
        showDailyExpenses(state) {
            return state.showDailyExpenses
        },
        dailyExpenses(state) {
            return state.dailyExpenses
        },
        date(state) {
            return state.date
        },
        expense(state) {
            return state.expense
        },
        showExpense(state) {
            return state.showExpense
        },
        searchedExpenses(state) {
            return state.searchedExpenses
        },
        showSearchedExpenses(state) {
            return state.showSearchedExpenses
        },
        createExpense(state) {
            return state.createExpense
        },
        error(state) {
            return state.error
        },
        pagination(state) {
            return state.pagination
        }
    }
})
