<template>

  <div v-show='mobile' class='my-6'>

    <v-bottom-navigation dark  fixed>

    <v-btn href='/home'>
      <span class='white--text'>Home</span>
      <v-icon color='green accent-3' >home</v-icon>
    </v-btn>

    <v-btn value="favorites" href='/chat'>
      <span class='white--text'>Chat</span>

        <v-icon :color='message_notify.color' v-text='message_notify.icon'></v-icon>

<!--
      <v-badge :content='message_notify.quantity'>
      </v-badge>
-->

    </v-btn>

    <v-btn value="nearby" href='notifications'>
      <span class='white--text'>Notifications</span>

      <v-icon :color='notify.color' v-text='notify.icon'></v-icon>
<!--
      <v-badge :content='notify.quantity'>
      </v-badge>
-->

    </v-btn>

  </v-bottom-navigation>

  </div>
</template>

<script>

import Bottom_navbar from '../components/bottom_navbar'

export default {
    data(){

        return {

            notify : { icon: 'notifications', color: 'green accent-3', quantity: 0 },

            message_notify: { icon: 'chat_bubble', color:'green accent-3', quantity: 0 },

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
