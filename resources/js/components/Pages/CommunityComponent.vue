<template>
    <div class="mix-container">
        <div class="mixtape-bar" style="border-bottom: 1px solid white;">
<!--            <marquee-text :duration="5" :repeat="10"> COME UNITY &nbsp; / &nbsp; </marquee-text>-->
            <running-text :slug='"community"' :fallback='"COME UNITY"'></running-text>
        </div>

        <div class="mix-container-content">

            <div class="row no-gutters h-100">
                <streamer-box :artist-data="item" v-for="item in communityList.data" :key="item.id" @clicked="setDetail"></streamer-box>
            </div>

        </div>
    </div>
</template>

<script>

import * as actions from '../Store/actions-types'
import * as getters from '../Store/getters-type'
import {mapActions, mapGetters} from "vuex";
import StreamerBox from "./streamer/StreamerBox";
import RunningText from "../Helper/RunningText";

export default {
    name: "Community",
    components: {
        StreamerBox,
        RunningText
    },
    computed: {
        ...mapGetters({
            communityList: getters.GET_COMMUNITY_LIST
        })
    },
    methods: {
        ...mapActions({
          getListCommunity: actions.COMMUNITY_LIST_SET,
          setDetail: actions.COMMUNITY_LIST_DETAIL_SET
        })
    },
    mounted() {
        this.getListCommunity();
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
