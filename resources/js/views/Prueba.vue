<template>
  <v-app>
    <v-container>


    <v-layout wrap align-center>

        <v-flex class='blue' v-for="(a, i) in 6 " :key="i" xs6 md3>

             <v-card class='red'>
                Card # {{ a }}
            </v-card>

        </v-flex>

    </v-layout>


    </v-container>
  </v-app>
</template>

<script>
export default {



}
</script>
