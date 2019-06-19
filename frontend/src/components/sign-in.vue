
<template>
  <div>

          <!-- Navbar -->
 <nav class="navbar fixed-top navbar-expand-lg navbar-dark scrolling-navbar">
            <div class="container">
        
              <!-- Brand -->
              <a class=" navbar-brand" href="#">
                <h3 class="navcolo" ><strong>soFine Tailor</strong></h3>
              </a>
        
              <!-- Collapse -->
              <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
        
              <!-- Links -->
              <div class="collapse navbar-collapse" id="navbarSupportedContent">
        
                <!-- Left -->
                <ul class="navbar-nav mr-auto">
                  <li  class="nav-item active">
                    <router-link  to="/" class="nav-link">Home
                      <span class="sr-only">(current)</span>
                    </router-link>
                  </li>
                  <li  class="nav-item">
                      <router-link to="/about" class="nav-link" href="#">About</router-link>
                    <!-- <a class="nav-link" href="#">About</a> -->
                  </li>
                  <li  class="nav-item">
                      <router-link to="/policy" class="nav-link" href="#">Policy</router-link>
                   <!--  <a class="nav-link" href="#">Policy</a> -->
                  </li>
                  <li  class="nav-item">
                      <router-link to="/support" class="nav-link" href="#">Support</router-link>
                    <!-- <a class="nav-link" href="#">Support</a> -->
                  </li>
                  <li class="nav-item">
                    <router-link to="/contact" class="nav-link" href="#">Contact</router-link>
                  </li>
                </ul>
        
                <!-- Right -->
                <ul class="navbar-nav nav-flex-icons">
                  <!-- <li class="nav-item">
                    <a href="#" class="nav-link">
                      <i class="fa fa-facebook"></i>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                      <i class="fa fa-twitter"></i>
                    </a>
                  </li> -->
                  <li  class="nav-item">
                    <router-link to="/signup" href="#" class="nav-link border border-light rounded"
                      >Sign Up</router-link>
                  </li>
                 <!--  <li  class="nav-item">
                    <router-link  to="/profile" href="#" class="nav-link border border-light rounded"
                      >Profile</router-link>
                  </li>
                  
                  <li class="nav-item">
                    <router-link to=""  href="" class="nav-link border border-light rounded"
                      >Logout</router-link>
                  </li> -->
                </ul>
        
              </div>
        
            </div>
          </nav>
  <!-- Navbar -->

  <!-- Full Page Intro -->
  <div class="view full-page-intro" style="background-image: url('image/caro/caro16.jpg');  background-repeat: no-repeat; background-size: cover;">

    <!-- Mask & flexbox options-->
    <div class="mask rgba-black-light d-flex justify-content-center align-items-center">

      <!-- Content -->
      <div class="container">

        <!--Grid row-->
        <div class="row wow fadeIn">

          <!--Grid column-->
          <div class="col-md-6 mb-4 white-text text-center text-md-left">

            <h1 class="display-4 font-weight-bold">Hire Expert &</h1>

            

            <h3>
              <strong>and get your job done</strong>
            </h3>

            <hr class="hr-light">

            <p class="mb-4 d-none d-md-block">
              <strong>The most comprehensive tutorial for the Bootstrap 4. Loved by over 500 000 users. Video and written versions
                available. Create your own, stunning website.</strong>
            </p>

            <router-link to="/signup" class="btn btn-success btn-lg">Register Here
              <i class="fa fa-book" aria-hidden="true"></i>
            </router-link>

          </div>
          <!--Grid column-->

          <!--Grid column-->
          <div class="col-md-6 col-xl-5 mb-4">

           <!-- Material form subscription -->
              <div class="card">

                  <h5 class="card-header success-color white-text text-center py-4">
                      <strong>SIGN IN</strong>
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
                      <form v-on:submit.prevent="login" class="text-center secondary">

                          <p>Join our mailing list. We write rarely, but only the best content.</p>

                         

                          <!-- Name -->
                          <div class="md-form mt-3">
                              <input v-model="email" type="email" id="materialSubscriptionFormEmail" class="form-control">
                              <label for="materialSubscriptionFormEmail">E-mail</label>
                          </div>

                          <!-- E-mail -->
                          <div class="md-form">
                              <input v-model="password" type="password" id="materialSubscriptionFormPasswords" class="form-control">
                              <label for="materialSubscriptionFormPasswords">Password</label>
                          </div>

                          <!-- Sign in button <router-link to="/customer-dashboard"><button class="btn btn-outline-success btn-rounded btn-block z-depth-0 my-4 waves-effect" type="submit">Sign in</button></router-link>-->
                          <button @click="login" class="btn btn-outline-success btn-rounded btn-block z-depth-0 my-4 waves-effect" type="submit">Sign in</button>
                         

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

  </div>
  <!-- Full Page Intro -->

  

  </div>
</template>

<script>
import axios from 'axios'
// import router from '../router'
import EventBus from './EventBus'
import Navbar from './Navbar'
import Notification from './Notification'
export default {
  components: {
     'Navbar': Navbar,
     'Notification':Notification,
  },
  data (){
    return{
      email:'',
      password:'',
      role:'',
      notification:{
        message:'',
        type:''
      }
    }
  },
  
  methods: {
    login () {
      axios.post("http://localhost/laravel/larasofine/backend/public/api/login",{
        email:this.email,
        password:this.password
      })
      .then((response)=>{

        //console.log(response.data.role);
        localStorage.setItem('usertoken',response.data.access_token)
        if (response.data.role=== 'guest'){
          //console.log('guest')
          this.$router.push('guest');
                  }
                  else if (response.data.role=== 'tailor') {
                     //console.log('customer')
          this.$router.push('tailor-dashboard');
        }
        else {
         // console.log('done')
           this.$router.push('customer-dashboard');
        }
        

        
        // else{
          // this.$router.push('tailor-dashboard')
        // }
        this.email=''
        this.password=''
        
        //router.push({name: 'profile'})
      })

      .catch((error)=>{
        this.email = this.password =''
        this.notification = Object.assign({},this.notification,{
          message:error.response.data.error,
          type:error.response.data.status
        })
       //console.log(error)
      })
      this.emitMethod()
    },
    emitMethod(){
      EventBus.$emit('logged-in','loggedin')
    }
  }
}
</script>


