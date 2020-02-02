import Vue from 'vue';
import Vuex from 'vuex';
import Router from 'vue-router';
import routes from './routes';

require('./bootstrap');

Vue.use(Router);
Vue.use(Vuex);

Vue.filter('capitalize', function (value) {
    if (!value) {
        return '';
    }
    value = value.toString();
    return value.charAt(0).toUpperCase() + value.slice(1);
});

const store = new Vuex.Store({
    modules: {},
    state: {user: {}}
});

let router = new Router({routes});
router.beforeEach((to, from, next) => {
    if (to.hasOwnProperty('meta') && to.meta.hasOwnProperty('title')) {
        document.title = to.meta.title;
    }
    next()
});

const vm = new Vue({
    el: '#app',
    router,
    store
});