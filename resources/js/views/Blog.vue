<template>

  <v-container>

    <div id='HTMLContainer'></div>

  </v-container>

</template>

<script>


export default {


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
