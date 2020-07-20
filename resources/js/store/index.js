import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

export default new Vuex.Store({

  state: {

    me: []


  },

  mutations: {

      fillData(state, data){

          state.me = data


      }

  },
  actions: {

    getUser: function({ commit }){ axios.post('api/user').then( res => commit('fillData', res.data) ) }

  },
  modules: {
  }

})
