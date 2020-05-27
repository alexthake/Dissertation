<template>
    <div class="row my-2">
        <div class="col-10">
            <b-form-checkbox class="float-left" size="lg" v-model="checkboxState" value=1 unchecked-value=0></b-form-checkbox>
            <input id="name-input" type="text" class="form-control chameleon-input mb-2 w-75 float-left p-0" v-model.lazy="nameInput" @change="patchTask()">
        </div>
        <div class="col-2">
            <button id="show-edit-modal" type="button" @click="showEditTaskModal = true" class="btn btn-light float-right py-1">...</button>
        </div>
        <edit-task v-on:update-name="updateTask($event)" v-on:delete-task="del" v-if="showEditTaskModal" @close="showEditTaskModal = false" :taskId=this.id :sectionId=this.section :completion=this.completionValue :initialNameInput=this.nameInput :initialDescInput=this.description :initialDueInput=this.due :initialPriorityInput=this.priority :initialWeightInput=this.weight></edit-task>
    </div>
</template>

<script>
    import moment from 'moment'

    export default{
        data: function() {
            return{
                checkboxState: this.completed,
                showEditTaskModal: false,
                nameInput: this.name,
                completedValue: this.completed,
                completionValue: this.completion,
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
                        task_name: this.nameInput, 
                        task_description: this.description, 
                        //task_due: ((this.due)? this.due : 'null' ),
                        task_completed: this.completedValue,
                        completion_date: this.completionValue,
                        task_priority: this.priority,
                        task_progress_weight: this.weight,
                        section_id: this.section
                    }
                );
                this.$emit('get-progress');
            },
            del(){
                this.$emit('delete-task', this.id);
                this.$emit('get-progress');
            }
        },
        watch: {
            checkboxState: function(val){
                this.completedValue = parseInt(val);
                ((this.completedValue) ? this.completionValue = moment().format('YYYY-MM-DD HH:mm:ss') : this.completionValue = '');
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