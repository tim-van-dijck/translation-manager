import Vue from 'vue';
import Vuex from 'vuex';
import Router from 'vue-router';
import routes from './routes';
import Navbar from "./components/partials/Navbar";
import {translations} from "./modules/translations";

require('./bootstrap');

Vue.use(Router);
Vue.use(Vuex);

let trans = {};
let locale = document.documentElement.lang;
axios.get(`/system/translations/${locale}`)
    .then((response) => {
        trans = response.data
    });

Vue.filter('capitalize', function (value) {
    if (!value) {
        return '';
    }
    value = value.toString();
    return value.charAt(0).toUpperCase() + value.slice(1);
});
Vue.filter('translate', function (value) {
    if (!value) {
        return '';
    }
    return trans.hasOwnProperty(value) ? trans[value] : value;
});

const store = new Vuex.Store({
    modules: {translations},
    state: {user: {}}
});

let router = new Router({routes});
router.beforeEach((to, from, next) => {
    if (to.hasOwnProperty('meta') && to.meta.hasOwnProperty('title')) {
        document.title = to.meta.title;
    }
    next();
});

const vm = new Vue({
    el: '#app',
    router,
    store,
    components: {Navbar}
});