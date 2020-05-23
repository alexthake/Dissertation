<template>
    <transition name="modal">
        <div class="modal-mask">
            <div class="modal-wrapper container">
                <div class="modal-container card">
                    <div class="card-body">
                        <form>
                            <input id="name-input" type="text" class="form-control chameleon-input mb-2 w-75 float-left p-0" v-model="nameInput">
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

                            <button type="button" class="btn btn-danger float-left">Delete</button>
                            <button type="button" class="btn btn-success float-right" @click="update(); $emit('close'); $emit('update-name', [nameInput, descriptionInput, dueInput, priorityInput, weightInput])">Submit</button>
                            <button type="button" class="btn btn-light float-right mr-2" @click="$emit('close')">Close</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </transition>
</template>

<script>
    export default {
        props: ['initialNameInput', 'initialDescInput', 'initialDueInput', 'initialPriorityInput', 'initialWeightInput', 'taskId', 'sectionId'],
        data: function() {
            return{
                nameInput: this.initialNameInput,
                descriptionInput: this.initialDescInput,
                dueInput: this.initialDueInput,
                priorityInput: this.initialPriorityInput,
                weightInput: this.initialWeightInput
            }
        },
        methods: {
            async update() {
                await window.axios.patch(`/api/tasks/`+this.taskId, { 
                        task_name: this.nameInput, 
                        task_description: this.descriptionInput, 
                        task_due: this.dueInput,
                        task_completed: true,
                        completion_date: null,
                        task_priority: this.priorityInput,
                        task_progress_weight: this.weightInput,
                        section_id: this.sectionId
                    }
                );

            },
        },
        mounted() {
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
  display: table;
  transition: opacity 0.3s ease;
}

.modal-wrapper {
  display: table-cell;
  vertical-align: middle;
}

.modal-container {
  width: 600px;
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
