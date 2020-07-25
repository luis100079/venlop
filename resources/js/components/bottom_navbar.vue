<template>

  <div v-show='mobile' class='my-6'>

    <v-bottom-navigation dark  fixed>

    <v-btn href='/home'>
      <span class='white--text'>Home</span>
      <v-icon color='green accent-3' >home</v-icon>
    </v-btn>

    <v-btn value="favorites" href='/chat'>
      <span class='white--text'>Chat</span>

      <v-badge
        :content="unread_messages"
        :value="unread_messages"
        color="red"
        overlap
      >
      <v-icon :color='message_notify.color' v-text='message_notify.icon'></v-icon>
      </v-badge>

    </v-btn>

    <v-btn value="nearby" href='notifications'>
      <span class='white--text'>Notifications</span>


      <v-badge
        :content="notifications"
        :value="notifications"
        color="red"
        overlap
        >
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

            unread_messages: 0,

            notifications: 0,

            notify : { icon: 'notifications', color: 'green accent-3', quantity: 0 },

            message_notify: { icon: 'chat_bubble', color:'green accent-3', quantity: 0 },

            mobile: screen.width  <= 800 ? true : false,

        }

    },

    created(){

        axios.post('api/user').then( res => {

                                            window.Echo.private('reaction.'+ res.data.id ).listen('React',  e  => { this.notify.icon = "notifications_active"; this.notify.color = "yellow"; this.notifications ++ ; } );
                                            window.Echo.private('chat.'+ res.data.id ).listen('sendMessage',  e  => {  if(this.$route.path !== "/chat" ){ this.unread_messages ++ ; };  this.message_notify.color = 'yellow'; } );

                                            } );

        if(this.$route.path !== "/notifications" ){

          axios.post('api/notifications', { clear: 0 } ).then( res => { this.notifications = res.data.length; if( res.data.length != 0){  this.notify.icon = "notifications_active"; this.notify.color = "yellow"; } } )

        }

        if(this.$route.path !== "/chat" ){

          axios.post('api/unread_messages', { clear: 0 } ).then( res => { console.log(res.data.length); this.unread_messages = res.data.length; if( res.data.length != 0){ this.message_notify.color = 'yellow'; } } )

        }

    }
}
</script>
