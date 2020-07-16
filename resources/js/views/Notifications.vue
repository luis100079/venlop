<template>

  <v-container>

    <span v-show='notifications.length == 0'> No Notifications </span>

    <v-list max-width="600">

      <v-list-item  v-for='(notification, i) of notifications' :key='i' class='my-1'>

        <v-list-item-avatar size='60'>
          <img :src='`storage/avatars/${notification.data.id}.jpg`'>
        </v-list-item-avatar>

        <v-list-item-content align-center>

          <v-list-item-title>
            {{ notification.data.name }} <br v-show='mobile'> Likes Your photo <v-icon color='red'>mdi-heart</v-icon>
          </v-list-item-title>

          <p>
            <img width='80' height='54' :src='`storage/photos/${notification.data.photo}`'>
          </p>

        </v-list-item-content>

      </v-list-item>

    </v-list>


  </v-container>


</template>

<script>

export default {

    data(){

        return{

          notifications: [],

          mobile: screen.width  <= 600 ? true : false,

          }

    },

    created(){
        axios.post('api/notifications').then( res=>{ this.notifications = res.data; } )
    }

}
</script>
