<template>
<v-app>

  <NavBar></NavBar>

<v-container>

        <div id='HTMLContainer'></div>

</v-container>

</v-app>
</template>

<script>
import NavBar from '../components/NavBar'

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
