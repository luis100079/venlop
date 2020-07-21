<template>

        <v-layout wrap align-center>

          <v-flex  v-for="(video, i) of videos" :key='i' xs12 md4>


          <v-card height='400px' class='justify-center my-1'>

            <v-card-title class='justify-center'>

              <v-avatar>
                <v-img :src='"/storage/avatars/"+video.user+".jpg"'></v-img>
              </v-avatar>

              <h2 class='ml-6 font-weight-thin font-italic'></h2>

            </v-card-title>

            <video style='cursor:pointer' :src='video.path + video.name' @click='play($event)' width='100%' height='65%'></video>

            <v-card-actions class='justify-center'>

              <v-btn icon>
                <v-icon size='30' color='red'>mdi-heart-outline</v-icon>
              </v-btn>

              <v-btn class='ml-3' color='orange' icon>
                  <v-icon size='30' color='warning'> comment </v-icon>
              </v-btn>

            </v-card-actions>


          </v-card>


          </v-flex>

        </v-layout>


</template>
