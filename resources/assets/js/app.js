
require('./bootstrap');
import VueRouter from 'vue-router';
import router from './routes';
 
window.Vue = require('vue');
Vue.use(VueRouter);
 
//Vue.component('example', require('./components/Example.vue'));-->
Vue.component('Task', require('./components/Task.vue'));
 
const app = new Vue({
    el: '#app',
    router
});