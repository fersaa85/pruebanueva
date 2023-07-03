/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue').default;

import VueRouter from 'vue-router';
Vue.use(VueRouter);

import { BootstrapVue, IconsPlugin } from 'bootstrap-vue';

// Import Bootstrap and BootstrapVue CSS files (order is important)
import 'bootstrap/dist/css/bootstrap.css';
import 'bootstrap-vue/dist/bootstrap-vue.css';

// Make BootstrapVue available throughout your project
Vue.use(BootstrapVue);
// Optionally install the BootstrapVue icon components plugin
Vue.use(IconsPlugin);

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

import FormComponent from './components/FormComponent.vue';
import EmployeeComponent from './components/EmployeeComponent.vue';
import DetailComponent from './components/DetailComponent.vue';


import * as VueGoogleMaps from 'vue2-google-maps';

Vue.use(VueGoogleMaps, {
    load: {
        key: 'AIzaSyADKylKUVLsgtYnHSHo0RI5GlC0Nf9PDu8',
        libraries: 'places', // This is required if you use the Autocomplete plugin
    },
    installComponents: true
});

import datePicker from 'vue-bootstrap-datetimepicker';
import 'bootstrap/dist/css/bootstrap.css';
import 'pc-bootstrap4-datetimepicker/build/css/bootstrap-datetimepicker.css';
Vue.use(datePicker);

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('form-component', require('./components/FormComponent.vue').default);
Vue.component('employee-component', require('./components/EmployeeComponent.vue').default);
Vue.component('detail-component', require('./components/DetailComponent.vue').default);

var router = new VueRouter({
    routes: [

        {
            path: '/',
            name: '/',
            component: FormComponent,
            meta: { scrollToTop: true }
        },
        {
            path: '/empleados',
            name: '/empleados',
            component: EmployeeComponent,
            meta: { scrollToTop: true }
        },
        {
            path: '/empleado/:email',
            name: 'detallempleados',
            component: DetailComponent,
            meta: { scrollToTop: true }
        },

    ]});





/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    router: router,
    linkActiveClass: "active",
    linkExactActiveClass: "exact-active",
});
