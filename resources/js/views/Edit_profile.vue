<template>

      <v-container>

      <v-layout wrap align-center>


        <v-flex xs12 md5>

            <img id='img' style='display:block; margin:auto;' :src=" Number(details.avatar) === 0 ? `/storage/avatars/men/sample_1.png`  : `/storage/avatars/${details.id}.jpg`  " width='80%' height='auto'>

            <v-file-input id='file_input' accept='image/jpeg' placeholder="Change Photo" prepend-icon="mdi-camera" @change='preview()'></v-file-input>

            <v-btn v-show=' show ' @click='upload_avatar()' color='success'>Upload Photo</v-btn>

        </v-flex>



        <v-flex xs12 md7>

        <form @submit='set_details($event)' >

        <v-text-field label='Name' :rules='rules' v-model='details.name' required> </v-text-field>

        <v-text-field label='Profession' v-model='details.profession'> </v-text-field>

<!--        <v-select :items='[ "Male", "Female" ]' v-model='details.gender' label='Gender'> </v-select> -->

        <v-text-field label='Phone #' v-model='details.tel'></v-text-field>

        <v-text-field label='Country' v-model='details.country'></v-text-field>

        <v-textarea label='About Me' v-model='details.about_me'></v-textarea>

        <v-btn type='submit' large color='success'>Save</v-btn>

      </form>

      </v-flex>

    </v-layout>

    </v-container>

</template>

<script>

export default {

  data: () => ({

      img: null,

      file_input: null,

      show: false,

      details: {},
/*
      details: {

          name: null,
          profession: null,
          tel: null,
          country: null,
          gender: null,
          about_me: null

      },

*/

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
        axios.post('/api/upload_avatar', data,  { headers: { 'Content-Type' : 'multipart/form-data' }  }).then( res => { window.location.reload() } /* window.location.href = '/user?id='+this.details.id */ );

    },

    set_details(e){
        e.preventDefault();
        axios.post('/api/set_details', this.details).then( res =>{ window.location.reload()  /* window.location.href = '/user?id='+this.details.id */ } );
    }

  },

  beforeCreate() {

    axios.post('/api/user', this.details).then( res => { this.details = res.data; } );

  }

}

</script>
