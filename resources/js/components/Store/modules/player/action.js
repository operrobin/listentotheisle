import * as action from '../../actions-types'
import * as mutation from "../../mutation-types";

export default {
    [action.PLAYER_PLAY]({commit}) {
        commit(mutation.PLAYER_PLAY);
    },
    [action.PLAYER_STOP]({commit}) {
        commit(mutation.PLAYER_STOP);
    },
    [action.PLAYER_PAUSE]({commit}) {
        commit(mutation.PLAYER_PAUSE)
    },
    [action.PLAYER_NEXT]({commit}, payload) {
        commit(mutation.PLAYER_SET_SONG, payload);
    },
    [action.PLAYER_PREV]({commit}, payload) {
        commit(mutation.PLAYER_SET_SONG, payload);
    },
    [action.MIXTAPE_SONG]({commit}) {
        axios.get('/api/home/mixSong')
            .then(res => {
                commit(mutation.PLAYER_MIXTAPE_SONG, res.data.data)
            }).catch(err => {
            console.error(err);
        })
    }
}
