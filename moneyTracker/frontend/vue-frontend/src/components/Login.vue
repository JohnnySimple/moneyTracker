<template>
    <div class="container-fluid login-container">
        <div class="container login">
            <h2>Login</h2>
            <div v-if="loginError" class="alert alert-danger">Incorrect username or password!</div>
            <div class="form">
                <form>
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="username" v-model="username" required>
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" placeholder="password" v-model="password" required>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary" type="submit" v-on:click="handleLogin">Login</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';
import router from '../router';
export default {
    name: 'login',
    data () {
        return {
            username: "",
            password: "",
            loginError: false
        }
    },
    methods: {
        handleLogin: function() {
            axios.post("http://localhost:8000/api/login", {
                username: this.username,
                password: this.password
            })
            .then(res=>{
                // console.log(res.data);
                if(res.data.success.token) {
                    router.push('/dashboard');
                    history.go();
                    sessionStorage.setItem('token', res.data.success.token);
                    sessionStorage.setItem('username', res.data.success.username);
                    sessionStorage.setItem('id', res.data.success.id);
                    sessionStorage.setItem('time_made', res.data.success.time_made);
                }
            }, (error)=> {
                this.loginError = true;
                // console.log(error);
            })

        }
    }
}
</script>

<style scoped>
.login {
    width: 40%;
    padding-top: 100px;
    background-color: #fff;
    padding-bottom: 10px;
}
.login-container {
    height: 100vh;
    background-image: linear-gradient(to bottom, rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), url('../assets/money-background1.jpeg');
    background-size: cover;
    background-position: center;
}
@media (max-width: 800px) {
    .login {
        width: 70%;
        padding-top: 250px;
    }
}
</style>