import Vue from "vue";
import router from './router.js'
import App from './App.vue'
import vuetify from './plugins/vuetify.js'
import './bootstrap.js'
import Vuex from 'vuex';

Vue.use(Vuex);

const store = new Vuex.Store({
    state: {
        counter: 0
    },
    mutations: {
        increment (state) {
            state.count++
        }
    }
});


const app = new Vue({
    el: '#app',
    router,
    vuetify,
    store,
    components: {
        App
    },
    computed: {
        counter() {
            return store.state.counter
         }
    },
    methods: {
        increment() {
            store.commit('increment')
        }
    }
});
