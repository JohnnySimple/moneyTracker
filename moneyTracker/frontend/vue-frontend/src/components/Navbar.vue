<template>
    <!-- <nav class="navbar navbar-default">
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
    </nav> -->
    <div class="nav-container">
        <b-navbar toggleable="lg" type="light" variant="light">
            <b-icon icon="border-width" id="side-menu-toggle"></b-icon>
            <b-navbar-brand href="/"><img src="../assets/expenseCheck.png" height="40px"></b-navbar-brand>

            <b-navbar-toggle target="nav-collapse"></b-navbar-toggle>

            <b-collapse id="nav-collapse" is-nav>
                <!-- right align nav items -->
                <b-navbar-nav v-if="username" class="ml-auto">
                    <b-navbar-item><router-link to="/"><b-icon icon='person-fill' class="sidebar-show"></b-icon> {{username}}</router-link></b-navbar-item>
                    <!-- <b-navbar-item><router-link to="/logout">Logout</router-link></b-navbar-item> -->
                </b-navbar-nav>
                <b-navbar-nav v-else class="ml-auto">
                    <b-navbar-item><router-link to="/login">Login</router-link></b-navbar-item>
                    <b-navbar-item><router-link to="/register">Register</router-link></b-navbar-item>
                </b-navbar-nav>
            </b-collapse>
        </b-navbar>
    </div>
</template>

<script>
import $ from 'jquery'

$(document).ready(function() {
    $('#side-menu-toggle').click(function(e) {
        e.preventDefault();
        $(".dashboard").toggleClass("toggled");
    });
});

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
b-navbar {
    background-color: rgba(255, 255, 255, 0.5);
}
b-navbar-item {
    margin: 0px 5px 0px 5px;
}

@media (min-width: 768px) {
    #side-menu-toggle {
        display: none;
    }
}
</style>