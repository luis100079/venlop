<template>
  <v-app>
    <v-container>

      <NavBar></NavBar>

      <v-row>


      <v-col cols='6'>

        <img id='img' :src='dir' width='80%' height='auto'>

        <v-file-input id='file_input' accept='image/*' placeholder="Change Photo" prepend-icon="mdi-camera" @change='preview()'></v-file-input>

        <v-btn v-show=' show ' @click='upload_avatar()' color='success'>Upload Photo</v-btn>

      </v-col>


      <v-col cols='6'>

      <form>

        <v-text-field label='Full Name' :rules='rules' v-model='details.name'> </v-text-field>

        <v-textarea label='About Me' v-model='details.about_me'></v-textarea>

        <v-select :items='[ "Male", "Female" ]' v-model='details.gender' label='Gender'> </v-select>


        <v-text-field label='Phone #' v-model='details.tel'></v-text-field>

        <v-text-field label='age' v-model='details.age'></v-text-field>

        <v-text-field label='Country' v-model='details.country'></v-text-field>

        <v-text-field label='Address' v-model='details.address'></v-text-field>

        <v-text-field label='Height' v-model='details.height'></v-text-field>

        <v-text-field label='Weight' v-model='details.weight'></v-text-field>

        <v-select :items='[ "Single", "Married", "Engaged", "Othe" ]' v-model='details.m_status' label='Marital Status'> </v-select>

        <v-select :items='[ "Female", "Male" ]' label='Interested in' v-model='details.interested_in'> </v-select>

        <v-btn large @click='set_details()' color='success'>Save</v-btn>

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

  data: () => ({



      dir: '/storage/avatars/random/men/jefe.png',

      img: null,

      file_input: null,

      show: false,

      details: {

          name: null,
          tel: null,
          age: null,
          country: null,
          address: null,
          height: null,
          weight: null,
          gender: null,
          m_status: null,
          interested_in: null,
          about_me: null

      },

      rules: [
        value => !!value || 'Required.',
        value => (value && value.length >= 3) || 'Min 3 characters',
      ]



  }),

  methods: {

    preview(){

        var input = document.getElementById('file_input');

        var img = document.getElementById('img');

        img.src = window.URL.createObjectURL(input.files[0]);

        this.show = true

    },

    upload_avatar(){

        var data = new FormData();
        var src = document.getElementById('file_input').files[0];
        data.append('avatar', src);
        axios.post('/api/upload_avatar', data,  { headers: { 'Content-Type' : 'multipart/form-data' }  }).then( window.location.href = '/profile' );

    },

    set_details(){
        axios.post('/api/set_details', this.details).then( window.location.href = '/profile'  );
    }

  }

}

</script>
