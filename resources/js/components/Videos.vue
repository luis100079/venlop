<template>
  <v-app>
    <v-container>
      <v-card>
        <v-container fluid>
          <v-row>
              <v-col v-for='n in 12' :key='n' cols='3' class='d-flex child-flex'>

                <v-card flat tile class='d-flex'>

                  <v-dialog v-model='dialog' width='500px'>

                    <template v-slot:activator='{ on }'>

                    <video
                         v-on='on'
                         :src='`https://www.w3schools.com/html/mov_bbb.mp4`'
                          aspect-ratio='1'
                          class='grey lighten-2'>
                    </video>

                    </template>

                    <video controls
                         :src='`https://www.w3schools.com/html/mov_bbb.mp4`'
                          aspect-ratio='1'
                          class='grey lighten-2'>
                    </video>

                  </v-dialog>

                </v-card>

              </v-col>
          </v-row>
        </v-container>
      </v-card>
    </v-container>
  </v-app>
</template>

<script>
export default {

    name: 'Videos'

}
</script>
