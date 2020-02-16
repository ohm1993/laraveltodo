<template>
  <div class="container">
     <div class="card">
         <div class="card-header">
             InComplete Jobs
         </div>
         <div class="card-body">           
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>S.no</th>
                        <th class="col-md-5">Name</th>
                        <th class="col-md-3">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    
                    <tr v-for="(task, index) in list">
                        <td>{{index+1}}</td>
                        <td class="col-md-5"><strike>{{task.name}}</strike></td>
                        <td><input type="checkbox"  @click="changeTask(task.id)" name="name1" />&nbsp;</td>
                    </tr>
                    </tbody>
                </table>
                <div style="text-align: center;" v-if='list.length === 0'>There are no tasks</div>
          </div>  
     </div>
  </div>
</template>
<style>
   
</style>
<script>
   export default{
        name: 'incompletejob',
        props: ['app'],
        data() {
            return {
                list: [],
                task: {
                    id: '',
                    name: ''
                }
            };
        },
        mounted(){
           this.fetchCompleteTask();
        },
        methods: {
            fetchCompleteTask() {
                this.app.req.get("api/completetask/"+this.app.user.id).then(response => {
                    this.list = response.data.tasks;
                })
            },
            changeTask(id) {
                this.app.req.post('api/changetask/'+id).then(result => {
                    this.fetchCompleteTask();
                }).catch(err => {
                    console.log(err);
                });
            }
        }
        
   }  
</script>