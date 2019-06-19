
<template>
  <div>


  <!-- Full Page Intro -->
 
    <!-- Mask & flexbox options rgba-black-light-->
    <div class=" justify-content-center align-items-center">

      <!-- Content -->
      <div class="container">

        <!--Grid row-->
        <div class="row wow fadeIn">
          <div class="col-md-6 mb-4 white-text text-center text-md-left">
   <div class="card">
                  <!--Card content-->
                  <div class="card-body px-lg-5">
            <h6 class=" ">List Of Categories</h6>
            <!-- <h3>
              <strong>and get your job done</strong>
            </h3> -->
            <hr class="hr-light">

           <table class="table table-bordered">
    <tbody id="contactTable"><tr><th>type_id</th><th>Type_name</th><!-- <th colspan="2">Action</th> --></tr></tbody>
  <!-- @foreach ($dat as $d) -->
    <tr v-for="type in types" :key="type.id">
       <td>{{type.id}}</td>
      <td>{{type.type_name}}</td>
      
      <!-- <td>{{$d->name}}</td> -->
      <!-- <td><a href="/product/{{$d->id}}/edit" class="btn btn-primary">Edit</a></td>
      <td><a href="{{url('/deleteproduct/'.$d->id)}}" class="btn btn-primary">Delete</a></td> categories--></tr>
      
          
  
<!-- @endforeach -->
</table>
           
</div>
</div>
          </div>
          <div class="col-md-6 col-xl-5 mb-6">

           <!-- Material form subscription -->
              <div class="card">

                  <h5 class="card-header success-color white-text text-center py-4">
                      <strong>Add Categories Type</strong>
                  </h5>

                  <!--Card content-->
                  <div class="card-body px-lg-5">

                      <!-- Form -->
                       <p style="color: red" class="text-center">

                             <Notification 
                             :message="notification.message"
                             :type="notification.type" 
                             v-if="notification.message"
                              />
                             <!--  <a href="" ></a> -->
                          </p>
                      <form v-on:submit.prevent="addtype" class="text-center secondary">
                          <!-- Name -->
                          <select class="form-control" v-model="type_id">
                            <option>select Categories type</option>
  <option v-for="type in types" :key="type.id">
  {{type.type_name}}
</option>
</select>
                          <div class="md-form mt-3">
                              <input v-model="cat_name" type="text" id="materialSubscriptionFormName" class="form-control">
                              <label for="materialSubscriptionFormEmail">Categories_name</label>
                          </div>
                           <div class="md-form mt-3">
                              <input v-model="description" type="text" id="materialSubscriptionFormName" class="form-control">
                              <label for="materialSubscriptionFormEmail">description</label>
                          </div>
                          <input type="text" name="" v-model="user_id"  >
  <md-field >
     <!--  <md-icon class="md-primary">email</md-icon> -->
      <label>Email</label>
       <md-input v-model="email" type="text">{{users.email}}</md-input>
    </md-field>
                          <label class="btn btn-primary btn-file">
                                    choose file
                                    <input  type="file" @change="onImageChange" name="file" style="display: none;"> 
                                   
                                </label>
                          <!-- E-mail value="{{user.id}}"-->
<!--                           <div class="md-form">
                              <input v-model="password" type="password" id="materialSubscriptionFormPasswords" class="form-control">
                              <label for="materialSubscriptionFormPasswords">Password</label>
                          </div> -->

                          <!-- Sign in button <router-link to="/customer-dashboard"><button class="btn btn-outline-success btn-rounded @click="login" btn-block z-depth-0 my-4 waves-effect" type="submit">Sign in</button></router-link>-->
                          <button  class="btn btn-outline-success btn-rounded btn-block z-depth-0 my-4 waves-effect" type="submit">Save</button>
                         

                      </form>
                      <!-- Form -->
 
                  </div>

              </div>
              <!-- Material form subscription -->

          </div>
          <!--Grid column-->

        </div>
        <!--Grid row-->

      </div>
      <!-- Content -->

    </div>
    <!-- Mask & flexbox options-->


  <!-- Full Page Intro -->

  

  </div>
</template>

<script>
import axios from 'axios'
// import router from '../router'
// import EventBus from './EventBus'

import Notification from './Notification'
export default {
  components: {
  
     'Notification':Notification,
  },
  data (){
    // this.getType().then(res =>{
    //          this.type_name = res.type.type_name
    //           this.id= res.type.id
    //          //return res 
    //           console.log(this.type_name)
    //        })
    return{
      id:'',
      type_name:'',
      types:{},
   users:[],
      notification:{
        message:'',
        type:''
      }
    }
  },
  
  methods: {
     getType(){
             return axios.get('http://localhost/laravel/larasofine/backend/public/api/gettype', {
            headers:{
                 Authorization:`Bearer ${localStorage.usertoken}`
               } 
          }) 
             .then(({data}) =>(this.types = data.type,this.users=data.user) 
               //return res.data
               //console.log(users.email)
            )
             .catch(err => {
               console.log(err)
             })
           },
   addtype () {
      axios.post("http://localhost/laravel/larasofine/backend/public/api/addtype",{
        type_name:this.type_name,
      })
      .then((response)=>{
        this.$router.push('addtype')
      })

      .catch((error)=>{
        // this.email = this.password =''
        this.notification = Object.assign({},this.notification,{
          message:error.response.data.success,
          type:error.response.data.status
        })
       //console.log(error)
      })
      // this.emitMethod()
    },
    
    // emitMethod(){
    //   EventBus.$emit('logged-in','loggedin')
    // }
  },
  created(){
      this.getType();
    }
}
</script>


