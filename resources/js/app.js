// require('./bootstrap');

window.Vue = require('vue');

// Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('notification', require('./components/Notification.vue').default);

const app = new Vue({
    el: '#app'
});
