import Vue from 'vue'
import Vuex from 'vuex'
import alert from './module/alert'
import auth from './module/auth'
import dialog from './module/dialog'
import transaction from './module/transaction'



Vue.use(Vuex)

export default new Vuex.Store({
    modules: {
        transaction,
        alert,
        auth,
        dialog

    }

})
