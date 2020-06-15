<template>
  <v-app>

    <v-container>

      <v-form>

        <v-text-field label='Name' v-model=' form.name '></v-text-field>

        <v-text-field label='E-mail' v-model=' form.email '></v-text-field>

        <v-text-field label='Password' v-model=' form.password '></v-text-field>

        <v-checkbox label='Terms & conditions'></v-checkbox>

        <v-btn @click='login()'>Submit</v-btn>

      </v-form>

    </v-container>

  </v-app>
</template>

<script>
export default {

    data() {

        return {

          form: { name: null, email: null, password : null }

        }

    },

    methods: {
        login() {
//       console.log(this.form)
         axios.post('/api/create_account', this.form ).then( response => { console.log(response.data) } )

         }
    },

    created() {

     }

}
</script>
