<template>
    <div class="fullpage-container">
        <div class="fullpage-wp" v-fullpage="opts" ref="example">
            <div class="section page">

                <VueSlickCarousel class="carousel-container-all" :arrows="true" :dots="false" :slidesPerRow="1">
                    <div class="h-100" v-for="item in homeList.all" :key="item.id">
                        <div class="artist_card"  :style="fluidBackground(item)">
                            <div class="text-container">

                                <div class="rank">
                                    {{ item.rank }}
                                </div>
                                <div class="title">
                                    {{ item.artist_name }}
                                </div>

                                <div class="description">
                                    {{ item.artist_description }}
                                </div>


                                <button class="btn btn-primary btn-enter" @click="setDetail(item)">
                                    ENTER
                                </button>

                            </div>
                        </div>
                    </div>


                    <template #prevArrow>
                        <div class="custom-arrow prev">
                            <img src="assets/arrow_left.png"/>
                        </div>
                    </template>

                    <template #nextArrow>
                        <div class="custom-arrow next">
                            <img src="assets/arrow_right.png"/>
                        </div>
                    </template>
                </VueSlickCarousel>

            </div>
            <div class="section page section-second h-100">

                <div class="mixtape-container">
                    <div class="mixtape-bar" style="border-top:0;">
                        <div class="d-table h-100">
                            <div class="d-table-cell h-100 align-middle">
                                <running-text class="my-auto" :slug="'mixtape'" :fallback="'MIX TO TAPE'"></running-text>
                            </div>
                        </div>
                    </div>

                    <div class="carousel-container">
                        <!-- <div class="row">
                            <youtube-box-flexible :artist-data="item" v-for="item in homeList.head" :key="item.id" @clicked="setListHeadDetail"></youtube-box-flexible>
                        </div> -->
                        <VueSlickCarousel :arrows="true" :dots="false" :slidesPerRow="getItemSize">
                            <artist-box-flexible :artist-data="item" v-for="item in homeList.mix" :key="item.id" @clicked="setMixTapeDetail"></artist-box-flexible>


                            <template #prevArrow>
                                <div class="custom-arrow prev">
                                    <img src="assets/arrow_left.png"/>
                                </div>
                            </template>

                            <template #nextArrow>
                                <div class="custom-arrow next">
                                    <img src="assets/arrow_right.png"/>
                                </div>
                            </template>

                        </VueSlickCarousel>

                        <!-- <carousel :items="getItemSize" :nav="false" :dots="false">
                            <artist-box-flexible :artist-data="item" v-for="item in homeList.mix" :key="item.id" @clicked="setMixTapeDetail"></artist-box-flexible>
                        </carousel> -->
                    </div>
                </div>

                <div class="listhead-container">
                    <div class="mixtape-bar">
                        <div class="d-table h-100">
                            <div class="d-table-cell h-100 align-middle">
                                <running-text :slug="'list_head'" :fallback="'LIST IN MY HEAD'"></running-text>
                            </div>
                        </div>
                    </div>

                    <div class="carousel-container">
                        <!-- <div class="row">
                            <youtube-box-flexible :artist-data="item" v-for="item in homeList.head" :key="item.id" @clicked="setListHeadDetail"></youtube-box-flexible>
                        </div> -->
                        <!-- <carousel :items="getItemSize" :nav="false" :dots="false"> -->
                        <VueSlickCarousel :arrows="true" :dots="false" :slidesPerRow="getItemSize">
                            <youtube-box-flexible :artist-data="item" v-for="item in homeList.head" :key="item.id" @clicked="setListHeadDetail"></youtube-box-flexible>

                            <template #prevArrow>
                                <div class="custom-arrow prev">
                                    <img src="assets/arrow_left.png"/>
                                </div>
                            </template>

                            <template #nextArrow>
                                <div class="custom-arrow next">
                                    <img src="assets/arrow_right.png"/>
                                </div>
                            </template>
                        </VueSlickCarousel>
                        <!-- </carousel> -->
                    </div>
                </div>

            </div>

            <div class="section page">

                <VueSlickCarousel class="carousel-container-all" :arrows="true" :dots="false" :slidesPerRow="1">
                    <div class="h-100" v-for="item in homeList.conversation" :key="item.id">
                        <div class="artist_card"  :style="classBackground(item.thumbnail_url)">
                            <div class="text-container">

                                <div class="rank">
                                    {{ item.rank }}
                                </div>
                                <div class="title">
                                    {{ item.artist_name }}
                                </div>

                                <div class="description">
                                    {{ item.short_description }}
                                </div>


                                <button class="btn btn-primary btn-enter" @click="setConversation(item)">
                                    ENTER
                                </button>

                            </div>
                        </div>
                    </div>
                </VueSlickCarousel>

            </div>
        </div>
    </div>
