<template>
    <div>
    <div v-if="todayExpenses.length == 0">
        <div class="alert alert-warning">No expenses recorded today</div>
    </div>
    <div class="expense">
        <div class="button-container">
            <div class="filter-container">
                <b-button v-b-modal.modal-2 variant="primary">Filter Expenses</b-button>
                <b-modal id="modal-2" title="Filter Expenses">
                    <b-form>
                        <b-form-group
                        id="filter-input-group-1"
                        label="Date"
                        label-for="filter-date"
                        description="Date period you want to view expense data.">
                            <b-form-input
                            id="filter-date"
                            v-model="filter_date"
                            type="date">

                            </b-form-input>
                        </b-form-group>
                        <b-button type="submit" variant="primary" v-on:click="addFilter">Submit</b-button>
                    </b-form>
                </b-modal>
            </div>
            <div class="addExpense">
                <b-button v-b-modal.modal-1 variant="primary"><b-icon icon="plus"></b-icon>Add Expense</b-button>
                <b-modal id="modal-1" title="Add Expense">
                    <div v-if="add_wallet_success" class="alert alert-success">Expense recorded successfully!</div>
                    <b-form>
                        <b-form-group
                        id="input-group-1"
                        label="Category"
                        label-for="category"
                        description="Category to record expense in.">
                            <b-form-select id="category" 
                            v-model="expense_form.category" 
                            :options="expense_form.category_options"
                            required>
                            
                            </b-form-select>
                        </b-form-group>
                        <b-form-group
                        id="input-group-2"
                        label="Amount"
                        label-for="amount"
                        description="Amount to be recorded.">
                            <b-form-input
                            id="amount"
                            v-model="expense_form.amount"
                            type="number"
                            required
                            placeholder="Enter amount">

                            </b-form-input>
                        </b-form-group>
                        <b-form-group
                        id="input-group-2"
                        label="Wallet"
                        label-for="wallet"
                        description="Wallet to deduct expense from.">
                            <b-form-select id="wallet" 
                            v-model="expense_form.wallet" 
                            :options="expense_form.wallet_options"
                            required>
                            
                            </b-form-select>
                        </b-form-group>
                        
                        <b-button type="submit" variant="primary" v-on:click="addExpense">Add</b-button>
                    </b-form>
                </b-modal>
            </div>
        </div>
        <div class="data-container container">
            <div class="row">
                <div class="expense-graph col-md-6 col-sm-6">
                    <div class="graph-div-wrapper">
                        <div class="doughnut-chart">
                            <doughnut-chart v-bind:items="table_items"
                             v-bind:labels="doughnutLabels"
                             v-bind:data="doughnutData"
                             :key="doughnutChartKey"
                             height="300">
                                
                            </doughnut-chart>
                        </div>
                    </div>
                </div>
                <div class="expense-table col-md-6 col-sm-6">
                    <div class="table-div-wrapper">
                        <div class="table-div-top">
                            <p style="color: white; font-size: 20px; padding-left: 20px;">
                                Expenses Data <br>
                                <small style="color: white;">Expenses in 
                                    {{months[filter_date.getMonth()]}} {{filter_date.getDate()}}, {{filter_date.getFullYear()}}
                                </small>
                                    
                            </p>
                            
                        </div>
                        <div class="table-div">
                            <!-- <div v-if="table_items.length == 0" align="center" style="padding-top: 100px">
                                <p>Loading...</p>
                            </div> -->
                            <b-table hover :items="table_items"></b-table>
                            <!-- <div v-if="todayExpenses.length == 0">
                                <div class="alert alert-warning">No expenses recorded today</div>
                            </div> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="holder"></div>
        <div id="datepicker1"></div>
        <!-- <p v-for="expense in expenses" :key="expense.id">{{expense.amount}}</p> -->
    </div>
    </div>
</template>

<script>
import axios from 'axios'
import DoughnutChart from './views/DoughnutChart'

