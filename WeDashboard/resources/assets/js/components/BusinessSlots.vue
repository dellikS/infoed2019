<template>
    <canvas id="slotsChart"></canvas>
</template>

<script>
    import Chart from 'chart.js'
    export default {
        props:['employees', 'vacancies'],
        data() {
            return {
                labels: ['Vacancies', 'Employees']
            }
        },
        mounted() {
            this.drawChart();
        },
        methods: {
            drawChart() {
                var vacancies = this.vacancies-this.employees;
                let ctx = document.getElementById("slotsChart");
                let slotsChart = new Chart(ctx, {
                    type: 'doughnut',
                    data: {
                        labels: this.labels,
                        datasets: [{
                            label: 'Number of users online',
                            data: [vacancies, this.employees],
                            backgroundColor: ['#395ba1', '#ccc'],
                            border: 1,
                        }]
                    }
                });
            }
        }
    }
</script>