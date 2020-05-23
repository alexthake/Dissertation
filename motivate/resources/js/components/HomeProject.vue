<template>
    <div class="container m-0">
        <div class="card my-3">
            <div class="card-body p-2">
                <div class="row mb-1">
                    <a type="button" :href="'/project/'+this.id" class="col-8 projectName">
                        <h3>{{this.name}}</h3>
                    </a>
                    <div class="col-3">
                        <h5 class="d-inline-block float-left mt-2"><b-icon-alarm></b-icon-alarm></h5> <h5 class="d-inline-block ml-2 float-left mt-2">{{dueString}}</h5>
                    </div>
                    <div class="col-1">
                        <button id="show-edit-modal" type="button" @click="showEditModal = true" class="btn btn-light float-right py-1 mt-1">...</button>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <progress-bar
                        :progress=this.progress 
                        :time="j"></progress-bar>
                    </div>
                </div>
                <edit-project v-on:update-name="updateProject($event)" v-if="showEditModal" @close="showEditModal = false" :projectId=this.id :initialNameInput=this.name :initialDueInput=this.due></edit-project>
            </div>
        </div>
    </div>
</template>

<script>
    import ProgressBar from './ProgressBar.vue';
    import moment from 'moment'

    export default{
        methods: {
            updateProject($event){
                this.name = $event[0];
                this.due = $event[1];
            },
            async getProgress() {
                const {data} = await window.axios.get('/api/projects/progress/'+this.id);
                var $total = data[0];
                var $completed = data[1];
                
                this.progress = (($completed/$total)*100);
            }
        },
        data: function() {
            var start = moment(this.created);
            var end = moment(this.due);
            var span = end.diff(start, "minutes");
            var position = moment().diff(start, "minutes");
            return{
                j: Math.floor((position/span)*100),
                dueString: moment(this.due).format('DD/MM/YY'),
                showEditModal: false
            }
        },
        components: {
            ProgressBar
        },
        props: ['id', 'name', 'due', 'created', 'progress'],
        created() {
            this.getProgress();
        }
    }
</script>

<style scoped>
    .projectName{
        color: black;
    }
    .projectName:hover{
        text-decoration: none;
    }
</style>