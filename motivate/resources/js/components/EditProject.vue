<template>
    <transition name="modal">
        <div class="modal-mask">
            <div class="modal-wrapper container">
                <div class="row justify-content-center">
                    <div class="modal-container col-12 col-md-8 col-lg-6 mt-5 card">
                        <div class="card-body">
                            <form>
                            <div class="form-row">
                                <div class="form-group col-10 mb-0">
                                    <input id="name-input" type="text" class="form-control chameleon-input mb-2 w-75 float-left p-0" v-model="nameInput">
                                </div>
                                <div class="form-group col-2 mb-0">
                                    <a type="button" class="btn btn-primary float-right" :href="'/progress/'+this.projectId" >Analysis</a>
                                </div>
                            </div>
                            <div class="form-row mt-1 mb-3">
                                    <div class="form-group col-12 mb-0">
                                        <label class="mt-2 mb-0 float-left" for="due-datepicker">Task Due</label>
                                        <b-form-datepicker id="due-datepicker" class="mb-2 w-50 float-right" v-model="dueInput"></b-form-datepicker>
                                    </div>
                                </div>
                            <button type="button" class="btn btn-danger float-left" @click="$emit('delete-project');">Delete</button>
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
        props: ['initialNameInput', 'initialDueInput', 'projectId'],
        data: function() {
            return{
                nameInput: this.initialNameInput,
                dueInput: this.initialDueInput
            }
        },
        methods: {
            async update() {
                await window.axios.patch(`/api/projects/`+this.projectId, { 
                        project_name: this.nameInput, 
                        project_due: this.dueInput,
                        user_id: this.$userId
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
