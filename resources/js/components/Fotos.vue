<template>
  <v-app>
    <v-container>

      <NavBar></NavBar>

      <v-card>
            Upload Foto

                    <v-dialog v-model='dialog'>

                      <template v-slot:activator='{ on }'>

                        <v-btn  v-on='on' icon color='green' @click='Take()'>
                          <v-icon>add_a_photo</v-icon>
                        </v-btn>

                      </template>

                        
                        <div :class='`d-flex justify-center `' >

                          <video id="video1" :class='`d-flex justify-center`' autoplay v-start='this'>
                          </video>

                        </div>

                        <div :class='`d-flex justify-center`' >
                          <v-btn color='red' @click='Capture()' icon>
                            <v-icon size='50'>camera</v-icon>
                          </v-btn>
                        </div>
                            




<!--

                        <canvas id="myCanvas" width="270" height="135"></canvas>



                        <v-btn color='red' icon>
                          <v-icon>cancel</v-icon>
                        </v-btn>

                         <v-btn color='green' icon>
                            <v-icon>check_circle_outline</v-icon>
                        </v-btn>
-->
                    </v-dialog>
 
                       <v-btn color='green' icon>
                          <label for='upload_input'>
                            <v-icon>add_photo_alternate</v-icon>
                          </label>
                        </v-btn>

                     <input type='file' style='display:none' accept='image/*' id='upload_input' @change='preview()'>


                    <v-dialog v-model='dialog2'>

                    <v-card>
                        <img id='prev_img' src='' v-show_preview='this'>
                    </v-card>
 
                    </v-dialog>


                     


        <v-container fluid>
          <v-row>
              <v-col v-for='n in 12' :key='n' cols='3' class='d-flex child-flex'>

                <v-card flat tile class='d-flex'>

                  <v-dialog v-model='dialog' width='500px'>

                    <template v-slot:activator='{ on }'>

                    <v-img
                         v-on='on'
                         :src='`https://picsum.photos/500/300?image=${n * 5 + 10}`'
                         :lazy-src='`https://picsum.photos/500/300?image=${n * 5 + 10}`'
                          aspect-ratio='1'
                          class='grey lighten-2'>
                    </v-img>

                    </template>

                    <v-img
                         :src='`https://picsum.photos/500/300?image=${n * 5 + 10}`'
                         :lazy-src='`https://picsum.photos/500/300?image=${n * 5 + 10}`'
                          aspect-ratio='1'
                          class='grey lighten-2'>
                    </v-img>

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



    name: 'Fotos',

    data(){
      return {
          dialog2 : false
      }
    },

    computed: {},

    directives: {
        start(e){

             var v = e;

             const constraints = { video: true };

             navigator.mediaDevices.getUserMedia(constraints).then( (stream) => { v.srcObject = stream } );
              },

        show_preview(e){
             e.src = window.URL.createObjectURL(event.target.files[0]);
        }
  },

    methods: {

        preview(){
            this.dialog2=true;
        },
        

      Capture() {

        var videoElem = document.getElementById('video1');
        const stream = videoElem.srcObject;
        const tracks = stream.getTracks();

        tracks.forEach(function(track) {
        track.stop();
        
    });

      document.getElementById('video1').srcObject = null;


/*        navigator.mediaDevices.getUserMedia.stop();

        var v = document.getElementById("video1");
        var c = document.getElementById("myCanvas");
        var ctx = c.getContext("2d");
        var i;

        ctx.drawImage(v,5,5,260,122);
*/
      }

    },

    components: { NavBar }

  }




</script>
