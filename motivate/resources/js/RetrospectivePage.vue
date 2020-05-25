<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 card py-3">
                <retrospective
                v-bind="project"
                :key="project.id"
                ></retrospective>
            </div>
        </div>
    </div>
</template>

<script>
    import moment from 'moment'

    function projectIni({id, project_name, project_due, user_id, created_at}) {
        this.id = id;
        this.name = project_name;
        this.due = project_due;
        this.user = user_id;
        this.created = created_at;
    }

    export default{
        props: {
            id: Number,
        },
        data: function() {
            return{
                project: [],
            }
        },
        methods: {
            async read() {
                const {data} = await window.axios.get('/api/projects/'+this.id);
                this.project = new projectIni(data);
            },
        },
        created() {
            this.read();
        }
    }
</script>