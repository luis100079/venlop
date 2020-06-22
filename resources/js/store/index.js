import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

export default new Vuex.Store({

  state: {
    me: null
  },
  mutations: {

      fullData(state, data){
          state.me = data
      }

  },
  actions: {
    getUser: function({ commit }){ axios.post('api/user').then( res => commit('fullData', res.data) ) }
  },
  modules: {
  }

})
