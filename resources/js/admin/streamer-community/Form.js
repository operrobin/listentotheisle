import AppForm from '../app-components/Form/AppForm';

Vue.component('streamer-community-form', {
    mixins: [AppForm],
    data: function() {
        return {
            form: {
                name:  '' ,
                streamer_name:  '' ,
                description:  '' ,
                twitch_url:  '' ,
                soundcloud_url:  '' ,
                mixcloud_url:  '' ,
                website_url:  '' ,
                published_at:  '' ,
                
            },
            mediaCollections: ['gallery']
        }
    }

});