<template>

<v-app>
    <v-container fuid>
      <NavBar></NavBar>
     
      Titulo<input type='text'> <br>

      Imagen de portada <input type='file'> <br>

      <v-btn icon>
        <v-icon>save</v-icon>
      </v-btn>

    </v-container>

</v-app>

</template>

<script>
import NavBar from '../NavBar'


export default {

    components: { NavBar }

}
</script>
