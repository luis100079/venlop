<template>
  <v-app>
    <v-container fuid>

      <NavBar></NavBar>



    </v-container>
    </v-app>
</template>
<script>

import NavBar from './NavBar'
import store from '../store/index.js'
import  { mapState, mapMutations, mapActions, mapGetters } from 'vuex'


export default {

    stote: store,

    components: { NavBar },

    computed: {

         ...mapState( ['me'] ),

},


}
</script>
