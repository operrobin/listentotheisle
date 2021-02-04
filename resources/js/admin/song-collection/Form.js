import AppForm from '../app-components/Form/AppForm';

Vue.component('song-collection-form', {
    mixins: [AppForm],
    data: function() {
        return {
            form: {
                song_name:  '' ,
                song_description:  '' ,
                artist_id:  '' ,
                soundcloud_url:  '' ,
                mixcloud_url:  '' ,
                website_url:  '' ,
                published_at:  '' ,
            },
            mediaCollections: ['song_file']
        }
    }

});
