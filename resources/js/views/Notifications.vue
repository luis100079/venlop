<template>

  <v-container>

    <span v-show='zero'>
      <img :src='box_img' class='my-12' width='200px' style='display:block; margin:auto;'>
    </span>

    <v-list max-width="600">

      <v-list-item v-for='(notification, i) of notifications' :key='i' class='my-1'>

        <v-list-item-avatar size='60'>
          <img :src=' Number(notification.data.avatar) === 0 ? `storage/avatars/men/sample_1.png`  : `storage/avatars/${notification.data.id}.jpg`'>
        </v-list-item-avatar>

        <v-list-item-content align-center>

          <v-list-item-title class='font-italic'>
            {{ notification.data.name }} <br v-show='mobile'> {{ notification.data.type }} Your {{ notification.data.media }} <v-icon color='red' v-text=' notification.data.type === "commented" ? "comment" : "mdi-heart" '></v-icon>
          </v-list-item-title>

          <p>
            <img width='80' height='54' :src=' `storage/photos/${notification.data.photo}`'>
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

          box_img : "storage/photos/caja.png",

          zero : false,

          }

    },

    created(){
        axios.post('api/notifications', {clear: 1} ).then( res=>{ this.notifications = res.data; if(res.data.length == 0){ this.zero = true }  } )
    }

}
</script>
