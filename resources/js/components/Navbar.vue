<template>
   <nav class="navbar navbar-expand-sm navbar-dark bg-info mb-2">
      <a class="navbar-brand" href="#">Todo App</a>
      <ul class="navbar-nav">
        <li class="nav-item" v-if="app.user">
          <router-link to="/job" class="nav-link">Jobs</router-link>
        </li>
         <li class="nav-item" v-if="app.user">
          <router-link to="/complete" class="nav-link">complete Job</router-link>
        </li>
      </ul>
        <ul class="navbar-nav ml-auto">
          <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            {{app.user ? app.user.name : 'Account'}}
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <div v-if="!app.user">
             <router-link :to="{ name: 'login' }" class="dropdown-item">Login</router-link>
             <router-link :to="{ name: 'register' }" class="dropdown-item">Register</router-link>
             </div>
             <a v-else href="javascript:;" @click="logout" class="dropdown-item">Logout</a>
          </div>
          </li>
        </ul>
    </nav>
</template>

<script>
  export default{
      name: 'navbar',
      props: ['app'],
      data() {
        return {
          
        }
      },
      methods: {
        logout()
        {
          this.app.req.post("auth/logout").then(()=>{
            this.app.user = null;
            this.$router.push('/');
          })
        }
      }
    }
</script>