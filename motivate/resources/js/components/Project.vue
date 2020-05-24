<template>
    <div class="container m-0">
        <div class="row mb-1">
            <div class="col-12 col-lg-8">
                <h3>{{name}}</h3>
            </div>
            <div class="col-9 col-lg-3">
                <h5 v-if="this.due" :class="'d-inline-block mx-2 float-left float-lg-right mt-2 '+((this.dueMarker >= 100 && this.projectProgress != 100) ? 'text-red' : '')">{{dueString}}</h5><h5 v-if="this.due" :class="'d-inline-block float-left float-lg-right mt-2 '+((this.dueMarker >= 100 && this.projectProgress != 100) ? 'text-red' : '')"><b-icon-alarm></b-icon-alarm></h5>
            </div>
            <div class="col-3 col-lg-1">
                <button id="show-edit-modal" type="button" @click="showEditModal = true" class="btn btn-light float-right py-1 mt-1">...</button>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <progress-bar
                :progress=this.projectProgress 
                :time=this.dueMarker></progress-bar>
            </div>
        </div>
        <edit-project v-on:update-name="updateProject($event)" v-on:delete-project="del" v-if="showEditModal" @close="showEditModal = false" :projectId=this.id :initialNameInput=this.name :initialDueInput=this.due></edit-project>
        
        <project-section
        v-for="section in sections"
        v-bind="section"
        :key="section.id"
        @delete-section="deleteSection"
        v-on:get-project-progress="getProjectProgress()"
        ></project-section>

        <div class="row mt-4">
            <div type="button" class="col-12" @click="createSection">
                <h5 class="d-inline-block"><b-icon-plus></b-icon-plus></h5><label type="button" style="font-weight: 500; font-size: 1.4rem; color: rgba(33, 37, 41, 0.55);; padding-left: 10px;">New Section</label>
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
        props: {
            id: Number,
            name: String,
            due: String,
            created: String,
        },
        data: function() {
            return{
                sections: [],
                showEditModal: false,
                dueMarker: 0,
                dueString: moment(this.due).format('DD/MM/YY'),
                projectProgress: 0,
            }
        },
        methods: {
            async read() {
                const { data } = await window.axios.get('/api/sections/project/'+this.id);
                data.forEach(section => this.sections.push(new sectionIni(section, this.created)));
            },
            async createSection() {
                const {data} = await window.axios.get('/api/sections/create?project_id='+this.id);
                this.sections.push(new sectionIni(data));
            },
            async getProjectProgress() {
                const {data} = await window.axios.get('/api/projects/progress/'+this.id);
                var $total = data[0];
                var $completed = data[1];

                this.projectProgress = (($completed/$total)*100);

                var start = moment(this.created);
                var end = moment(this.due);
                var span = end.diff(start, "minutes");
                var position = moment().diff(start, "minutes");

                this.dueMarker = Math.floor((position/span)*100);
            },
            async deleteSection(id) {
                try {
                    await window.axios.delete(`/api/sections/`+id);
                    let index = this.sections.findIndex(section => section.id === id);
                    this.sections.splice(index, 1);
                } catch(error) {
                    this.$emit("delete-fail");
                }
            },
            updateProject($event){
                this.name = $event[0];
                this.due = $event[1];
                this.getProjectProgress();
                this.dueString = moment(this.due).format('DD/MM/YY');
            },
            del() {
                this.$emit('delete-project', this.id);
            }
        },
        created() {
            this.getProjectProgress();
            this.read();
        }
    } 
</script>

<style scoped>
    .text-red{
        color: red;
    }
</style>