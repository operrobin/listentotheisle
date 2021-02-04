<template>
    <div class="detail-container h-100">
        <div class="artist-image">
            <b-embed
                class="my-auto"
                type="iframe"
                aspect="16by9"
                :src="getTwitchUrl"
                allowfullscreen
            ></b-embed>

        </div>

        <div class="artist-info">

            <div class="artist-name">
                {{ detail.name }}
            </div>

            <div class="artist-name-streamer">
                {{ detail.streamer_name }}
            </div>

            <div class="info-content">

                {{ detail.description }}

            </div>

            <div class="info-footer">
                <div class="button-container">
                    <div class="box" v-if="detail.soundcloud_url != null">
                        <a :href="detail.soundcloud_url" target="_blank" class="btn btn-link">SOUNDCLOUD</a>
                    </div>
                    <div class="box" v-if="detail.mixcloud_url != null">
                        <a :href="detail.mixcloud_url" target="_blank" class="btn btn-link">MIXCLOUD</a>
                    </div>
                    <div class="box" v-if="detail.website_url != null">
                        <a :href="detail.website_url" target="_blank" class="btn btn-link">WEBSITE</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

import VueAspectRatio from "vue-aspect-ratio";

// import * as actions from '../Store/actions-types'
import * as getters from '../Store/getters-type'
import {mapGetters} from "vuex";
import * as actions from "../Store/actions-types";

export default {
    name: "ArtistDetailComponent",
    components: {
        'vue-aspect-ratio': VueAspectRatio
    },
    computed: {
        ...mapGetters({
           detail: getters.GET_COMMUNITY_SELECTED_LIST
        }),
        getTwitchUrl() {
            return this.detail.twitch_url + "&parent=dev2.listentotheisle.com";
        }
    },
    methods: {
        renderBackground(url) {
          return 'background-image:url("' + url + '")';
        },
        play() {
            let item = this.detail;
            let dataSong = item.songs[0];

            let song = {
                name: dataSong.song_name,
                artist: {
                    name: item.artist_name,
                    avatar: item.album_url
                },
                song: dataSong.song_url
            };

            this.$store.dispatch(actions.PLAYER_NEXT, song);
        }
    },
    mounted() {
        if (this.detail == null) {
            this.$router.push('/');
        }
    }
}
</script>

<style scoped>
    .detail-container {
        height: 100%;
        display: flex;
        flex-direction: column;
    }

    .detail-container .artist-image {
        flex: auto;
    }

    .detail-container .artist-info {
        flex: auto;
        background: rgb(250,240,92);
        background: linear-gradient(90deg, rgba(250,240,92,1) 0%, rgba(229,174,81,1) 50%, rgba(206,91,78,1) 100%);
        display: flex;
        flex-direction: column;
    }

    .detail-container .artist-info .artist-name {
        font-family: Soulmaze, sans-serif;
        color: red;
        /*-webkit-text-stroke-color: black;*/
        /*-webkit-text-stroke-width: .4pt;*/
        font-weight: bold;
        font-size: 30pt;
        line-height: 1.5;
        text-align: center;
        border-bottom: 1px solid white;
    }

    .detail-container .artist-info .artist-name-streamer {
        color: white;
        font-weight: bold;
        font-size: 12pt;
        border-bottom: 1px solid white;
        text-align: center;
    }

    .detail-container .artist-info .info-name .row div {
        border: 1px solid white;
        text-align: center;
    }

    .detail-container .artist-info .info-name .row div .btn {
        padding: 4pt;
        font-size: 7pt;
        font-weight: bold;
        color: red;
    }

    .detail-container .artist-info .info-content {
        flex: auto;
        overflow: auto;
        font-family: sans-serif;
        padding: 10pt;
        color: black;
        font-size: 10pt;
        font-weight: bold;
        overflow: auto;
    }

    .detail-container .artist-info .info-footer .button-container {
        display: flex;
        flex-direction: row;
    }

    .detail-container .artist-info .info-footer .button-container .box {
        border: 1px solid white;
        text-align: center;
        flex: 1;
    }

    .detail-container .artist-info .info-footer .button-container .box .btn {
        color: black;
        font-size: 8pt;
        font-weight: bold;
        padding: 4pt;
    }

    @media only screen and (min-width: 768px) {

        .detail-container {
            height: 100%;
            display: flex;
            flex-direction: row;
        }

        .detail-container .artist-image {
            width: 50%;
            /*background: #333;*/
        }

        .detail-container .artist-info {
            width: 5%;
        }

        .detail-container .artist-info .artist-name {
            font-size: 50pt;
            padding: 4pt 0;
        }

        .detail-container .artist-info .info-content {
            font-size: 12pt;
            padding: 2em 1.5em;
        }

        .detail-container .artist-info .info-footer .button-container .box .btn {
            color: black;
            font-size: 10pt;
            font-weight: bold;
            padding: 4pt;
        }
    }
</style>
