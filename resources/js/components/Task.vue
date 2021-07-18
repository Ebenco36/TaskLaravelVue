<template>
    <div class="container">
        <h1>Task: {{ tasks.length }}</h1>
        <div class="row">
            <form action="javascript:void(0);" style="width:90%;">
                <div class="form-group">
                    <div class="input-group">
                        <input v-model="task.name"  type="text" class="form-control" placeholder="Task name" aria-label="Task name" aria-describedby="basic-addon2">
                        <div class="input-group-append">
                            <button v-on:click.prevent="createTask()" class="btn btn-primary" type="button" style="">ADD</button>
                        </div>
                    </div>
                </div>

                
            </form>

            
        </div>
        <div class="row" style="width:100%;" id="myUL">
            <ul class="">
                <li v-if="tasks.length === 0" class="">Nothing on the list</li>
                <li v-on:click.prevent="markTask(task.id)" :class="[ task.status == 'complete' ? 'checked' : 'list-group-item']" v-for="(task, index) in tasks" :style="[task.status == 'complete' ? {'text-decoration': 'line-through'} : '']">
                    <span v-on:click.prevent="markTask(task.id)">{{task.name}}</span>
                <span v-on:click.prevent="deleteTask(task.id)" style="float:right!important;" class="close">×</span>
                </li>
                
            </ul>
        </div>
    </div>

</template>

<script>
    export default{
        data(){
            return {
                tasks: [],
                task:{
                    id: '',
                    name: '',
                    status: ''
                },
                editingTask: {},
                activeItem: 'current'
            };
        },

        created(){
            this.fetchTask();
        },

        methods:{
            fetchTask(){
                axios.get('api/task').then((res) =>{
                    this.tasks = res.data.data;
                }).catch(err => {
                    console.log(err);
                });
            },
            createTask(){
                axios.post('api/task', this.task).then((res) => {
                    this.task.name = ""
                    this.edit = false;
                    this.fetchTask();
                }).catch(err => {
                    console.log(err);
                });
            },

            markTask(id){
                axios.get('api/mark-task/'+id).then((res) => {
                    this.fetchTask();
                }).catch(err => {
                    console.log(err);
                });
            },

            
            deleteTask(id){
                axios.delete('api/task/'+id).then((res) => {
                    this.fetchTask();
                }).catch(err => {
                    console.log(err);
                });
            }
        }
    }
</script>

<style>
/* Remove margins and padding from the list */
ul {
  margin: 0;
  padding: 0;
  width: 100%;
}

/* Style the list items */
ul li {
  cursor: pointer;
  position: relative;
  padding: 12px 8px 12px 40px;
  list-style-type: none;
  background: #eee;
  font-size: 18px;
  transition: 0.2s;
  
  /* make the list items unselectable */
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
}

/* Set all odd list items to a different color (zebra-stripes) */
ul li:nth-child(odd) {
  background: #f9f9f9;
}

/* Darker background-color on hover */
ul li:hover {
  background: #ddd;
}

/* When clicked on, add a background color and strike out text */
ul li.checked {
  background: #888;
  color: #fff;
  text-decoration: line-through;
}

/* Add a "checked" mark when clicked on */
ul li.checked::before {
  content: '';
  position: absolute;
  border-color: #fff;
  border-style: solid;
  border-width: 0 2px 2px 0;
  top: 10px;
  left: 16px;
  transform: rotate(45deg);
  height: 15px;
  width: 7px;
}



/* Style the close button */
.close {
  position: absolute;
  right: 0;
  top: 0;
  padding: 12px 16px 12px 16px;
  border: 1px solid grey;
  background-color: #f44336;
}

.close:hover {
  background-color: #f44336;
  color: white;
}
</style>