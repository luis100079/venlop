<template>
<v-app>

<v-container>
  <NavBar></NavBar>
    <v-row> <div id='HTMLContainer'></div> </v-row>
</v-container>

</v-app>
</template>

<script>
import NavBar from './NavBar'

export default {

    components: { NavBar },

    data() {

      return{
            me: false,
            details: null,
         
            }

          },

    created(){

        axios.post('api/get_post_data', { value: this.$route.query.id }).then( res => { 
                  
                  this.details = res.data
                  document.getElementById('HTMLContainer').innerHTML = res.data.content

         } );   

    }


}
</script>
