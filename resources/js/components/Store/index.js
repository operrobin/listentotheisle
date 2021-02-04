import Vue from 'vue';
import Vuex from 'vuex';
import VuexPersist from "vuex-persist";

import player from './modules/player'
import home from './modules/home'

Vue.use(Vuex);

const vuexLocalStorage = new VuexPersist({
    key: 'vuex', // The key to store the state on in the storage provider.
    storage: window.localStorage, // or window.sessionStorage or localForage
    // Function that passes the state and returns the state with only the objects you want to store.
    reducer: state => ({
        player: {
            song: state.player.song,
            lastSong: state.player.lastSong,
            nextSong: state.player.nextSong,
            mixTapeSong: state.home.mixTapeSong
        },
        home: {
            homeList: state.home.homeList,
            mixTape: state.home.mixtapeList,
            listHead: state.home.listHead,
            detailSelected: state.home.detailSelected,
            community: {
                list: state.home.community.list,
                selected: state.home.community.selected
            },
            words: state.home.words,
            conversation: {
                list: state.home.conversation.list,
                detail: state.home.conversation.detail
            }
        },
    }),
    // Function that passes a mutation and lets you decide if it should update the state in localStorage.
    // filter: mutation => (true)
})

export default new Vuex.Store({
    modules: {
        player,
        home
    },
    plugins: [vuexLocalStorage.plugin]
})
