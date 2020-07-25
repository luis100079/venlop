<template>

  <v-container>

    <template>
      <v-tabs color='warning' v-model='tabs' centered>
        <v-tab v-for='(category, i) of categories' :key='i'> {{ category }} </v-tab>
      </v-tabs>
    </template>

    <v-tabs-items v-model='tabs' class='d-flex justify-center'>

      <v-tab-item>
        <Photos></Photos>
      </v-tab-item>

      <v-tab-item>
        <Videos></Videos>
      </v-tab-item>

      <v-tab-item>
        <Blogs></Blogs>
      </v-tab-item>

    </v-tabs-items>

  </v-container>

</template>

<script>

import Photos from '../components/Photos'
import Videos from '../components/Videos'
import Blogs from '../components/Blogs'

export default {

  components: {Photos, Videos, Blogs},

    data(){
        return { categories: ['Photos', 'Videos', 'Blogs'], tabs: null, }
    }

}

</script>
