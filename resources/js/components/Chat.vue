<template>
  <v-app>
    <v-container fuid>

      <NavBar></NavBar>

      <v-card max-width='800'>

      <v-list-item v-for='(friend, i) of friends' :key='i' @click='get_chat( friend.id )' >

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

          <v-timeline-item v-for="(n, i) in chat" :key="i" large >

            <template v-slot:icon>

              <v-avatar>
                  <img :src=' n.to === `"${me.id}"`  ? `storage/avatars/${n.to}.jpg`  : `storage/avatars/${n.from}.jpg` '>
              </v-avatar>

            </template>

            <template v-slot:opposite>
                <span> {{ }} </span>
            </template>

            <v-card class="elevation-2" :color='  n.to === me.id  ? `orange`  : `green`  '>
              <v-card-title class="headline">{{ n.message }}</v-card-title>
            </v-card>

          </v-timeline-item>

      </v-timeline>

      <v-card-actions>
          <v-text-field color='green' v-model='text_message' placeholder='Type new message'></v-text-field>
          <v-btn icon style='cursor:pointer;'> <v-icon color='green' @click='send_message()'> fa fa-send </v-icon> </v-btn>
      </v-card-actions>

      </v-card>



    </v-container>
    </v-app>
</template>
<script>

import NavBar from './NavBar'

import store from '../store/index.js'

import { mapState, mapMutations, mapActions, mapGetters } from 'vuex'



import Echo from 'laravel-echo';

window.Pusher = require('pusher-js');

window.Echo = new Echo({

broadcaster : 'pusher',
key : 'd9461b0680b177d5911e',
cluster : 'ap3',
encrypted: true

});

export default {

    store: store,

    data(){

        return {

            active_chat: null,

            friends: [],

            chat: [],

            text_message: null

        }
    },

     computed: {

         ...mapState( ['me'] ),

    },

    methods: {

        get_chat(e){ this.active_chat = e;  axios.post('messages', { id: e } ).then( res =>{ this.chat = res.data; console.log( res.data ) } ) },

        send_message(){ /* console.log( { to: this.active_chat, text: this.text_message } ); */
            axios.post('sendMessage',  { to: this.active_chat, text: this.text_message }  ).then( res => { console.log(res.data); } );
        },

        add_message(message){ this.chat.push(message.message) }

     },

    components: { NavBar },



    created() {

              store.dispatch('getUser')
              axios.get('get_related').then( res => { this.friends = res.data } );

             window.Echo.channel('chat').listen('sendMessage',  e  => { this.add_message(e) } )
    },


}
</script>
