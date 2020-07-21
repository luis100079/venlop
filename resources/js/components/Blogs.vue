<template>

  <v-layout wrap align-center>

    <v-flex  v-for="(post, i) of posts" :key='i' xs12 md4>

       <v-card class='justify-center my-1'>

          <a :href='"/blog?id="+post.id' style='text-decoration:none'>
            <v-img class='blue-grey darken-4 white--text align-center' aspect-ratio='1.7' :src='post.path+post.thumbnail'>
              <h1 class='ml-6 font-weight-thin font-italic'>{{ post.title }}</h1>
            </v-img>
          </a>

          <v-card-text>
          <p>  <v-avatar size='30'>
                <v-img :src='"/storage/avatars/"+post.user.id+".jpg"'></v-img>
              </v-avatar>

                    Luis Rene López Hernandez</p>

                      <v-icon color='green accent-3'>mdi-eye</v-icon> 101
                      <v-icon color='red'>mdi-heart</v-icon> 100
                    <v-icon color='green accent-3'>comment</v-icon> 100
                <v-icon color='warning'>mdi-calendar</v-icon> 101

                </v-card-text>


                <v-card-title class='justify-center'>

                  <h2 class='ml-6 font-weight-thin font-italic'>{{ post.title }}</h2>

                </v-card-title>



                <v-card-actions class='justify-center'>

                  <v-btn icon>
                    <v-icon color='red'>mdi-heart</v-icon>
                  </v-btn>

                  <v-btn icon>
                    <v-icon color='blue'>mdi-eye</v-icon>
                  </v-btn>


                  <v-btn icon>
                    <v-icon color='warning'>comments</v-icon>
                  </v-btn>

                </v-card-actions>


<center>
                <v-card-text>

                  <v-avatar>
                    <v-img :src='"/storage/avatars/"+post.user.id+".jpg"'></v-img>
                  </v-avatar>

                  Published by Luis Rene Lopez

                </v-card-text>

</center>


              </v-card>





            </v-flex>

          </v-layout>

</template>

<script>
export default {

    data(){
        return{
            posts: []
        }
    },

    created(){

        axios.post('api/list_posts').then( res => { this.posts = res.data; } );

    }
}
</script>
