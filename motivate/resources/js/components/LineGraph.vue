<script>
    import moment from 'moment'
    import { Line } from 'vue-chartjs'
    
    export default {
        extends: Line,
        props: ['chartdata', 'options'],
        mounted () {
            this.renderChart(this.chartdata, this.options)
        }
    }
</script>

<style scoped>
    
</style>