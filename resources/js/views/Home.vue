<template>

  <v-app>

    <NavBar></Navbar>

    <v-container>


      <template>
        <v-tabs color='green' v-model='tabs' centered>

          <v-tab v-for='(media, i) of medias' :key='i'> {{ media }} </v-tab>

        </v-tabs>
      </template>



      <v-tabs-items v-model='tabs' class='d-flex justify-center'>

        <v-tab-item>

        <v-layout wrap align-center>


          <v-flex v-for="(photo, i) of photos" :key='i' xs12 md4>

            <v-card height='400px'  class='justify-center my-1'>

              <v-card-title class='justify-center'>



                  <v-avatar @click='go(photo.user)'>
                      <v-img :src='"/storage/avatars/"+photo.user+".jpg"'></v-img>
                  </v-avatar>

              </v-card-title>


              <img width='100%' height='65%' :src='photo.path+photo.name'>


              <v-card-actions class='justify-center'>

                <v-btn icon @click='like(photo.id, i)'>
                  <v-icon color='red' v-text=' photo.my_likes.filter( arr => { return  arr.id === me.id }).length ? `mdi-heart` : `mdi-heart-outline` '></v-icon>
                </v-btn>

                 <span id='fotos-length' v-show=' photo.my_likes.length != 0 '>
                     {{ photo.my_likes.length }}
                 </span>

              </v-card-actions>

            </v-card>

          </v-flex>
        </v-layout>

        </v-tab-item>



        <v-tab-item>

        <v-layout wrap align-center>

          <v-flex  v-for="(video, i) of videos" :key='i' xs12 md4>


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


          </v-flex>

        </v-layout>


        </v-tab-item>




        <v-tab-item>


          <v-layout wrap align-center>

            <v-flex  v-for="(post, i) of posts" :key='i' xs12 md4>

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

            </v-flex>

          </v-layout>


        </v-tab-item>


      </v-tabs-items>


  </v-container>

  <Bottom_navbar></Bottom_navbar>

  </v-app>

</template>

<script>

import NavBar from '../components/NavBar.vue'

import Bottom_navbar from '../components/bottom_navbar'

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

            location.href='/user?id='+id

        },

        like(id, index){


        if( this.photos[index].my_likes.filter( i => { return i.id == this.me.id }).length !== 0  ){

          this.photos[index].my_likes.forEach( (e, i) => { e.id == this.me.id && this.photos[index].my_likes.splice( i, 1) } )

        }

        else if ( this.photos[index].my_likes.filter( i => { return i.id == this.me.id }).length == 0 ){

            this.photos[index].my_likes.push( { id: this.me.id } )

        }


        axios.post('api/like_photo', { id: id } );

        },

        ...mapMutations([ '' ]),
    },


    created(){

        axios.post('api/list_photos').then( res => { this.photos = res.data; } );

        axios.post('api/list_posts').then( res => { this.posts = res.data; } );

        axios.post('api/list_videos').then( res => { this.videos = res.data; } );

        store.dispatch('getUser');

    },

    components: { NavBar, Bottom_navbar }

}

</script>
