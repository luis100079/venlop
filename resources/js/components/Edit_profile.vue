<template>
  <v-app>
    <v-container>

      <NavBar></NavBar>

      <v-row>

      <v-col cols='6'>

        <img id='img' :src='dir' width='80%' height='auto'>

        <v-file-input id='file_input' accept='image/*' placeholder="Change Photo" prepend-icon="mdi-camera" @change='preview()'></v-file-input>

      </v-col>


      <v-col cols='6'>

      <form>

        <v-text-field label='Full Name'> </v-text-field>

        <v-text-field label='Phone #'></v-text-field>

        <v-text-field label='age'></v-text-field>

        <v-text-field label='Country'></v-text-field>

        <v-select :items='[ "Single", "Married", "engaged" ]' label='Marital Status'> </v-select>

        <v-select :items='[ "Female", "Male" ]' label='Interested in'> </v-select>

        <v-textarea label='About Me'></v-textarea>

        <v-btn large color='success'>Save</v-btn>

      </form>

     </v-col>

      </v-row>


    </v-container>
  </v-app>
</template>

<script>

import NavBar from './NavBar'

export default {

  components: {

    NavBar

  },

  data(){

    return {

      dir: '/storage/avatars/random/men/jefe.png',

      img: null,

      file_input: null

    }

  },

  methods: {

    preview(){

        var input = document.getElementById('file_input');

        var img = document.getElementById('img');

        img.src = window.URL.createObjectURL(input.files[0]);

    }

  }

}

</script>
