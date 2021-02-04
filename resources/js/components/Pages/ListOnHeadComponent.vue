<template>
    <div class="mix-container">
        <div class="mixtape-bar" style="border-bottom: 1px solid white;">
<!--            <marquee-text :duration="5" :repeat="10"> LIST IN MY HEAD &nbsp; / &nbsp; </marquee-text>-->
            <running-text :slug='"list_head"' :fallback='"LIST IN MY HEAD"'></running-text>
        </div>

        <div class="mix-container-content">

            <div class="row no-gutters h-100">
                <youtube-box :artist-data="item" v-for="item in listHead.data" :key="item.id" @clicked="setDetail"></youtube-box>
                <youtube-box :artist-data="item" v-for="item in listHead.data" :key="item.id" @clicked="setDetail"></youtube-box>
            </div>

        </div>
    </div>
</template>

<script>

import * as actions from '../Store/actions-types'
import * as getters from '../Store/getters-type'
import {mapActions, mapGetters} from "vuex";
import YoutubeBox from "./artist/YoutubeBox";
import RunningText from "../Helper/RunningText";

export default {
    name: "ListOnHead",
    components: {
        YoutubeBox,
        RunningText
    },
    computed: {
        ...mapGetters({
            listHead: getters.GET_LIST_HEAD
        })
    },
    methods: {
        ...mapActions({
          getListHead: actions.LISTHEAD_LIST_SET,
          setDetail: actions.HOME_DETAIL_SET
        })
    },
    mounted() {
        this.getListHead();
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
        flex: auto;
        /*background: red;*/
        overflow: auto;
    }

    .mix-container .mixtape-bar {
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
