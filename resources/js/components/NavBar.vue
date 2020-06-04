<template>

<div>
    <v-app-bar color='green' dark>
      <v-app-bar-nav-icon @click='drawer = true'></v-app-bar-nav-icon>
    </v-app-bar>

    <v-navigation-drawer v-model='drawer' absolute temporary>
      <v-list nav dense>
        <v-list-item-group v-model='group' active-class='green--text text--accent-4'>

            <v-list-item>
              <v-list-item-icon>
                <v-icon>person</v-icon>
              </v-list-item-icon>
              <v-list-item-title>Profile</v-list-item-title>
            </v-list-item>

            <v-list-item>
              <v-list-item-icon>
                <v-icon>collections</v-icon>
              </v-list-item-icon>
              <v-list-item-title>Photos</v-list-item-title>
            </v-list-item>


            <v-list-item>
                <v-list-item-icon>
                    <v-icon>video_library</v-icon>
                </v-list-item-icon>
                <v-list-item-title>Videos</v-list-item-title>
            </v-list-item>

            <v-list-item>
                <v-list-item-icon>
                    <v-icon>star</v-icon>
                </v-list-item-icon>
                <v-list-item-title>Stars</v-list-item-title>
            </v-list-item>

            <v-list-item>
                <v-list-item-icon>
                    <v-icon>mdi-heart</v-icon>
                </v-list-item-icon>
                <v-list-item-title>Followers</v-list-item-title>
            </v-list-item>

            <v-list-item>
                <v-list-item-icon>
                    <v-icon>local_library</v-icon>
                </v-list-item-icon>
                <v-list-item-title>Blogs</v-list-item-title>
            </v-list-item>

            <v-list-item>
              <v-list-item-icon>
                <v-icon>fa fa-briefcase</v-icon>
              </v-list-item-icon>
              <v-list-item-title>Resume / Jobs</v-list-item-title>
            </v-list-item>

            <v-list-item>
                <v-list-item-icon>
                    <v-icon>settings</v-icon>
                </v-list-item-icon>
                <v-list-item-title>Settings</v-list-item-title>
            </v-list-item>

            <v-list-item>
              <v-list-item-icon>
                <v-icon>exit_to_app</v-icon>
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

    })
}
</script>
