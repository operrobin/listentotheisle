<template>
    <div class="mix-container">
        <div class="mixtape-bar" style="border-bottom: 1px solid white;">
            <running-text :slug='"mixtape"' :fallback='"Mix to Tape"'></running-text>
        </div>

        <div class="mix-container-content" style="height: 96%;">

            <div class="row no-gutters h-100">
                <artist-box :artist-data="item" v-for="item in mixtapeList.data" :key="item.id" @clicked="setDetail"></artist-box>
                <artist-box :artist-data="item" v-for="item in mixtapeList.data" :key="item.id" @clicked="setDetail"></artist-box>
            </div>

        </div>
    </div>
</template>

<script>

import * as actions from '../Store/actions-types'
import * as getters from '../Store/getters-type'
import {mapActions, mapGetters} from "vuex";
import ArtistBox from "./artist/ArtistBox";
import RunningText from "../Helper/RunningText";

export default {
    name: "MixTapeComponent",
    components: {
        ArtistBox,
        RunningText
    },
    computed: {
        ...mapGetters({
            mixtapeList: getters.GET_MIXTAPE
        })
    },
    methods: {
        ...mapActions({
          getMixList: actions.MIXTAPE_LIST_SET,
          setDetail: actions.HOME_DETAIL_SET
        })
    },
    mounted() {
        this.getMixList();
    }
}
</script>

<style scoped>
    .mix-container {
        display: flex;
        flex-direction: column;
        height: 100%;
    }

    .mix-container .mix-container-content {
        /* height: 92%; */
        flex: auto;
        /*background: red;*/
        overflow: auto;
    }

    .mix-container .mixtape-bar {
        /* height: 4%; */
        color: red;
        background-color: #FFA51D;
    }

    @media only screen and (min-width: 768px) {

        .mix-container .mix-container-content {
            height: 92%;
        }

        .mix-container .mixtape-bar {
            height: 4%;
        }

    }
</style>
