<template>
   <div class="card mt-5 mb-5 col-md-6 offset-md-3">

      <div class="d-flex justify-content-center"> 
        <div class="avatar-photo">
  <img v-if="user.avatar" :src="'http://127.0.0.1:8000/' + user.avatar"  class="avatar-photo card-img-top" alt="...">
      <img v-else src="https://www.eguardtech.com/wp-content/uploads/2018/08/Network-Profile.png" class="card-img-top " alt="...">


<div @click="openInputFile" class="avatar-photo-overlay">
      <span class="overlay-photo" >Change Photo</span>
</div>
      </div>
</div>
<input style="display:none;" @change="uploadPhoto" ref="inputFile" type="file" />

<div class="card-body">
<div class="form-group">
    <label for="firstname">First Name</label>
    <input v-model="user.first_name" type="text" class="form-control" id="firstname">
  </div>

  <div class="form-group">
    <label for="lastname">Last Name</label>
    <input v-model="user.last_name"  type="text" class="form-control" id="lastname" >
  </div>


  <div class="form-group">
    <label for="username">Username</label>
    <input v-model="user.username"  type="text" class="form-control" id="username" >
  </div>



  <div class="form-group">
    <label for="email">Email</label>
    <input v-model="user.email"  type="text" class="form-control" id="email">
  </div>



  <div class="form-group">
    <label for="country">Country</label>
    <input v-model="user.country"  placeholder="Please update" type="text" class="form-control" id="country">
  </div>



  <div class="form-group">
    <label for="city">City</label>
    <input v-model="user.city" placeholder="Please update" type="text" class="form-control" id="city" >
  </div>
  
</div>
  <div class="card-body">
<a href='#' @click.prevent="saveChanges" class="btn btn-lg btn-primary">Save Changes </a>
  </div>

</div>
</template>


<script>
export default {
  
  data() {
    return {
      user: {},
      changePhoto: false
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
  },
  methods: {
    openInputFile() {
      this.$refs.inputFile.click();
    },
    uploadPhoto() {
        
        const image = event.target.files[0];
        const formData = new FormData();
        formData.append('image', image);
        window.axios.post('image/upload', formData, {
            headers : {
              'content-type': 'multipart/form-data'
            }
        })
        .then(response => {
          this.changePhoto = true;

           this.user.avatar =   response.data.imageName; 
           console.log(response.data.imageName);
        });
    },
    saveChanges() {
      const userObject = {
          id: this.user.id,
          first_name : this.user.first_name,
            last_name : this.user.last_name,
              username : this.user.username,
                email : this.user.email,
                country: this.user.country,
                city: this.user.city
      }
        if(this.changePhoto) {
            userObject.avatar = this.user.avatar;
        } 
        window.axios.post('user/update', userObject, {
        })
        .then(response => {
              this.$store.dispatch('updateUser', response.data.user);
        });
    }
  },
}
</script>
<style>
.avatar-photo-overlay {
  opacity: 0;
}
.avatar-photo:hover .avatar-photo-overlay {
  transition: all .5s;
  opacity: 1;
  width: 100%;
  height: 100%;
  position: absolute;
  background:#d3d3d3;
  top:0;
  left:0;
  display: flex;
  justify-content: center;
  align-items: center;
  cursor: pointer;
}
.overlay-photo {
  text-align: center;
}
  
</style>