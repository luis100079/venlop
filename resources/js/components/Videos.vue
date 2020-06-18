<template>
  <v-app>

    <v-container>


      <NavBar></NavBar>


        <v-card>

        <v-card-title>

            <v-btn icon v-on='on'>
              <label for='input_video'>
                <v-icon color='green' size='50'>theaters</v-icon>
              </label>
            </v-btn>

            <input type='file' accept='video/*' style='display:none' id='input_video' @change='preview()'>
            Add new

            <v-dialog v-model='upload_dialog' max-width="500">

              <v-card style='overflow:hidden;'>
                <video width='100%' id='video_1' v-show_preview='this' controls></video>

              <v-card-actions>

                <v-row justify='center'>
                  <v-btn @click='upload_video()' icon>
                    <v-icon color='green' size='60'>check_circle_outline</v-icon>
                  </v-btn>
                </v-row>

              </v-card-actions>

              </v-card>


            </v-dialog>

        </v-card-title>

        <v-container fluid>

          <v-row >

              <v-col v-for='n in 12' :key='n' cols='4' class='d-flex child-flex'>

                <v-card class=text-center>

                  <v-card-title class="justify-center">Video Title</v-card-title>


                  <v-dialog v-model='dialog' width='500px'>

                    <template v-slot:activator='{ on }'>

                    <video
                         v-on='on'
                         :src='`https://www.w3schools.com/html/mov_bbb.mp4`'
                          aspect-ratio='1'
                          class='grey lighten-2'>
                    </video>

                    </template>

                    <video controls
                         :src='`https://www.w3schools.com/html/mov_bbb.mp4`'
                          aspect-ratio='1'
                          class='grey lighten-2'>
                    </video>

                  </v-dialog>



                </v-card>

              </v-col>

          </v-row>

        </v-container>

        </v-card>

    </v-container>
  </v-app>
</template>

<script>

import NavBar from './NavBar'

export default {

    name: 'Videos',

    data(){

        return {

            dialog: false,
            upload_dialog: false

        }

    },

    directives: {
        show_preview(e){  e.src= window.URL.createObjectURL(document.getElementById('input_video').files[0]); }
    },

    methods: {

        preview(){
          this.upload_dialog = true;
        },

        upload_video(){


          var src = document.getElementById('input_video').files[0];
          var video = new FormData();
          video.append('video', src);
          axios.post('api/upload_video', video, { headers: { 'Content-Type' : 'multipart/form-data' } } ).then( res => console.log(res.data) );

        },

    },

    components: { NavBar }

}
</script>
