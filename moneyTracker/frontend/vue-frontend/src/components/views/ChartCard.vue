<template>
    <md-card>
        
    </md-card>
</template>

<script>
export default {
    name: "chart-card",
    props: {
        footerText: {
            type: String,
            default: ""
        },
        headerTitle: {
            type: String,
            default: "Chart title"
        },
        chartType: {
            type: String,
            default: "Line" //Line | Bar | Pie | Doughnut
        },
        chartOptions: {
            type: Object,
            default: () => {
                return {};
            }
        },
        chartResponsiveOptions: {
            type: Array,
            default: () => {
                return [];
            }
        },
        chartData: {
            type: Object,
            default: () => {
                return {
                    labels: [],
                    series: []
                };
            }
        },
        dataBackgroundColor: {
            type: String,
            default: ""
        }
    },
    data () {
        return {
            chartId: "no-id"
        };
    },
    methods: {
        // initializing the chart
        initChart(Chartist) {
            var chartIdQuery = `#${this.chartId}`;
            Chartist[this.chartType](chartIdQuery, this.chartData, this.chartOptions);
        },
        // assigns a random id to the chart
        updateChartId() {
            var currentTime = new Date().getTime().toString();
            var randomInt = this.getRandomInt(0, currentTime);
            this.chartId = `div_${randomInt}`;
        },
        getRandomInt(min, max) {
            return Math.floor(Math.random() * (max - min + 1)) + min;
        }
    },
    mounted() {
        this.updateChartId;
        import("chartist").then(Chartist => {
            let ChartistLib = Chartist.default || Chartist;
            this.$nextTick(() => {
                this.initChart(ChartistLib);
            });
        });
    }
};
</script>

<style>

</style>