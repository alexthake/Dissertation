<template>
    <div class="container m-0">
        <div class="card my-3">
            <a type="button" :href="'/project/'+this.id" class="card-body p-2 projectName">
                <div class="row mb-1">
                    <div class="col-10">
                        <h3>{{this.name}}</h3>
                    </div>
                    <div class="col-2">
                        <button id="show-edit-modal" type="button" @click="showEditModal = true" class="btn btn-light float-right">...</button>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <progress-bar
                        :progress="i" 
                        :time="j"></progress-bar>
                    </div>
                </div>
                <edit-project v-on:update-name="updateProject($event)" v-if="showEditModal" @close="showEditModal = false" :projectId=this.id :initialNameInput=this.name :initialDueInput=this.due></edit-project>
            </a>
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
            }
        },
        data: function() {
            var start = moment(this.created);
            var end = moment(this.due);
            var span = end.diff(start, "minutes");
            var position = moment().diff(start, "minutes");
            return{
                i: Math.floor((Math.random() * 100) + 1),
                j: Math.floor((position/span)*100),

                showEditModal: false
            }
        },
        components: {
            ProgressBar
        },
        props: ['id', 'name', 'due', 'created'],
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