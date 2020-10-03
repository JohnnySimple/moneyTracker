<template>
    <div>
        <div class="container" align="right">
            <b-button v-b-modal.modal-1 variant="primary"><b-icon icon="plus"></b-icon>Add category</b-button>
            <b-modal id="modal-1" title="Add Category">
                <div v-if="add_category_success" class="alert alert-success">Category addedd successfully!</div>
                <b-form>
                    <b-form-group
                    id="input-group-1"
                    label="Category name"
                    label-for="input-1"
                    description="Name of a category you spend on. Eg, clothing, food."
                    >
                        <b-form-input
                        id="input-1"
                        v-model="category_form.name"
                        type="text"
                        required
                        placeholder="Enter category">

                        </b-form-input>
                    </b-form-group>
                    <b-button type="submit" variant="primary" v-on:click="addCategory">Add</b-button>
                </b-form>
            </b-modal>
        </div>

        <div v-for="cat in catAmounts" :key="cat[2]">
            {{ cat[0] }} => {{ cat[1] }}
        </div>
        
        <div class="doughnut-chart">
            <doughnut-chart v-bind:catAmts="catAmounts" v-bind:cats="category_names" v-bind:cat_amounts="category_amounts">
                
            </doughnut-chart>
        </div>
    </div>
</template>

<script>
import axios from 'axios';
import BarChart from './views/BarChart'
import PieChart from './views/PieChart'
import DoughnutChart from './views/DoughnutChart'

export default {
    name: 'category',
    components: {
        BarChart,
        PieChart,
        DoughnutChart
    },
    data () {
        return {
            id: sessionStorage.getItem('id'),
            categories: [],
            category_names: [],
            category_amounts: [],
            expenses: [],
            cat_amounts: [],
            category_form: {
                name: ''
            },
            add_category_success: false,
            chartData: {
                // labels: ["Ghana", "South Africa", "Nigeria", "Egypt"],
                labels: this.category_names,
                datasets: [{
                    borderWidth: 1,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        // 'rgba(255, 206, 86, 0.2)',
                        'rgba(152, 102, 255, 0.2)'
                    ],
                    data: this.category_amounts
                    // data: ['100', '50', '70']
                }]
            },
            options: {
                legend: {
                    display: true
                },
                responsive: true,
                maintainAspectRatio: false
            }
        }
    },
    async mounted () {
        await axios.get(`http://localhost:8000/api/category/all/${this.id}`)
        .then(res => {
            this.categories = res.data.success;
            // console.log(this.categories);
        })

        await axios.get(`http://localhost:8000/api/expense/all/${this.id}`)
        .then(res => {
            this.expenses = res.data.success;
            // console.log(this.expenses);
        });
            this.catAmounts.forEach(element => {
                this.category_names.push(element[0]);
                this.category_amounts.push(element[1]);
            });
    },
    computed: {
        catAmounts: function () {
            // getting total expenses under each category of current user
            let amounts = [];
            for (let i = 0; i < this.categories.length; i++) {
                let total_amount = 0;
                for (let j = 0; j < this.expenses.length; j++) {
                    if (this.categories[i].id == this.expenses[j].spending_category_id) {
                        total_amount += this.expenses[j].amount;
                        // console.log(this.expenses[j].amount);
                    }
                }
                amounts[amounts.length] = [this.categories[i].name, total_amount, this.categories[i].id];
                // this.category_names.push(this.categories[i].name);
                // this.category_amounts.push(total_amount);
            }
            return amounts;
        }
    },
    methods: {
        addCategory: function(e) {
            e.preventDefault();
            if(this.category_form.name != "") {
                axios.post('http://localhost:8000/api/category/add',{
                    name: this.category_form.name,
                    user_id: this.id
                })
                .then(res => {
                    // console.log(res.data.success.message);
                    this.add_category_success = true;
                }, (error) => {
                    console.log(error);
                })
                this.category_form.name = "";
            }
        }
    }
}
</script>

<style scoped>
.bar-chart {
    width: 200px;
    /* height: 200px; */
}
.pie-chart {
    width: 200px;
}
.doughnut-chart {
    width: 200px;
}
</style>