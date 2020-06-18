<template>

<div>
    <v-app-bar color='green' dark>
      <v-app-bar-nav-icon @click='drawer = true'></v-app-bar-nav-icon>
    </v-app-bar>

    <v-navigation-drawer v-model='drawer' absolute temporary>
      <v-list nav dense>
        <v-list-item-group v-model='group' active-class='green--text text--accent-4'>

            <v-list-item href='/home'>
              <v-list-item-icon>
                <v-icon color='success'>home</v-icon>
              </v-list-item-icon>
              <v-list-item-title>Home</v-list-item-title>
            </v-list-item>


            <v-list-item href='/profile'>
              <v-list-item-icon>
                <v-icon color='success'>person</v-icon>
              </v-list-item-icon>
              <v-list-item-title>Profile</v-list-item-title>
            </v-list-item>



            <v-list-item href='/photos'>
              <v-list-item-icon>
                <v-icon  color='success'>collections</v-icon>
              </v-list-item-icon>
              <v-list-item-title>Photos</v-list-item-title>
            </v-list-item>


            <v-list-item href='/videos'>
                <v-list-item-icon>
                    <v-icon color='success'>video_library</v-icon>
                </v-list-item-icon>
                <v-list-item-title>Videos</v-list-item-title>
            </v-list-item>

<!--
            <v-list-item>
                <v-list-item-icon>
                    <v-icon>star</v-icon>
                </v-list-item-icon>
                <v-list-item-title>Stars</v-list-item-title>
            </v-list-item>
-->

<!--
            <v-list-item>
                <v-list-item-icon>
                    <v-icon>mdi-heart</v-icon>
                </v-list-item-icon>
                <v-list-item-title>Followers</v-list-item-title>
            </v-list-item>
-->
            <v-list-item href='/blogs'>
                <v-list-item-icon>
                    <v-icon color='success'>local_library</v-icon>
                </v-list-item-icon>
                <v-list-item-title>Blogs</v-list-item-title>
            </v-list-item>

<!--
            <v-list-item>
              <v-list-item-icon>
                <v-icon>fa fa-briefcase</v-icon>
              </v-list-item-icon>
              <v-list-item-title>Resume / Jobs</v-list-item-title>
            </v-list-item>
-->

<!--
            <v-list-item>
                <v-list-item-icon>
                    <v-icon>settings</v-icon>
                </v-list-item-icon>
                <v-list-item-title>Settings</v-list-item-title>
            </v-list-item>
-->

            <v-list-item @click='logout()'>
              <v-list-item-icon>
                <v-icon color='success'>exit_to_app</v-icon>
              </v-list-item-icon>
              <v-list-item-title>Logout</v-list-item-title>
            </v-list-item>


        </v-list-item-group>
      </v-list>
    </v-navigation-drawer>

</div>

</template>

<script>

export default {

    data: () => ({

            drawer: false

    }),

    methods: {

        logout(){

            axios.post('/logout').then( window.location.reload() );

        }

    }
}
</script>
