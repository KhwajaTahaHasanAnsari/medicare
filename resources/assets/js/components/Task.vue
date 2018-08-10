<template>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <button @click="initAddTask()" class="btn btn-primary btn-xs pull-right" >
                            + Add New Task
                        </button>
                        My Tasks
                    </div>
 
                    <div class="panel-body">
                      <!--  {{csrf_field()}}-->
                        <table class="table table-bordered table-striped table-responsive"  v-if="tasks.length > 0">
                            <tbody>
                            <tr>
                                <th>
                                    No.
                                </th>
                                <th>
                                    Name
                                </th>
                                <th>
                                    Description
                                </th>
                                <th>
                                    Action
                                </th>
                            </tr>
                            <tr  v-for="task in tasks" :key="task.id">
                                <td>{{ task.id}}</td>
                                <td>
                                    {{ task.name }}
                                </td>
                                <td>
                                    {{ task.description }}
                                </td>
                                <td>
                                    <button @click="initUpdate(task)" class="btn btn-success btn-xs">Edit</button>
                                   <button @click="deleteTask(task.id)" class="btn btn-danger btn-xs">Delete</button>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
 
        <div class="modal fade" tabindex="-1" role="dialog" id="add_task_model">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Add New Task</h4>
                    </div>
                    <div class="modal-body">
 
                        <div class="alert alert-danger" v-if="errors.length > 0">
                            <ul>
                                <li v-for="error in errors">{{ error }}</li>
                            </ul>
                        </div>
 
                        <div class="form-group">
                            <label for="name">Name:</label>
                            <input type="text" name="name" id="name" placeholder="Task Name" class="form-control"
                                   v-model="task.name">
                        </div>
                        <div class="form-group">
                            <label for="description">Description:</label>
                            <textarea name="description" id="description" cols="30" rows="5" class="form-control"
                                      placeholder="Task Description" v-model="task.description"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" @click="createTask" class="btn btn-primary">Submit</button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
 
        <div class="modal fade" tabindex="-1" role="dialog" id="update_task_model">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Update Task</h4>
                    </div>
                    <div class="modal-body">
 
                        <div class="alert alert-danger" v-if="errors.length > 0">
                            <ul>
                                <li v-for="error in errors">{{ error }}</li>
                            </ul>
                        </div>
 
                        <div class="form-group">
                            <label>Name:</label>
                            <input type="text" placeholder="Task Name" class="form-control" id="e_task_name">
                            <input type="hidden" placeholder="Task Name" class="form-control" id="e_task_id">
                        </div>
                        <div class="form-group">
                            <label for="description">Description:</label>
                            <textarea cols="30" rows="5" class="form-control"
                                      placeholder="Task Description" id="e_task_desc"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" @click="updateTask" class="btn btn-primary">Submit</button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
 
    </div>
</template>
 
<script>
    export default {
        data(){
            return {
                task: {
                    id:'',
                    name: '',
                    description: ''
                },
                errors: [],
                tasks: [],
                update_task:[]
            }
        },
        mounted()
        {
            this.readTasks();
        },
        methods: {
            initAddTask()
            {
                $("#add_task_model").modal("show");
            },
            createTask()
            {
                axios.post('http://medicare.test:82/task', {
                    name: this.task.name,
                    description: this.task.description,
                })
                    .then(response => {
 
                        this.reset();
 
                        this.tasks.push(response.data.task);
 
                        $("#add_task_model").modal("hide");
 
                    })
                    .catch(error => {
                        this.errors = [];
                       /* if (error.response.data.errors.name) {
                            this.errors.push(error.response.data.errors.name[0]);
                        }
 
                        if (error.response.data.errors.description) {
                            this.errors.push(error.response.data.errors.description[0]);
                        }*/
                    });
            },
            reset()
            {
                this.task.name = '';
                this.task.description = '';
            },
            readTasks()
            {
                axios.get('/task')
                    .then(response => {
 
                        this.tasks = response.data.tasks;
 
                    });
            },
            initUpdate(task)
            {   
                
                console.log("inside update method");
                console.log(task);
                this.errors = [];
                 this.update_task.taskIndex = this.tasks[task.Id];
                $('#e_task_name').val(task.name);
                $('#e_task_desc').val(task.description);
                $('#e_task_id').val(task.id);

                $("#update_task_model").modal("show");
              
               
               // this.update_task.id = this.task.id;
               // this.update_task.name = this.task.name;
               // this.update_task.description= this.task.description;
            },
            updateTask()
            {
                axios.patch('http://medicare.test:82/task/' + $('#e_task_id').val(), {
                    name: $('#e_task_name').val(),
                    description: $('#e_task_desc').val(),
                })
                    .then(response => {
 
                        $("#update_task_model").modal("hide");
                        //alert(response);
                        window.location.reload();
 
                    })
                    .catch(error => {
                        this.errors = [];
                        if (error.response.data.errors.name) {
                            this.errors.push(error.response.data.errors.name[0]);
                        }
 
                        if (error.response.data.errors.description) {
                            this.errors.push(error.response.data.errors.description[0]);
                        }
                    });
            },
            deleteTask(id)
            {
                let conf = confirm("Do you ready want to delete this task?");
                if (conf === true) {
                  console.log(id);
                       // this.tasks.taskIndex = this.task[id];
                    axios.delete(`http://medicare.test:82/task/`+ id )
                   // + this.task.id
                        .then(response => {

                            if (response.status < 400) { 
                            this.task.splice( 
                             this.tasks.findIndex(e => e.id === id), 1) 
                              this.fetchtask();
                              } 
                           
                        })
                        
                           // const  taskIndex  = this.tasks.indexOf(task);
                           // this.tasks.splice(taskIndex, 1);
                           
                        .catch(error => {
                                console.log(error);
                        });
                }
            }
        }
    }
</script>
<style>

</style>
