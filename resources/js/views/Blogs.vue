<template>

    <v-container fuid>

      <v-card>

        <v-card-title>
          <a href='/create_blog' style='text-decoration:none;'>

          <v-btn v-show='me' icon>
            <v-icon color='blue'>local_library</v-icon>
          </v-btn>

          <span v-show='me'>
          + New Blog
          </span>

          </a>
        </v-card-title>

        <v-container fluid>


        <v-layout wrap align-center>

            <v-flex  v-for='(post, i) in posts' :key='i'  xs12 md3>




                <v-card :href='`/blog?id=${post.id}`' >

                  <v-card-title class='justify-center'>{{ post.title }}</v-card-title>

                    <v-img
                          width='100%'
                         :src='post.path+post.thumbnail'
                         :lazy-src='post.path+post.thumbnail'
                          aspect-ratio='1'
                          class='grey lighten-2'>
                    </v-img>

                      <v-card-actions class='justify-center'>
                        <span> </span>
                      </v-card-actions>

                </v-card>
<!--                </a> -->

            </v-flex>
        </v-layout>
        </v-container>
      </v-card>

    </v-container>

</template>

<script>

export default {

    name: 'Blogs',

    data(){

      return {
        posts: null,
        me: false,

      }

    },

    created(){


        axios.post('api/user',  { value: this.$route.query.id } ).then( res => {

          if( res.data.id == this.$route.query.id ){

                this.me = true;

                axios.post('api/search_user_posts', { value: this.$route.query.id } ).then( res => { this.posts = res.data ; } );

            }

                else{

                    axios.post('api/search_user_posts',  { value: this.$route.query.id } ).then( res => { this.posts = res.data } );

                    }

            }

         );

        }

}
</script>
