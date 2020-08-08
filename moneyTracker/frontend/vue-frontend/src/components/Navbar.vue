<template>
    <nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span> 
        </button>
        <div class="logo">
            <a href="/"><img src="../assets/expenseCheck.png" height="40px"></a>
        </div>
        </div>
        <div v-if="username" class="collapse navbar-collapse" id="myNavbar">
            <ul class="nav navbar-nav navbar-right">
                <li><router-link to="/">{{username}}</router-link></li>
                <li><router-link to="/logout">Logout</router-link></li>
            </ul>
        </div>
        <div v-else class="collapse navbar-collapse" id="myNavbar">
            <ul class="nav navbar-nav navbar-right">
                <li><router-link to="/login">Login</router-link></li>
                <li><router-link to="/register">Register</router-link></li>
            </ul>
        </div>
    </div>
    </nav>
    <!-- <nav class="NavBar">
        <div>
            <img src="../assets/expenseCheck.png" height="40px">
        </div>
        <div v-if="username" class="nav-menu">
            <ul class="menu">
                <li>{{username}}</li>
                <li>Logout</li>
            </ul>
        </div>
        <div v-else class="nav-menu">
            <ul class="menu">
                <li><router-link to="/">Home</router-link></li>
                <li><router-link to="/login">Login</router-link></li>
                <li><router-link to="/register">Register</router-link></li>
            </ul>
        </div>
    </nav> -->
</template>

<script>
export default {
    name: 'navbar',
    data () {
        return {
            username: sessionStorage.getItem('username')
        }
    }
}
</script>

<style scoped>
.NavBar {
    display: flex;
    justify-content: space-between;
}
.menu {
    list-style-type: none;
    display: flex;
}
.menu li {
    margin: 0px 10px 0px 10px;
}
.menu a {
    text-decoration-line: none;
}
.logo {
    margin-top: 10px;
}
</style>