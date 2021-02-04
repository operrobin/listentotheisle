<template>
    <div class="detail-container">
        <div class="artist-image" v-if="detail.artist_type != 'list_head'" :style="renderBackground(detail.landscape_url)">
            <div class="info-name d-none d-sm-block">
                <!-- <div class="row no-gutters"> -->

                    <!-- <div class="col-4 artist-record ">
                        <p class="d-table h-100 w-100">
                            <span class="align-middle text-center d-table-cell w-100">
                                MIX TAPE #1
                            </span>
                        </p>

                    </div>

                    <div class="col-8 artist-name">
                        {{ detail.artist_name }}
                    </div> -->

                <!-- </div> -->
            </div>
        </div>

        <div class="artist-info">
            <div class="info-name">
                <div class="row no-gutters">

                    <div class="col-8 artist-name">
                        {{ detail.artist_name }}
                    </div>

                    <div class="col-4 artist-record ">
                        {{ detail.record }}
                    </div>

                </div>
            </div>

            <div class="info-content" :class="{'no-overflow': detail.artist_type == 'list_head'}">

                {{ detail.artist_description }}
                <br>
                <br>
                <button class="btn btn-primary btn-enter" v-if="detail.artist_type != 'list_head'" @click="play()">
                    PLAY NOW
                </button>

            </div>

            <div class="info-footer" v-if="detail.artist_type != 'list_head'">
                <div class="button-container">
                    <div class="box" v-if="detail.songs[0].soundcloud_url != null">
                        <a :href="detail.songs[0].soundcloud_url" target="_blank" class="btn btn-link">SOUNDCLOUD</a>
                    </div>
                    <div class="box" v-if="detail.songs[0].mixcloud_url != null">
                        <a :href="detail.songs[0].mixcloud_url" target="_blank" class="btn btn-link">MIXCLOUD</a>
                    </div>
                    <div class="box" v-if="detail.songs[0].website_url != null">
                        <a :href="detail.songs[0].website_url" target="_blank" class="btn btn-link">WEBSITE</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="youtube-info" v-if="detail.artist_type == 'list_head'">
            <div class="youtube-list" v-for="item in detail.youtube" :key="item.id">
                <b-embed
                    type="iframe"
                    aspect="16by9"
                    :src="item.youtube_url"
                    allowfullscreen
                    class="m-sm-4"
                ></b-embed>

                <div class="info mx-sm-4">
                    <div class="title"> {{ item.title }} </div>
                    <div class="description"> {{ item.short_description }} </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

// import * as actions from '../Store/actions-types'
import * as getters from '../Store/getters-type'
import {mapGetters} from "vuex";
import * as actions from "../Store/actions-types";

