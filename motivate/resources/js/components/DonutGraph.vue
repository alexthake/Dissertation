<script>
    import moment from 'moment'
    import { Doughnut } from 'vue-chartjs'
    
    export default {
        extends: Doughnut,
        props: ['chartdata', 'options'],
        mounted () {
            this.renderChart(this.chartdata, this.options)
        }
    }
</script>

<style scoped>
    
</style>