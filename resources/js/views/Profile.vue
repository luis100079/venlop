<template>
  <v-app>

    <v-container fluid>

      <NavBar></NavBar>

     <v-row>
        <Header></Header>
        <Welcome></Welcome>
     </v-row>

     <v-row>
        <LeftMenu></LeftMenu>
        <Album></Album>
     </v-row>



    </v-container>
  </v-app>
</template>

<script>

import  Header  from '../components/Profile/Header.vue'
import  Album  from '../components/Profile/Album.vue'
import Welcome from  '../components/Profile/Welcome.vue'
import LeftMenu from '../components/Profile/LeftMenu.vue'
import NavBar from '../components/NavBar.vue'

export default {

  name: 'Profile',

  components: { Header, Album, Welcome, LeftMenu, NavBar }

}
</script>
