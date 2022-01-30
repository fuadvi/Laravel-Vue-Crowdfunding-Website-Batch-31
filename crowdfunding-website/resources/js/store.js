import Vue from 'vue'
import Vuex from 'vuex'
import VuexPersistence from 'vuex-persist'
import alert from './module/alert'
import auth from './module/auth'
import dialog from './module/dialog'
import transaction from './module/transaction'

const vuexPersistence = new VuexPersistence({
    key: "myApp",
    storage : localStorage
})


Vue.use(Vuex)

export default new Vuex.Store({
    plugins: [vuexPersistence.plugin],
    modules: {
        transaction,
        alert,
        auth,
        dialog
    }

})
