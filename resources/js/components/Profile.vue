<template>
  <v-app>

    <v-container fluid>

     <v-row>
        <Header></Header>
        <Welcome></Welcome>
     </v-row>

     <v-row>
        <LeftMenu></LeftMenu>
        <Album></Album>
     </v-row>

     <v-row>

     </v-row>

    </v-container>
  </v-app>
</template>

<script>

import  Header  from './Profile/Header.vue'
import  Album  from './Profile/Album.vue'
import Welcome from  './Profile/Welcome.vue'
import LeftMenu from './Profile/LeftMenu.vue'

export default {

  name: 'Profile',

  components: { Header, Album, Welcome, LeftMenu }

}
</script>
