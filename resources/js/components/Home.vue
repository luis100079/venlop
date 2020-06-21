<template>
  <v-app>
  <v-container>
    <NavBar></Navbar>

     <template>

       <v-tabs color='green' v-model='tabs' centered>
         <v-tab v-for='(media, i) of medias' :key='i'> {{ media }} </v-tab>

       </v-tabs>
     </template>


      <v-tabs-items v-model='tabs'>

        <v-tab-item>
          <v-card>
            Lorem, ipsum dolor sit amet consectetur adipisicing elit. Nulla a, odit voluptatum quibusdam corrupti animi ipsam impedit architecto asperiores magnam deserunt praesentium unde, amet delectus tenetur facilis? Minus, tenetur mollitia.
          </v-card>
        </v-tab-item>

        <v-tab-item>
          <v-card>
            Lorem ipsum dolor, sit amet consectetur adipisicing elit. Recusandae dolor accusamus accusantium, quibusdam pariatur nam voluptatem? Illo ipsam ab, architecto incidunt officia quas suscipit illum nihil nam a, ex laboriosam.
          </v-card>
        </v-tab-item>

         <v-tab-item>
          <v-card>
            Lorem, ipsum dolor sit amet consectetur adipisicing elit. Nulla a, odit voluptatum quibusdam corrupti animi ipsam impedit architecto asperiores magnam deserunt praesentium unde, amet delectus tenetur facilis? Minus, tenetur mollitia.
          </v-card>
        </v-tab-item>

        <v-tab-item>
          <v-card>
            Lorem ipsum dolor, sit amet consectetur adipisicing elit. Recusandae dolor accusamus accusantium, quibusdam pariatur nam voluptatem? Illo ipsam ab, architecto incidunt officia quas suscipit illum nihil nam a, ex laboriosam.
          </v-card>
        </v-tab-item>

      </v-tabs-items>


  </v-container>
  </v-app>
</template>

<script>
import NavBar from './NavBar.vue'

export default {

    data(){
        return {

           medias: ['All', 'Photos', 'Videos', 'Posts'],

           tabs: null

         }
    },

    created(){

     // axios.get('api/videos').then( response => { console.log(response.data) } );

    },

    components: { NavBar }

}
</script>
