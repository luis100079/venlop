<template>

<v-app>
    <v-container fuid>
      <NavBar></NavBar>

     <!-- <Vueditor id='vueditor' style='height:450px'></Vueditor> -->


  <textarea>Next, get a free Tiny Cloud API key!</textarea>


      Titulo<input type='text'> <br>

      Imagen de portada <input type='file'> <br>


      <v-btn icon @click='upload()'>
        <v-icon>save</v-icon>
      </v-btn>

      <div id='x'>

      </div>

    </v-container>

</v-app>

</template>


<script>
import NavBar from '../NavBar'


export default {

    components: { NavBar },

    methods: {
        upload(){

            document.getElementById('x').innerHTML =
            document.getElementById('vueditor').innerHTML; }
     }

}
</script>
