import * as getter from '../../getters-type'

export default {
    [getter.GET_PLAYER_PLAYING](state) {
        return state.play;
    },
    [getter.GET_PLAYER_STOP](state) {
        return state.stop;
    },
    [getter.GET_PLAYER_SONG](state) {
        return state.song;
    },
    [getter.GET_NEXT_SONG](state) {
        return state.nextSong;
    },
    [getter.GET_PREV_SONG](state) {
        return state.lastSong;
    },
    [getter.GET_MIXTAPE_SONG](state) {
        return state.mixTapeSong;
    }
}
