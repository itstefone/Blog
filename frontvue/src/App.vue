<template>
  <div id="app">
<app-nav></app-nav>
<router-view name="searchForm"></router-view>
<router-view></router-view>
<app-footer></app-footer>
  </div>
</template>
<script>
import nav from './components/Nav';
import footer from './components/Footer';
export default {
  components: {
    'appNav' :  nav,
    'appFooter' : footer
  },
  created() {
      const token = sessionStorage.getItem('token');
      if(token) {
 this.$store.dispatch('refresh');
      }

      this.$store.dispatch('getCategories');


  }
}
</script>
<style>
html {
    overflow: scroll;
    overflow-x: hidden;
}

</style>
