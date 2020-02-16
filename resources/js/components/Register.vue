<template>
  <div class="container">
     <div class="card">
         <div class="card-header">
            Register
         </div>
         <div class="card-body">
            <div class="col-md-6 offset-md-3">
                <form v-on:submit="onSubmit" method="post">
                   <div class="alert alert-danger" v-if="errors.length">
                      <ul class="mb-0">
                         <li v-for="(error,index) in errors" :key="index">
                           {{error}}
                         </li>
                      </ul>
                   </div>
                   <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" id="name" class="form-control" v-model="name" required>
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
      name: 'register',
      props: ['app'],
      data() {
        return {
          name: '',
          email: '',
          password: '',
          errors: []
        }
      },
      methods: {
            onSubmit: function(event){
                event.preventDefault();
                this.errors = [];
                if(!this.name)
                {
                    this.errors.push("Name is required");
                }
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
                        name: this.name,
                        email: this.email,
                        password: this.password
                    }
                    this.app.req.post("auth/register",data).then(response => {
                        this.app.user = response.data;
                        this.$router.push("/");
                    }).catch(error => {
                        console.log("error value is",error);
                        this.errors.push(error.response.data.error);
                    })
                }
            }
      }
   }  
</script>