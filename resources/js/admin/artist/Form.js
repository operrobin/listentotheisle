import AppForm from '../app-components/Form/AppForm';

Vue.component('artist-form', {
    mixins: [AppForm],
    data: function() {
        return {
            form: {
                artist_name:  '' ,
                artist_description:  '' ,
                artist_type:  '' ,
                record: ''

            },
            mediaCollections: ['gallery']
        }
    }

});
