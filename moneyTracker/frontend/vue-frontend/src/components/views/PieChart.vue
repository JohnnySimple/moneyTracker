
<script>
import { Pie } from 'vue-chartjs'

export default {
    extends: Pie,
    data () {
        return {
            chartData: {
                labels: ["Ghana", "South Africa", "Nigeria", "Egypt"],
                datasets: [{
                    borderWidth: 1,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(152, 102, 255, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(152, 102, 255, 1)'
                    ],
                    data: [1000, 500, 1500, 1000]
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
    }
}
</script>