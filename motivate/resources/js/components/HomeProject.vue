<template>
    <div class="container m-0">
        <div class="card my-3">
            <div class="card-body p-2">
                <div class="row mb-1">
                    <a type="button" :href="'/project/'+this.id" class="col-12 col-lg-8 projectName">
                        <h3>{{this.name}}</h3>
                    </a>
                    <div class="col-9 col-lg-3">
                        <h5 v-if="this.due" :class="'d-inline-block mx-2 float-left float-lg-right mt-2 '+((this.dueMarker >= 100 && this.progressValue != 100) ? 'text-red' : '')">{{dueString}}</h5><h5 v-if="this.due" :class="'d-inline-block float-left float-lg-right mt-2 '+((this.dueMarker >= 100 && this.progressValue != 100) ? 'text-red' : '')"><b-icon-alarm></b-icon-alarm></h5>
                    </div>
                    <div class="col-3 col-lg-1">
                        <button id="show-edit-modal" type="button" @click="showEditModal = true" class="btn btn-light float-right py-1 mt-1">...</button>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <progress-bar
                        :progress=this.progressValue 
                        :time=this.dueMarker></progress-bar>
                    </div>
                </div>
                <edit-project v-on:update-name="updateProject($event)" v-on:delete-project="del" v-if="showEditModal" @close="showEditModal = false" :projectId=this.id :initialNameInput=this.name :initialDueInput=this.due></edit-project>
            </div>
        </div>
    </div>
</template>

<script>
    import ProgressBar from './ProgressBar.vue';
    import moment from 'moment'

    export default{
        props: ['id', 'name', 'due', 'created', 'progress'],
        created() {
            this.getProgress();
        },
        data: function() {
            return{
                dueMarker: 0,
                dueString: moment(this.due).format('DD/MM/YY'),
                showEditModal: false,
                progressValue: this.progress,
            }
        },
        methods: {
            async getProgress() {
                const {data} = await window.axios.get('/api/projects/progress/'+this.id);
                var $total = data[0];
                var $completed = data[1];
                
                this.progressValue = (($completed/$total)*100);

                var start = moment(this.created);
                var end = moment(this.due);
                var span = end.diff(start, "minutes");
                var position = moment().diff(start, "minutes");

                this.dueMarker = Math.floor((position/span)*100);
            },
            updateProject($event){
                this.name = $event[0];
                this.due = $event[1];
                this.getProgress();
                this.dueString = moment(this.due).format('DD/MM/YY');
            },
            del() {
                this.$emit('delete-project', this.id);
            }
        },
    }
</script>

<style scoped>
    .text-red{
        color: red;
    }
    .projectName{
        color: black;
    }
    .projectName:hover{
        text-decoration: none;
    }
</style>