<template>
<div>
    <h2>Departments</h2>
    <form @submit.prevent="addDepartment" class="mb-2" >
        <div class="form-group">
        <input type="text" class="form-control" placeholder="Department name" v-model="department.NAME">
        </div>
        <button type="submit" class=" btn btn-info btn-block">Save</button>
    </form>
    <div class="card card-body mb-2" v-for="department in departments" v-bind:key="department.DEPT_ID">
            <h4>{{department.NAME}}</h4>
            <hr>
            <form class="mb-2" >
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Department name" v-model="department.NAME">
                </div>
                <button type="submit" @click.prevent="updateDepartment(department.DEPT_ID, department.NAME)" class=" btn btn-info btn-block">Update</button>
            </form>
            <button @click="deleteDepartment(department.DEPT_ID)" class="btn btn-danger">Delete</button>
    </div>
</div>
</template>

<script>
export default {
    data(){
        return{
            departments:[],
            department:{
                DEPT_ID:'',
                NAME:''
            }
        }
    },
    created(){
        this.fetchDepartments();
    },
    methods:{
        fetchDepartments(){
            fetch('api/departments')
            .then(res=>res.json())
            .then(res =>{
                this.departments = res.data;
            });
        },
        deleteDepartment(DEPT_ID){
            fetch('api/departments/'+DEPT_ID, {
            method : 'delete'})
            .then(res => res.json())
            .then( data=>{
                alert('Departments deleted');
                this.fetchDepartments();
             }).catch(err=> console.log(err))
            },
    addDepartment(){
        fetch('api/departments',{
            method: 'post',
            body: JSON.stringify(this.department),
            headers:{
                'content-type' :'aplication/json'
            }
        }).then(res=>res.json())
        .then(data => {
            this.department.NAME = '';
            alert('Department added');
            this.fetchDepartments();
        })
    },
    updateDepartment(DEPT_ID, NAME){
    this.department.DEPT_ID = DEPT_ID;
    this.department.NAME = NAME;
    fetch('api/departments/'+DEPT_ID,{
            method: 'put',
            body: JSON.stringify(this.department),
            headers:{
                'content-type' :'aplication/json'
            }
        }).then(res=>res.json())
        .then(data => {
            alert('Department updated');
           this.fetchDepartments();
       })
    }
    },
}
</script>
