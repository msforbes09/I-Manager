// window._ = require('lodash');
window.axios = require('axios')
window.Vue = require('vue')

window.Prefix = process.env.MIX_API
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest'

import 'vuetify/dist/vuetify.min.css'
import Vuetify from 'vuetify'

Vue.use(Vuetify)

let token = document.head.querySelector('meta[name="csrf-token"]')

if (token) {
    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content
} else {
    console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token')
}
