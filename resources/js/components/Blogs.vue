<template>
  <v-app>
    <v-container fuid>

     <NavBar></NavBar>

      <v-card>

        <v-card-title>
          <a href='/create_blog' style='text-decoration:none;'>

          <v-btn icon>
            <v-icon color='blue'>local_library</v-icon>
          </v-btn>
          + New Blog

          </a>
        </v-card-title>

        <v-container fluid>
          <v-row>

              <v-col v-for='n in 11' :key='n' cols='3' class='d-flex child-flex'>

                <a :href='`/blog/${n}`'>
                <v-card flat tile class='d-flex'>

                    <v-img
                         :src='`https://picsum.photos/500/300?image=${n * 5 + 10}`'
                         :lazy-src='`https://picsum.photos/500/300?image=${n * 5 + 10}`'
                          aspect-ratio='1'
                          class='grey lighten-2'>
                    </v-img>

                </v-card>
                </a>

              </v-col>
          </v-row>
        </v-container>
      </v-card>

    </v-container>
  </v-app>
</template>

<script>
import NavBar from './NavBar'

export default {

    name: 'Blogs',
    components: { NavBar }

}
</script>
