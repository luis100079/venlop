<template>
  <v-app>

      <NavBar></NavBar>

      <v-container style='margin-top: -50px ;'>

      <v-list v-for='(user, index) of users' :key='index'>

        <v-list-item @click='go(user.id)'>

          <v-list-item-avatar size='80'>
            <img :src=" Number(user.avatar) === 0 ? 'storage/avatars/men/sample_1.png' : 'storage/avatars/'+user.id+'.jpg' ">
          </v-list-item-avatar>

          <v-list-item-content>
            <v-breadcrumbs :items="[{text: user.name}, {text: user.profession}]" :divider=' user.profession !== null ? "/" : "" '> </v-breadcrumbs>
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

            window.location.href = 'user?id=' + id

        },



    },

     created(){

         axios.post('api/search', this.data).then( res => { this.users = res.data; } );

        }

}
</script>
