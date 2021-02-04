<template>

    <div class="artist-item">

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



    </div>

</template>

<script>

    export default {
        name: "ArtistBoxFlexible",
        props: {
            artistData: Object
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

    .artist-item .artist_container {
        display: flex;
        flex-direction: column;
        border-top: 1px solid white;
        border-left: 1px solid white;
        cursor: pointer;
    }

    .artist-item:last-child .artist_container {
        border-right: 1px solid white;
    }

    .artist-item:nth-child(5) .artist_container,
    .artist-item:nth-child(6) .artist_container,
    .artist-item:nth-child(7) .artist_container,
    .artist-item:nth-child(8) .artist_container {
        border-top: 0;
    }

    .artist-item:nth-child(1) .artist_container,
    .artist-item:nth-child(2) .artist_container,
    .artist-item:nth-child(3) .artist_container,
    .artist-item:nth-child(4) .artist_container {
        border-bottom: 0;
        border-top: 0;
    }

    .artist-item .artist_container .artist_box {
        flex: 9;
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        /* border-top: 1px solid white; */
    }

    .artist-item .artist_container .artist_song, .artist-item .artist_container .artist_name {
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

    .artist-item .artist_container .artist_name .artist_name_title {
        font-family: Soulmaze, sans-serif;
        font-size: calc(0.5em + 5vmin);
        color: orange;
        /*-webkit-text-stroke-color: black;*/
        /*-webkit-text-stroke-width: .1pt;*/
        line-height: 1;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }


    .artist-item .artist_container .artist_name {
        border-top: 1px solid white;
        flex: 1;
    }

    .artist-item .artist_container .artist_song {
        border-top: 1px solid white;
        flex: 1;
    }

    @media only screen and (min-width: 768px) {
        .artist-item .artist_container .artist_song .artist_song_title {
            font-size: 11pt;
        }

        .artist-item .artist_container .artist_song .artist_song_duration {
            font-size: 10pt;
        }

        .artist-item .artist_container .artist_name .artist_name_title {
            font-size: 14pt;
        }
    }

</style>
