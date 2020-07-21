<template>

  <v-dialog  v-model="comment_dialog" fullscreen hide-overlay transition="dialog-bottom-transition">

  <template v-slot:activator="{ on, attrs }">

  <v-layout wrap align-center>

    <v-flex  v-for="(video, i) of videos" :key='i' xs12 md4>

      <v-card height='400px' class='justify-center my-1'>

        <v-card-title class='justify-center'>

          <v-avatar>
            <v-img :src='"/storage/avatars/"+video.user+".jpg"'></v-img>
          </v-avatar>

          <h2 class='ml-6 font-weight-thin font-italic'></h2>

        </v-card-title>

        <video style='cursor:pointer' :src='video.path + video.name' @click='play($event)' width='100%' height='65%'></video>

          <v-card-actions class='justify-center'>

            <v-btn icon>
              <v-icon size='30' color='red'>mdi-heart-outline</v-icon>
            </v-btn>

            <v-btn class='ml-3' color='orange' icon>
              <v-icon size='30' color='warning'> comment </v-icon>
            </v-btn>

          </v-card-actions>

      </v-card>

    </v-flex>

  </v-layout>
  </template>

  <v-card>

    <v-app-bar dark color='warning' fixed>

      <v-btn icon dark @click="comment_dialog = false; comments = []">
        <v-icon>mdi-close</v-icon>
      </v-btn>

      <v-toolbar-title class='font-italic'>Comments</v-toolbar-title>

        <v-spacer></v-spacer>
        <v-icon size='30' color='white'>comment</v-icon>

    </v-app-bar>


    <img class='mt-12' width='100%' height='200px' :src='"storage/photos/"+active_video_src'>

    <center><v-card-text class='font-italic'>Hermoso paisaje</v-card-text></center> <v-divider></v-divider>

    <v-textarea label='leave a comment' rows='2' color='warning' v-model='new_comment' @keyup.enter='comment(); $event.target.blur(); new_comment = "" '>
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

</template>

<script>

export default {

    data(){
        return {
            videos: [],

            new_comment: "",

            comment_dialog: false,

            active_video_src : null,

            active_video_id : null,

            comments: [],
        }
    },

    methods: {

        play(event){ event.target.paused ? event.target.play() : event.target.pause() },

        comment(){

          this.comments.unshift({id: this.me.id, name: this.me.name, pivot:{ comment: this.new_comment } })

          axios.post('api/comment_photo', {photo_id: this.active_video_id, comment: this.new_comment });

        },

        scroll(){

            window.onscroll = () =>{

              let bottomOfWindow =   document.documentElement.scrollTop + window.innerHeight  ===   document.documentElement.offsetHeight;

              if(bottomOfWindow){

                axios.post('api/list_videos', { num: this.videos.length }).then( res => { res.data.forEach( arr => { this.videos.push(arr) } ); } );

                }

            }

        },

        visitUser(id){

            location.href='/user?id='+id

        },

        like(id, index){


        if( this.videos[index].my_likes.filter( i => { return i.id == this.me.id }).length !== 0  ){

          this.videos[index].my_likes.forEach( (e, i) => { e.id == this.me.id && this.videos[index].my_likes.splice( i, 1) } )

        }

        else if ( this.videos[index].my_likes.filter( i => { return i.id == this.me.id }).length == 0 ){

            this.videos[index].my_likes.push( { id: this.me.id } )

        }

          axios.post('api/like_photo', { id: id } );

        },

    },

    mounted() { this.scroll( ) },

    created(){ axios.post('api/list_videos', { num: 0 }).then( res => { this.videos = res.data; } ); }

}
</script>