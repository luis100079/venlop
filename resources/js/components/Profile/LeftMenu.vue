<template>
  <v-col cols='5'>
    <v-container>


      <v-row>
        <v-col cols='12' >
            <v-carousel >
              <v-carousel-item  v-for='(item, i) in items' :key='i' :src='item.src'
                    reverse-transition='fade-transition' transition='fade-transition'>
              </v-carousel-item>
            </v-carousel>
        </v-col>
      </v-row>
<!--
      <v-row >
        <v-col cols='12' >
            <v-carousel>
              <v-carousel-item v-for='(item, i) in items' :key='i' :src='item.src'
                    reverse-transition='fade-transition' transition='fade-transition'>
              </v-carousel-item>
            </v-carousel>
        </v-col>
      </v-row>
-->

    </v-container>
  </v-col>
</template>

<script>
export default {

    name: 'LeftMenu',

    data(){
      return {
          items: [ {
            src: 'https://cdn.vuetifyjs.com/images/carousel/squirrel.jpg',
          },
          {
            src: 'https://cdn.vuetifyjs.com/images/carousel/sky.jpg',
          },
          {
            src: 'https://cdn.vuetifyjs.com/images/carousel/bird.jpg',
          },
          {
            src: 'https://cdn.vuetifyjs.com/images/carousel/planet.jpg',
          }
          ]
      }
  }

}
</script>
