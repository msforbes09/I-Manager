import Vue from 'vue'
import Router from 'vue-router'

import Home from './view/Home.vue'
import Report from './view/Report.vue'
import Income from './view/income/Index.vue'
import Expense from './view/expense/Index.vue'
import Login from './view/auth/Login.vue'
import None from './components/404.vue'

Vue.use(Router)

const routes = [
    {
        path: '/login',
        name: 'login',
        component: Login,
        meta: {
            requiresVisitor: true
        }
    },
    {
        path: '/',
        name: 'home',
        component: Home,
        meta: {
            requiresAuth: true
        }
    },
    {
        path: '/summary',
        name: 'summary',
        component: Report,
        meta: {
            requiresAuth: true
        }
    },
    {
        path: '/income',
        name: 'income',
        component: Income,
        meta: {
            requiresAuth: true
        }
    },
    {
        path: '/expense',
        name: 'expense',
        component: Expense,
        meta: {
            requiresAuth: true
        }
    },
    { path: '/*', name: '404', component: None }
]

const router = new Router({
    mode: 'history',
    routes
})

router.beforeEach((to, from, next) => {
    if (to.matched.some(record => record.meta.requiresAuth)) {
        if (!store.getters.loggedIn) {
            next({
                name: 'login'
            })
        } else {
            next()
        }
    } else if (to.matched.some(record => record.meta.requiresVisitor)) {
        if (store.getters.loggedIn) {
            next({
                name: 'home'
            })
        } else {
            next()
        }
    } else {
        next()
    }
})

export default router
