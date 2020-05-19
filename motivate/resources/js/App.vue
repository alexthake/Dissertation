<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Projects</div>

                    <div class="card-body py-1">
                        <home-project
                        v-for="project in projects"
                        v-bind="project"
                        :key="project.id"
                        ></home-project>
                        <new-project-button></new-project-button>
                    </div>
                </div>
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
                projects: []
            }
        },
        methods: {
            async create() {
                // To do
            },
            async read() {
                console.log(this.$userId)
                const { data } = await window.axios.get('/api/projects/user/'+this.$userId);
                data.forEach(project => this.projects.push(new projectIni(project)));
            },
            async update(id, color) {
                // To do
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