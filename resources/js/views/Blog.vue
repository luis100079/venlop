<template>

  <v-container>

    <v-card>

        <v-card-title>

          <span style='font-size:12px;'>

           <a :href=' "user?id="+user.id '>
             <v-avatar ><v-img :src="Number(user.avatar) === 0 ? 'storage/avatars/men/sample_1.png' : 'storage/avatars/'+user.id+'.jpg'"></v-img></v-avatar>
             </a> <span>{{ user.name }}</span>
           <br>

           <v-icon color='green accent-3'>mdi-eye</v-icon> <span> {{ details.seens }} </span>
           <v-btn icon  @click='like()'> <v-icon color='red' v-text=' likes.filter( arr => { return  arr.id === me.id }).length ? `mdi-heart` : `mdi-heart-outline` '></v-icon> </v-btn>  <span  v-show='likes.length != 0'>{{ likes.length }}</span>  <br>
           <v-icon color='warning'>mdi-calendar</v-icon> <span>Published on {{ date_created  }}</span> <br>

          </span>
        </v-card-title>


      <div id='HTMLContainer'></div>

      <v-card-actions class='justify-center'>

        <v-dialog  v-model="comment_dialog" fullscreen hide-overlay transition="dialog-bottom-transition">


          <template v-slot:activator="{ on, attrs }">

            <v-btn color='warning' v-bind="attrs" v-on="on" text>Comments (  <v-icon>comment</v-icon>  <span v-show='comments.length != 0 '>{{ comments.length }}</span> )</v-btn>

          </template>


          <v-card>

            <v-app-bar dark color='warning' fixed>

              <v-btn icon dark @click="comment_dialog = false; new_comment = []">
                <v-icon>mdi-close</v-icon>
              </v-btn>

              <v-toolbar-title class='font-italic'>Comments</v-toolbar-title>

                <v-spacer></v-spacer>

                <v-icon size='30' color='white'>comment</v-icon>

              </v-app-bar>

              <span class='my-1'>...</span>

              <v-textarea background-color="grey lighten-5" class='my-12' label='leave a comment' v-model='new_comment' rows='2' color='warning' @keyup.enter='comment(); $event.target.blur(); new_comment = "" '> </v-textarea>


    <v-list>

      <v-list-item v-for='(comment, i) of comments ' :key='i'>

        <a :href=' "user?id="+comment.id '>
        <v-list-item-avatar>
          <v-img  :src="  Number(comment.avatar) === 0   ? 'storage/avatars/men/sample_1.png' : 'storage/avatars/'+comment.id+'.jpg'"></v-img>
        </v-list-item-avatar>
        </a>

        <v-list-item-content>
          <v-list-item-title> {{ comment.name }} </v-list-item-title>
          <v-list-item-subtitle> {{ comment.pivot.comment }} </v-list-item-subtitle>
        </v-list-item-content>

      </v-list-item>

    </v-list>


            </v-card>


        </v-dialog>

      </v-card-actions>

    </v-card>


  </v-container>

</template>

<script>


export default {


    data() {

      return{
            id: "",
            photo: "",
            user: "",
            me: [],
            new_comment: "",
            details: [],
            comments: [],
            likes: [],
            comment_dialog: false,
            date_created: "",
            }

          },

    methods: {

      like(){


        if( this.likes.filter( i => { return i.id == this.me.id }).length !== 0  ){

             this.likes.forEach( (e, i) => { e.id == this.me.id && this.likes.splice( i, 1) } )

          }

        else if ( this.likes.filter( i => { return i.id == this.me.id }).length == 0 ){

          this.likes.push( { id: this.me.id } )

        }

          axios.post('api/like_blog', { id: this.id } );

        },

        comment(){

          this.comments.unshift({ id: this.me.id, name: this.me.name, pivot: { comment: this.new_comment }, avatar:this.me.avatar })

          axios.post('api/comment_blog', {blog_id: this.id, comment: this.new_comment });

        },


      },

    created(){


        axios.post('api/get_post_data', { value: this.$route.query.id }).then( res => {

              this.id = this.$route.query.id;
              this.photo = "storage/avatars/"+res.data.content.user_id+".jpg";
              this.details = res.data.content;
              this.comments = res.data.comments;
              this.likes = res.data.likes;
              this.user = res.data.user;
              this.date_created = (res.data.content.created_at).substr(0,10)
              document.getElementById('HTMLContainer').innerHTML = res.data.content.content;

         } );

         axios.post('api/user').then( res => { this.me = res.data } );

    }

}
</script>
