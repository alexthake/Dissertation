<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <home-project
                v-for="project in projects"
                v-bind="project"
                :key="project.id"
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
                showNewModal: false
            }
        },
        methods: {
            async read() {
                const { data } = await window.axios.get('/api/projects/user/'+this.$userId);
                data.forEach(project => this.projects.push(new projectIni(project)));
            },
            async del(id) {
                // To do
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