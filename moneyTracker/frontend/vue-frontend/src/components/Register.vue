<template>
    <div class="container register">
        <h3>Register</h3>
        <div class="alert alert-danger" v-if="registerError">Error signing up. Please check your inputs!</div>
        <div class="alert alert-danger" v-if="usernameRegistered">Username "{{username}}" is already taken!</div>
        <div class="alert alert-danger" v-if="passwordError">Password field must be equal to confirm password field!</div>
        <div class="alert alert-danger" v-if="emailError">Email "{{email}}" is already taken!</div>
        <div class="alert alert-danger" v-if="phoneError">Phone format should be in the form 0xxxxxxxxx</div>
        <div class="form">
            <form>
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="username" v-model="username" required>
                </div>
                <div class="form-group">
                    <input type="email" class="form-control" placeholder="email" v-model="email" required>
                </div>
                <div class="form-group">
                    <input type="phone" class="form-control" placeholder="phone - 0xxxxxxxxx" v-model="phone" required>
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" placeholder="password" v-model="password" required>
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" placeholder="confirm password" v-model="c_password" required>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary" v-on:click="handleRegister">Sign up</button>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
import axios from 'axios';
import router from '../router';
export default {
    name: 'regsiter',
    data () {
        return {
            username: "",
            email: "",
            phone: "",
            password: "",
            c_password: "",
            registerSuccess: false,
            registerError: false,
            registeredUsernames: [],
            usernameRegistered: false,
            passwordError: false,
            emailError: false,
            phoneError: false
        }
    },
    methods: {
        handleRegister: function(event) {
            let username = this.username;
            let email = this.email;
            let phone = this.phone;
            let password = this.password;
            let c_password = this.c_password;
            
            this.passwordError = false;
            this.emailError = false;
            this.usernameRegistered = false;
            this.phoneError = false;

            axios.get('http://127.0.0.1:8000/api/usernames')
            .then(response=>{
                this.registeredUsernames = response.data.success;
            });

            axios.post('http://localhost:8000/api/register', {
                username: username,
                email: email,
                phone: phone,
                password: password,
                c_password: c_password
            })
            .then(response=> {
                // console.log(response);
                router.push('/login');
            }, (error) => {
                let phonePat = /'(0)[0-9]{9}'/;
                for (let i = 0; i < this.registeredUsernames.length; i++) {
                    if(this.registeredUsernames[i].username == this.username) {
                        this.usernameRegistered = true;
                    } else if(this.registeredUsernames[i].email == this.email) {
                        this.emailError = true;
                    }
                }
                if(this.password != this.c_password) {
                    this.passwordError = true;
                } else if(!phonePat.exec(this.phone)) {
                    this.phoneError = true;
                }
                // this.registerError = true;
                // console.log(error);
            });
            // event.preventDefault();
        }
    }
}
</script>

<style scoped>
.register {
    width: 40%;
    margin-top: 100px;
}
</style>