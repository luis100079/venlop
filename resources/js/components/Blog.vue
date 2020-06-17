<template>
<v-app>

<v-container>
  <NavBar></NavBar>


    Welcome To blog # {{ $route.params.id }}
</v-container>

</v-app>
</template>

<script>
import NavBar from './NavBar'

export default {



    components: { NavBar }


}
</script>
