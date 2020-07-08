<template>

<v-app>

      <NavBar></NavBar>

      <v-container fuid>

        <v-text-field  prepend-icon="menu_book" label='Blog name' v-model='title'></v-text-field>

        <v-file-input  prepend-icon="insert_photo" id='thumbnail_input' label='Blog thumbnail picture' accept='image/*'> </v-file-input>

    <editor
       output-format="html"
       v-model="content"
       api-key="1g8zmzjy4q697wqvanevaj237ak9lnjcibwzmzrp2s3xxuf2"
       :init="{
         height: 500,
         menubar: false,
         plugins: [
           'advlist autolink lists link image charmap print preview anchor',
           'searchreplace visualblocks code fullscreen',
           'insertdatetime media table paste code help wordcount'
         ],
         toolbar:
           'undo redo | formatselect | bold italic backcolor | \
           alignleft aligncenter alignright alignjustify | \
           bullist numlist outdent indent | removeformat | help'
       }"
     />



      <v-btn large color='error' @click='upload()'>
        Create
      </v-btn>






    </v-container>

</v-app>

</template>


<script>
import NavBar from '../components/NavBar'
import Editor from '@tinymce/tinymce-vue'

export default {

    components: { NavBar, Editor },

    data(){
        return {

             content: null,

             title : null

        }
    },

    methods: {
        upload(){

            var src = document.getElementById('thumbnail_input').files[0];

            var data = new FormData();

            data.append('thumbnail', src);
            data.append('title', this.title);
            data.append('content', this.content);

            axios.post('api/create_post', data,  { headers: { 'Content-Type' : 'multipart/form-data' } } ).then( res => { window.location.href='/blogs' } );
        }

    }
}

</script>
