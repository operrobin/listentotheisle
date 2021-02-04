<template>
    <div class="mix-container">
        <div class="mixtape-bar" style="border-bottom: 1px solid white;">
            <running-text :slug="'conversation'" :fallback="'Conversation'"></running-text>
        </div>

        <div class="mix-container-content">

            <div class="row no-gutters h-100">
                <conversation-box :artist-data="item" v-for="item in conversationList.data" :key="item.id" @clicked="setDetail"></conversation-box>
            </div>

        </div>
    </div>
</template>

<script>

import * as actions from '../Store/actions-types'
import * as getters from '../Store/getters-type'
import {mapActions, mapGetters} from "vuex";

import RunningText from '../Helper/RunningText';
import ConversationBox from './conversation/ConversationBox';

export default {
    name: "Conversation",
    components: {
        RunningText,
        ConversationBox
    },
    computed: {
        ...mapGetters({
            conversationList: getters.GET_CONVERSATION_LIST
        })
    },
    methods: {
        ...mapActions({
          getConversationList: actions.CONVERSATION_LIST,
          setDetail: actions.CONVERSATION_DETAIL
        })
    },
    mounted() {
        this.getConversationList();
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
