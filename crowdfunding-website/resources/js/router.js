import Vue from "vue";
import Router from "vue-router";

Vue.use(Router)

const router = new Router({
    mode: 'history',
    routes: [
        {
            path: '/',
            name: 'home',
            alias: '/home',
            component: () =>  import('./views/Home.vue')
        },
        {
            path: '*',
            redirect: '/'
        }
    ]
});

export default router
