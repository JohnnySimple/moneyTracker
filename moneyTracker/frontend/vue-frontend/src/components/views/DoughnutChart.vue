
<script>
import { Doughnut } from 'vue-chartjs'

export default {
    extends: Doughnut,
    // props: ['catAmts', 'cats', 'cat_amounts', 'items', 'labels', 'data'],
    props: {
        labels: {
            type: Array,
            default: []
        },
        data: {
            type: Array,
            default: []
        }
    },
    data () {
        return {
            chartData: {
                // labels: ["Ghana", "South Africa", "Nigeria", "Egypt"],
                labels: this.labels,
                datasets: [{
                    borderWidth: 1,
                    // backgroundColor: [
                    //     'rgba(255, 99, 132, 2)',
                    //     'rgba(54, 162, 235, 2)',
                    //     // 'rgba(255, 206, 86, 0.2)',
                    //     'rgba(152, 102, 255, 2)'
                    // ],
                    backgroundColor: this.dynamicColors(102),
                    data: this.data
                    // data: ['100', '50', '70', '40']
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
    mounted () {
        this.renderChart(this.chartData, this.options)
        // console.log('items', this.items);
        // console.log('labels: ', this.labels._chartjs);
        // console.log('data: ', this.data);
    },
    methods: {
        dynamicColors: function(size) {
            console.log('size', this.data.length);
            let colors = [];
            for(let i = 0; i < size; i++) {
                let r = Math.floor(Math.random() * 255);
                let g = Math.floor(Math.random() * 255);
                let b = Math.floor(Math.random() * 255);
                colors.push("rgb(" + r + "," + g + "," + b + ",1)");
            }
            return colors;
            // return "rgb(" + r + "," + g + "," + b + ",0.2)";
        }
    }
}
</script>