export default {
    name: "ArtistDetailComponent",
    computed: {
        ...mapGetters({
           detail: getters.GET_HOME_DETAIL_SELECTED
        })
    },
    methods: {
        renderBackground(url) {
          return 'background-image:url("' + url + '")';
        },
        play() {
            let item = this.detail;
            let dataSong = item.songs[0];

            let song = {
                id: item.id,
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

    .btn-enter {
        font-family: Cow90, sans-serif;
        border: 1px solid white;
        background: orange;
        color: red;
        padding: 8pt;
        border-radius: 0pt;
        text-align: center;
        margin-top: 2em;
    }

    .detail-container {
        min-height: 100%;
        display: flex;
        flex-direction: column;
    }

    .detail-container .artist-image {
        flex: 10%;
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
    }

    .detail-container .artist-info {
        flex: auto;
        background: rgb(250,240,92);
        background: linear-gradient(90deg, rgba(250,240,92,1) 0%, rgba(229,174,81,1) 50%, rgba(206,91,78,1) 100%);
        display: flex;
        flex-direction: column;
    }

    .detail-container .youtube-info {
        background: rgb(250,240,92);
        background: linear-gradient(90deg, rgba(250,240,92,1) 0%, rgba(229,174,81,1) 50%, rgba(206,91,78,1) 100%);
        padding: 0 1em;
        padding-top: 1em;
        /* overflow: scroll; */
    }

    .detail-container .youtube-info .title {
        color: black;
        font-weight: bold;
        margin-top: 1em;
    }

    .detail-container .youtube-info .description {
        color: black;
        font-weight: normal;
        margin-bottom: 1em;
    }

    .detail-container .artist-info .info-name .artist-name {
        font-family: Soulmaze, sans-serif;
        color: red;
        /*-webkit-text-stroke-color: black;*/
        /*-webkit-text-stroke-width: .4pt;*/
        font-weight: bold;
        font-size: 20pt;
        line-height: 20pt;
        padding: .5em 0;
        border-right: 1px solid white;
        border-bottom: 1px solid white;
    }

    .detail-container .artist-info .info-name .artist-record {
        color: white;
        font-weight: bold;
        font-size: 12pt;
        display: flex;
        justify-content: center;
        align-items: center;
        text-transform: uppercase;
        border-bottom: 1px solid white;
        border-right: 1px solid white;
    }

    .detail-container .artist-info .info-name .row div {
        /* border: 1px solid white; */
        text-align: center;
    }

    .detail-container .artist-info .info-name .row div .btn {
        padding: 4pt;
        font-size: 7pt;
        font-weight: bold;
        color: red;
    }

    .detail-container .artist-info .info-content {
        flex: 4;
        overflow: auto;
        font-family: sans-serif;
        padding: 10pt;
        color: black;
        font-size: 10pt;
        font-weight: bold;
        line-height: 1.3;
    }

    .detail-container .artist-info .info-content.no-overflow {
        overflow: visible !important;
    }

    .detail-container .artist-info .info-footer .button-container {
        display: flex;
        flex-direction: row;
        height: 25pt;
    }

    .detail-container .artist-info .info-footer .button-container .box {
        border: 1px solid white;
        border-bottom: 0 !important;
        text-align: center;
        flex: 1;
    }

    .detail-container .artist-info .info-footer .button-container .box .btn {
        color: black;
        font-size: 8pt;
        font-weight: bold;
        display: block;
        height: 100%;
        width: 100%;
    }

    .detail-container .artist-info .info-footer .button-container .box .btn:hover {
        text-decoration: none;
    }

    @media only screen and (min-width: 768px) {
        .detail-container {
            height: 90%;
            display: flex;
            flex-direction: row;
            background: rgb(250,240,92);
            background: linear-gradient(90deg, rgba(250,240,92,1) 0%, rgba(229,174,81,1) 50%, rgba(206,91,78,1) 100%);
        }

        /* _::-webkit-full-page-media, _:future, :root .detail-container .artist-info .info-name {
            height: 20pt;
        } */

        .detail-container .artist-info .info-content {
            border-right: 1px solid white;
        }

        .detail-container .artist-image {
            position: relative ;
            /*height: 100%;*/
            flex: 50%;
            order: 2;
        }

        .detail-container .artist-info {
            background: none;
            flex: 50%;
        }

        .detail-container .artist-info .info-name .artist-name {
            font-size: 50pt;
            /* padding: 10pt 0; */
            line-height: 1;
        }

        .detail-container .artist-info .info-name .row div .btn {
            font-size: 10pt;
        }

        .detail-container .artist-info .info-content {
            font-size: 14pt;
            padding: 2em 1.5em;
        }


        .detail-container .artist-image .info-name .artist-name {
            font-family: Soulmaze, sans-serif;
            color: white;
            -webkit-text-stroke-color: black;
            -webkit-text-stroke-width: .4pt;
            font-weight: bold;
            font-size: 50pt;
            line-height: 40pt;
            padding: 10pt 0pt;
        }

        .detail-container .artist-image .info-name .row div {
            /* border: 1px solid white; */
            text-align: center;
        }

        .detail-container .artist-image .info-name .artist-record {
            color: white;
            font-weight: bold;
            font-size: 12pt;
            border-right: 1px solid white;

        }

        .detail-container .artist-image .info-name .row div .btn {
            padding: 4pt;
            font-size: 7pt;
            font-weight: bold;
            color: red;
        }


        .detail-container .youtube-info {
            width: 50%;
            height: 100%;
            background: none;
            overflow-x: hidden;
            overflow-y: scroll;
        }

        .btn-enter {
            font-family: Cow90, sans-serif;
            border: 1px solid white;
            background: orange;
            color: red;
            font-size: 18pt;
            padding: 8pt 12pt;
            border-radius: 0pt;
            text-align: center;
            margin-top: 2em;
        }
    }
</style>
