<template>
  <v-app>

    <v-container>

      <NavBar></NavBar>

        <v-card>

        <v-card-title>

            <v-btn icon v-show='me'>
              <label for='input_video'>
                <v-icon color='red' style='cursor:pointer;' size='50'>theaters</v-icon>
              </label>
            </v-btn>

            <input type='file' accept='video/*' style='display:none' id='input_video' @change='preview()'>
            <span v-show='me'>Add new</span>

            <v-dialog v-model='upload_dialog' max-width="500">

              <v-card style='overflow:hidden;'>
                <video width='100%' id='video_1' v-show_preview='this' controls></video>

                <v-textarea rows='2' color='green' id='video_description' label='Description'></v-textarea>
<!-- v-model="video_description" -->
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

        <Videos_list></Videos_list>

<!---

          <v-row>

              <v-col v-for='(video, i) in videos' :key='i' cols='4' class='d-flex child-flex'>

-->


<!--

               <v-layout wrap align-center>

            <v-flex  v-for='(video, i) in videos' :key='i'  xs12 md3>


                <v-card class=text-center>

                  <v-card-title class="justify-center"></v-card-title>

                  <v-dialog width='500px'>

                    <template v-slot:activator='{ on }'>

                    <video width='100%' height='70%'
                         v-on='on'
                         :src='video.path+video.name'
                          aspect-ratio='1'
                          class='grey lighten-2'>
                    </video>

                    </template>

                    <video controls
                         :src='video.path+video.name'
                          aspect-ratio='1'
                          class='grey lighten-2'>
                    </video>

                  </v-dialog>

                  <v-card-actions class='justify-center'>


                    <v-tooltip top>

                      <template v-slot:activator="{ on, attrs }">

                        <v-btn icon  v-bind='attrs'>
                          <v-icon color='red'>mdi-heart</v-icon>
                        </v-btn>

                      </template>

                      <span>
                        Followers
                      </span>

                    </v-tooltip>


                    <v-tooltip top>

                      <template v-slot:activator="{ on, attrs }">

                        <v-btn icon  v-bind='attrs'>
                          <v-icon color='blue'>mdi-eye</v-icon>
                        </v-btn>

                      </template>

                      <span>Seens</span>

                    </v-tooltip>

                    <v-tooltip top>
                      <template v-slot:activator='{ on, attrs }'>

                        <v-btn v-show='me' v-bind='attrs' icon>
                          <v-icon color='red'>delete</v-icon>
                        </v-btn>

                      </template>
                      <span>
                          Delete
                      </span>
                    </v-tooltip>





                  </v-card-actions>



                </v-card>



            </v-flex>

            </v-layout>
-->

        </v-container>

        </v-card>

    </v-container>
  </v-app>
</template>

<script>

import NavBar from '../components/NavBar'
import Videos_list from '../components/Videos'

export default {

    name: 'Videos',

    data(){

        return {

            videos: null,

            video_description: "",

            me: false,

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
          video.append('video_description', document.getElementById('video_description').value);
          axios.post('api/upload_video', video, { headers: { 'Content-Type' : 'multipart/form-data' } } ).then( res => { window.location.reload() } );

        },



    },

    components: { NavBar, Videos_list },

         created(){

         axios.post('api/user',  { value: this.$route.query.id } ).then( res => {

                if( res.data.id == this.$route.query.id ){

                    this.me = true;

                    axios.post('api/search_user_videos', { value: this.$route.query.id } ).then( res => { this.videos = res.data ; } );

                  }

                else{

                    axios.post('api/search_user_videos',  { value: this.$route.query.id } ).then( res => { this.videos = res.data } );

                    }



            }

         );

        }


}
</script>
