<template>
    <div class="footer">
        <player-info v-if="song != null" :preload="true"></player-info>
        <footer-info></footer-info>
    </div>
</template>

<script>

import * as getters from '../Store/getters-type'
import * as actions from '../Store/actions-types'
import {mapGetters, mapActions} from "vuex";

export default {
    name: "FooterComponent",
    computed: {
        ...mapGetters( {
            song: getters.GET_PLAYER_SONG
        })
    },
    methods: {
        ...mapActions({
           getSongs: actions.MIXTAPE_SONG
        })
    },
    mounted() {
        this.getSongs();
    }
}
</script>

<style scoped>
    .footer {
        width: 100%;
        z-index: 12;
    }

    @media only screen and (min-width: 768px) {

        /* _::-webkit-full-page-media, _:future, :root .footer{

        } */

        .footer {
            height: 7%;
            height: 6vh;
            display: flex;
            flex-direction: row;
        }

         .footer .player-info {
             width: 80vw;
         }

    }
</style>
