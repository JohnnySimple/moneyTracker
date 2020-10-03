<template>
    <div class="wallet">
        <div class="row wallet-div">
            <div v-for="wallet in wallets" v-bind:key="wallet.id" class="col-md-4 single-wallet">
                <div class="single-wallet-top">
                    <div>
                        <div class="card">
                            <b-icon icon="wallet-fill" style="color:white; font-size: 25px;"></b-icon>
                        </div>
                    </div>
                    <div class="wallet-details" align="right">
                        <small class="wallet-name">{{ wallet.name }}</small> <br>
                        <small class="wallet-balance"><h5>Ghs {{ (wallet.balance).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",") }}</h5></small>
                    </div>
                </div>
                <hr>
                <div class="single-wallet-bottom">
                    <small><b-icon icon="calendar3-fill" style=""></b-icon> Updated {{ getUpdatedAt(wallet.id) }}</small>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    name: 'wallet',
    data () {
        return {
            id: sessionStorage.getItem('id'),
            wallets: [],
            expenses: []
        }
    },
    async mounted () {
        await axios.get(`http://localhost:8000/api/wallet/all/${this.id}`)
        .then(res => {
            this.wallets = res.data.success;
        })
        // console.log(this.wallets);
    },
    methods: {
        getUpdatedAt: function(wallet_id) {
            axios.get(`http://localhost:8000/api/expense/all/${this.id}`)
            .then(res => {
                this.expenses = res.data.success;
                // console.log(expenses)
            })
            for (let i = this.expenses.length-1; i >= 0; i--) {
                if(this.expenses[i].wallet_id == wallet_id) {
                    var d = new Date(this.expenses[i].time_made)
                    return d.toDateString();
                }
            }
            // return this.expenses[0].time_made;
        }
    }
}
</script>

<style scoped>

.single-wallet {
    margin: 30px 10px;
    height: 20vh;
    box-shadow: 0 0 1px #000;
}
.single-wallet-top {
    /* height: 70%; */
    display: flex;
    justify-content: space-between;
}
.card {
    width: 60px;
    height: 60px;
    background-color: #0ab035;
    top: -20px;
    padding: 20px 0px 0px 20px;
}
</style>