<template>

  <div v-show='mobile'>

    <v-bottom-navigation v-model="bottomNav" color='green' dark  fixed>

    <v-btn value="recent">
      <span>Home</span>
      <v-icon>home</v-icon>
    </v-btn>

    <v-btn value="favorites">
      <span>Chat</span>
      <v-icon>chat_bubble</v-icon>
    </v-btn>

    <v-btn value="nearby">
      <span>Notifications</span>
      <v-icon>notifications</v-icon>
    </v-btn>
  </v-bottom-navigation>

  </div>
</template>

<script>
export default {
    data(){

        return {

            bottomNav: 'recent',

            mobile: screen.width  <= 800 ? true : false,

        }


    }
}
</script>
