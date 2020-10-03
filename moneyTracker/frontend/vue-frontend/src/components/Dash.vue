<template>
    <div class="dash">
        <div class="dash-top">
            <div class="total-income">
                <div class="total-income-content">
                    <p>
                        <b-iconstack>
                            <b-icon icon="circle-fill" variant="success"></b-icon>
                            <b-icon icon="plus" variant="white"></b-icon>
                        </b-iconstack>
                        Total Income <br> 
                        <!-- <span><h3>Ghs 1,000,000</h3></span> -->
                        <span><h3>Ghs {{total_income.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")}}</h3></span>
                    </p>
                </div>
            </div>
            <div class="total-expenses">
                <div class="total-expenses-content">
                    <p>
                        <b-iconstack>
                            <b-icon icon="circle-fill" variant="danger"></b-icon>
                            <b-icon icon="dash" variant="white"></b-icon>
                        </b-iconstack>
                        Total Expenses <br> 
                        <span><h3>Ghs {{total_expenses.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")}}</h3></span>
                    </p>
                </div>
            </div>
            <div class="balance">
                <div class="balance-content">
                    <p>
                        <b-iconstack>
                            <b-icon icon="circle-fill" variant="primary"></b-icon>
                            <b-icon icon="grip-vertical" variant="white"></b-icon>
                        </b-iconstack>
                        Balance + Initial Deposit <br> 
                        <span><h3>Ghs {{balance.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")}}</h3></span>
                    </p>
                </div>
            </div>
        </div>
        <div class="dash-bottom">
            <b-button v-b-modal.modal-1 variant="primary">choose date</b-button>
                <b-modal id="modal-1" title="Choose Date">
                    <b-form>
                        <b-form-group
                        id="input-group-1"
                        label="Month"
                        label-for="month"
                        description="Month to retrieve expenses from.">
                            <b-form-select id="month" 
                             v-model="month_filtered"
                            :options="months"
                            required>
                            
                            </b-form-select>
                        </b-form-group>
                        <b-form-group
                        id="input-group-2"
                        label="Year"
                        label-for="year"
                        description="Year to retrieve expenses from.">
                            <b-form-select id="year" 
                             v-model="year_filtered"
                            :options="years"
                            required>
                            
                            </b-form-select>
                        </b-form-group>
                        <b-button type="submit" variant="primary" v-on:click="changeDate">Submit</b-button>
                    </b-form>
                </b-modal>
            <line-chart 
            :labels="linechartLabels"
            :data="linechartData"
            :key="lineChartKey"
            height="300px"
            class="expense-line-chart">
            </line-chart>
        </div>
    </div>
</template>

<script>
import axios from 'axios'
import LineChart from './views/LineChart'

export default {
    name: 'dash',
    components: {
        LineChart
    },
    data () {
        return {
            id: sessionStorage.getItem('id'),
            user_time_made: new Date(sessionStorage.getItem('time_made')),
            income: [],
            total_income: 0,
            expenses: [],
            total_expenses: 0,
            balance: 0,
            filter_date: new Date(),
            monthlyExpenses: [],
            linechartLabels: [],
            linechartData: [],
            lineChartKey: 'linechart1',
            months: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
            // years: ["2019", new Date().getFullYear()]
            years: this.getYears(),
            month_filtered: null,
            year_filtered: null
        }
    },
    async mounted() {
        // alert(this.months[this.filter_date.getMonth()] + '-' + this.filter_date.getDate());

        // getting income of current user
        await axios.get(`http://localhost:8000/api/income/all/${this.id}`)
        .then(res => {
            this.income = res.data.success;
            console.log('income', this.income);
            let sum = 0;
            this.income.forEach(inc => {
                sum += inc.amount;
            });
            this.total_income = sum;
        })
        
        // getting all expenses of current user
        await axios.get(`http://localhost:8000/api/expense/all/${this.id}`)
        .then(res => {
            this.expenses = res.data.success;
            console.log('expenses', this.expenses);
            let sum = 0;
            this.expenses.forEach(exp => {
                sum += exp.amount;
            });
            this.total_expenses = sum;
        })

        // getting all wallets of current user
        await axios.get(`http://localhost:8000/api/wallet/all/${this.id}`)
        .then(res => {
            this.wallets = res.data.success;
            console.log('wallets', this.wallets);
            let sum = 0;
            this.wallets.forEach(wallet => {
                sum += wallet.balance;
            });
            this.balance = sum;
        })

        // getting all expenses of logged in user on current month
        await axios.get(`http://localhost:8000/api/expense/monthlyExpenses/${this.id}/${(this.filter_date.getMonth()+1)}/${this.filter_date.getFullYear()}`)
        .then(res => {
            this.monthlyExpenses = res.data.success;
            // console.log('monthly expenses', this.monthlyExpenses);
            this.monthlyExpenses.forEach(expense => {
                let d = new Date(expense.time_made);
                if(this.linechartLabels.includes(this.months[d.getMonth()] + '-' + d.getDate())) {
                    this.linechartData[this.linechartLabels.indexOf(this.months[d.getMonth()] + '-' + d.getDate())] += expense.amount;
                } else {
                    this.linechartLabels.push(this.months[d.getMonth()] + '-' + d.getDate());
                    this.linechartData.push(expense.amount);
                }
            });
            this.lineChartKey += 1;
        })
    },
    methods: {
        getYears: function() {
            let years = [];
            for (let i = new Date().getFullYear(); i >= 2010; i--) {
                years.push(i);
            }
            return years;
        },
        changeDate: function() {
            if(this.month_filtered && this.year_filtered != null) {
                // alert(this.months.indexOf(this.month_filtered)+1 + ', ' + this.year_filtered);
                axios.get(`http://localhost:8000/api/expense/monthlyExpenses/${this.id}/${(this.months.indexOf(this.month_filtered)+1)}/${this.year_filtered}`)
                .then(res => {
                    this.monthlyExpenses = res.data.success;
                    this.linechartLabels.splice(0, this.linechartLabels.length);
                    this.linechartData.splice(0, this.linechartData.length);
                    this.lineChartKey += 1;
                    this.monthlyExpenses.forEach(expense => {
                        let d = new Date(expense.time_made);
                        if(this.linechartLabels.includes(this.months[d.getMonth()] + '-' + d.getDate())) {
                            this.linechartData[this.linechartLabels.indexOf(this.months[d.getMonth()] + '-' + d.getDate())] += expense.amount;
                        } else {
                            this.linechartLabels.push(this.months[d.getMonth()] + '-' + d.getDate());
                            this.linechartData.push(expense.amount);
                        }
                    });
                });
            }
        }
    }
}
</script>

<style scoped>
.dash-top {
    display: flex;
    justify-content: space-between;
}
@media (max-width: 600px) {
    .dash-top {
        flex-direction: column;
    }
    .dash-top > div {
        width: 100%;
        margin-bottom: 10px;
    }
}
@media (min-width: 600px) {
    .dash-top > div {
        width: 30%;
    }
}
.dash-top > div {
    height: 150px;
    /* width: 30%; */
    box-shadow: 0 0 4px #ccc;
    border-radius: 5px;
}
.dash-top > div > div {
    padding: 30px 0px 0px 20px;
}
.dash-top > div > div > p > span h3{
    margin-left: 10px;
}
.dash-bottom {
    margin-top: 50px;
    border-radius: 10px;
    margin-bottom: 50px;
    box-shadow: 0 0 4px #ccc;
    overflow: scroll;
}
.dash-bottom::-webkit-scrollbar { 
    display: none;  /* Safari and Chrome */
}
.dash-bottom {
    -ms-overflow-style: none;  /* Internet Explorer 10+ */
    scrollbar-width: none;  /* Firefox */
}
.expense-line-chart {
    width: 1200px;
}
</style>