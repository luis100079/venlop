<template>

    <v-container>


      <template>
        <v-tabs color='green' v-model='tabs' centered>

          <v-tab v-for='(media, i) of medias' :key='i'> {{ media }} </v-tab>

        </v-tabs>
      </template>



      <v-tabs-items v-model='tabs' class='d-flex justify-center'>


        <v-tab-item>


          <v-dialog  v-model="comment_dialog" fullscreen hide-overlay transition="dialog-bottom-transition">

            <template v-slot:activator="{ on, attrs }">





        <v-layout wrap align-center>


          <v-flex v-for="(photo, i) of photos" :key='i' xs12 md4>

            <v-card height='auto'  class='justify-center my-1'>

              <v-card-title class='justify-center'>

                  <v-avatar @click='go(photo.user)'>
                      <v-img :src='"/storage/avatars/"+photo.user+".jpg"'></v-img>
                  </v-avatar>

              </v-card-title>


              <img width='100%' height='250px' :src='photo.path+photo.name'>


              <v-card-actions class='justify-center'>

                <v-btn icon @click='like(photo.id, i)'>
                  <v-icon color='red' v-text=' photo.my_likes.filter( arr => { return  arr.id === me.id }).length ? `mdi-heart` : `mdi-heart-outline` '></v-icon>
                </v-btn>

                 <span id='fotos-length' v-show=' photo.my_likes.length != 0 '>
                     {{ photo.my_likes.length }}
                 </span>

                <v-btn @click='active_img = photo.name; active_img_id = photo.id; comments = photo.my_comments'  v-bind="attrs" v-on="on" color='orange' icon>
                  <v-icon color='warning'> comment </v-icon>
                </v-btn>

                 <span id='fotos-length' v-show=' photo.my_commengts.length != 0 '>
                     {{ photo.my_likes.length }}
                 </span>



              </v-card-actions>


            </v-card>

          </v-flex>
        </v-layout>




         </template>

            <v-card>


                    <v-toolbar dark color='warning'>

                        <v-btn icon dark @click="comment_dialog = false; comments = []">
                            <v-icon>mdi-close</v-icon>
                        </v-btn>


                        <v-toolbar-title>Comments</v-toolbar-title>

                    </v-toolbar>


                    <img width='100%' height='200px' :src='"storage/photos/"+active_img'>

                    <v-textarea label='leave a comment' rows='1' color='warning' v-model='new_comment' @keyup.enter='comment(); $event.target.blur(); new_comment = "" '>

                    </v-textarea>

                    <v-list>

                    <v-list-item v-for='(comment, i) of comments ' :key='i'>

                        <v-list-item-avatar>
                            <v-img :src='"storage/avatars/"+comment.id+".jpg"'></v-img>
                        </v-list-item-avatar>

                        <v-list-item-content>

                            <v-list-item-title> {{ comment.name }} </v-list-item-title>

                            <v-list-item-subtitle> {{ comment.pivot.comment }} </v-list-item-subtitle>

                        </v-list-item-content>

                    </v-list-item>

                    </v-list>


                   </v-card>

         </v-dialog>




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

</template>

<script>

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

           comment_dialog : false,

           new_comment: "",

           active_img : null,

           active_img_id : null,

           tabs: null,

           photos: [],

           posts: [],

           videos: [],

           comments: [],

         }
    },

    methods: {

        comment(){

//        console.log( {photo_id: this.active_img_id, comment: this.new_comment } );

          this.comments.unshift({id: this.me.id, name: this.me.name, pivot:{ comment: this.new_comment } })

          axios.post('api/comment_photo', {photo_id: this.active_img_id, comment: this.new_comment });

        },

        scroll( ){

            window.onscroll = () =>{

              let bottomOfWindow =   document.documentElement.scrollTop + window.innerHeight  ===   document.documentElement.offsetHeight;

              if(bottomOfWindow){

                axios.post('api/list_photos', { num: this.photos.length }).then( res => { res.data.forEach( arr => { this.photos.push(arr) } ); } );

                }

            }

        },

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

    mounted() {

      this.scroll( )

    },


    created(){

        axios.post('api/list_photos', { num: 0 }).then( res => { this.photos = res.data; } );

        axios.post('api/list_posts').then( res => { this.posts = res.data; } );

        axios.post('api/list_videos').then( res => { this.videos = res.data; } );

        store.dispatch('getUser');

    },


}

</script>
