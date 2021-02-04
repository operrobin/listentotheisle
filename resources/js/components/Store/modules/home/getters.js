import * as getter from '../../getters-type'

export default {
    [getter.GET_HOME_LIST](state) {
        return state.homeList;
    },
    [getter.GET_HOME_DETAIL_SELECTED](state) {
        return state.detailSelected;
    },
    [getter.GET_MIXTAPE](state) {
        return state.mixtapeList;
    },
    [getter.GET_LIST_HEAD](state) {
        return state.listHead;
    },
    [getter.GET_COMMUNITY_LIST](state) {
        return state.community.list;
    },
    [getter.GET_COMMUNITY_SELECTED_LIST](state) {
        return state.community.selected;
    },
    [getter.GET_WORD](state) {
        return state.words;
    },
    [getter.GET_CONVERSATION_LIST](state) {
        return state.conversation.list;
    },
    [getter.GET_CONVERSATION_DETAIl](state) {
        return state.conversation.detail;
    }
}
