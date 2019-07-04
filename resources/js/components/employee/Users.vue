<template>
    <div class="container">
        <div class="row">
            <div class="col-10">
                <h3> User Managenment   </h3> 
            </div>
            <div class="col-2 text-right">
                <!-- <router-link to="/add-user"><i class="fas fa-plus"></i></router-link> -->
                <a class="btn btn-info btn-sm" href="./add-user"><i class="fas fa-plus"></i></a>
            </div>
        </div>
        <!-- <router-view></router-view> -->
        <div class="row">
            <div class="col">
                <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Lastname</th>
                        <th scope="col">username</th>
                        <th scope="col">Email</th>
                        <th scope="col">Role</th>
                        <th scope="col"></th>
                        
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(user,index) in users.data">
                        <td width="15%">{{user.first_name}}</td>
                        <td width="15%">{{user.last_name}}</td>
                        <td width="15%">{{user.username}}</td>
                        <td width="15%">{{user.email}}</td>
                        <td width="10%">{{user.role}}</td>
                        <td width="10%">
                            <a class="btn btn-primary btn-sm" :href="'./edit-user/'+user.id"><i class="fas fa-user-edit"></i></a>
                            <a class="btn btn-danger btn-sm" href="#" v-on:click='deleteuser(user.id,user.first_name,user.last_name,index)'><i class="fas fa-user-slash"></i></a>
                        </td>
                       
                    </tr>
                </tbody>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <pagination :data="users" @pagination-change-page="getResults"></pagination>
            </div>
        </div> 
    </div>
</template>

<script>
    export default {
        mounted() {
            this.getUserData();
        },
        methods: {
            
            getResults(page = 1) {
                axios.get('./api/users?page=' + page)
                    .then(response => {
                        this.users = response.data;
                });
            },
            getUserData(){
               axios.get('./api/users').then(
                   response=>{
                    this.users = response.data;
                   }
               )
            },
            deleteuser(id,name,lastname,index){
                Swal.fire({
                    title: 'Are you sure?',
                    text: name+" "+lastname,
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                   
                    
                    if (result.value) {
                        // console.log(id);
                        axios.delete('./api/users/'+id).then(
                            response=>{
                                this.users.splice(index,1);
                                Swal.fire(
                                    'Deleted!',
                                    '',
                                    'success'
                                )
                            }
                        )
                    }
                })
            }
        },
        data(){
            return{
                users:{},
                
                user:{
                    id:0,
                    first_name:'',
                    last_name:'',
                    username:'',
                    email:'',
                    role:''
                }
            }
        }
    }
</script>
