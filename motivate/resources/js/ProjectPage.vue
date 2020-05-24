<template>
    <div class="container">
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
            <div class="col-md-8 card py-3">
                <project
                v-bind="project"
                :key="project.id"
                @delete-project="deleteProject"
                @delete-fail="showAlert"
                ></project>
            </div>
        </div>
    </div>
</template>

<script>
    import moment from 'moment'
    
    function projectIni({id, project_name, project_due, created_at}) {
        this.id = id;
        this.name = project_name;
        this.due = project_due;
        this.created = created_at;
    }

    export default{
        props: {
            id: Number,
        },
        data: function() {
            return{
                project: [],
                dismissCountDown: 0
            }
        },
        methods: {
            async read() {
                const {data} = await window.axios.get('/api/projects/'+this.id);
                this.project = new projectIni(data);
            },
            async deleteProject(id) {
                try {
                    await window.axios.delete(`/api/projects/`+id);
                    window.location.href = '/home/'
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
        created() {
            this.read();
        }
    }
</script>