<template>
  <v-app>
    <v-container fuid>

      <NavBar></NavBar>

      <v-card max-width='800'>

      <v-list-item v-for='(friend, i) of friends' :key='i' @click='get_chat( friend.id )'>

        <v-list-item-avatar>
            <v-img :src='`storage/avatars/${ friend.id }.jpg`'></v-img>
        </v-list-item-avatar>

        <v-list-item-content>
          <v-list-item-title > {{ friend.name }}_{{ friend.id }} </v-list-item-title>
        </v-list-item-content>

        <v-list-item-icon>
            <v-icon color='green'>chat_bubble</v-icon>
        </v-list-item-icon>

      </v-list-item>

      </v-card>

        <v-card max-width='500'>

        <v-timeline max-width='500'>

          <v-timeline-item
                v-for="(n, i) in chat"
                :key="i"
                large
          >

            <template v-slot:icon>

              <v-avatar>
                  <img :src=' n.to === "1"  ? `storage/avatars/${n.to}.jpg`  : `storage/avatars/${n.from}.jpg` '>
              </v-avatar>

            </template>

            <template v-slot:opposite>
                <span> {{ }} </span>
            </template>

            <v-card class="elevation-2" :color='  n.to === 1  ? `orange`  : `green`  '>
              <v-card-title class="headline">{{ n.message }}</v-card-title>
            </v-card>

          </v-timeline-item>

      </v-timeline>

      <v-card-actions>
          <v-text-field color='green' placeholder='Type new message'></v-text-field>
          <v-button icon style='cursor:pointer;'> <v-icon color='green'> fa fa-send </v-icon> </v-button>
      </v-card-actions>

        </v-card>



    </v-container>
    </v-app>
</template>
<script>

import NavBar from './NavBar'
import store from '../store/index.js'
import  { mapState, mapMutations, mapActions, mapGetters } from 'vuex'


export default {

    stote: store,

    data(){
        return {

            friends: [],

            chat: null,



        }
    },

    methods: {

        get_chat(e){ axios.post('messages', { id: e }).then( res =>{ this.chat = res.data  } ) }

     },

    components: { NavBar },

    computed: {

         ...mapState( ['me'] ),

    },

    created() {

             axios.get('get_related').then( res => { this.friends = res.data } );

    }


}
</script>
