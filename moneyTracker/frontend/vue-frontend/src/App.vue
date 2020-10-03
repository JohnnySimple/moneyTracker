<template>
  <div id="app">
    <Navbar id="nav" v-if="!$route.meta.hideNavbar"/>
    <router-view></router-view>
  </div>
</template>

<script>
import Homepage from './components/Homepage';
import Navbar from './components/Navbar';
// import './assets/css/bootstrap.min.css';
// import './assets/js/jquery1.js';
// import './assets/js/bootstrap.min.js';
export default {
  name: 'App',
  components: {
    Homepage,
    Navbar
  }
}
</script>

<style>
/* #app {
  font-family: 'Avenir', Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  color: #2c3e50;
} */

</style>