</template>

<script>

import carousel from 'vue-owl-carousel2';
import * as actions from '../Store/actions-types'
import * as getters from '../Store/getters-type'
import {mapActions, mapGetters} from "vuex";
import { isMobile } from 'mobile-device-detect';
import RunningText from "../Helper/RunningText";
import ArtistBoxFlexible from "./artist/ArtistBoxFlexible";
import YoutubeBoxFlexible from "./artist/YoutubeBoxFlexible";


export default {

    name: "HomeComponent",
    data() {
        return {
            secondCarouselOptions: {
                0:{
                    items:1,
                    nav:false
                },
                768:{
                    items:4,
                    nav:true
                }
            },
            opts: {
                start: 0,
                dir: 'v',
                duration: 500,
                beforeChange: function (currentSlideEl,currenIndex,nextIndex) {
                },
                afterChange: function (currentSlideEl,currenIndex) {
                }
            }
        }
    },
    components: {
        carousel,
        RunningText,
        ArtistBoxFlexible,
        YoutubeBoxFlexible
    },
    computed: {
      ...mapGetters({
          homeList: getters.GET_HOME_LIST
      }),
        getItemSize() {
          if (isMobile) {
              return 1;
          }

          return 4;
        }
    },
    methods: {
        ...mapActions({
            getHomeList: actions.HOME_LIST,
            setDetail: actions.HOME_DETAIL_SET,
            setConversation: actions.CONVERSATION_DETAIL
        }),
        setMixTapeDetail(item) {
          console.log(item);
        },
        setListHeadDetail(item) {
            console.log(item);
        },
        classBackground(url) {
          return 'background-image: url("' + url + '")';
        },
        fluidBackground(item) {
            if (isMobile) {
                return this.classBackground(item.portrait_url);
            }

            return this.classBackground(item.landscape_url);
        }
    },
    mounted() {

        this.getHomeList();

    }
}
</script>

