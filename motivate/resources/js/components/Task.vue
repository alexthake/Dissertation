<template>
    <div class="row my-2">
        <div class="col-10">
            <b-form-checkbox class="float-left" size="lg" v-model="completed" value=1 unchecked-value=0 @change="checkTask(); $emit('get-progress');"></b-form-checkbox>
            <input id="name-input" type="text" class="form-control chameleon-input mb-2 w-75 float-left p-0" v-model.lazy="nameInput" @change="renameTask()">
        </div>
        <div class="col-2">
            <button id="show-edit-modal" type="button" @click="showEditTaskModal = true" class="btn btn-light float-right py-1">...</button>
        </div>
        <edit-task v-on:update-name="updateTask($event)" v-if="showEditTaskModal" @close="showEditTaskModal = false" :taskId=this.id :sectionId=this.section :completion=this.completion :initialNameInput=this.name :initialDescInput=this.description :initialDueInput=this.due :initialPriorityInput=this.priority :initialWeightInput=this.weight></edit-task>
    </div>
</template>

<script>
    export default{
        data: function() {
            return{
                showEditTaskModal: false,
                nameInput: this.name
            }
        },
        props: {
            id: Number,
            name: String,
            description: String,
            due: String,
            completed: Number,
            completion: String,
            priority: Number,
            weight: Number,
            section: Number
        },
        methods: {
            updateTask($event){
                this.name = $event[0];
                this.description = $event[1];
                this.due = $event[2];
                this.priority = $event[3];
                this.weight = $event[4];
            },
            async patchTask() {
                await window.axios.patch(`/api/tasks/`+this.id, { 
                        task_name: this.name, 
                        task_description: this.description, 
                        task_due: this.due,
                        task_completed: this.completed,
                        completion_date: null,
                        task_priority: this.priority,
                        task_progress_weight: this.weight,
                        section_id: this.section
                    }
                );
            },
            checkTask() {
                this.completed = !this.completed;
                this.patchTask();
            },
            renameTask() {
                this.name = this.nameInput;
                this.patchTask();
            }
        }
    }
</script>

<style scoped>
.chameleon-input{
    font-size: 20px;
    border: none;
    color: #212529;
    height: 30px;
}
</style>