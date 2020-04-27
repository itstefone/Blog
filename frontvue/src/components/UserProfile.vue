<template>

  <div class="card mt-5 mb-5 col-md-6 offset-md-3">

      <div class="d-flex justify-content-center"> 
  <img v-if="user.avatar" :src="'http://127.0.0.1:8000/' + user.avatar"  class="avatar-photo card-img-top" alt="...">
      <img v-else src="https://www.eguardtech.com/wp-content/uploads/2018/08/Network-Profile.png" class="card-img-top avatar-photo" alt="...">
</div>
  <div class="card-body">
    <h5  class="card-title text-center">{{user.username}}</h5>
  </div>
  <ul class="list-group list-group-flush">
    <li class="list-group-item d-flex justify-content-between">
      <span>First name</span>
      <span>{{user.first_name|capitalize }}</span>
    </li>
    <li class="list-group-item d-flex justify-content-between">
      <span>Last name</span>
      <span>{{user.last_name|capitalize}}</span>
    </li>
    <li class="list-group-item d-flex justify-content-between">
      <span>Email</span>
      <span>{{user.email}}</span>
    </li>
    <li class="list-group-item d-flex justify-content-between">
      <span>Country</span>
      <span>{{user.country|capitalize}}</span>
    </li>
    <li class="list-group-item d-flex justify-content-between">
      <span>City</span>
      <span>{{user.city|capitalize}}</span>
    </li>
  </ul>
  <div class="card-body">


    <router-link :to="{name:'profileSetting'}" class="btn btn-warning" tag="a">Update Profile</router-link>
  </div>

</div>
</template>


<script>
export default {
  

  data() {
    return {
      user: {}
    }
  },
  filters: {
  capitalize: function (value) {
    if (!value) return 'Please update'
    value = value.toString()
    return value.charAt(0).toUpperCase() + value.slice(1)
  }
},
  created() {
      this.user = this.$store.getters.user;
      console.log(this.user);
  }
}
</script>


<style>
  
  .avatar-photo {
    position: relative;
    width:100px;
    height: 100px;
  }
</style>