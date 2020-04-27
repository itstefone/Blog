<template>
  <div >
     <nav class="navbar navbar-light bg-light static-top">
    <div class="container">
      <a href="#">Blog</a>
      <ul class="nav nav-pills justify-content-end">
   <li class="nav-item">
     <router-link tag='a' class="nav-link" exact activeClass="active"  :to="{name:'home'}" >Home</router-link>
  </li>
 <li v-if='!isLoggedIn' class="nav-item">
     <router-link tag='a'  class="nav-link" activeClass="active" :to="{name:'login'}" >Login</router-link>
  </li>

 <li  v-if='isLoggedIn' class="nav-item">
     <router-link tag='a'  class="nav-link" activeClass="active" :to="{name:'createBlogPost'}" >Create Post</router-link>
  </li>

  <li  v-if='!isLoggedIn' class="nav-item">
     <router-link tag='a'  class="nav-link" activeClass="active" :to="{name:'register'}" >Register</router-link>
  </li>
  <li v-if="isLoggedIn" class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">{{username}}</a>
    <div class="dropdown-menu">
      <router-link :to="{name:'profile'}"  class="dropdown-item" href="#">My Profile</router-link>

            <router-link :to="{name:'profileSetting'}"  class="dropdown-item" href="#">Setting Profile</router-link>
      <div class="dropdown-divider"></div>
      <a  class="dropdown-item" @click="logout" href="#">Logout</a>
    </div>
  </li>
</ul>
    </div>
  </nav>
  </div>
</template>


<script>
export default {

  computed: {
    isLoggedIn() {
      return this.$store.getters.isLoggedIn;
    },
    username() {
      return this.$store.getters.user.username;
    }
  },
  methods: {
    logout() {
      this.$store.dispatch('logout').then(() => {
             this.$router.push({name:'login'});
      });
     
    }
  }
}
</script>

<style>
  
</style>