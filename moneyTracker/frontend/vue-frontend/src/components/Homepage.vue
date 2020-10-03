<template>
  <div class="homePage">
      <div class="buts" align="center">
          <router-link to="/register"><button class="btn btn-success">Register</button></router-link>
          <router-link to="/login"><button class="btn btn-primary">Login</button></router-link>
      </div>
  </div>
</template>

<script>
export default {
    name: 'homepage',
    data () {
        return {

        }
    },
}
</script>

<style scoped>
.homePage {
    height: 100vh;
    background-image: linear-gradient(to bottom, rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), url('../assets/money-background1.jpeg');
    background-size: cover;
    background-position: center;
}
.buts {
    padding-top: 250px;
}
</style>