<style scoped>

    .btn-enter {
        font-family: Cow90, sans-serif;
        border: 1px solid white;
        background: orange;
        padding: 8pt;
        border-radius: 0pt;
        text-align: center;
        margin-top: 2em;
        font-size: 22pt;
        color: red;
    }


    .fullpage-container {
        /* height: 75vh !important; */
        height: auto;
    }

    .fullpage-container .section {
        height: auto;
    }

    .carousel-container-all {
        height: 100%;
    }

    .carousel-container-all .artist_card {
        height: 100%;
        background-size: cover;
        background-position: center center;
        background-repeat: no-repeat;
        position: relative;
    }

    .carousel-container-all .artist_card .text-container {
        position: absolute;
        top: 50%;
        left: 50%;
        width: 80%;
        transform: translate(-50%, -50%);
        text-align: center;
    }

    .carousel-container-all .artist_card .title {
        font-weight: bold;
        font-family: Soulmaze, sans-serif;
        font-size: 24pt;
        color: orange;
        line-height: 32pt;
        margin-bottom: 10pt;
        margin-top: 1em;
    }

    .carousel-container-all .artist_card .description {
        font-weight: bold;
        font-family: Soulmaze, sans-serif;
        font-size: 12pt;
        color: red;
        /* -webkit-text-stroke-color: black;
        -webkit-text-stroke-width: .2pt; */
        line-height: 24pt;
    }

    .carousel-container-all .artist_card .rank {
        font-weight: bold;
        font-family: Soulmaze, sans-serif;
        font-size: 13pt;
        color: red;
        text-transform: uppercase;
        line-height: 24pt;
    }

    .section-second {
        /* display: flex;
        flex-direction: column; */
        height: 100%;
        max-height: 100%;
        /*background: red;*/
    }

    .section-second .mixtape-container {
        height: 50%;
        max-height: 50%;
        box-sizing: border-box;
        /* display: flex;
        flex-direction: column; */
    }

    .section-second .listhead-container {
        height: 50%;
        max-height: 50%;
    }

    .custom-arrow {
        position: absolute;
        width: 15pt;
        color: white;
        z-index: 100;
        transform: translateY(-50%);
        opacity: 0.9;
    }

    .custom-arrow img {
        width: 100%;
    }

    .custom-arrow.prev {
        top: 50%;
        left: 5%;
    }

    .custom-arrow.next {
        top: 50%;
        right: 5%;
    }

    .section-second .mixtape-bar {
        color: red;
        background-color: #FFA51D;
        border-bottom: 1px solid white;
        border-top: 1px solid white;
        /* flex: 1; */
        height: 12%;
    }

    .section-second .carousel-container {
        flex: auto;
        /* height: 100%; */
        min-height: 0;
        min-width: 0;
        /*background-color: red;*/
        height: 88%;
    }


    .section-second .carousel-container .carousel-container-slide {
        height: 100%;
        border: 1px solid #F00;
    }

    .section-second .carousel-container .carousel-container-slide .artisbox-carousel {
        height: 100%;
        background-size: cover;
        background-position: center center;
        background-repeat: no-repeat;
        position: relative;
    }

    .section-second .carousel-container .carousel-container-slide .artis_card_box div {
        height: 100%;
        border: 1px solid #0FF;
    }

    @media screen and (-webkit-min-device-pixel-ratio:0) {

        .wrapper-webkit {
            padding-bottom: 20pt;
        }

    }

    @media only screen and (min-width: 768px) {
         .carousel-container-all .artist_card .text-container {
            text-align: left;
            top: 45%;
        }

        .custom-arrow {
            position: absolute;
            width: 25pt;
            color: white;
            z-index: 100;
            transform: translateY(-50%);
            opacity: 0.9;
        }

        .custom-arrow img {
            width: 100%;
        }

        .custom-arrow.prev {
            top: 50%;
            left: 3%;
        }

        .custom-arrow.next {
            top: 50%;
            right: 3%;
        }

        .carousel-container-all .artist_card .title {
            font-family: Soulmaze, sans-serif;
            font-size: 72pt;
            line-height: 42pt;
            margin-top: .1em;
        }

        .carousel-container-all .artist_card .description {
            font-weight: bold;
            font-family: sans-serif;
            font-size: 34pt;
            color: red;
            line-height: 1.2;
            margin-top: .8em;
            /* line-height: 32pt; */
        }

        .carousel-container-all .artist_card .rank {
            font-weight: bold;
            font-family: sans-serif;
            font-size: 30pt;
            color: red;
            margin-top: .6em;
            margin-bottom: .8em;
            /* line-height: 32pt; */
        }

        .btn-enter {
            padding: 6pt 16pt;
            font-size: 28pt;
            line-height: 1;
        }

        .btn-enter img{
            width: 82pt;
        }

        .section-second .mixtape-bar {
            height: 8%;
        }

        .section-second .carousel-container {
            height: 92%;
        }

    }

</style>
