import VueRouter from 'vue-router';
import Task from './components/Task.vue';
import Profile from './components/Profile.vue';
import Product from './components/Product.vue';
 
 
let routes = [
   

    {
        path: '/',
        component: Task
    },
    {
        path: '/profile',
        component: Profile
    },
    {
        path: '/product',
        component: Product
    }




];
 
 
export default new VueRouter({
    routes
});