<template>
  <div id="app">
  <!--   <navbar></navbar> -->
  <br><br><br>
<div class="container">
  <form>
      <div class="row">
    
      <div class="col-md-6">
      <div class="card" style="">
    <a :href="getPhoto()"><img class="card-img-top rounded-circle" :src="getPhoto()" alt="Card image" id="mk"></a>
    <div class="card-body">
      <h5 class="card-title"> <label class="btn btn-primary btn-file">
                                    choose file
                                    <input  type="file" @change="onImageChange" name="file" style="display: none;"> 
                                   
                                </label></h5>
                                <!--  <input type="" name="" value="{{localStorage.getItem('usertoken')}}"> -->
      <p class="card-text">Choose another Photo</p>
      </div>
  </div>
   </div>
     <div class="col-md-6">
     <md-tabs md-sync-route>
      <md-tab id="tab-account" md-label="Account" >
      <md-field>
     <!--  <md-icon class="md-primary">email</md-icon> -->
      <label>Email</label>
       <md-input v-model="email"   type="text">{{email}}</md-input>
    </md-field>
      <md-field>

              <label>Username</label>
              <md-input v-model="name" type="text"  >{{name}}</md-input>
     </md-field>
    <md-field>
      <label>Role</label>
      <md-input v-model="role" type="text" >{{role}}</md-input>
    </md-field>

  </md-tab>

      <md-tab id="tab-profile" md-label="Profile" >
          <md-field>
      <label>Firstname</label>
       <md-input v-model="firstname" type="text"  placeholder="Delight"></md-input>
    </md-field>
  <md-field>
              <label>LastName</label>
              <md-input v-model="username" type="text"  placeholder="Promise"></md-input>
     </md-field>
    <md-field>
      <label> Status</label>
      <md-input v-model="status"  placeholder="The Lord is Good"></md-input>
    </md-field>
 <md-datepicker v-model="selectedDate"  value="date"/>
    </md-tab>
 <md-tab id="tab-contact" md-label="Contact" >

      <md-field>
        <!-- <md-icon class="md-primary">phone</md-icon> -->
      <label>Phone Number</label>
       <md-input v-model="phone" type="text"  >{{phone}}</md-input>
    </md-field>
  

      </md-tab>
    </md-tabs>

          </div>
          <button type="submit" class="btn purple-gradient"  @click.prevent="uploadUser">Update</button>
           
        
          </div>
        </form>
      </div>
        <notification></notification>
</div>




    
   
  </template>

<script>
import axios from 'axios'
import { Row, Column, Card, CardBody, ViewWrapper, MdMask, CardTitle, CardText, CardFooter, Fa, Btn, Pagination, PageNav, PageItem } from 'mdbvue'
// import Navbar from './Navbar'
import Notification from './Notification'
export default {
  name: 'Profile',
  components: {
    Row,
    Column,
    Card,
    CardBody,
    ViewWrapper,
    MdMask,
    CardTitle,
    CardText,
    CardFooter,
    Fa,
    Btn,
    Pagination,
    PageNav,
    PageItem,
    // 'Navbar': Navbar,
     'Notification':Notification,
  },
  //  data: () => ({
  //     email: null,
  //     username: null,
  //     password: null,
  //     firstname:null,
  //     lastname:null,
  //     status:null,
  //     phone:null,
  //     selectedDate: null
  //        }),

         data(){
           this.getUser().then(res =>{
             this.name = res.user.name
             this.email = res.user.email
             this.phone = res.user.phone
              this.file = res.user.file
              this.role = res.user.role
              this.id= res.user.id
             return res 
           })
           return {
            id:'',
             name:'',
             email:'',
             phone:'',
             file:'',
            role:'',
            usertoken :''
           }
         },
         beforeRouteEnter (to, from, next){
          const token = localStorage.getItem('usertoken')
          return token ? next() : next ('/signin')
         },
         methods: {
          getPhoto(){
            return "http://localhost/laravel/larasofine/backend/public/upload/uploads/"+ this.file;
          },
          uploadUser(){
                 return axios.post('http://localhost/laravel/larasofine/backend/public/api/me',
                  {    
                    id:this.id,
                   name:this.name,
          email:this.email,
          phone:this.phone, 
          role:this.role,
          file:this.file,
       //localStorage.getItem('usertoken'),
          
          },
          {
            headers:{
                 Authorization:`Bearer ${localStorage.usertoken}`
               } 
          }).then(() => {
           // console.log(localStorage.usertoken)
            
               //return res.data
             })
             .catch(() => {
               //console.log(err)
             })
            },
          onImageChange(e){
            let file = e.target.files[0];

          // console.log(file);
            let reader = new FileReader();
                let vm = this;
                reader.onloadend =(file)=> {
                  // body...
                  //console.log(this.file = reader.result)
                  this.file = reader.result;
                }
                reader.readAsDataURL(file);
          },
           getUser(){
             return axios.get('http://localhost/laravel/larasofine/backend/public/api/me',{
               headers:{
                 Authorization:`Bearer ${localStorage.usertoken}`
               }
             }) 
             .then(res => {
               return res.data
             })
             .catch(err => {
               console.log(err)
             })
           }
         }

}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style>

#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  color: #2c3e50;

}
.file-text
  {
    font-size: 13px;
    margin-left: 0px
  }


#mk{
    width: 400px;
    height: 400px;

}
.card{
  width:500px;
  height:500px
}

</style>
