import Vue from 'vue'
import Router from 'vue-router'

import Home from './view/Home.vue'
import Report from './view/Report.vue'
import Income from './view/income/Index.vue'
import Expense from './view/expense/Index.vue'
import None from './components/404.vue'

Vue.use(Router)

const routes = [
    { path: '/', name: 'home', component: Home },
    { path: '/summary', name: 'summary', component: Report },
    { path: '/income', name: 'income', component: Income },
    { path: '/expense', name: 'expense', component: Expense },
    { path: '/*', name: '404', component: None }
]

const router = new Router({
    mode: 'history',
    routes,
    linkActiveClass: 'blue'
})

export default router
