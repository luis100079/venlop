<template>

<div class='my-8'>

    <v-app-bar color='grey darken-3' dark fixed>

      <v-app-bar-nav-icon @click='drawer = true' color='purple lighten-2'></v-app-bar-nav-icon>

        <form method='get' action='/results'>
          <v-text-field color='green' name='name' placeholder='search'  prepend-icon="search" v-model='data.value' @keyup='search()' :class=' mobile ? "ml-12" : "ml-1" '></v-text-field >
        </form>

        <v-spacer></v-spacer>

      <div v-show='mobile'>

      <v-btn icon href='/home' class='mr-12'>
        <v-icon color='green' >home</v-icon>
      </v-btn>


      <v-btn icon href='/notifications' class='mr-12'>
        <v-icon :color='notify.color' v-text='notify.icon'></v-icon>
        <audio id='notify' src='/storage/sounds/pristine.mp3'></audio>
      </v-btn>

      <v-btn icon href="/chat" class='mr-12'>
        <v-icon color='green' >chat</v-icon>
      </v-btn>

      <a :href='"/user?id="+ me.id '>
      <v-avatar class='mr-12'>
        <img :src='"storage/avatars/"+me.id+".jpg"'>
      </v-avatar>
      </a>

      </div>

    </v-app-bar>

    <v-navigation-drawer v-model='drawer' absolute temporary color='grey darken-3'>

      <v-list nav dense>

        <v-list-item-group active-class='dark--text text--accent-4'>

            <v-list-item :href='"/user?id="+ me.id '>

                <v-avatar>
                  <img :src=" `/storage/avatars/${me.id}.jpg` ">
                </v-avatar>

              <v-list-item-title  class='green--text ml-3'> {{ me.name }}  </v-list-item-title>

            </v-list-item>

            <v-list-item href='/home'>
              <v-list-item-icon>
                <v-icon color='purple lighten-2' >home</v-icon>
              </v-list-item-icon>
              <v-list-item-title  class='green--text'>Home</v-list-item-title>
            </v-list-item>


            <v-list-item href='/photos'>
              <v-list-item-icon>
                <v-icon  color='purple lighten-2'>collections</v-icon>
              </v-list-item-icon>
              <v-list-item-title class='green--text'>Photos</v-list-item-title>
            </v-list-item>


            <v-list-item href='/videos'>
                <v-list-item-icon>
                    <v-icon color='purple lighten-2'>video_library</v-icon>
                </v-list-item-icon>
                <v-list-item-title class='green--text'>Videos</v-list-item-title>
            </v-list-item>

            <v-list-item href='/blogs'>
                <v-list-item-icon>
                    <v-icon color='purple lighten-2'>local_library</v-icon>
                </v-list-item-icon>
                <v-list-item-title class='green--text'>Blogs</v-list-item-title>
            </v-list-item>

             <v-list-item href='/chat'>
                <v-list-item-icon>
                    <v-icon color='purple lighten-2'>chat</v-icon>
                </v-list-item-icon>
                <v-list-item-title class='green--text'>Chat</v-list-item-title>
            </v-list-item>

             <v-list-item href='/notifications'>
                <v-list-item-icon>
                    <v-icon color='purple lighten-2' v-text='notify.icon'></v-icon>
                </v-list-item-icon>
                <v-list-item-title class='green--text'>Notifications</v-list-item-title>
            </v-list-item>

            <v-list-item @click='logout()'>
              <v-list-item-icon>
                <v-icon color='purple lighten-2'>exit_to_app</v-icon>
              </v-list-item-icon>
              <v-list-item-title class='green--text'>Logout</v-list-item-title>
            </v-list-item>


        </v-list-item-group>
      </v-list>
    </v-navigation-drawer>

</div>
</template>

<script>

import Echo from 'laravel-echo';

window.Pusher = require('pusher-js');

window.Echo = new Echo({

broadcaster : 'pusher',
key : 'd9461b0680b177d5911e',
cluster : 'ap3',
encrypted: true

});


import store from '../store/index.js'

import { mapState, mapMutations, mapActions, mapGetters } from 'vuex'


export default {

    name: 'Navbar',

    store: store,

    data: () => ({

            notify : { icon: 'notifications', color: 'green', },

            drawer: false,

            data: { value: null },

            mobile: screen.width  <= 600 ? false : true,

    }),

    computed: {

         ...mapState( ['me'] ),

    },

    methods: {

        logout(){

            axios.post('/logout').then( window.location.href = '/register' );

        },

        search(){
            axios.post('api/search', this.data);
        },


    },


      created(){

        store.dispatch('getUser');

        axios.post('api/user').then( res => {

                                            window.Echo.private('reaction.'+ res.data.id ).listen('React',  e  => { this.notify.icon = "notifications_active"; this.notify.color = "yellow"; document.getElementById('notify').play() } );
                                            window.Echo.private('chat.'+ res.data.id ).listen('sendMessage',  e  => { console.log('New Message '); } );

                                            }

                                    );

    }


}
</script>
