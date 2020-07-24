<template>

  <v-layout wrap align-center>

    <v-flex  v-for="(post, i) of posts" :key='i' xs12 md4>

      <v-card class='justify-center my-1'>

          <a :href='"/blog?id="+post.id' style='text-decoration:none'>
            <v-img class='blue-grey darken-4 white--text align-center' aspect-ratio='1.7' :src='post.path+post.thumbnail'>
            </v-img>
          </a>

          <center><h2 class='font-weight-thin font-italic'>{{ post.title }}</h2></center>

          <v-card-actions>

          <v-card-text>

            <p>
              <v-avatar size='30'>
                <v-img :src='"/storage/avatars/"+post.user_id+".jpg"'></v-img>
              </v-avatar> <span>{{ post.user.name }}</span>
            </p>

                <v-icon color='green accent-3'>mdi-eye</v-icon> <span v-show='post.seens != 0'>{{ post.seens }}</span>
                <v-icon size='30' color='red'>mdi-heart</v-icon><span v-show='post.my_likes.length != 0'>{{ post.my_likes.length }}</span>
                <v-icon color='green accent-3'>comment</v-icon> <span v-show='post.my_comments.length != 0'>{{ post.my_comments.length }}</span>
                <v-icon color='warning'>mdi-calendar</v-icon> {{ (post.created_at).substr(0,10)  }}

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

              <v-list-item v-show='Number(post.user_id) === Number(me.id)' @click='delete_post(post.id, i)'>
                <v-list-item-title><v-icon color='red'>delete</v-icon></v-list-item-title>
                Delete
              </v-list-item>

              <v-list-item @click=''>
                <v-list-item-title><v-icon color='warning'>flag</v-icon></v-list-item-title>
                Report
              </v-list-item>

            </v-list>
          </v-menu>


            </v-card-text>


            </v-card-actions>

      </v-card>


            </v-flex>

          </v-layout>

</template>

<script>
export default {

    data(){
        return{ posts: [], me: [], type: false, }
    },

    methods: {
        delete_post(id, i){

            axios.post('api/delete_blog', {id: id}).then( this.posts.splice( i, 1) );
        }
    },

    created(){

        if(this.$route.path === "/blogs"){ this.type = true };
        axios.post('api/user').then( res => { this.me = res.data } )
        axios.post('api/list_posts', { type: this.type, num: 0 }).then( res => {this.posts = res.data; } );

    }

}

</script>
