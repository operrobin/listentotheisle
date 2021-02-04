import * as action from '../../actions-types'
import * as mutation from "../../mutation-types";

export default {
    [action.HOME_LIST]({commit}) {
        axios.get('api/home/list')
            .then(res => {
                commit(mutation.HOME_LIST, res.data.data);
            }).catch(err => {
            console.error(err);
        });

    },
    [action.HOME_DETAIL_SET]({commit}, payload) {
        commit(mutation.HOME_DETAIL_SET, payload);
    },
    [action.MIXTAPE_LIST_SET]({commit}) {
        axios.get('/api/home/mix')
            .then(res => {
                commit(mutation.MIXTAPE_LIST, res.data.data);
            }).catch(err => {
                console.error(err);
        })
    },
    [action.LISTHEAD_LIST_SET]({commit}) {
        axios.get('/api/home/listHead')
            .then(res => {
                commit(mutation.LISTHEAD_LIST, res.data.data);
            }).catch(err => {
            console.error(err);
        })
    },
    [action.COMMUNITY_LIST_SET]({commit}) {
        axios.get('/api/home/community')
        .then(res => {
            commit(mutation.COMMUNITY_LIST, res.data.data)
        }).catch(err => {
            console.error(err);
        });
    },
    [action.COMMUNITY_LIST_DETAIL_SET]({commit}, payload) {
        commit(mutation.COMMUNITY_DETAIL, payload);
    },
    [action.WORD_SET]({commit, state}, payload) {

        let data = state.words;

        let slug = payload.slug;
        let fallback = payload.fallback;

        axios.get('/api/word/' + slug)
        .then(res => {
            console.log(res);
            data[slug] = res.data.data.content;
            commit(mutation.WORD_SET, data);
        }).catch(err => {
            console.log(err);
            data[slug] = fallback;
            commit(mutation.WORD_SET, data);
        })
    },
    [action.CONVERSATION_LIST]({commit}) {
        axios.get('/api/home/conversation')
        .then(res => {
            commit(mutation.CONVERSATION_LIST, res.data.data);
        }).catch(err => {
            console.error(err);
        });
    },
    [action.CONVERSATION_DETAIL]({commit}, payload) {
        axios.get('/api/home/conversation/detail/' + payload.id)
        .then(res => {
            commit(mutation.CONVERSATION_DETAIL, res.data.data);
        }).catch(err => {
            console.error(err);
        });
    }
}
