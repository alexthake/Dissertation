<template>
    <div class="row justify-content-end">
        <div class="section col-11">
            <div class="container pt-2 p-0">
                <div class="row mb-1">
                    <div class="col-10">
                        <input id="name-input" type="text" class="form-control chameleon-input mb-2 w-75 float-left p-0" v-model.lazy="nameInput" @change="renameSection()">
                    </div>
                    <div class="col-2">
                        <button id="show-edit-modal" type="button" @click="showEditSectionModal = true" class="btn btn-light float-right py-1">...</button>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <progress-bar
                        :progress=progress 
                        :time=dueMarker></progress-bar>
                    </div>
                </div>

                <edit-section v-on:update-name="updateSection($event)" v-if="showEditSectionModal" @close="showEditSectionModal = false" :sectionId=this.id :projectId=this.project :initialNameInput=this.name :initialDueInput=this.due></edit-section>
                
                <task
                v-for="task in tasks"
                v-bind="task"
                :key="task.id"
                v-on:get-progress="getProgress()"
                ></task>

                <div class="row my-2">
                    <div type="button" class="col-12" @click="createTask">
                        <h5 class="d-inline-block"><b-icon-plus></b-icon-plus></h5><label type="button" style="font-weight: 400; font-size: 1.25rem; color: rgba(33, 37, 41, 0.55);; padding-left: 10px;">New Task</label>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import moment from 'moment'

    function tasksIni({id, task_name, task_description, task_due, task_completed, completion_date, task_priority, task_progress_weight, section_id}) {
        this.id = id;
        this.name = task_name;
        this.description = task_description;
        this.due = task_due;
        this.completed = task_completed;
        this.completion = completion_date;
        this.priority = task_priority;
        this.weight = task_progress_weight;
        this.section = section_id;
    }

    export default{
        data: function() {
            return{
                tasks: [],
                showEditSectionModal: false,
                nameInput: this.name,
                dueMarker: 0
            }
        },
        props: {
            id: Number,
            name: String,
            due: String,
            completed: Boolean,
            project: Number,
            progress: Number,
            project_created: String
        },
        methods: {
            async read() {
                const { data } = await window.axios.get('/api/tasks/section/'+this.id);
                data.forEach(task => this.tasks.push(new tasksIni(task)));
            },
            async update() {
                await window.axios.patch(`/api/sections/`+this.id, { 
                        section_name: this.name, 
                        section_due: this.due,
                        project_id: this.project
                    }
                );

            },
            async createTask() {
                const {data} = await window.axios.get('/api/tasks/create?section_id='+this.id);
                this.tasks.push(new tasksIni(data));
            },
            async getProgress() {
                const {data} = await window.axios.get('/api/sections/progress/'+this.id);

                var $total = data[0];
                var $completed = data[1];

                this.progress = (($completed/$total)*100);

                var start = moment(this.project_created);
                var end = moment(this.due);
                var span = end.diff(start, "minutes");
                var position = moment().diff(start, "minutes");

                this.dueMarker = Math.floor((position/span)*100);
            },
            updateSection($event){
                this.name = $event[0];
                this.due = $event[1];
            },
            renameSection() {
                this.name = this.nameInput;
                this.update();
            }
        },
        created() {
            this.read();
            this.getProgress();
        }
    }
</script>

<style scoped>
.chameleon-input{
    font-size: 24px;
    font-weight: 500;
    border: none;
    color: #212529;
    height: 30px;
}
</style>