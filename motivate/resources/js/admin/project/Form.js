import AppForm from '../app-components/Form/AppForm';

Vue.component('project-form', {
    mixins: [AppForm],
    data: function() {
        return {
            form: {
                project_name:  '' ,
                project_due:  '' ,
                user_id:  '' ,
                
            }
        }
    }

});