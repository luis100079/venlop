<template>
<!--  sm='6' offset-sm='3' -->
    <v-col cols='7'>

          <v-card>
            <v-container fluid>
              <v-row>
                <v-col v-for='n in 9' :key='n' cols='4'
                        class='d-flex child-flex'>

                    <v-card>


                     <v-dialog width='500'>

                       <template v-slot:activator='{ on }'>

                             <v-img
                                v-on='on'

                                :src='`https://picsum.photos/500/300?image=${n * 5 + 10}`'
                                :lazy-src='`https://picsum.photos/10/6?image=${n * 5 + 10}`'
                                aspect-ratio='1'
                                class='grey lighten-2'>

                            </v-img>

                       </template>

                        <v-card>

                         <v-img
                         :src='`https://picsum.photos/500/300?image=${n * 5 + 10}`'
                         :lazy-src='`https://picsum.photos/10/6?image=${n * 5 + 10}`'
                          aspect-ratio='1'
                          class='grey lighten-2'>

                          </v-img>

                          <v-card-actions class='justify-center'>

                            <v-btn icon>
                              <v-icon color='red'>mdi-heart</v-icon>
                            </v-btn>

                          </v-card-actions>

                        </v-card>


                     </v-dialog>

                    </v-card>



                </v-col>
              </v-row>
            </v-container>
          </v-card>

    </v-col>

</template>

<script>
export default {
    name: 'Album',
    data(){
        return {
            dialog_album: false
        }
    }
}
</script>
