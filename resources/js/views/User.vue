<template>
  <v-app>

     <NavBar></NavBar>

     <v-container fuid>

     <v-layout wrap align-center>



        <v-flex xs12 md4>

          <v-card>

            <v-img class='blue-grey darken-4 white--text align-end'
                    aspect-ratio='1.7'
                    :src='"storage/avatars/"+details.id+".jpg"'>
              <v-card-title>{{ details.name }}</v-card-title>

            </v-img>

            <v-card-text>

              <p v-for='(detail, i) in details' :key='i' v-show=' detail != null && i != "id" && i != "created_at" && i != "updated_at"  && i != "about_me" && i != "gender" && i != "email" '>
                  {{ i }}: {{ detail }}
              </p>

            </v-card-text>

            <v-card-actions>

              <v-btn @click='show = !show ' color='green' text>About me</v-btn>

              <v-tooltip top>

                <template v-slot:activator="{ on, attrs }">

                  <v-btn icon v-on='on' v-bind='attrs'>
                    <v-icon color='red' v-text=' me ? "mdi-heart" : "mdi-heart-outline" '></v-icon>
                  </v-btn>

                </template>

                <span v-text=' me ? "My Followers" : "Follow" '>
                    Follow
                </span>

              </v-tooltip>


             <div v-show=' !me '>

              <v-tooltip top >

                <template v-slot:activator="{ on, attrs }">

                  <v-btn :href='"/chat?with="+details.id' v-on='on' v-bind='attrs' icon>
                    <v-icon size='30' color='green'>chat</v-icon>
                  </v-btn>

                </template>

                <span>Send Message</span>

              </v-tooltip>

             </div>


                <v-tooltip top>

                  <template v-slot:activator="{ on, attrs }">

                    <v-btn href='/edit_profile' v-show='me' icon v-on='on' v-bind='attrs'>
                      <v-icon color='orange'>create</v-icon>
                    </v-btn>

                  </template>

                  <span>
                      Edit Profile
                  </span>

                </v-tooltip>


            </v-card-actions>

            <v-expand-transition>

                <div v-show='show'>

                <v-card-text>
                  {{ details.about_me }}
                </v-card-text>

                </div>

            </v-expand-transition>

          </v-card>

        </v-flex>



        <v-flex xs12 md8>

          <v-card v-show='  photos.length != 0  '>
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
                           <v-btn :href='`/photos?id=${ details.id }`' color='success'>All Photos...</v-btn>
                  </v-card-actions>

          </v-card>


        </v-flex>





        <v-flex xs12 md4>



        <v-card v-show='  posts.length != 0  '>

          <v-carousel height='400'>
            <v-carousel-item  v-for='(post, i) in posts' :key='i'
                :src='post.path + post.thumbnail' :href='"/blog?id="+post.id'
                reverse-transition='fade-transition' transition='fade-transition'>


                <v-card-title class='justify-center'> {{ post.title }} </v-card-title>

            </v-carousel-item>
          </v-carousel>

          <v-card-actions class='justify-center'>
            <v-btn :href='`/blogs?id=${ details.id }`' color='success'>All Blogs...</v-btn>
          </v-card-actions>

        </v-card>

        </v-flex>




         <v-flex xs12 md8>

          <v-card v-show='  videos.length != 0  '>

            <v-carousel>
              <v-carousel-item  v-for='(video, i) in videos' :key='i'>
                  <v-sheet height='100%'>

                    <video width='100%' height='90%' controls :src='video.path+video.name'></video>

                  </v-sheet>

              </v-carousel-item>
            </v-carousel>


            <v-card-actions class='justify-center'>
                <v-btn :href='`/videos?id=${ details.id }`' color='success'>All Videos...</v-btn>
            </v-card-actions>

          </v-card>

         </v-flex>




    </v-layout>

    </v-container>

    </v-app>

</template>
<script>

import NavBar from '../components/NavBar'

export default {

  components: { NavBar },

     data(){
          return {

              data: { value: this.$route.query.id  },

              details: [],
              photos: [],
              videos: [],
              posts: [],
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
