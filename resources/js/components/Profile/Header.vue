<template>

        <v-col cols='4'>
          <v-card>

            <v-img class='grey lighten-2 white--text align-end' aspect-ratio='1.7' height='' lazy-src='https://picsum.photos/510/300?random' src='https://picsum.photos/510/300?random'>
              <v-card-title>Luis Rene López</v-card-title>

            </v-img>

            <v-card-text>
                <p>Age: 20</p>

                <p>Country: Guatemala</p>

                <p>Interested in Women</p>

                <p>Status: Single</p>

<!--                <p>Languages: Spanish, English</p> -->
            </v-card-text>

            <v-card-actions>

              <v-btn @click='show = !show ' color='green' text>About me</v-btn>

              <v-tooltip top>

                <template v-slot:activator="{ on, attrs }">

                  <v-btn icon v-on='on' v-bind='attrs'>
                    <v-icon color='red'>mdi-heart</v-icon>
                  </v-btn>

                </template>

                <span>
                    Follow
                </span>

              </v-tooltip>




<!--
              <v-btn icon>
                <v-icon color='yellow'>star</v-icon>
              </v-btn>

              <v-btn icon>
                <v-icon color='blue dark-4'>fa fa-briefcase</v-icon>
              </v-btn>

              <v-btn icon>
                <v-icon color='orange'>mdi-play</v-icon>
              </v-btn>
-->
            <v-tooltip top>
                <template v-slot:activator="{ on, attrs }">

                  <v-btn icon v-on='on' v-bind='attrs'>
                    <v-icon color='blue'>mdi-eye</v-icon>
                  </v-btn>

                </template>
                <span>Visits</span>
            </v-tooltip>


              <v-spacer></v-spacer>

              <v-tooltip left>

                <template v-slot:activator="{ on, attrs }">

                  <v-btn href='/edit_profile' v-on='on' v-bind='attrs' icon>
                    <v-icon size='30' color='orange'>create</v-icon>
                  </v-btn>

                </template>

                <span>Edit</span>

              </v-tooltip>

            </v-card-actions>

            <v-expand-transition>

                <div v-show='show'>

                <v-card-text>
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Tenetur, optio aliquid porro voluptatem dolore sunt blanditiis eveniet laborum iure assumenda minus nisi, alias qui facilis nulla deserunt ipsam possimus rem!
                </v-card-text>

                </div>

            </v-expand-transition>

          </v-card>
        </v-col>

</template>

<script>

export default {
    name: 'Header',

    data: () => ({

        show:false

    })
}
</script>
