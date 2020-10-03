
<script>
import { Line } from 'vue-chartjs'

export default {
    extends: Line,
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
                // labels: ["Aug-01", "Aug-02", "Aug-03", "Aug-04", "Aug-05", "Aug-01", "Aug-02", "Aug-03", "Aug-04", "Aug-05", "Aug-01", "Aug-02", "Aug-03", "Aug-04", "Aug-05"],
                labels: this.labels,
                datasets: [{
                    label: 'Expenses',
                    fill: true,
                    borderWidth: 1,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                    ],
                    pointBorderColor: '#2554FF',
                    // data: [12, 19, 3, 5, 2, 12, 19, 3, 5, 2, 12, 19, 3, 5, 2]
                    data: this.data
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        },
                        gridLines: {
                            display: true
                        },
                        scaleLabel: {
                            display: true,
                            labelString: 'Amount'
                        }
                    }],
                    xAxes: [{
                        gridLines: {
                            display: false
                        },
                        scaleLabel: {
                            display: true,
                            labelString: 'Date'
                        }
                    }]
                },
                legend: {
                    display: true
                },
                responsive: true,
                maintainAspectRatio: false
            }
        }
    },
    async mounted () {
        
        await this.renderChart(this.chartData, this.options);
        // console.log('linechart labels', this.labels);
        // console.log('linechart data', this.data);
        // alert(this.labels.length);
    }
}
</script>