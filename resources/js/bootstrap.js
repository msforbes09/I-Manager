window._ = require('lodash')
window.axios = require('axios')
window.Vue = require('vue')

import 'vuetify/dist/vuetify.min.css'
import Vuetify from 'vuetify'

import store from './store/index'
import router from './router'
window.store = store
window.router = router

Vue.use(Vuetify)

axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest'
axios.defaults.headers.common['Authorization'] = 'Bearer ' + store.getters.token

window.axios.interceptors.response.use(
    function(response) {
        if (response.data.message) store.commit('alert', { message: response.data.message, color: 'blue' })
        return response
    },
    function(error) {
        if (error.response) {
            if (error.response.status === 401) {
                store.dispatch('clearToken')
                store.commit('loading', false)
            } else if (error.response.status === 422) {
                store.state.error.record(error.response.data.errors)
            } else {
                store.commit('alert', { message: error.message, color: 'red' })
            }
            console.log(error.response)
        } else if (error.request) {
            console.log(error.request)
        } else {
            console.log('Error', error.message)
        }
        // console.log(error.config)
        return Promise.reject(error)
    }
)
