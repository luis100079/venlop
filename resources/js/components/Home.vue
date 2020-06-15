<template>
  <v-app>
  <v-container>
    <NavBar></Navbar>
    {{ name }}
  </v-container>
  </v-app>
</template>

<script>
import NavBar from './NavBar.vue'

export default {

    data(){
        return { name: null }
    },

    created(){

     // axios.get('api/videos').then( response => { console.log(response.data) } );

    },

    components: { NavBar }

}
</script>