export default {
    name: 'expense',
    components: {
        DoughnutChart
    },
    data () {
        return {
            id: sessionStorage.getItem('id'),
            expenses: [],
            categories: [],
            wallets: [],
            expense_form: {
                category: null,
                category_options: [],
                amount: '',
                wallet: null,
                wallet_options: []
            },
            add_wallet_success: false,
            table_items: [],
            table_items_update: [],
            doughnutLabels: [],
            doughnutData: [],
            doughnutChartKey: 'doughtnutchartkey1',
            filter_date: new Date(),
            days: ["Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday"],
            months: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
            currentDate: new Date(),
            updatedDate: new Date().toDateString(),
            todayExpenses: []
        }
    },
    async mounted() {
        await axios.get(`http://localhost:8000/api/expense/all/${this.id}`)
        .then(res => {
            this.expenses = res.data.success;
        })

        // getting expenses of the day
        await axios.get(`http://localhost:8000/api/expense/search/${this.id}/${this.currentDate.getFullYear()+'-'+(this.currentDate.getMonth()+1)+'-'+this.currentDate.getDate()}`)
        .then(res => {
            this.todayExpenses = res.data.success;
            // console.log('today', this.todayExpenses);
            this.todayExpenses.forEach(expense => {
                var d = new Date(expense.time_made);
                // this.table_items.push({date: d.toDateString(), 
                //  category: expense.category_name, amount: 'Ghs'+expense.amount, wallet: expense.wallet_id});
                this.table_items.push({category: expense.category_name, amount: 'Ghs'+expense.amount});
                
                if(this.doughnutLabels.includes(expense.category_name)) {
                    this.doughnutData[this.doughnutLabels.indexOf(expense.category_name)] += expense.amount;
                } else {
                    this.doughnutLabels.push(expense.category_name);
                    this.doughnutData.push(expense.amount);
                }
                
    
            });
        })

        // getting all categories of current user
        await axios.get(`http://localhost:8000/api/category/all/${this.id}`)
        .then(res => {
            this.categories = res.data.success;
            this.categories.forEach(cat => {
                this.expense_form.category_options.push({value: cat.id, text: cat.name});
            });
        })

        // getting all wallets of current user
        await axios.get(`http://localhost:8000/api/wallet/all/${this.id}`)
        .then(res => {
            this.wallets = res.data.success;
            this.wallets.forEach(wallet => {
                this.expense_form.wallet_options.push({value: wallet.id, text: wallet.name});
            });
            this.doughnutChartKey += 1;
        })
    },
    methods: {
        addExpense: function(e) {
            e.preventDefault();
            if(this.expense_form.category != null) {
                axios.post('http://localhost:8000/api/expense/add',{
                    spending_category_id: this.expense_form.category,
                    amount: this.expense_form.amount,
                    wallet_id: this.expense_form.wallet,
                    user_id: this.id
                })
                .then(res => {
                    this.add_wallet_success = true;
                }, (error) => {
                    console.log(error);
                })
                this.expense_form.category = "";
                this.expense_form.amount = "";
                this.expense_form.wallet = "";
            }
            
        },
        addFilter: function(e) {
            axios.get(`http://localhost:8000/api/expense/search/${this.id}/${this.filter_date}`)
            .then(res => {
                this.todayExpenses = res.data.success;
                // console.log('Filtered date: ', this.todayExpenses);
                this.table_items.splice(0, this.table_items.length);
                this.doughnutLabels.splice(0, this.doughnutLabels.length);
                this.doughnutData.splice(0, this.doughnutData.length);
                this.doughnutChartKey += 1;
                this.todayExpenses.forEach(expense => {
                    var d = new Date(expense.time_made);
                    this.table_items.push({category: expense.category_name, amount: 'Ghs'+expense.amount});

                    if(this.doughnutLabels.includes(expense.category_name)) {
                        this.doughnutData[this.doughnutLabels.indexOf(expense.category_name)] += expense.amount;
                    } else {
                        this.doughnutLabels.push(expense.category_name);
                        this.doughnutData.push(expense.amount);
                    }
                    // this.doughnutLabels.push(expense.category_name);
                    // this.doughnutData.push(expense.amount);
                    
                });  
            })
        }
    }
}
</script>

<style scoped>
.button-container {
    display: flex;
    justify-content: space-between;
}
@media (max-width: 430px) {
    .button-container {
        flex-direction: column;
    }
    .button-container div {
        margin: 0px 10px 10px 10px;
    }
}
.data-container {
    margin-top: 50px;
}
.expense-table {
    height: auto;
}
.table-div {
    height: 300px;
    overflow: scroll;
}
.table-div::-webkit-scrollbar { 
    display: none;  /* Safari and Chrome */
}

.table-div {
    -ms-overflow-style: none;  /* Internet Explorer 10+ */
    scrollbar-width: none;  /* Firefox */
}
.table-div-top {
    margin: -30px 5px 5px 5px;
    height: 60px;
    background-color: orange;
    border-radius: 5px;
}
.doughnut-chart {
    position: relative;
    height: 200px;
}
@media (min-width: 380px) {
    .expense-graph {
        margin-bottom: 50px;
    }
    .expense-table {
        margin-top: 50px;
    }
}

@media (max-width: 600px) {
    .expense-graph {
        margin-bottom: 100px;
    }
    .expense-table {
        margin-top: 50px;
    }
}

</style>