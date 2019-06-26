require('./bootstrap')
import store from './store/index'
import router from './router'
import App from './App.vue'

new Vue({
    router,
    store,
    render: h => h(App)
}).$mount('#app')
