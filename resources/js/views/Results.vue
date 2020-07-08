<template>
  <v-app>

      <NavBar></NavBar>

      <v-container>

      <v-list v-for='(user, index) of users' :key='index'>

        <v-list-item @click='go(user.id)'>

          <v-list-item-avatar size='80'>
            <img :src='"storage/avatars/"+user.id+".jpg"' >
          </v-list-item-avatar>

          <v-list-item-content>
          {{ user.name }} /  {{ user.height }} from {{ user.country }}
          </v-list-item-content>

        </v-list-item>

      </v-list>


    </v-container>
  </v-app>
</template>

<script>
import NavBar from '../components/NavBar'
import store from '../store/index.js'

import  { mapState, mapMutations, mapActions, mapGetters } from 'vuex'


export default {

    components: { NavBar },

    data(){
        return {
            data: {value: this.$route.query.name},
            users: [ ],
            s: null

        }
    },

    methods: {
        go(id){

            window.location.href = 'users?id=' + id

        },



    },

     created(){

         axios.post('api/search', this.data).then( res => {this.users = res.data } );

        }

}
</script>
