<template>
  <v-app>

      <NavBar></NavBar>

      <v-container fuid>


      <v-dialog max-width='600'>

        <template v-slot:activator="{ on, attrs }">


      <v-row>

      <v-col align='center'>



      <v-card max-width='800'>

      <v-list-item v-for='(friend, i) of friends' :key='i' @click='get_chat( friend.id )'  v-bind="attrs"
          v-on="on">

        <v-list-item-avatar>
            <v-img :src='`storage/avatars/${ friend.id }.jpg`'></v-img>
        </v-list-item-avatar>

        <v-list-item-content>
          <v-list-item-title > {{ friend.name }} </v-list-item-title>
        </v-list-item-content>



        <v-list-item-icon>
            <v-icon color='green'>chat_bubble</v-icon>
        </v-list-item-icon>

      </v-list-item>

      </v-card>

      </v-col>

      </v-row>

      </template>





        <v-card max-width='600'>

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


      </v-dialog>


    </v-container>
    </v-app>
</template>
<script>

import NavBar from '../components/NavBar'

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

            text_message: null,

            pending: { }

        }
    },

     computed: {

         ...mapState( ['me'] ),

    },

    methods: {

        get_chat(e){ this.active_chat = e;  axios.post('api/messages', { id: e } ).then( res =>{ this.chat = res.data; } ) },

        send_message(){ /* console.log( { to: this.active_chat, text: this.text_message } ); */

            axios.post('api/sendMessage',  { to: this.active_chat, text: this.text_message }  ).then( res => { console.log(res.data);  this.chat.push( {message: this.text_message, from: this.me.id, to:this.active_chat} ) } );

        },

        add_message(message){
                                if( this.active_chat === message.message.from || this.active_chat === message.message.to ){

                                  this.chat.push(message.message)

                                }

                            },

     },

    components: { NavBar },

    created() {

             store.dispatch('getUser');
             axios.post('api/user').then( res => {   window.Echo.private('chat.'+ res.data.id ).listen('sendMessage',  e  => { this.add_message(e) } ) } );
             axios.post('api/get_related').then( res => { this.friends = res.data; } );

    },


}
</script>
