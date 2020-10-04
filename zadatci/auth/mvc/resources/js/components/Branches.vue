<template>
<div>
    <h2>Branches</h2>
    <form @submit.prevent="addBranch" class="mb-2" >
        <div class="form-group">
        <input type="text" class="form-control" placeholder="Branch name" v-model="branch.NAME" required>
        <input type="text" class="form-control" placeholder="Branch city" v-model="branch.CITY" required>
        <input type="text" class="form-control" placeholder="Branch address" v-model="branch.ADDRESS" required>
        <input type="text" class="form-control" placeholder="Branch state" v-model="branch.STATE" required>
        <input type="text" class="form-control" placeholder="Branch ZIP" v-model="branch.ZIP_CODE" required>
        </div>
        <button type="submit" class=" btn btn-info btn-block">Save</button>
    </form>
    <div class="card card-body mb-2" v-for="branch in branches" v-bind:key="branch.BRANCH_ID">
            <h4>{{branch.NAME}}</h4>
            <p>{{branch.CITY}}, {{branch.ADDRESS}}, {{branch.STATE}}</p>
            <h4>ZIP CODE: {{branch.ZIP_CODE}}</h4>
            <hr>
            <form class="mb-2" >
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Branch name" v-model="branch.NAME" required>
                     <input type="text" class="form-control" placeholder="Branch city" v-model="branch.CITY" required>
                     <input type="text" class="form-control" placeholder="Branch address" v-model="branch.ADDRESS" required>
                     <input type="text" class="form-control" placeholder="Branch state" v-model="branch.STATE" required>
                     <input type="text" class="form-control" placeholder="Branch ZIP" v-model="branch.ZIP_CODE" required>
                </div>
                <button type="submit" @click.prevent="updateBranch(branch.BRANCH_ID, branch.NAME,branch.CITY,branch.ADDRESS, branch.STATE, branch.ZIP_CODE )" class=" btn btn-info btn-block">Update</button>
            </form>
            <button @click="deleteBranch(branch.BRANCH_ID)" class="btn btn-danger">Delete</button>
    </div>
</div>
</template>

<script>
export default {
    data(){
        return{
            branches:[],
            branch:{
                BRANCH_ID:'',
                ADDRESS:'',
                CITY:'',
                NAME:'',
                STATE:'',
                ZIP_CODE:''
            }
        }
    },
    created(){
        this.fetchBranches();
    },
    methods:{
        fetchBranches(){
            fetch('api/branches')
            .then(res=>res.json())
            .then(res =>{
                this.branches = res.data;
            });
        },
        deleteBranch(BRANCH_ID){
            fetch('api/branches/'+BRANCH_ID, {
            method : 'delete'})
            .then(res => res.json())
            .then( data=>{
                alert('Branch deleted');
                this.fetchBranches();
             }).catch(err=> console.log(err))
            },
    addBranch(){
        fetch('api/branches',{
            method: 'post',
            body: JSON.stringify(this.branch),
            headers:{
                'content-type' :'aplication/json'
            }
        }).then(res=>res.json())
        .then(data => {
            this.branch.NAME = '';
            this.branch.ADDRESS ='',
            this.branch.CITY='',
            this.branch.NAME='',
            this.branch.STATE='',
            this.branch.ZIP_CODE=''
            alert('Branch added');
            this.fetchBranches();
        })
    },
    updateBranch(BRANCH_ID,NAME,CITY,ADDRESS, STATE, ZIP_CODE){
    this.branch.BRANCH_ID = BRANCH_ID;
    this.branch.NAME = NAME;
    this.branch.CITY = CITY;
    this.branch.ADDRESS = ADDRESS;
    this.branch.STATE = STATE;
    this.branch.ZIP_CODE = ZIP_CODE;
    fetch('api/branches/'+BRANCH_ID,{
            method: 'put',
            body: JSON.stringify(this.branch),
            headers:{
                'content-type' :'aplication/json'
            }
        }).then(res=>res.json())
        .then(data => {
            this.branch.NAME = '';
            this.branch.ADDRESS ='',
            this.branch.CITY='',
            this.branch.NAME='',
            this.branch.STATE='',
            this.branch.ZIP_CODE=''
            alert('Branch updated');
           this.fetchBranches();
       })
    }
    },
}
</script>
