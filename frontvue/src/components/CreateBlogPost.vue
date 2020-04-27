<template>
  <div class="container" id="createBlogPost">
    
    <div class="row">
      <div class="col-md-8  mt-5 offset-2">
        <div class="card">
          <div class="card-header">
            <h4 class="text-center">Create Blog Post</h4>
          </div>
    <div class="card-body">
<form>
  <div class="form-group">
    <label for="title">Title</label>
    <input type="text" v-model="blogPost.title" class="form-control" id="title" placeholder="Post title">
  </div>
  <div class="form-group">
    <label for="exampleFormControlSelect1">Category</label>
    <select   v-model="blogPost.category_id" class="form-control" >
      
      <option v-for="category in categories" :key="category.id" :value="category.id" >{{category.name}}</option>
    </select>
  </div>

 <div class="custom-file">
    <input type="file" @change="setImage" class="custom-file-input" id="validatedCustomFile" required>
    <label class="custom-file-label" for="validatedCustomFile">Choose file...</label>
  </div>

  <div class="form-group">
    <label for="exampleFormControlTextarea1">Description</label>
    <textarea  v-model="blogPost.description" class="form-control" id="description"  resize="none" rows="7"></textarea>
  </div>


  <div class="card-footer">
    <button @click.prevent='addPost' class="btn btn-primary">Add Post</button>
  </div>
</form>


    </div>


        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  
  data() {

    return {
      user: {},
      blogPost: {
        title: '',
        image: '',
        description: '',
        category_id: 1,
        user_id: ''
      },
      image: '',
    categories : []
    }
  },
  created() {
    this.user = this.$store.getters.user;
    this.categories = this.$store.getters.categories;
  },
  methods: {
    addPost() {
      const formData = new FormData();
      formData.append('image', this.image);
      formData.append('title', this.blogPost.title);
       formData.append('description', this.blogPost.description);
        formData.append('category_id', this.blogPost.category_id);
         formData.append('user_id', this.user.id);
      window.axios.post('post/create', formData, {
        headers: {
          'enctype': 'multipart/form-data'
        }
      })
      .then(response => {
            console.log(response);
      });
      },
      setImage() {
        this.image = event.target.files[0];
        console.log(this.image);
      }
  }
}
</script>

<style>
  #createBlogPost {
    min-height: 85vh;
    margin-bottom: 20px;
  }

  #description {
    resize:none;
  }
</style>