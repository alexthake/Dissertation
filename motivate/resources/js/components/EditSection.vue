<template>
    <transition name="modal">
        <div class="modal-mask">
            <div class="modal-wrapper container">
                <div class="row justify-content-center">
                    <div class="modal-container col-12 col-md-8 col-lg-6 mt-5 card">
                        <div class="card-body">
                            <form>
                                <div class="form-row">
                                    <div class="form-group col-12 mb-0">
                                        <input id="name-input" type="text" class="form-control chameleon-input mb-2 w-75 float-left p-0" v-model="nameInput">
                                    </div>
                                </div>
                                <div class="form-row mt-1 mb-3">
                                    <div class="form-group col-12 mb-0">
                                        <label class="mt-2 mb-0 float-left" for="due-datepicker">Task Due</label>
                                        <b-form-datepicker id="due-datepicker" class="mb-2 w-50 float-right" v-model="dueInput"></b-form-datepicker>
                                    </div>
                                </div>
                                <button type="button" class="btn btn-danger float-left" @click="$emit('delete-section');">Delete</button>
                                <button type="button" class="btn btn-success float-right" @click="update(); $emit('close'); $emit('update-name', [nameInput, dueInput])">Submit</button>
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
    export default {
        props: ['initialNameInput', 'initialDueInput', 'sectionId', 'projectId'],
        data: function() {
            return{
                nameInput: this.initialNameInput,
                dueInput: this.initialDueInput
            }
        },
        methods: {
            async update() {
                await window.axios.patch(`/api/sections/`+this.sectionId, { 
                        section_name: this.nameInput, 
                        section_due: this.dueInput,
                        project_id: this.projectId
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
