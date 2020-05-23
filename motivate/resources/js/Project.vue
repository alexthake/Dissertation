<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 card py-3">
                <div class="container m-0">
                    <div class="row mb-1">
                        <div class="col-10">
                            <h3>{{name}}</h3>
                        </div>
                        <div class="col-2">
                            <button id="show-edit-modal" type="button" @click="showEditModal = true" class="btn btn-light float-right py-1 mt-1">...</button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <progress-bar
                            :progress=this.progress 
                            :time=this.dueMarker></progress-bar>
                        </div>
                    </div>
                    <edit-project v-on:update-name="updateProject($event)" v-if="showEditModal" @close="showEditModal = false" :projectId=this.id :initialNameInput=this.name :initialDueInput=this.due></edit-project>
                    
                    <project-section
                    v-for="section in sections"
                    v-bind="section"
                    :key="section.id"
                    ></project-section>

                    <div class="row mt-4">
                        <div type="button" class="col-12" @click="createSection">
                            <h5 class="d-inline-block"><b-icon-plus></b-icon-plus></h5><label type="button" style="font-weight: 500; font-size: 1.4rem; color: rgba(33, 37, 41, 0.55);; padding-left: 10px;">New Section</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import moment from 'moment'

    function sectionIni({id, section_name, section_due, project_id}, project_created) {
        this.id = id;
        this.name = section_name;
        this.due = section_due;
        this.project = project_id;
        this.project_created = project_created;
    }
    
    export default{
        data: function() {
            return{
                sections: [],
                showEditModal: false,
                dueMarker: 0
            }
        },
        props: {
            id: Number,
            name: String,
            due: String,
            progress: Number,
            created: String,
        },
        methods: {
            async projectRead() {
                const { data } = await window.axios.get('/api/projects/'+this.id);
                this.name = data.project_name;
                this.due = data.project_due;
                this.created = data.created_at;
            },
            async read() {
                const { data } = await window.axios.get('/api/sections/project/'+this.id);
                data.forEach(section => this.sections.push(new sectionIni(section, this.created)));
            },
            async createSection() {
                const {data} = await window.axios.get('/api/sections/create?project_id='+this.id);
                this.sections.push(new sectionIni(data));
            },
            async getProgress() {
                const {data} = await window.axios.get('/api/projects/progress/'+this.id);
                var $total = data[0];
                var $completed = data[1];

                this.progress = (($completed/$total)*100);

                var start = moment(this.created);
                var end = moment(this.due);
                var span = end.diff(start, "minutes");
                var position = moment().diff(start, "minutes");

                this.dueMarker = Math.floor((position/span)*100);
                console.log(this.dueMarker);
            },
            updateProject($event){
                this.name = $event[0];
                this.due = $event[1];
            }
        },
        created() {
            this.projectRead();
            this.getProgress();
            this.read();
        }
    }
</script>