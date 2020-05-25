<template>
    <div class="container py-2">
        <b-alert
        :show="dismissCountDown"
        dismissible
        variant="danger"
        @dismissed="dismissCountDown=0"
        @dismiss-count-down="countDownChanged"
        >
        <p class="m-0">Unable to delete, please delete any contained tasks or sections and try again</p>
        </b-alert>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <home-project
                v-for="project in projects"
                v-bind="project"
                :key="project.id"
                @delete-project="deleteProject"
                ></home-project>
                <div class="container m-0">
                    <div class="card my-3">
                        <div id="show-new-modal" type="button" @click="showNewModal = true" class="card-body p-2">
                            <div class="row mb-1">
                                <div class="col-12">
                                    <h3 class="my-2 text-center">New Project</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <new-project v-if="showNewModal" @close="showNewModal = false;"></new-project>
            </div>
        </div>
    </div>
</template>

<script>
    function projectIni({id, project_name, project_due, created_at}) {
        this.id = id;
        this.name = project_name;
        this.due = project_due;
        this.created = created_at;
    }

    import HomeProject from './components/HomeProject.vue';

    export default{
        data: function() {
            return{
                projects: [],
                showNewModal: false,
                dismissCountDown: 0
            }
        },
        methods: {
            async read() {
                const { data } = await window.axios.get('/api/projects/user/'+this.$userId);
                data.forEach(project => this.projects.push(new projectIni(project)));
            },
            async deleteProject(id) {
                try {
                    await window.axios.delete(`/api/projects/`+id);
                    let index = this.projects.findIndex(project => project.id === id);
                    this.projects.splice(index, 1);
                } catch(error) {
                    this.showAlert();
                }
            },
            countDownChanged(dismissCountDown) {
                this.dismissCountDown = dismissCountDown
            },
            showAlert() {
                this.dismissCountDown = 5
            }
        },
        components: {
            HomeProject
        },
        created() {
            this.read();
        }
    }
</script>