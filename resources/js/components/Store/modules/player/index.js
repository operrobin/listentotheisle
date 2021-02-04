import mutations from "./mutation";
import getters from "./getters";
import actions from "./action";

const state = {
    play: false,
    stop: false, 
    song: null,
    lastSong: null,
    nextSong: null,
    mixTapeSong: [],
}

export default {
    state,
    mutations,
    actions,
    getters
}
