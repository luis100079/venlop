<template>
  <v-app>
    <v-container>
      <v-card>
          <v-card-title>Upload Foto

                     <v-btn icon color='green' @click='Take()'><i class='material-icons'>add_a_photo</i></v-btn>

                     <v-btn icon color='green'>
                        <label for='upload_input'>
                          <i class='material-icons'>image</i>
                        </label>
                     </v-btn>

                    <video id="video1" width="270" autoplay>
                    </video>

                     <v-btn color='red' @click='Capture()'>Capture</v-btn>

                     <canvas id="myCanvas" width="270" height="135"></canvas>

          </v-card-title>
        <v-container fluid>
          <v-row>
              <v-col v-for='n in 12' :key='n' cols='3' class='d-flex child-flex'>

                <v-card flat tile class='d-flex'>

                  <v-dialog v-model='dialog' width='500px'>

                    <template v-slot:activator='{ on }'>

                         v-on='on'
                    <v-img
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

export default {

    name: 'Fotos',

    data(){
      return {}
    },

    computed: {},

    methods: {


      Take(){

             var v = document.getElementById("video1");


             const constraints = { video: true };

             const video = document.querySelector('video');

             navigator.mediaDevices.getUserMedia(constraints).then( (stream) => { video.srcObject = stream } );

        },

      Capture(e){

        var v = document.getElementById("video1");
        var c = document.getElementById("myCanvas");
        var ctx = c.getContext("2d");
        var i;

        ctx.drawImage(v,5,5,260,122);

      }

    }

  }


</script>
