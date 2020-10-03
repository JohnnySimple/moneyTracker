<template>
    <div class="sidebar-div">
        <div class="sidebar">
            <b-navbar-brand href="/">
                <img src="../assets/expenseCheck.png" height="40px" style="margin-left:-10px">
            </b-navbar-brand>
            
            <hr color="white">
            <b-navbar-nav class="sidebar-menu">
                <b-navbar-item><router-link to="/dashboard/dash" id="s-link"><b-icon icon="grid1x2-fill" style="margin-right: 20px;"></b-icon> Dashboard</router-link></b-navbar-item>
                <b-navbar-item><router-link to="/dashboard/categories" id="s-link"><b-icon icon="collection-fill" style="margin-right: 20px;"></b-icon> Categories</router-link></b-navbar-item>
                <b-navbar-item><router-link to="/dashboard/wallets" id="s-link"><b-icon icon="wallet-fill" style="margin-right: 20px;"></b-icon> Wallets</router-link></b-navbar-item>
                <b-navbar-item><router-link to="/dashboard/expense" id="s-link"><b-icon icon="cash-stack" style="margin-right: 20px;"></b-icon> Expenses</router-link></b-navbar-item>
                <b-navbar-item><router-link to="/dashboard/income" id="s-link"><b-icon icon="collection-fill" style="margin-right: 20px;"></b-icon> Income</router-link></b-navbar-item>
                <b-navbar-item><router-link to="/dashboard/profile" id="s-link"><b-icon icon="person-fill" style="margin-right: 20px;"></b-icon> User Profile</router-link></b-navbar-item>
                <b-navbar-item><router-link to="/logout" id="s-link"><b-icon icon="power" style="margin-right: 20px;"></b-icon> Logout</router-link></b-navbar-item>
            </b-navbar-nav>
        </div>
    </div>
</template>

<script>
import $ from 'jquery';

$(document).ready(function() {
    $('.s-toggle').click(function(e) {
        e.preventDefault();
        $(".sidebar-div").toggleClass("toggled");
    })
});

export default {
    name: 'sidebar',
    data () {
        return {

        }
    }
}
</script>

<style scoped>
b-navbar-item {
    margin: 10px 0px 10px 0px;
    color: white;
}

#s-link {
    color: #fff;
}

</style>