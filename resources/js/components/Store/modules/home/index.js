import mutations from "./mutation";
import getters from "./getters";
import actions from "./action";

const state = {
    homeList: {
        mix: [],
        head: []
    },
    mixtapeList: [],
    listHead: [],
    community : {
        list: [],
        selected: null
    },
    detailSelected: null,
    words: {},
    conversation: {
        detail: null,
        list: []
    }
}

export default {
    state,
    mutations,
    actions,
    getters
}
