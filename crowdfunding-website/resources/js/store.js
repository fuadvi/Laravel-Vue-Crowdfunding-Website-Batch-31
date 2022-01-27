import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

export default new Vuex.Store({
    state: {
        transaction: 1
    },
    mutations: {
        insert (state) {
        state.transaction++
        }
    },
    actions: {

    },
    getters: {
        transaction : state => state.transaction
    }

})
