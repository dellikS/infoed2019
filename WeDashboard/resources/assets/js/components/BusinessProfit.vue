<template>
    <canvas id="profitChart"></canvas>
</template>

<script>
    import Chart from 'chart.js'
    export default {
        props:['profit', 'expense'],
        data() {
            return {
                labels: ['Profit', 'Expense']
            }
        },
        mounted() {
            this.drawChart();
        },
        methods: {
            drawChart() {
                var profit  = this.profit - this.expense
                let ctx = document.getElementById("profitChart");
                let profitChart = new Chart(ctx, {
                    type: 'doughnut',
                    data: {
                        labels: this.labels,
                        datasets: [{
                            label: 'Number of users online',
                            data: [profit, this.expense],
                            backgroundColor: [profit < 0 ? '#dc3545' : '#28a745', '#ccc'],
                            border: 1,
                        }]
                    }
                });
            }
        }
    }
</script>