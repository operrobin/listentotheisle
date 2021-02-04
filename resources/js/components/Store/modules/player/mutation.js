import * as mutation from '../../mutation-types'

export default {
    [mutation.PLAYER_PLAY](state) {
        state.play = true;
    },
    [mutation.PLAYER_PAUSE](state) {
        state.play = false;
    },
    [mutation.PLAYER_STOP](state) {
        state.stop = false;
    },
    [mutation.PLAYER_SET_SONG](state, payload) {

        state.stop = true;

        let index = state.mixTapeSong.findIndex(function(res) {
          return res.id === payload.id;
        });

        if (index !== -1) {

            if (index === 0) {
                state.lastSong = null;
            } else {
                let lastItem = state.mixTapeSong[index - 1];
                let lastDataSong = lastItem.songs[0];

                state.lastSong = {
                    id: lastItem.id,
                    name: lastDataSong.song_name,
                    artist: {
                        name: lastItem.artist_name,
                        avatar: lastItem.album_url
                    },
                    song: lastDataSong.song_url
                };
            }

            state.song = payload;
            state.play = true;
            
            

            if (index > state.mixTapeSong.length) {
                state.nextSong = null;
            } else {
                let nextItem = state.mixTapeSong[index + 1];
                let nextDataSong = nextItem.songs[0];

                state.nextSong  = {
                    id: nextItem.id,
                    name: nextDataSong.song_name,
                    artist: {
                        name: nextItem.artist_name,
                        avatar: nextItem.album_url
                    },
                    song: nextDataSong.song_url
                };
            }
        }


    },
    [mutation.PLAYER_MIXTAPE_SONG](state, payload) {
        state.mixTapeSong = payload;

        if (state.song == null && payload.length > 0) {

            let item = payload[0];
            let dataSong = item.songs[0];

            if (payload.length > 1) {
                let nextItem = payload[1];
                let dataSongNext = nextItem.songs[0];

                state.nextSong = {
                    id: nextItem.id,
                    name: dataSongNext.song_name,
                    artist: {
                        name: nextItem.artist_name,
                        avatar: nextItem.album_url
                    },
                    song: dataSongNext.song_url
                };
            }

            state.song = {
                id: item.id,
                name: dataSong.song_name,
                artist: {
                    name: item.artist_name,
                    avatar: item.album_url
                },
                song: dataSong.song_url
            };
        }
    }
}
