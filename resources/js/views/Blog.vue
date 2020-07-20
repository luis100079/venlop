<template>

  <v-container>


    <v-card>

        <v-card-title>

          <span style='font-size:12px;'>

           <v-avatar><v-img src='storage/avatars/1.jpg'></v-img></v-avatar> Luis Rene Lopez<br>
           <v-icon color='green accent-3'>mdi-eye</v-icon> 192
           <v-btn icon> <v-icon color='red'>mdi-heart-outline</v-icon> </v-btn> 153 <br>
           <v-icon color='warning'>mdi-calendar</v-icon> Published on 17/12/2818 <br>

          </span>
        </v-card-title>


      <div id='HTMLContainer'></div>

      <v-card-actions class='justify-center'>

        <v-dialog  v-model="comment_dialog" fullscreen hide-overlay transition="dialog-bottom-transition">


          <template v-slot:activator="{ on, attrs }">

            <v-btn color='warning' v-bind="attrs" v-on="on" text>Comments (  <v-icon>comment</v-icon>  123)</v-btn>

          </template>


          <v-card>

            <v-app-bar dark color='warning' fixed>

              <v-btn icon dark @click="comment_dialog = false; comments = []">
                <v-icon>mdi-close</v-icon>
              </v-btn>

              <v-toolbar-title class='font-italic'>Comments</v-toolbar-title>

                <v-spacer></v-spacer>

                <v-icon size='30' color='white'>comment</v-icon>

              </v-app-bar>

              <span class='my-1'>...</span>

              <v-textarea background-color="grey lighten-5" class='my-12' label='leave a comment' rows='2' color='warning'> </v-textarea>


            </v-card>


        </v-dialog>

      </v-card-actions>

    </v-card>


  </v-container>

</template>

<script>


export default {


    data() {

      return{
            me: false,
            details: null,
            comment_dialog: false,

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
