<template>

  <v-dialog  v-model="comment_dialog" fullscreen hide-overlay transition="dialog-bottom-transition">

  <template v-slot:activator="{ on, attrs }">

  <v-layout wrap align-center>

    <v-flex  v-for="(video, i) of videos" :key='i' xs12 md4>

      <v-card height='auto' class='justify-center my-1'>

        <v-card-title class='justify-center'>

          <v-avatar>
            <v-img :src=" Number(video.get_user.avatar) === 0 ? 'storage/avatars/men/sample_1.png' : 'storage/avatars/'+video.get_user.id+'.jpg'"></v-img>
          </v-avatar>

          <h2 class='ml-6 font-weight-thin font-italic'></h2>

        </v-card-title>

        <video style='cursor:pointer' :src='"storage/videos/" + video.name' @click='play($event)' width='100%' height='250px'></video>

          <center><v-card-text class='font-italic'><span>{{ video.get_user.name }}</span> <br> <span v-text=' video.description !== null ? `"`+video.description+`"` : "" '></span> </v-card-text></center>

          <v-card-actions class='justify-center'>

            <v-btn icon @click='like(video.id, i)'>
              <v-icon size='30' color='red' v-text=' video.my_likes.filter( arr => { return  arr.id === me.id }).length ? `mdi-heart` : `mdi-heart-outline` '></v-icon>
            </v-btn>

            <span id='videos-length' class='font-italic' v-show=' video.my_likes.length != 0 '>
                {{ video.my_likes.length }}
            </span>

            <v-btn class='ml-3' color='orange' icon>
              <v-icon @click='active_video_src = video.name; active_video_id = video.id; comments = video.my_comments'  v-bind="attrs" v-on="on"  size='30' color='warning'> comment </v-icon>
            </v-btn>

             <span class='font-italic' v-show=' video.my_comments.length != 0 '>
                {{ video.my_comments.length }}
            </span>


            <v-menu top right>
            <template v-slot:activator="{ on, attrs }">
              <v-btn
                dark
                icon
                v-bind="attrs"
                v-on="on"
                class='ml-4'

              >
                <v-icon color='primary'>widgets</v-icon>
              </v-btn>
            </template>

            <v-list>

              <v-list-item v-show='Number(video.user) === Number(me.id)' @click='delete_video(video.id, i)'>
                <v-list-item-title><v-icon color='red'>delete</v-icon></v-list-item-title>
                Delete
              </v-list-item>

              <v-list-item @click=''>
                  <v-list-item-title><v-icon color='warning'>flag</v-icon></v-list-item-title>
                Report
              </v-list-item>

            </v-list>
          </v-menu>

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


<!--    <video class='mt-12' width='100%' height='200px' :src='"storage/video/"+active_video_src'></video>

    <center><v-card-text class='font-italic'>Hermoso paisaje</v-card-text></center> <v-divider></v-divider>
-->
    <v-textarea  class='mt-12' label='leave a comment' rows='3' color='warning' v-model='new_comment' @keyup.enter='comment(); $event.target.blur(); new_comment = "" '>
    </v-textarea>

    <v-list>

      <v-list-item v-for='(comment, i) of comments ' :key='i'>

        <v-list-item-avatar>
          <v-img  :src="Number(comment.avatar) === 0 ? 'storage/avatars/men/sample_1.png' : 'storage/avatars/'+comment.id+'.jpg'"></v-img>
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

            type: false,

            me: [],

            videos: [],

            new_comment: "",

            comment_dialog: false,

            active_video_src : null,

            active_video_id : null,

            comments: [],
        }
    },

    methods: {


        delete_video(id, i){
          axios.post('api/delete_video', {id: id}).then( this.videos.splice( i, 1) );
        },

        play(event){ event.target.paused ? event.target.play() : event.target.pause() },

        comment(){

          this.comments.unshift({id: this.me.id, name: this.me.name, pivot:{ comment: this.new_comment },  avatar:this.me.avatar })

          axios.post('api/comment_video', {video_id: this.active_video_id, comment: this.new_comment });

        },

        scroll(){

            window.onscroll = () =>{

              let bottomOfWindow =   document.documentElement.scrollTop + window.innerHeight  ===   document.documentElement.offsetHeight;

              if(bottomOfWindow){

                axios.post('api/list_videos', { type:this.type, num: this.videos.length }).then( res => { res.data.forEach( arr => { this.videos.push(arr) } ); } );

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

          axios.post('api/like_video', { id: id } );

        },

    },

    mounted() { this.scroll( ) },

    created(){
        if(this.$route.path === "/videos"){ this.type = true };
        axios.post('api/user').then( res => { this.me = res.data } )
        axios.post('api/list_videos', { type: this.type, num: 0 }).then( res => { this.videos = res.data; } );
    }

}
</script>
