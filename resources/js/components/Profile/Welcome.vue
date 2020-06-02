<template>

    <v-col cols='8'>

       <v-card >
              <v-carousel>
              <v-carousel-item v-for='(item, i) in items' :key='i' :src='item.src'
                    reverse-transition='fade-transition' transition='fade-transition'>
              </v-carousel-item>
              </v-carousel>
        </v-card>

    </v-col>

</template>

<script>
export default {

  name: 'Menu',

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
          },]
      }
  }

}
</script>
