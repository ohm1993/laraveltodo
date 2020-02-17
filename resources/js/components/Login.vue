<template>
  <div class="container">
     <div class="card">
         <div class="card-header">
            Login
         </div>
         <div class="card-body">
            <div class="col-md-6 offset-md-3">
                <form v-on:submit="onLogin" method="post">
                    <div class="alert alert-danger" v-if="errors.length">
                      <ul class="mb-0">
                         <li v-for="(error,index) in errors" :key="index">
                           {{error}}
                         </li>
                      </ul>
                   </div>
                   <div class="form-group">
                        <label for="email">E-mail</label>
                        <input type="email" id="email" class="form-control" placeholder="user@example.com" v-model="email" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" id="password" class="form-control" v-model="password" required>
                    </div>
                    <button type="submit" class="btn btn-default">Submit</button>
                </form>
            </div>
         </div>
     </div>
  </div>
</template>
<style>
   
</style>
<script>
   export default{
      name: 'login',
      props: ['app'],
      data() {
        return {
          email: '',
          password: '',
          errors: []
        }
      },
      methods: {
            onLogin: function(event){
                event.preventDefault();
                this.errors = [];
                if(!this.email)
                {
                    this.errors.push("Email is required");
                }
                if(!this.password)
                {
                    this.errors.push("Password is required");
                }
                if(!this.errors.length)
                {
                    const data = {
                        email: this.email,
                        password: this.password
                    }
                    this.app.req.post("auth/login",data).then(response => {
                        this.app.user = response.data;
                        if(this.app.user.is_two_factor_enabled){
                           window.location.href = 'verify-2fa';
                        }else{
                            window.location.href = 'setup-2fa';
                        }
                    }).catch(error => {
                        console.log("error value is",error);
                        this.errors.push(error.response.data.error);
                    })
                }
            }
      }
   }  
</script>