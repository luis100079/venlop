<template>

  <v-dialog  v-model="comment_dialog" fullscreen hide-overlay transition="dialog-bottom-transition">

    <template v-slot:activator="{ on, attrs }">

      <v-layout wrap align-center>

        <v-flex v-for="(photo, i) of photos" :key='i' xs12 md4>

          <v-card height='auto'  class='justify-center my-1 ml-1 mr-1'>

            <v-card-title class='justify-center'>

              <v-avatar style='cursor:pointer;' @click='visitUser(photo.user)'>
                <v-img :src=" Number(photo.get_user.avatar) === 0 ? 'storage/avatars/men/sample_1.png' : 'storage/avatars/'+photo.get_user.id+'.jpg'"></v-img>
              </v-avatar>

            </v-card-title>

            <v-dialog width='500'>

                <template v-slot:activator='{ on }'>
                    <img  v-on='on' width='100%' height='250px' :src='"storage/photos/"+photo.name'>
                    <center><v-card-text class='font-italic'><span>{{ photo.get_user.name }}</span> <br> <span v-text=' photo.description !== null ? `"`+photo.description+`"` : "" '></span> </v-card-text></center>
                </template>

                <v-card>
                  <img  v-on='on' width='100%' height='250px' :src='"storage/photos/"+photo.name'>
                  <center><v-card-text class='font-italic'><span>{{ photo.get_user.name }}</span> <br> <span v-text=' photo.description !== null ? `"`+photo.description+`"` : "" '></span> </v-card-text></center>
                </v-card>

            </v-dialog>

            <v-card-actions class='justify-center'>

              <v-btn icon @click='like(photo.id, i)'>
                <v-icon size='30' color='red' v-text=' photo.my_likes.filter( arr => { return  arr.id === me.id }).length ? `mdi-heart` : `mdi-heart-outline` '></v-icon>
              </v-btn>

              <span id='fotos-length' class='font-italic' v-show=' photo.my_likes.length != 0 '>
                {{ photo.my_likes.length }}
              </span>

              <v-btn class='ml-4' @click='active_img_src = photo.name; active_img_id = photo.id; comments = photo.my_comments'  v-bind="attrs" v-on="on" color='orange' icon>
                <v-icon size='30' color='warning'> comment </v-icon>
              </v-btn>

              <span id='fotos-length' class='font-italic' v-show=' photo.my_comments.length != 0 '>
                {{ photo.my_comments.length }}
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

              <v-list-item v-show='Number(photo.user) === Number(me.id)' @click='delete_photo(photo.id, i)'>
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

    <span class='my-1'>...</span>

    <v-textarea class='mt-12' label='leave a comment' rows='3' color='warning' v-model='new_comment' @keyup.enter='comment(); $event.target.blur(); new_comment = "" '>
    </v-textarea>

    <v-list>

      <v-list-item v-for='(comment, i) of comments ' :key='i'>

        <a :href=' "user?id="+comment.id '>
        <v-list-item-avatar>
          <v-img  :src="Number(comment.avatar) === 0 ? 'storage/avatars/men/sample_1.png' : 'storage/avatars/'+comment.id+'.jpg'"></v-img>
        </v-list-item-avatar>
        </a>

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

          type: false,

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

                axios.post('api/list_photos', { type: this.type, num: this.photos.length }).then( res => { (res.data).forEach( arr => { this.photos.push(arr) } ); } );

                }

            }

        },

        visitUser(id){ location.href='/user?id='+id },

        comment(){

            this.comments.unshift({id: this.me.id, name: this.me.name, pivot:{ comment: this.new_comment }, avatar:this.me.avatar  })

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

        delete_photo(id, i){

            axios.post('api/delete_photo', {id: id}).then( this.photos.splice( i, 1) );
        }

    },

    mounted() { this.scroll() },

    created(){

        if(this.$route.path === "/photos"){ this.type = true };
        axios.post('api/user').then( res => { this.me = res.data } );
        axios.post('api/list_photos', { type: this.type, num: 0 }).then( res => { this.photos = res.data } );

    }

}

</script>
