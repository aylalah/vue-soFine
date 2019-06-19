
<script>

import EventBus from './EventBus';
export default {
  
  data (){
    return{
      auth:'',
     user:''
    }
  },
 //  methods:{
 //      logout(){
 //     localStorage.removeItem('usertoken')
 // }
 //  },
  mounted(){
  	localStorage.removeItem('usertoken')
      EventBus.$on('logged-in', status => {
          this.auth = status;
      })
       this.$router.push({ name: 'signin' })
  }
}
</script>