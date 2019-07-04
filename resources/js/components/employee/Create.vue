
<template>
   
    <div class="container">
        <div class="row">
            <div class="col">
              <h3>Add Employee</h3>
            </div>
        </div>
        <form @submit.prevent="onSubmit">
      
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label for="ID">ID</label>
                    <input type="text" class="form-control" v-validate="'required'" name="emid" v-model="emid" placeholder="Enter Employee ID">
                    <div class="text-danger" v-if="errors.has('emid')">{{ errors.first('emid') }}</div>
                </div>
                <div class="form-group">
                    <label for="role">Role</label>
                    <select class="form-control" v-model="role" v-validate="'required'" name="role" >
                        <option></option>
                        <option>Admin</option>
                    </select>
                    <div class="text-danger" v-if="errors.has('role')">{{ errors.first('role') }}</div>
                </div>
                 <div class="form-group">
                    <label for="title">Title</label>
                    <select class="form-control" v-model="title" v-validate="'required'" name="title">
                        <option>Select Title</option>
                        <option>Mr.</option>
                        <option>Ms.</option>
                        <option>Miss.</option>
                    </select>
                    <div class="text-danger" v-if="errors.has('title')">{{ errors.first('title') }}</div>
                </div>
               <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" v-validate="'required'" name="name" v-model="name" placeholder="Enter Name">
                    <div class="text-danger" v-if="errors.has('name')">{{ errors.first('name') }}</div>
                </div>
                 <div class="form-group">
                    <label for="lastname">Lastname</label>
                    <input type="text" class="form-control" v-validate="'required'" name="lastname" v-model="lastname" placeholder="Enter Lastname">
                    <div class="text-danger" v-if="errors.has('lastname')">{{ errors.first('lastname') }}</div>
                </div>
                <div class="form-group">
                    <label for="nickname">Nickname</label>
                    <input type="text" class="form-control" v-validate="'required'" name="nickname" v-model="nickname" placeholder="Enter Nickname">
                    <div class="text-danger" v-if="errors.has('nickname')">{{ errors.first('nickname') }}</div>
                </div>
                 <div class="form-group ">
                    <label for="gender">Gender</label><br>
                     <select class="form-control" v-validate="'required'" name="gender" v-model="gender">
                        <option>Select Gender</option>
                        <option>Male</option>
                        <option>Female</option>
                    </select>
                    <div class="text-danger" v-if="errors.has('gender')">{{ errors.first('gender') }}</div>
                </div>
                
                
               
            </div>
            <div class="col">
                 
                
                
               
                
                <div class="form-group">
                    <label for="Birthday">Birthday</label> 
                    <input type="date" class="form-control " v-validate="'required'" name="birthday" v-model="birthday">
                    <div class="text-danger" v-if="errors.has('birthday')">{{ errors.first('birthday') }}</div>
                </div>
                <div class="form-group">
                    <label for="Email">Email</label>
                    <input type="text" class="form-control" v-validate="'required|email'" name="email" v-model="email" placeholder="Enter Email">
                    <div class="text-danger" v-if="errors.has('email')">{{ errors.first('email') }}</div>
                </div>
                 <div class="form-group">
                    <label for="Nationality">Nationality</label>
                    <input type="text" class="form-control" v-validate="'required'" name="nationality" v-model="nationality" placeholder="Enter Nationality">
                    <div class="text-danger" v-if="errors.has('nationality')">{{ errors.first('nationality') }}</div>
                </div>
                <div class="form-group">
                    <label for="Street/Distric">Street/Distric</label>
                    <input type="text" class="form-control" v-validate="'required'" name="address" v-model="address" placeholder="Enter Address">
                    <div class="text-danger" v-if="errors.has('address')">{{ errors.first('address') }}</div>
                </div>
                <div class="form-group">
                    <label for="House number">House number</label>
                    <input type="text" class="form-control" v-validate="'required'" name="housenumber" v-model="housenumber" placeholder="House number">
                    <div class="text-danger" v-if="errors.has('housenumber')">{{ errors.first('housenumber') }}</div>
                </div>
                <div class="form-group">
                    <label for="Postal code">Postal code</label>
                    <input type="text" class="form-control" v-validate="{required:true , numeric:true}" name="postalcode" v-model="postalcode" placeholder="Postal code">
                    <div class="text-danger" v-if="errors.has('postalcode')">{{ errors.first('postalcode') }}</div>
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col text-right">
                <button class="btn btn-primary">Create Employee</button>
                
            </div>
        </div>
        </form>
    </div>
</template>

<script>
    import Vue from 'vue';
    import VeeValidate from 'vee-validate';
    Vue.use(VeeValidate);
    
    export default {
        data(){
            return{
                emid:'',
                name:'',
                nickname:'',
                nationality:'',
                gender:'',
                address:'',
                email:'',
                role:'',
                title:'',
                lastname:'',
                birthday:'',
                housenumber:'',
                postalcode:'', 
            }
        },
        methods: {
            onSubmit: function (e) {
                // Swal.fire({
                //     title: '" ID " is already exist !!',
                //     // text: 'Inserted Data!!',
                //     type: 'error',
                //     confirmButtonText: 'OK'
                // });
              this.$validator.validateAll().then(
                  result =>{
                      if(result){
                         axios.post('./api/users',{
                            em_id:this.emid,
                            name:this.name,
                            lastname:this.lastname,
                            nickname:this.nickname,
                            nationality:this.nationality,
                            gender:this.gender,
                            email:this.email,
                            role:this.role,
                            title:this.title,
                            birthday:this.birthday,
                            housenumber:this.housenumber,
                            address:this.address,
                            postalcode:this.postalcode,
                        }).then(function (response) {
                            e.target.reset();
                            Swal.fire({
                                title: 'Inserted Data!!',
                                type: 'success',
                                confirmButtonText: 'OK'
                            });
                        })
                        .catch(function (error) {
                            Swal.fire({
                                title: '" ID " is already exist !!',
                                type: 'error',
                                confirmButtonText: 'OK'
                            });
                        });
                      }
                  }
              )
            }
        }
    }
</script>
