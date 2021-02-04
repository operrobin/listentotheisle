import AppForm from '../app-components/Form/AppForm';

Vue.component('youtube-collection-form', {
    mixins: [AppForm],
    data: function() {
        return {
            form: {
                artist_id:  '' ,
                short_description:  '' ,
                title:  '' ,
                youtube_url:  '' ,
                
            }
        }
    }

});