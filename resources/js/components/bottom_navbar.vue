<template>

  <div v-show='mobile' class='my-6'>

    <v-bottom-navigation dark  fixed>

    <v-btn href='/home'>
      <span class='green--text'>Home</span>
      <v-icon color='purple lighten-2' >home</v-icon>
    </v-btn>

    <v-btn value="favorites" href='/chat'>
      <span class='green--text'>Chat</span>

      <v-badge :content='message_notify.quantity'>
      <v-icon :color='message_notify.color' v-text='message_notify.icon'></v-icon>
      </v-badge>

    </v-btn>

    <v-btn value="nearby" href='notifications'>
      <span class='green--text'>Notifications</span>

      <v-badge :content='notify.quantity'>
      <v-icon :color='notify.color' v-text='notify.icon'></v-icon>
      </v-badge>

    </v-btn>

  </v-bottom-navigation>

  </div>
</template>

<script>

import Bottom_navbar from '../components/bottom_navbar'

export default {
    data(){

        return {

            notify : { icon: 'notifications', color: 'purple lighten-2', quantity: 0 },

            message_notify: { icon: 'chat_bubble', color:'purple lighten-2', quantity: 0 },

            mobile: screen.width  <= 800 ? true : false,

        }

    },

    created(){

        axios.post('api/user').then( res => {

                                            window.Echo.private('reaction.'+ res.data.id ).listen('React',  e  => { this.notify.icon = "notifications_active"; this.notify.color = "yellow"; this.notify.quantity += 1; } );
                                            window.Echo.private('chat.'+ res.data.id ).listen('sendMessage',  e  => { this.message_notify.color = "yellow"; this.message_notify.quantity += 1; } );

                                            } );

    }
}
</script>
