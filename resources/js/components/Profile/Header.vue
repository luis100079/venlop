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

                <p>Languages: Spanish, English</p>
            </v-card-text>

            <v-card-actions>

              <v-btn color='green' text>About me</v-btn>

              <v-btn icon>
                <v-icon color='red'>mdi-heart</v-icon>
              </v-btn>

              <v-btn icon>
                <v-icon color='yellow'>star</v-icon>
              </v-btn>

              <v-btn icon>
                <v-icon color='blue dark-4'>fa fa-briefcase</v-icon>
              </v-btn>

              <v-btn icon>
                <v-icon color='orange'>mdi-play</v-icon>
              </v-btn>

              <v-btn icon>
                <v-icon color='blue'>mdi-eye</v-icon>
              </v-btn>

            </v-card-actions>

          </v-card>
        </v-col>

</template>

<script>

export default {
    name: 'Header'
}
</script>
