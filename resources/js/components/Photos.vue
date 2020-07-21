<template>

  <v-dialog  v-model="comment_dialog" fullscreen hide-overlay transition="dialog-bottom-transition">

    <template v-slot:activator="{ on, attrs }">

      <v-layout wrap align-center>

        <v-flex v-for="(photo, i) of photos" :key='i' xs12 md4>

          <v-card height='auto'  class='justify-center my-1'>

            <v-card-title class='justify-center'>

              <v-avatar @click='visitUser(photo.user)'>
                <v-img :src='"/storage/avatars/"+photo.user+".jpg"'></v-img>
              </v-avatar>

            </v-card-title>

            <img width='100%' height='250px' :src='photo.path+photo.name'>

            <center><v-card-text class='font-italic'>Hermoso paisaje</v-card-text></center>

            <v-card-actions class='justify-center'>

              <v-btn icon @click='like(photo.id, i)'>
                <v-icon size='30' color='red' v-text=' photo.my_likes.filter( arr => { return  arr.id === me.id }).length ? `mdi-heart` : `mdi-heart-outline` '></v-icon>
              </v-btn>

              <span id='fotos-length' class='font-italic' v-show=' photo.my_likes.length != 0 '>
                {{ photo.my_likes.length }}
              </span>

              <v-btn class='ml-3' @click='active_img_src = photo.name; active_img_id = photo.id; comments = photo.my_comments'  v-bind="attrs" v-on="on" color='orange' icon>
                <v-icon size='30' color='warning'> comment </v-icon>
              </v-btn>

              <span id='fotos-length' class='font-italic' v-show=' photo.my_comments.length != 0 '>
                {{ photo.my_comments.length }}
              </span>

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


    <img class='mt-12' width='100%' height='200px' :src='"storage/photos/"+active_img_src'>

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

        return{

           me: [],

           photos: [],

           new_comment: "",

           comment_dialog: false,

           active_img_src : null,

           active_img_id : null,

           comments: [],

        }
    },

    methods: {

        scroll(){

            window.onscroll = () =>{

              let bottomOfWindow =   document.documentElement.scrollTop + window.innerHeight  ===   document.documentElement.offsetHeight;

              if(bottomOfWindow){

                axios.post('api/list_photos', { num: this.photos.length }).then( res => { res.data.forEach( arr => { this.photos.push(arr) } ); } );

                }

            }

        },

        visitUser(id){ location.href='/user?id='+id },

        comment(){

            this.comments.unshift({id: this.me.id, name: this.me.name, pivot:{ comment: this.new_comment } })

            axios.post('api/comment_photo', {photo_id: this.active_img_id, comment: this.new_comment });

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

    },

    mounted() { this.scroll() },

    created(){ 
        axios.post('api/user').then( res => { this.me = res.data } )     
        axios.post('api/list_photos', { num: 0 }).then( res => { this.photos = res.data; } )        
    }

}

</script>