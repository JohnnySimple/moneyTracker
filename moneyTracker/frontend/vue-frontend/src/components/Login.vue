<template>
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
                    sessionStorage.setItem('username', this.username);
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
    margin-top: 100px;
}
</style>