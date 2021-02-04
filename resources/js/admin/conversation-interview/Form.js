import AppForm from '../app-components/Form/AppForm';

Vue.component('conversation-interview-form', {
    mixins: [AppForm],
    data: function() {
        return {
            form: {
                conversation_id:  '' ,
                question:  '' ,
                answer:  '' ,
                
            }
        }
    }

});