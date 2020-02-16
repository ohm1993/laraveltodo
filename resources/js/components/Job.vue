<template>
  <div class="container">
     <div class="card">
         <div class="card-header">
             Complete Jobs
         </div>
         <div class="card-body">  
               <form>
                    <div class="form-row align-items-center">
                        <div class="col-auto">
                        <label class="sr-only" for="inlineFormInput">Name</label>
                        <input type="text" class="form-control mb-2"  size="110"  placeholder="New Task" v-model="taskname">
                        </div>
                        <div class="col-auto">
                        <button type="submit" class="btn btn-primary mb-2" @click="addTask()">Add Task</button>
                        </div>
                    </div>
                    </form>
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
                        <td class="col-md-5">{{task.name}}</td>
                        <td><input type="checkbox"  @click="removeTask(task.id)" name="name1" />&nbsp;</td>
                    </tr>
                    </tbody>
                </table>
          </div>  
     </div>
  </div>
</template>
<style>
   
</style>
<script>
   export default{
        name: 'completejob',
        props: ['app'],
        data() {
            return {
                list: [],
                task: {
                    id: '',
                    name: ''
                },
                taskname: ''
            };
        },
        mounted(){
           this.fetchCompleteTask();
        },
        methods: {
            fetchCompleteTask() {
                this.app.req.get("api/alltask/" +this.app.user.id).then(response => {
                    console.log("response value is",response);
                    this.list = response.data.tasks;
                })
            },
            removeTask(id) {
                this.app.req.delete('api/task/'+id).then(result => {
                    this.fetchCompleteTask();
                }).catch(err => {
                    console.log(err);
                });
            },
            addTask(){
                event.preventDefault();
                const data = {
                        name: this.taskname,
                        user_id: this.app.user.id
                    }
                    this.app.req.post("api/task",data).then(response => {
                       this.taskname = '';
                       this.fetchCompleteTask();
                    }).catch(error => {
                        console.log("error value is",error);
                    })
            }
        }
        
   }  
</script>