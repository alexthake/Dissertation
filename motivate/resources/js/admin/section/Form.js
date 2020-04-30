import AppForm from '../app-components/Form/AppForm';

Vue.component('section-form', {
    mixins: [AppForm],
    data: function() {
        return {
            form: {
                section_name:  '' ,
                section_due:  '' ,
                project_id:  '' ,
                
            }
        }
    }

});