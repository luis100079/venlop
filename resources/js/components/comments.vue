<template>

  <v-card>

    <v-app-bar dark color='warning' fixed>

      <v-btn icon dark @click="comment_dialog = false; comments = []">
        <v-icon>mdi-close</v-icon>
      </v-btn>

      <v-toolbar-title class='font-italic'>Comments</v-toolbar-title>

        <v-spacer></v-spacer>
          <v-icon size='30' color='white'>comment</v-icon>

    </v-app-bar>


    <img class='mt-12' width='100%' height='200px' :src='"storage/photos/"+active_img'>

      <center><v-card-text class='font-italic'>Hermoso paisaje</v-card-text></center> <v-divider></v-divider>

      <v-textarea label='leave a comment' rows='2' color='warning' v-model='new_comment' @keyup.enter='comment(); $event.target.blur(); new_comment = "" '>
      </v-textarea>

      <v-list>

        <v-list-item v-for='(comment, i) of comments ' :key='i'>

          <v-list-item-avatar>
            <v-img :src='"storage/avatars/"+comment.id+".jpg"'></v-img>
          </v-list-item-avatar>

          <v-list-item-content>
            <v-list-item-title> {{ comment.name }} </v-list-item-title>
            <v-list-item-subtitle> {{ comment.pivot.comment }} </v-list-item-subtitle>
          </v-list-item-content>

        </v-list-item>

      </v-list>


  </v-card>
</template>

<script>

export default {


  props: {

    comments: Object,

  },

  data(){

    return {

    }

  },


}

</script>
