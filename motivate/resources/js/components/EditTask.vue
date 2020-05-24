<template>
    <transition name="modal">
        <div class="modal-mask">
            <div class="modal-wrapper container">
                <div class="row justify-content-center">
                    <div class="modal-container col-12 col-md-8 col-lg-6 mt-5 card">
                        <div class="card-body">
                            <form>
                                <div class="row">
                                    <div class="col-9">
                                        <input id="name-input" type="text" class="form-control chameleon-input mb-2 p-0" v-model="nameInput">
                                    </div>
                                    <div class="col-3">
                                        <p v-if="this.completion" class="mt-3" style="font-size: 12px;">completed:{{this.completion_text}}</p>
                                    </div>
                                </div>
                                <textarea class="form-control" id="taskDescription" placeholder="description..." v-model="descriptionInput"></textarea>
                                <div class="form-row mt-2">
                                    <div class="form-group col-12 mb-0">
                                        <label class="mt-2 mb-0 float-left" for="due-datepicker">Task Due</label>
                                        <b-form-datepicker id="due-datepicker" class="mb-2 w-50 float-right" v-model="dueInput"></b-form-datepicker>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-12 mb-0">
                                        <label class="mt-2 mb-0 float-left" for="priority-input">Priority</label>
                                        <input id="priority-input" type="text" class="form-control mb-2 w-25 float-right" v-model="priorityInput">
                                    </div>
                                </div>
                                <div class="form-row mb-3">
                                    <div class="form-group col-12 mb-0">
                                        <label class="mt-2 mb-0 float-left" for="weight-input">Task Progress Weight</label>
                                        <input id="weight-input" type="text" class="form-control mb-2 w-25 float-right" v-model="weightInput">
                                    </div>
                                </div>

                                <button type="button" class="btn btn-danger float-left" @click="$emit('delete-task');">Delete</button>
                                <button type="button" class="btn btn-success float-right" @click="update(); $emit('close'); $emit('update-name', [nameInput, descriptionInput, dueInput, priorityInput, weightInput])">Submit</button>
                                <button type="button" class="btn btn-light float-right mr-2" @click="$emit('close')">Close</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </transition>
</template>

<script>
    import moment from 'moment';

    export default {
        props: ['initialNameInput', 'initialDescInput', 'initialDueInput', 'initialPriorityInput', 'initialWeightInput', 'taskId', 'sectionId', 'completion'],
        data: function() {
            return{
                nameInput: this.initialNameInput,
                descriptionInput: this.initialDescInput,
                dueInput: this.initialDueInput,
                priorityInput: this.initialPriorityInput,
                weightInput: this.initialWeightInput,
                completion_text: null,
            }
        },
        methods: {
            async update() {
                await window.axios.patch(`/api/tasks/`+this.taskId, { 
                        task_name: this.nameInput, 
                        task_description: this.descriptionInput, 
                        task_due: this.dueInput,
                        task_completed: true,
                        completion_date: this.completion,
                        task_priority: this.priorityInput,
                        task_progress_weight: this.weightInput,
                        section_id: this.sectionId
                    }
                );

            },
        },
        created() {
            this.completion_text = moment(this.completion).format('DD/MM/YY');
        }
    }
</script>

<style scoped>
.chameleon-input{
    font-size: 24px;
    border: none;
    color: #212529;
    height: 34px;
}

.modal-mask {
  position: fixed;
  z-index: 9998;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, 0.5);
  transition: opacity 0.3s ease;
}

.modal-wrapper {
  vertical-align: middle;
}

.modal-container {
  margin: 0px auto;
  background-color: #fff;
  border-radius: 2px;
  box-shadow: 0 2px 8px rgba(0, 0, 0, 0.33);
  transition: all 0.3s ease;
  font-family: Helvetica, Arial, sans-serif;
}

.w-20{
    width: 20%;
}

.m-auto{
    margin: auto;
}
</style>
