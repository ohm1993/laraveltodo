<template>
  <div class="container">
      <navbar :app="this"></navbar>
      <spinner v-if="loading"></spinner>
      <div v-else-if="initiated">
      <router-view :app="this"/>
      </div>
  </div>
</template>
<style>
    .fade-enter-active, .fade-leave-active {
      transition: opacity .5s
    }
    .fade-enter, .fade-leave-active {
      opacity: 0
    }
</style>
<script>
  import Navbar from './components/Navbar';
    export default{
      name: 'app',
      components: {
        Navbar
      },
      data() {
        return {
          user: null,
          loading: false,
          initiated: false,
          req: axios.create({
            baseUrl: 'http://localhost:8000/'
          })
        }
      },
      mounted(){
        this.init();
      },
      methods: {
        init() {
          this.loading = true;
          this.req.get("auth/init").then(response => {
            console.log("response one value is",response);
            if(response.data.user){
              this.user = response.data.user;
              this.loading = false;
              this.initiated = true;
              this.$router.push("/job");
            }else{
              this.loading = false;
              this.initiated = true;
            }
          })
        },
      }
    }
</script>