/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

import moment from 'moment';
import { Form, HasError, AlertError } from 'vform';
import Swal from 'sweetalert2';



window.swal = Swal;

const Toast = swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000,
    // timerProgressBar: true,
    // onOpen: (toast) => {
    //     toast.addEventListener('mouseenter', Swal.stopTimer)
    //     toast.addEventListener('mouseleave', Swal.resumeTimer)
    // }
})
window.toast = Toast;


window.Form = Form;
Vue.component(HasError.name, HasError)
Vue.component(AlertError.name, AlertError)

import VueRouter from 'vue-router'
Vue.use(VueRouter)


import Chartkick from 'vue-chartkick'
import Chart from 'chart.js'
 
Vue.use(Chartkick.use(Chart))


import VueProgressBar from 'vue-progressbar'
Vue.use(VueProgressBar, {
    color: 'rgb(143, 255, 199)',
    failedColor: 'red',
    height: '3px'
})




const routes = [
    { path: '/dashboard', component: require('./components/Dashboard.vue').default },
    { path: '/device', component: require('./components/Device.vue').default },
    { path: '/profile', component: require('./components/Profile.vue').default },
    { path: '/user_devices/:deviceId', component: require('./components/UserDevices.vue').default },
    { path: '/*', component: require('./components/Error.vue').default }
]

const router = new VueRouter({
    mode: 'history',
    routes // short for `routes: routes`
})

Vue.filter('textUpper', function (text) {
    return text.charAt(0).toUpperCase() + text.slice(1)
})

Vue.filter('cutDate', function (date) {
    return moment(date).format("MMM Do YYYY");
})

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))



// Vue.component(
//     'passport-clients',
//     require('./components/passport/Clients.vue').default
// );

// Vue.component(
//     'passport-authorized-clients',
//     require('./components/passport/AuthorizedClients.vue').default
// );

// Vue.component(
//     'passport-personal-access-tokens',
//     require('./components/passport/PersonalAccessTokens.vue').default
// );

Vue.component('error-404', require('./components/Error.vue').default);

Vue.component('pagination', require('laravel-vue-pagination'));


let Fire = new Vue();
window.Fire = Fire;


Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    router,
    data() {
        return {
            query: ""
        }
    },
    methods: {
        search: _.debounce(() => {
            Fire.$emit('searching');
        }, 1000),
        printme() {
            window.print();
        }
    },
});
