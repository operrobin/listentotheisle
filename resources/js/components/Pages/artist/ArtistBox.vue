<template>

    <div class="col-12 col-sm-4 col-md-4 col-lg-3 h-50 item">

        <!-- <vue-aspect-ratio ar="1:1"> -->
            <div class="artist_container h-100" v-on:click='clicked'>
                <div class="artist_box" :style="renderImage">

                </div>

                <div class="artist_name">
                    <div class="artist_name_title">
                        {{ artistData.artist_name }}
                    </div>
                    <div class="artist_name_number">
                    0
                    </div>
                </div>

                <div class="artist_song">
                    <div class="artist_song_title">
                        {{ artistData.record }}
                    </div>
                    <div class="artist_song_duration">1 HR 30 M</div>
                </div>
            </div>
        <!-- </vue-aspect-ratio> -->



    </div>

</template>

<script>

    import VueAspectRatio from "vue-aspect-ratio";

    export default {
        name: "ArtistBox",
        props: {
            artistData: Object
        },
        components: {
            "vue-aspect-ratio": VueAspectRatio
        },
        computed: {
            renderImage() {
                return 'background-image: url(' + this.artistData.landscape_url + ')';
            }
        },
        methods: {
            clicked() {
                this.$emit('clicked', this.artistData);
            }
        },
        mounted() {

        }
    }
</script>

<style scoped>

    .item .artist_container {
        display: flex;
        flex-direction: column;
        border-top: 1px solid white;
        border-left: 1px solid white;
        cursor: pointer;
    }

    .item:last-child .artist_container {
        border-right: 1px solid white;
    }

    .item:nth-child(5) .artist_container,
    .item:nth-child(6) .artist_container,
    .item:nth-child(7) .artist_container,
    .item:nth-child(8) .artist_container {
        border-top: 0;
    }

    .item:nth-child(1) .artist_container,
    .item:nth-child(2) .artist_container,
    .item:nth-child(3) .artist_container,
    .item:nth-child(4) .artist_container {
        border-bottom: 1px solid white;
        border-top: 0;
    }

    .item .artist_container .artist_box {
        flex: auto;
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        /* border-top: 1px solid white; */
    }

    .item .artist_container .artist_song, .item .artist_container .artist_name {
        background: red;
        display: flex;
        flex-direction: row;
        justify-content: space-between;
        align-items: center;
        color: white;
        padding: 4pt 18pt;
        text-transform: uppercase;
        font-size: calc(0.75em + .5vmin);
        font-weight: bold;
    }

    /**
     * If you happened to change something in here,
     * and expect to change every single the box titles thingy,
     * please apply the same change to all boxes in
     * artist, conversation, and streamer folder.
     * 
     * But if you are a Vue JS developer (unlike me that only had a few knowledges about Frontend thingy)
     * make sure to put these CSS code in seperated files since CSS contents are practically same.
     * 
     *      (
     *       \
     *       )
     *   ##-------->
     *       )
     *       /
     *      (
     *
     *
     * Let's leave this ancient BOW as a tribute to
     * the legacy who leave Shotgun Surgery problem in this project.
     */
    .item .artist_container .artist_name .artist_name_title {
        font-family: Soulmaze;
        font-size: calc(0.5em + 5vmin);
        color: red;
        /* -webkit-text-stroke-color: black;
        -webkit-text-stroke-width: .1pt; */
        line-height: 1;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        font-style: italic !important;
    }


    .item .artist_container .artist_name {
        border-top: 1px solid white;
    }

    .item .artist_container .artist_song {
        border-top: 1px solid white;
        /* border-bottom: 1px solid white; */
    }

    @supports (-webkit-text-stroke: 1px orange){
        .item .artist_container .artist_name .artist_name_title{
            -webkit-text-stroke: 1px orange;
            -webkit-text-fill-color: red;
        }
    }

    @media only screen and (min-width: 768px) {

        .item {
            height: 50%;
        }

        .item .artist_container .artist_song .artist_song_title {
            font-size: 11pt;
        }

        .item .artist_container .artist_song .artist_song_duration {
            font-size: 10pt;
        }

        .item .artist_container .artist_name .artist_name_title {
            font-size: calc(0.5em + 3vmin);
        }
    }

</style>
