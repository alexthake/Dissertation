<template>
    <transition name="modal">
        <div class="modal-mask">
            <div class="modal-wrapper container">
            <div class="modal-container card">
                    <div class="card-header py-2 px-4">
                        <h4 class="m-0 mt-2 d-inline-block">New Project</h4>
                        <button type="button" class="btn btn-light float-right d-inline" @click="$emit('close')">X</button>
                    </div>
                    <div class="card-body">
                        <form>
                        <div class="form-group">
                            <label class="mb-0" for="newProjectName">Project Name</label>
                            <input type="text" class="form-control" id="newProjectName" placeholder="Enter project name" v-model="nameInput">
                            <label class="mt-2 mb-0" for="due-datepicker">Due Date</label>
                            <b-form-datepicker id="due-datepicker" class="mb-2" v-model="dueInput"></b-form-datepicker>
                        </div>
                        <button type="button" class="btn btn-success float-right" @click="post(); $emit('close')">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </transition>
</template>

<script>
    export default {
        data: function() {
            return{
                nameInput: '',
                dueInput: ''
            }
        },
        methods: {
            async post() {
                await window.axios.post(`/api/projects`, { 
                        project_name: this.nameInput, 
                        project_due: this.dueInput,
                        user_id: this.$userId
                    }).then(function (response) {
                        //Open created project by id
                        window.location.href = '/project/'+response.data;
                    }
                );
            },
        },
        mounted() {
            //
        }
    }
</script>

<style scoped>
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