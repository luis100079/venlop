<template>

    <v-container>

      <v-card>

          <v-card-title>

            <span v-show='me'>Upload Foto</span>
<!--
                    <v-dialog v-model='dialog' persistent max-width="390">

                      <template v-slot:activator='{ on }'>

                        <v-btn  v-on='on' icon color='green' >
                          <v-icon>add_a_photo</v-icon>
                        </v-btn>

                      </template>

                      <v-card>

                        <v-btn @click='close_camera()' style='position:absolute; z-index:2; right:0;' icon><v-icon color='red'>close</v-icon></v-btn>

                        <video id="video1" width='100%' autoplay v-start='this'> </video>

                        <v-row  justify="center">

                        <canvas id="myCanvas" width='300px' height='300px' style='display:none;'></canvas>

                        </v-row>

                        <v-card-actions>

                          <v-row  justify="center">

                          <v-btn color='red' id='camara_icon' @click='Capture()' icon>
                            <v-icon size='50'>camera</v-icon>
                          </v-btn>

                          </v-row>

                          <v-row id='canvas_btns' style='display:none;'>

                            <v-btn  @click='upload_camera()' color='green' icon>
                              <v-icon size='40'>check_circle_outline</v-icon>
                            </v-btn>

                                  <v-divider></v-divider>

                            <v-btn @click='return_camera()' color='orange' icon>
                              <v-icon size='40'>cached</v-icon>
                            </v-btn>

                          </v-row>


                        </v-card-actions>


                      </v-card>

                    </v-dialog>
-->
                    <v-btn v-show='me' color='red' icon>
                      <label for='upload_input'>
                        <v-icon size='40'>add_photo_alternate</v-icon>
                      </label>
                    </v-btn>

                     <input type='file' style='display:none' accept='image/*' id='upload_input' @change='preview()'>

                    <v-dialog v-model='dialog2' max-width="500">

                    <v-card>

                      <v-btn @click='close_canvas()' style='position:absolute; right:0; z-index:2;' icon><v-icon color='red'>close</v-icon></v-btn>

                      <img id='prev_img' src='' width='100%' v-show_preview='this'>

                      <v-card-actions class='justify-center'>

                            <v-btn @click='upload_photo()' color='green' icon>
                              <v-icon size='50'>check_circle_outline</v-icon>
                            </v-btn>

                      </v-card-actions>

                    </v-card>

                    </v-dialog>

          </v-card-title>


        <v-container fluid>



            <v-layout wrap align-center>

            <v-flex v-for='(photo, i) in photos' :key='i'  xs12 md3>


                <v-card flat tile class='d-flex'>

                  <v-dialog  max-width="500">

                    <template v-slot:activator='{ on }'>

                    <v-img
                         v-on='on'
                         :src='photo.path+photo.name'
                         :lazy-src='photo.path+photo.name'
                          aspect-ratio='1'
                          class='grey lighten-2'>
                    </v-img>

                    </template>

                    <v-card>

                    <v-img
                         :src='photo.path+photo.name'
                         :lazy-src='photo.path+photo.name'
                          aspect-ratio='1'
                          class='grey lighten-2'>
                    </v-img>

                    <v-card-actions class='justify-center'>

                    <v-tooltip top>

                      <template v-slot:activator="{ on, attrs }">

                        <v-btn icon v-on='on' v-bind='attrs'>
                          <v-icon color='red'>mdi-heart</v-icon>
                        </v-btn>

                      </template>

                      <span>Likes</span>

                    </v-tooltip>

                     <v-tooltip top>
                      <template v-slot:activator='{ on, attrs }'>

                        <v-btn v-show='me' v-on='on' v-bind='attrs' icon>
                          <v-icon color='red'>delete</v-icon>
                        </v-btn>

                      </template>
                      <span>
                          Delete
                      </span>
                    </v-tooltip>


                    </v-card-actions>

                    </v-card>

                  </v-dialog>

                </v-card>


            </v-flex>

            </v-layout>



        </v-container>
      </v-card>

    </v-container>

</template>

<script>

export default {

    name: 'Fotos',

    data(){

      return {
          photos: null,
          dialog: false,
          dialog2 : false,
          tomada: false,
          me: false
      }

    },

    computed: {},

    directives: {

        start(e){

          if( document.getElementById('video1') == undefined ){

             var v = e;

             const constraints = { video: true };

             navigator.mediaDevices.getUserMedia(constraints).then( (stream) => { v.srcObject = stream } );
          }
          },

        show_preview(e){
             e.src = window.URL.createObjectURL(event.target.files[0]);
        }
  },

    methods: {

        upload_photo(){

            var src = document.getElementById('upload_input').files[0];
            var photo = new FormData();
            photo.append('img', src);
            axios.post('api/upload_photo', photo, { headers: { 'Content-Type' : 'multipart/form-data' } } ).then( window.location.reload() );

        },
/*
        upload_camera(){

            var src = document.getElementById('myCanvas').toDataURL("image/png");
            var photo = new FormData();
            photo.append('img', src);
            axios.post('api/upload_photo', photo, { headers: { 'Content-Type' : 'multipart/form-data' } } ).then( res => console.log(res.data) );

        },

*/

        close_camera(){

        var videoElem = document.getElementById('video1');
        const stream = videoElem.srcObject;
        const tracks = stream.getTracks();

        tracks.forEach(function(track) {
        track.stop();

        }

        );

        this.dialog = false;


        },

        return_camera(){

        document.getElementById('camara_icon').style='display:block;';

        var v = document.getElementById("video1");
        v.style='display:block;';
        var c = document.getElementById("myCanvas");
        c.style='display:none';

        document.getElementById('canvas_btns').style='display:none';

        const constraints = { video: true };

        navigator.mediaDevices.getUserMedia(constraints).then( (stream) => { v.srcObject = stream } );



        },

        close_canvas(){
          this.dialog2 = false;
        },

        preview(){
            this.dialog2=true;
        },


      Capture() {



        document.getElementById('camara_icon').style='display:none;';

        var v = document.getElementById("video1");
        var c = document.getElementById("myCanvas");
        c.style='display:block';
        var ctx = c.getContext("2d");
        var i;

        ctx.drawImage(v, 0, 30, 300, 270);
        document.getElementById('canvas_btns').style='display:block';


        var videoElem = document.getElementById('video1');
        const stream = videoElem.srcObject;
        const tracks = stream.getTracks();

        tracks.forEach(function(track) {
        track.stop();
        videoElem.style='display:none';
        }

        );


/*
        document.getElementById('video1').srcObject = null;

        navigator.mediaDevices.getUserMedia.stop();
*/

      }

    },

         created(){


         axios.post('api/user',  { value: this.$route.query.id } ).then( res => {

                if( res.data.id == this.$route.query.id ){

                    this.me = true;

                    axios.post('api/search_user_photos', { value: this.$route.query.id } ).then( res => { this.photos = res.data ; } );

                  }

                else{

                    axios.post('api/search_user_photos',  { value: this.$route.query.id } ).then( res => { this.photos = res.data } );

                    }

            }

         );

        }

  }




</script>
