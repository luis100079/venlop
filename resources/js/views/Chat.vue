<template>

  <v-container fuid>

    <v-dialog v-model='chat_dialog' max-width='600' fullscreen hide-overlay transition="dialog-bottom-transition">

      <template v-slot:activator="{ on, attrs }">

      <v-row>

      <v-col align='center'>


      <v-card max-width='800'>

        <v-card-title class='justify-center'>
            <v-icon color='green accent-3'>fa fa-group</v-icon>
            <v-btn color='black' text>Known People</v-btn>
        </v-card-title>

        <v-list-item v-for='(friend, i) of friends' :key='i' @click='get_chat( friend.id )'  v-bind="attrs" v-on="on">

        <v-list-item-avatar>
            <v-img :src="Number(friend.avatar) === 0 ? 'storage/avatars/men/sample_1.png' : 'storage/avatars/'+friend.id+'.jpg' "></v-img>
        </v-list-item-avatar>

        <v-list-item-content>
          <v-list-item-title> {{ friend.name }} </v-list-item-title>
        </v-list-item-content>

        <v-list-item-icon>
            <v-icon large color='yellow'>chat_bubble</v-icon>
        </v-list-item-icon>


      </v-list-item>

      </v-card>

      </v-col>

      </v-row>

      </template>



        <v-card max-width='600' id='chat_card'  style='background:#E0FFFF'>

          <v-app-bar dark color="black" fixed>

            <v-btn icon dark @click="chat_dialog = false; chat = [] ">
              <v-icon>mdi-close</v-icon>
            </v-btn>

            <v-toolbar-title>Chat</v-toolbar-title> <v-spacer></v-spacer> <v-icon color='#E0FFFF'>chat_bubble</v-icon>

          </v-app-bar>


          <div>

            <div class="mb-12">.</div>

            <div class="mb-12">.</div>


            <div v-for="(n, i) in chat" :key="i" :class=' n.to === me.id ? "d-flex justify-start" : "d-flex justify-end" '>

                <v-card class='my-3 ml-6 mr-6' :color='n.to === me.id ? "orange"  : "#32CD32" '>
                  <v-card-text class='white--text'>{{ n.message }} </v-card-text>
                </v-card>

            </div>

             <div class="my-12 ">.</div>

            <div class="my-12">.</div>

          </div>

      <v-bottom-navigation dark color='black' fixed>

          <v-text-field id='message_input' color='green' v-model='text_message' placeholder='Type new message' @keyup.enter='send_message(); $event.target.value="" '></v-text-field>
          <v-btn icon style='cursor:pointer;'> <v-icon color='green' @click='send_message(); ' > fa fa-send </v-icon> </v-btn>

      </v-bottom-navigation>

        </v-card>




      </v-dialog>

    </v-container>


</template>
<script>

import store from '../store/index.js'

import { mapState, mapMutations, mapActions, mapGetters } from 'vuex'

export default {

    store: store,

    data(){

        return {

            active_chat: null,

            friends: [],

            chat: [],

            text_message: null,

            sub_message: null,

            pending: { },

            chat_dialog: false,

        }
    },

     computed: {

         ...mapState( ['me'] ),

    },

    methods: {



        get_chat(e){ this.active_chat = e;
                     axios.post('api/messages', { id: e } ).then( res =>{ this.chat = res.data; } );
                     axios.post('api/read_messages', { fiend: e } ).then( res =>{ console.log(res.data); } );

                       },

        send_message(){

            this.sub_message = this.text_message;

            this.text_message = "";

            document.getElementById('chat_card').scrollIntoView(false)

            this.chat.push(  {message: this.sub_message, to:this.active_chat, from:this.me.id } );

            axios.post('api/sendMessage',  { to: this.active_chat, text: this.sub_message }  );

        },

        add_message(message){

                        if( this.active_chat == message.message.from || this.active_chat == message.message.to ){ this.chat.push(message.message); document.getElementById('chat_card').scrollIntoView(false) }

                            },

     },

    created() {

             store.dispatch('getUser');

             axios.post('api/user').then( res => {   window.Echo.private('chat.'+ res.data.id ).listen('sendMessage',  e  => { this.add_message(e); } ) } );

             axios.post('api/get_related').then( res => { this.friends = res.data; } );

             if( this.$route.query.with != undefined ){

                this.active_chat = this.$route.query.with;

                axios.post('api/messages', { id: this.$route.query.with } ).then( res =>{ this.chat = res.data; this.chat_dialog = true; } )

              }

    },


}

</script>
