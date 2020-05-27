import AppForm from '../app-components/Form/AppForm';

Vue.component('task-form', {
    mixins: [AppForm],
    data: function() {
        return {
            form: {
                task_name:  '' ,
                task_description:  '' ,
                task_due:  '' ,
                task_completed:  false ,
                completion_date:  '' ,
                task_priority:  '' ,
                task_progress_weight:  '' ,
                section_id:  '' ,
                
            }
        }
    }

});