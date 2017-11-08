import Vue from 'vue'
import Vuex from 'vuex'
import AuthUser from './modules/auth-user'
import login from './modules/Login'
Vue.use(Vuex)
export default new Vuex.Store({
  modules : {
    AuthUser,
    login
  }
})
