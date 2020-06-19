<template>

<div>
    <v-app-bar color='green' dark>

      <v-app-bar-nav-icon @click='drawer = true'></v-app-bar-nav-icon>

        <v-text-field prepend-icon="search" class='ml-12'></v-text-field>

      <v-spacer></v-spacer>

      <v-btn icon href='/home' class='mr-12'>
        <v-icon color='white'>home</v-icon>
      </v-btn>


      <v-btn icon href='/notifications' class='mr-12'>
        <v-icon color='hite'>notifications</v-icon>
      </v-btn>

      <v-btn icon href="/chat" class='mr-12'>
        <v-icon color='white'>chat</v-icon>
      </v-btn>

      <a href='/profile'>
      <v-avatar class='mr-12'>
        <img src='storage/avatars/random/men/jefe.png'>
      </v-avatar>
      </a>



    </v-app-bar>

    <v-navigation-drawer v-model='drawer' absolute temporary>
      <v-list nav dense>
        <v-list-item-group v-model='group' active-class='green--text text--accent-4'>

            <v-list-item href='/profile'>


                <v-avatar>
                  <img src='storage/avatars/random/men/jefe.png'>
                </v-avatar>

              <v-list-item-title>Luis Rene López</v-list-item-title>

            </v-list-item>

            <v-list-item href='/home'>
              <v-list-item-icon>
                <v-icon color='success'>home</v-icon>
              </v-list-item-icon>
              <v-list-item-title>Home</v-list-item-title>
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

             <v-list-item href='/chat'>
                <v-list-item-icon>
                    <v-icon color='success'>chat</v-icon>
                </v-list-item-icon>
                <v-list-item-title>Chat</v-list-item-title>
            </v-list-item>

             <v-list-item href='/notifications'>
                <v-list-item-icon>
                    <v-icon color='success'>notifications</v-icon>
                </v-list-item-icon>
                <v-list-item-title>Notifications</v-list-item-title>
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
