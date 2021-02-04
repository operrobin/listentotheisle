import AppForm from '../app-components/Form/AppForm';

Vue.component('conversation-form', {
    mixins: [AppForm],
    data: function() {
        return {
            form: {
                artist_name:  '' ,
                short_description:  '' ,
                long_description:  '' ,
                interview_by:  '' ,
                photography_by:  '' ,
                published_at:  '' ,
                
            },
            mediaCollections: ['gallery', 'thumbnail']
        }
    }

});