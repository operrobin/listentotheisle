import * as mutation from '../../mutation-types'

export default {
    [mutation.HOME_LIST](state, payload) {
        state.homeList = payload;
    },
    [mutation.HOME_DETAIL_SET](state, payload) {
        state.detailSelected = payload;
        window.router.push('detail')
    },
    [mutation.MIXTAPE_LIST](state, payload) {
        state.mixtapeList = payload;
    },
    [mutation.LISTHEAD_LIST](state, payload) {
        state.listHead = payload
    },
    [mutation.COMMUNITY_LIST](state, payload) {
        state.community.list = payload;
    },
    [mutation.COMMUNITY_DETAIL](state, payload) {
        state.community.selected = payload;
        window.router.push('community-detail')
    },
    [mutation.WORD_SET](state, payload) {
        state.words = payload;
    },
    [mutation.CONVERSATION_LIST](state, payload) {
        state.conversation.list = payload;
    },
    [mutation.CONVERSATION_DETAIL](state, payload) {
        state.conversation.detail = payload;
        window.router.push('conversation-detail');
    }
}
