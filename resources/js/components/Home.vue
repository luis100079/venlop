<template>
  <v-app>
  <v-container>
    <NavBar></Navbar>

     <template>

       <v-tabs color='green' v-model='tabs' centered>
         <v-tab v-for='(media, i) of medias' :key='i'> {{ media }} </v-tab>

       </v-tabs>
     </template>


      <v-tabs-items v-model='tabs' class='d-flex justify-center'>



        <v-tab-item class=''>

        <v-row>
        <v-col sm='12' lg='4'  v-for="(photo, i) of photos" :key='i'>

          <v-card width='' height='400px'  class='justify-center my-1'>

            <v-card-title class='justify-center'>

                  <v-avatar @click='go(photo.user)'>
                      <v-img :src='"/storage/avatars/"+photo.user+".jpg"'></v-img>
                  </v-avatar>

                  <h2 class='ml-6 font-weight-thin font-italic'> </h2>

            </v-card-title>

              <img width='100%' height='65%' :src='photo.path+photo.name'>

            <v-card-actions class='justify-center'>

                <v-btn icon @click='like(photo.id)'>
                  <v-icon color='red' v-text='`mdi-heart-outline`'></v-icon>
                </v-btn>

            </v-card-actions>

          </v-card>

        </v-col>
        </v-row>

        </v-tab-item>




        <v-tab-item>

        <v-row>
        <v-col sm='12' lg='4' v-for="(video, i) of videos" :key='i' >


          <v-card height='400px' class='justify-center my-1'>

            <v-card-title class='justify-center'>

                  <v-avatar>
                      <v-img :src='"/storage/avatars/"+video.user+".jpg"'></v-img>
                  </v-avatar>

                  <h2 class='ml-6 font-weight-thin font-italic'></h2>

            </v-card-title>

              <video :src='video.path + video.name' controls width='100%' height='65%'></video>


            <v-card-actions class='justify-center'>

                <v-btn icon>
                  <v-icon color='red'>mdi-heart-outline</v-icon>
                </v-btn>

                <v-btn icon>
                  <v-icon color='green'>mdi-eye</v-icon>
                </v-btn>

            </v-card-actions>

          </v-card>

        </v-col>
        </v-row>
        </v-tab-item>






         <v-tab-item>

          <v-row>
          <v-col v-for="(post, i) of posts" :key='i'>

          <v-card class='justify-center my-1'>

            <v-card-title class='justify-center'>

                  <v-avatar>
                      <v-img :src='"/storage/avatars/"+post.user.id+".jpg"'></v-img>
                  </v-avatar>

                  <h2 class='ml-6 font-weight-thin font-italic'>{{ post.title }}</h2>

            </v-card-title>

              <a :href='"/blog?id="+post.id'>
                <img width='100%' :src='post.path+post.thumbnail' >
              </a>


            <v-card-actions class='justify-center'>

                <v-btn icon>
                  <v-icon color='green'>mdi-eye</v-icon>
                </v-btn>

            </v-card-actions>

          </v-card>

          </v-col>
          </v-row>

        </v-tab-item>

      </v-tabs-items>


  </v-container>
  </v-app>
</template>

<script>

import NavBar from './NavBar.vue'

import store from '../store/index.js'

import  { mapState, mapMutations, mapActions, mapGetters } from 'vuex'

export default {

  store: store,

  computed: {

      ...mapState( ['me'] ),

      },

    data(){
        return {

           medias: ['Photos', 'Videos', 'Posts'],

           tabs: null,

           photos: null,

           posts: null,

           videos: null,

         }
    },

    methods: {
        go(id){
            location.href='/users?id='+id
        },

        like(id){
          axios.post('like', { id: id } ).then( res => { console.log(res.data) } );
        }
    },


    created(){

        axios.post('api/list_photos').then( res => {this.photos = res.data } )

        axios.post('api/list_posts').then( res => {this.posts = res.data ; console.log(res.data[0].user.id) } )

        axios.post('api/list_videos').then( res => {this.videos = res.data } )

        store.dispatch('getUser')

    },

    components: { NavBar }

}
</script>
