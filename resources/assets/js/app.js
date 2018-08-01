
require('./bootstrap');
import VueRouter from 'vue-router';
import router from './routes';
import Product from './components/Product.vue';


 
window.Vue = require('vue');
Vue.use(VueRouter);

 
//Vue.component('example', require('./components/Example.vue'));-->
Vue.component('Task', require('./components/Task.vue'));
//vue.component('Product',require('./components/Product.vue'));
 
const app = new Vue({
    el: '#app',
    router,
     components: {
      Product
     }
    

});
  
   