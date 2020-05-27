<template>
    <div class="container m-0">
        <div class="row mb-1">
            <div class="col-7 col-lg-9">
                <h3>{{name}} - Analysis</h3>
            </div>
            <div class="col-5 col-lg-3">
                <h5 v-if="this.due" 
                :class="'d-inline-block mx-2 float-left float-lg-right mt-2 '+((this.dueMarker >= 100 && this.projectProgress != 100) ? 'text-red' : '')"
                >
                    {{dueString}}
                </h5>
                <h5 v-if="this.due" 
                :class="'d-inline-block float-left float-lg-right mt-2 '+((this.dueMarker >= 100 && this.projectProgress != 100) ? 'text-red' : '')"
                >
                    <b-icon-alarm></b-icon-alarm>
                </h5>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <progress-bar
                :progress=this.projectProgress 
                :time=this.dueMarker></progress-bar>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-12 col-xl-6">
                <div class="card">
                    <bar-graph
                    v-if="taskDaysLoaded"
                    :chartdata=this.taskDays
                    :options=this.options></bar-graph>
                </div>
            </div>
            <div class="col-12 mt-3 col-xl-6 mt-xl-0">
                <div class="card">
                    <line-graph
                    v-if="progressDaysLoaded"
                    :chartdata=this.progressDays
                    :options=this.percentOptions></line-graph>
                </div>
            </div>
        </div>
        <div class="row mt-3" v-if="taskProjectsLoaded">
            <div class="col-12">
                <div class="card">
                    <line-graph
                    :chartdata=this.taskProjects
                    :options=this.options></line-graph>
                </div>
            </div>
        </div>
        <div class="row mt-3" v-if="productivityDaysLoaded">
            <div class="col-12">
                <div class="card">
                    <donut-graph
                    :chartdata=this.productivityDays
                    :options=this.options></donut-graph>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import moment from 'moment'

    //Creates an array of moment dates between two given dates
    function datesBetween(startDate, endDate) {
        let dateArray = new Map();
        let currentDate = startDate;
        while(currentDate <= endDate){
            dateArray.set(currentDate, 0);
            currentDate = moment(currentDate).add(1, 'days');
        }
        return dateArray;
    }

    function taskDaysBuilder(dateSpan, taskDates) {
        let chartData = new Map();
        dateSpan.forEach(function(value, key){
            taskDates.forEach(function(date){
                if(date.isSame(key, 'day')){
                    value++;
                }
            })
            let dateString = key.format("DD/MM")
            chartData.set(dateString, value);
        });

        let chartLabels = Array.from( chartData.keys() );
        let chartValues = Array.from( chartData.values() );
        let taskDays = {
            labels: chartLabels,
            datasets: [
                {
                label: 'Tasks completed',
                backgroundColor: '#007bff',
                barPercentage: 1,
                categoryPercentage: 1,
                data: chartValues
                }
            ]
        }
        return taskDays;
    }

    function progressDaysBuilder(dateSpan, taskDates) {
        let chartData = new Map();
        let tasksComplete = 0;
        dateSpan.forEach(function(value, key){
            taskDates.forEach(function(date){
                if(date.isSame(key, 'day')){
                    tasksComplete++;
                }
            })
            let dateString = key.format("DD/MM")
            let progressPercent = (tasksComplete / taskDates.length)*100
            chartData.set(dateString, progressPercent);
        });

        let chartLabels = Array.from( chartData.keys() );
        let chartValues = Array.from( chartData.values() );
        let progressDays = {
            labels: chartLabels,
            datasets: [
                {
                label: 'Project Percentage Completed',
                backgroundColor: '#007bff80',
                data: chartValues
                }
            ]
        }
        return progressDays;
    }
    
    function taskProjectsBuilder(dateSpan, taskDates, allTasks, projectId, projectName) {
        let chartData = new Map();
        let chartDataProjects = new Map();
        dateSpan.forEach(function(value, key){
            taskDates.forEach(function(date){
                if(date.isSame(key, 'day')){
                    value++;
                }
            })
            let dateString = key.format("DD/MM")
            chartData.set(dateString, value);

            let count = 0;
            allTasks.forEach(function(data){
                if(data[0].isSame(key, 'day') && data[1] != projectId){
                    count++;
                }
            chartDataProjects.set(dateString, count);
            })
        });

        let chartLabels = Array.from( chartData.keys() );
        let chartValues = Array.from( chartData.values() );
        let chartProjectValues = Array.from( chartDataProjects.values() );
        let taskDays = {
            labels: chartLabels,
            datasets: [
                {
                label: projectName+' tasks completed',
                backgroundColor: '#007bff80',
                data: chartValues
                },
                {
                label: 'Other tasks completed',
                backgroundColor: '#ff000080',
                data: chartProjectValues
                }
            ]
        }
        return taskDays;
    }

    function productivityDaysBuilder(taskDates) {
        let chartData = new Map();
        let chartColours = new Map();
        taskDates.forEach(function(date){
            if(date.isValid()){
                let count = (chartData.get(date.format('dddd')) ? chartData.get(date.format('dddd')) : 0);
                count++;
                chartData.set(date.format('dddd'), count);
                chartColours.set(date.format('dddd'), '#'+(Math.floor(Math.random()*16777215).toString(16)));
            }
        });

        let chartLabels = Array.from( chartData.keys() );
        let chartValues = Array.from( chartData.values() );
        let arcColours = Array.from( chartColours.values() );
        let productivityDays = {
            labels: chartLabels,
            datasets: [
                {
                backgroundColor: arcColours,
                data: chartValues 
                }
            ]
        }
        return productivityDays;
    }

    export default{
        props: {
            id: Number,
            name: String,
            due: String,
            user: Number,
            created: String,
        },
        data: function() {
            return{
                tasks: [],
                dueMarker: 0,
                dueString: moment(this.due).format('DD/MM/YY'),
                projectProgress: 0,

                taskDays: {},
                taskDaysLoaded: false,
                progressDays: {},
                progressDaysLoaded: false,
                taskProjects: {},
                taskProjectsLoaded: false,
                productivityDays: {},
                productivityDaysLoaded: false,
                mostProductive: [],
                leastProductive: [],

                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true,
                                stepSize: 1,
                            }
                        }]
                    }
                },
                percentOptions: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true,
                                stepSize: 25,
                                suggestedMax: 100,
                            }
                        }]
                    },
                    elements: {
                        line: {
                            tension: 0
                        }
                    }
                }
            }
        },
        methods: {
            async getProjectData() {
                const {data} = await window.axios.get('/api/tasks/user/'+this.$userId);
                let project_id = this.id;
                let projectTasks = data.filter(function (el) {
                    return el.project_id == project_id;
                });
                let endDate = ((moment() < moment(projectTasks[0].project_due)) ? moment() : moment(projectTasks[0].project_due) )
                let dateSpan = datesBetween(moment(projectTasks[0].created_at), endDate);
                let taskDates = [];
                projectTasks.forEach(task => taskDates.push(moment(task.completion_date)))

                this.taskDays = taskDaysBuilder(dateSpan, taskDates);
                this.taskDaysLoaded = true

                this.progressDays = progressDaysBuilder(dateSpan, taskDates);
                this.progressDaysLoaded = true

                let allTasks = [];
                data.forEach(task => allTasks.push([moment(task.completion_date), task.project_id, task.project_name]))
                this.taskProjects = taskProjectsBuilder(dateSpan, taskDates, allTasks, this.id, projectTasks[0].project_name);
                this.taskProjectsLoaded = ((projectTasks.length < allTasks.length) ? true : false)

                this.productivityDays = productivityDaysBuilder(taskDates);
                this.productivityDaysLoaded = true
            },
            async getProjectProgress() {
                const {data} = await window.axios.get('/api/projects/progress/'+this.id);
                var $total = data[0];
                var $completed = data[1];

                this.projectProgress = (($completed/$total)*100);

                var start = moment(this.created);
                var end = moment(this.due);
                var span = end.diff(start, "minutes");
                var position = moment().diff(start, "minutes");

                this.dueMarker = Math.floor((position/span)*100);
            },
        },
        mounted() {
            this.getProjectProgress();
            this.getProjectData();
        }
    } 
</script>

<style scoped>
    .text-red{
        color: red;
    }
</style>