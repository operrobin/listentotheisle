import AppForm from '../app-components/Form/AppForm';

Vue.component('word-static-page-form', {
    mixins: [AppForm],
    data: function() {
        return {
            form: {
                content:  '' ,
                slug:  '' ,
                
            }
        }
    }

});