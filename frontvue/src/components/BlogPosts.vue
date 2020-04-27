<template>
  <div>
    <header class="bg-primary text-center py-5 mb-4">
  <div class="container">
    <h1 class="font-weight-light text-white">Blog Posts</h1>
  </div>
</header>

<!-- Page Content -->
<div class="container">
  <div class="row">
      <div v-for="post in posts"  :key="post.id" class="col-xl-6 col-md-6 mb-4">
      <div class="card border-0 shadow">
        <img :src="'http://127.0.0.1:8000/' + post.image" class="card-img-top" alt="...">
        <div class="card-body text-center">
          <h5 class="card-title mb-0">{{post.title}}</h5>
          <div class="card-text text-black-50">Web Developer</div>
          <p class="text-justify  ">{{post.description}}</p>
          <button  class="btn-primary btn">Read More</button>
        </div>
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
      posts: []
    }
  },
  created() {
              this.$store.dispatch('getPosts').then(()=> {
                 this.posts = this.$store.getters.posts;
                 console.log(this.posts);
              });
  },
  methods: {
  },
}
</script>