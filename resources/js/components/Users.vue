<template>
  <v-app>
    <v-container fuid>
     <NavBar></NavBar>

       <v-row>

        <v-col cols='4'>
          <v-card>

            <v-img class='blue-grey darken-4 white--text align-end'
                    aspect-ratio='1.7'
                    :src='"/storage/avatars/"+details.id+".jpg"'>
              <v-card-title>{{ details.name }}</v-card-title>

            </v-img>

            <v-card-text>

              <p> Country: {{ details.country }} </p>

              <p>Age: {{ details.age }}</p>

              <p> Tel: {{ details.tel }} </p>

              <p> Interested in: {{ details.interested_in }} </p>

            </v-card-text>

            <v-card-actions>

              <v-btn @click='show = !show ' color='green' text>About me</v-btn>

              <v-tooltip top>

                <template v-slot:activator="{ on, attrs }">

                  <v-btn icon v-on='on' v-bind='attrs'>
                    <v-icon color='red'>mdi-heart-outline</v-icon>
                  </v-btn>

                </template>

                <span>
                    Follow
                </span>

              </v-tooltip>





                <v-tooltip top>

                  <template v-slot:activator="{ on, attrs }">

                    <v-btn href='/edit_profile' v-show='me' icon v-on='on' v-bind='attrs'>
                      <v-icon color='orange'>create</v-icon>
                    </v-btn>

                  </template>

                  <span>
                      Follow
                  </span>

                </v-tooltip>



<!--
              <v-btn icon>
                <v-icon color='yellow'>star</v-icon>
              </v-btn>

              <v-btn icon>
                <v-icon color='blue dark-4'>fa fa-briefcase</v-icon>
              </v-btn>

              <v-btn icon>
                <v-icon color='orange'>mdi-play</v-icon>
              </v-btn>
-->

            </v-card-actions>

            <v-expand-transition>

                <div v-show='show'>

                <v-card-text>
                  {{ details.about_me }}
                </v-card-text>

                </div>

            </v-expand-transition>

          </v-card>
        </v-col>


        <v-col cols='8'>

          <v-card>

            <v-carousel>
              <v-carousel-item  v-for='(video, i) in videos' :key='i'>
                  <v-sheet height='100%'>

                    <video width='100%' height='90%' controls :src='video.path+video.name'></video>

                  </v-sheet>

              </v-carousel-item>
            </v-carousel>


<!--
              <v-carousel>
              <v-carousel-item v-for='(video, i) in videos' :key='i' reverse-transition='fade-transition' transition='fade-transition' >

              </v-carousel-item>
              </v-carousel>
-->
            <v-card-actions class='justify-center'>
                <v-btn :href='`/videos?id=${ details.id }`' color='success'>View All...</v-btn>
            </v-card-actions>

          </v-card>

        </v-col>

       </v-row>

<v-row>
     <v-col cols='5'>
    <v-container>


      <v-row>
        <v-col cols='12'>
<v-card>

    <v-carousel height='400'>
        <v-carousel-item  v-for='(post, i) in posts' :key='i'
            :src='post.path + post.thumbnail' :href='"/blog?id="+post.id'
            reverse-transition='fade-transition' transition='fade-transition'>

                <center><h2 style='font-style:italic; text-decoration:underline; color:black;'>{{ post.title }}</h2></center>

        </v-carousel-item>
    </v-carousel>

    <v-card-actions class='justify-center'>
        <v-btn :href='`/blogs?id=${ details.id }`' color='success'>View All...</v-btn>
    </v-card-actions>



</v-card>
        </v-col>
      </v-row>
<!--
      <v-row >
        <v-col cols='12' >
            <v-carousel>
              <v-carousel-item v-for='(item, i) in items' :key='i' :src='item.src'
                    reverse-transition='fade-transition' transition='fade-transition'>
              </v-carousel-item>
            </v-carousel>
        </v-col>
      </v-row>
-->

    </v-container>
  </v-col>




 <v-col cols='7'>

          <v-card>
            <v-container fluid>
              <v-row>
                <v-col v-for='(photo, i) of photos' :key='i' cols='4'
                        class='d-flex child-flex'>

                    <v-card>


                     <v-dialog width='500'>

                       <template v-slot:activator='{ on }'>

                             <v-img
                                v-on='on'

                                :src='photo.path+photo.name'
                                aspect-ratio='1'
                                class='grey lighten-2'>

                            </v-img>

                       </template>

                        <v-card>

                         <v-img
                         :src='photo.path+photo.name'
                          aspect-ratio='1'
                          class='grey lighten-2'>

                          </v-img>

                          <v-card-actions class='justify-center'>

                            <v-btn icon>
                              <v-icon color='red'>mdi-heart-outline</v-icon>
                            </v-btn>

                          </v-card-actions>

                        </v-card>


                     </v-dialog>

                    </v-card>



                </v-col>
              </v-row>
            </v-container>
                  <v-card-actions class='justify-center'>
                           <v-btn :href='`/photos?id=${ details.id }`' color='success'>View All...</v-btn>
                  </v-card-actions>

          </v-card>

    </v-col>




</v-row>





    </v-container>
    </v-app>
</template>
<script>

import NavBar from './NavBar'

export default {

  components: { NavBar },

     data(){
          return {

              data: { value: this.$route.query.id  },

              details: null,
              photos: null,
              videos: null,
              posts: null,
              show: false,
              me: false,

                 items: [ {
            src: 'https://cdn.vuetifyjs.com/images/carousel/squirrel.jpg',
          },
          {
            src: 'https://cdn.vuetifyjs.com/images/carousel/sky.jpg',
          },
          {
            src: 'https://cdn.vuetifyjs.com/images/carousel/bird.jpg',
          },
          {
            src: 'https://cdn.vuetifyjs.com/images/carousel/planet.jpg',
          },]
          }
      },

      created(){


         axios.post('api/user', this.data).then( res => {


                if( res.data.id == this.$route.query.id ){

                    this.details = res.data;

                    this.me = true;

                    axios.post('api/search_user_photos', this.data).then( res => { this.photos = res.data ;  } );

                    axios.post('api/search_user_videos', this.data).then( res => { this.videos = res.data ; } );

                    axios.post('api/search_user_posts', this.data).then( res => { this.posts = res.data ; } );

                }

                else{

                    this.me = false;

                    axios.post('api/search_user', this.data).then( res => { this.details = res.data } );

                    axios.post('api/search_user_photos', this.data).then( res => { this.photos = res.data } );

                    axios.post('api/search_user_videos', this.data).then( res => { this.videos = res.data } );

                    axios.post('api/search_user_posts', this.data).then( res => { this.posts = res.data } );


                    }



            }

         );




        }

}

</script>
