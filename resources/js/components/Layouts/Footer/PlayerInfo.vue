<template>
    <div class="player-info">
        <div  class="d-flex flex-row h-100 align-items-center">
            <div class="develop-by d-none d-sm-block">
                <div><b style="font-weight: bolder;">DEVELOPED BY</b></div>
                <div>KUASA WORLD</div>
            </div>
            <div class="song-info h-100">

                <div class="row no-gutters h-100" v-if="song != null">
                    <div class="col-4 col-sm-4 col-md-4 col-lg-4 col-xl-4 align-self-center">
                        <div class="avatar text-right ml-1 ml-sm-0">
                            <img v-if="song != null" :src="song.artist.avatar" />
                        </div>
                    </div>

                    <div class="col-7 offset-1 align-self-center">
                        <div v-if="song != null">
                            <div class="songName">{{ song.name}}</div>
                            <div class="artisName">{{ song.artist.name}}</div>
                        </div>
                    </div>

                </div>

            </div>
            <div class="button-container h-100">

                <div class="row no-gutters align-items-center h-100 ml-auto">
                    <div class="col-4 col-sm-3 col-md-3 col-lg-3 offset-lg-3 text-center">
                        <button class="btn btn-link" @click="prevSong()"><i class="fa fa-step-backward"></i></button>
                    </div>

                    <div class="col-4 col-sm-3 col-md-3 col-lg-3 text-center">
                        <button class="btn btn-link" @click="playSong()"><i class="fa" :class="{'fa-play': !play, 'fa-pause': play}"></i></button>
                    </div>
                    <div class="col-4 col-sm-3 col-md-3 col-lg-3 text-center">
                        <button class="btn btn-link" @click="nextSong()"><i class="fa fa-step-forward"></i></button>
                    </div>
                </div>

            </div>
            <div class="seekbar-container">
                <div class="row no-gutters seekbar-info">
                    <div class="col-2 seekbar-playing text-center">
                        {{ formatSecondsAsTime(seek) }}
                    </div>

                    <div class="col-8 text-center">
                        <input ref="seekbar" v-model="seek" @change="changeSeek" type="range" min="0" :max="duration" class="seekbar">
                    </div>

                    <div class="col-2 seekbar-remaining text-center">
                        {{ formatSecondsAsTime(duration) }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

import VueHowler from 'vue-howler'
import {Howl, Howler} from 'howler';
import * as getters from '../../Store/getters-type'
import * as actions from '../../Store/actions-types'
import {mapActions, mapGetters} from "vuex";

export default {
    name: "PlayerInfo",
    // mixins: [VueHowler],
    computed: {
        ...mapGetters({
            play: getters.GET_PLAYER_PLAYING,
            song: getters.GET_PLAYER_SONG,
            stoping: getters.GET_PLAYER_STOP,
            nextSongs: getters.GET_NEXT_SONG,
            prevSongs: getters.GET_PREV_SONG
        })
    },
    data() {
        return {
            seekChangeValue: 0,
            loaded: false,
            player: null,
            duration: 0,
            seek: 0,
            seekInterval: null,
        }
    },
    watch: {
        'song': function(newVal) {
            this.createPlayer(newVal);
        }
    },
    methods: {
        ...mapActions({
            playState: actions.PLAYER_PLAY,
            pauseState: actions.PLAYER_PAUSE,
            setSong: actions.PLAYER_NEXT
        }),
        clamp(num, min, max) {
            return num <= min ? min : num >= max ? max : num;
        },
        createPlayer(newVal) {
            if (this.player != null) {
                this.player.stop();
                this.player = null;
            }

            if (newVal != null) {
                console.log(newVal)
                this.player = new Howl({
                    src: [newVal.song],
                    preload: true,
                    html5: false,
                    loop: false
                })

                this.player.once('load', () => {
                    if (this.play) {
                        this.player.play();
                    }

                    this.duration = this.player.duration();
                    console.log(this.player.duration());
                });

                this.player.on('play',() => {
                    this.playState();

                    this.seekInterval = setInterval(() => {
                        this.seek = this.player.seek();
                    }, 1000 / 4);

                });

                this.player.on('pause', () => {
                    this.pauseState();
                    clearInterval(this.seekInterval);
                });

                this.player.once('end', () => {
                    clearInterval(this.seekInterval);
                });
            }
        },
        emptyString(str) {
          return str === undefined || str === null || str === '';
        },
        changeSeek(newVal) {
            if (this.player != null) {
                console.log('change seek ', this.seek)
                this.player.seek(this.seek);
            }
        },
        playSong() {

          if (this.player != null) {
              if (this.play) {
                  this.player.pause();
              } else {
                  this.player.play();
              }
          }
        },
        nextSong() {
            console.log(this.nextSongs);
            console.log(this.prevSongs);
            if (this.nextSongs != null) {
                this.setSong(this.nextSongs);
            }
        },
        prevSong() {
            if (this.prevSongs != null) {
                this.setSong(this.prevSongs);
            }
        },
        floorMath(seconds) {
          return Math.floor(seconds / 3600);
        },
        formatSecondsAsTime(seconds) {
            let hr  = Math.floor(seconds / 3600);
            let min = Math.floor((seconds - (hr * 3600))/60);
            let sec = Math.floor(seconds - (hr * 3600) -  (min * 60));

            if (min < 10){
                min = "0" + min;
            }
            if (sec < 10){
                sec  = "0" + sec;
            }
            let duration = min + ':' + sec;

            if(hr){
                duration = hr+ ':' +duration;
            }
            return duration;
        }
    },
    mounted() {
        // this.$on('load', (...args) => {
        //     this.loaded = true;
        //     setTimeout(() => {
        //         console.log('load and play song');
        //         this.togglePlayback();
        //     }, 000);
        // })
        this.createPlayer(this.song);
    }
}
</script>

<style scoped>

    .player-info {
        background-color: #FFA51D;
        height: 2.5em;
        border-bottom: 1px solid white;
        border-top: 1px solid white;
    }

    .player-info .avatar img {
        width: 100%;
        border-radius: 10pt;
        border: 1px solid white;
    }

    .player-info .songName {
        font-size: 6pt;
        font-weight: bold;
        overflow: hidden;
        white-space: nowrap;
        text-overflow: ellipsis;
    }

    .player-info .artisName {
        font-size: 6pt;
        overflow: hidden;
        white-space: nowrap;
        text-overflow: ellipsis;
    }

    .player-info .song-info {
        color: white;
        width: 25vw;
    }

    .player-info .button-container {
        width: 20vw;
    }

    .player-info .seekbar-container {
        position: relative;
        width: 55vw;
    }

    .player-info .seekbar-info {
        /*position: absolute;*/
        /*top: 50%;*/
        /*left: 50%;*/
        /*transform: translate(-50%, -50%);*/
    }

    .player-info .seekbar {
        -webkit-appearance: none;
        margin: 3pt 0;
        width: 100%;
        height: 1.5pt;
        background: white;
        outline: none;
    }

    .player-info .seekbar::-webkit-slider-thumb {
        -webkit-appearance: none;
        -moz-appearance: none;
        appearance: none;
        width: 12pt;
        height: 12pt;
        /*border: 1px solid #aaa;*/
        border-radius: 50%;
        background: white;
    }

    .player-info .seekbar::-moz-range-thumb {
        width: 12pt;
        height: 12pt;
        /*border: 1px solid #aaa;*/
        border-radius: 50%;
        background: white;
    }

    .player-info .button-container .btn {
        padding: 0;
        color: white;
        border-radius: 0;
    }

    .player-info .seekbar-playing, .player-info .seekbar-remaining {
        font-size: 6pt;
        color: white;
        font-weight: bold;
    }

    @media only screen and (min-width: 768px) {

        .player-info {
            background-color: #FFA51D;
            border-left: 1px solid white;
            border-top: 1px solid white;
            border-bottom: 1px solid white;
            border-right: 1px solid white;
            height: 100%;
        }

        .player-info .develop-by {
            width: 20vw;
            color: white;
            text-align: center;
            font-size: 8pt;
        }

        .player-info .song-info {
            color: white;
            border-left: 1px solid white;
            width: 25vw;
        }

        .player-info .songName {
            font-size: 10pt;
        }

        .player-info .artisName {
            margin-top: -.3em;
            font-size: 10pt;
        }

        .player-info .avatar img {
            max-width: 30pt;
            max-height: 30pt;
            border-radius: 50%;
        }

        .player-info .button-container {
            border-left: 1px solid white;
            flex-basis: auto;
            text-align: right;
        }

        .player-info .button-container .btn {
            font-size: 14pt;
        }

        .player-info .seekbar {
            margin: 5pt 0;
        }

        .player-info .seekbar-playing, .player-info .seekbar-remaining {
            font-size: 8pt;
        }

        .develop-by div:first-child {
            order:1;
            font-size:9pt;
        }

        .develop-by div:last-child {
            font-size:8pt;
            order:2;
            margin-top: -3px;
        }

    }

</style>
