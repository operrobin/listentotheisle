<template>
    <div class="detail-container h-100">
        <div class="render" :style="renderBackground(detail.thumbnail_url)">
            <div class="parallax-container">
                <div class="parallax-wrapper">
                    <div class="parallax-image" :style="renderBackground(detail.thumbnail_url)">
                    </div>
                </div>
            </div>

            <div class="artist_info">
                <div class="rank">
                    {{ detail.rank }}
                </div>
                <h3 class="artist_name">{{ detail.artist_name }}</h3>
                <p class="artist_detail">{{ detail.short_description }}</p>
            </div>
        </div>


        <div class="render h-100" :style="renderBackground(getFirstImage())">

            <div class="parallax-container">
                <div class="parallax-wrapper">
                    <div class="parallax-image" :style="renderBackground(getFirstImage())">
                    </div>
                </div>
            </div>


            <div class="interview_info">
                <div class="interview_by">
                    <div>INTERVIEW</div>
                    <div style="margin-top:-0px;">
                        {{ detail.interview_by }}
                    </div>
                </div>
                <div class="photography_by">
                    <div>PHOTOGRAPHY</div>
                    <div style="margin-top:-0px;">
                        {{ detail.photography_by }}
                    </div>
                </div>
            </div>

            <div class="interview_detail">

                {{ detail.long_description }}
            </div>

        </div>

        <div class="render h-100" v-for="(item, index) in splitInterviews" :key="index" :style="renderBackground(getImage(index + 1))">

            <div class="parallax-container">
                <div class="parallax-wrapper">
                    <div class="parallax-image" :style="renderBackground(getImage(index + 1))">
                    </div>
                </div>
            </div>


            <div class="centering-qa">
                <div class="question">
                    Q: {{ item[0].question }}
                </div>
                <div class="answer">
                    A: {{ item[0].answer }}
                </div>
                <br>
                <br>
                <div v-if="item[1] != null">
                    <div class="question">
                        Q: {{ item[1].question }}
                    </div>
                    <div class="answer">
                        A: {{ item[1].answer }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

import * as getters from '../Store/getters-type'
import {mapGetters} from "vuex";
import * as actions from "../Store/actions-types";

export default {
    name: "ConversationDetailComponent",
    computed: {
        ...mapGetters({
           detail: getters.GET_CONVERSATION_DETAIl
        }),
        splitInterviews() {
            let result = [];
            for (var i = 0; i < this.detail.interviews.length; i += 2) result.push(this.detail.interviews.slice(i, i + 2));
            return result;
        }
    },
    methods: {
        renderBackground(url) {
          return 'background-image:url("' + url + '")';
        },
        getImage(index) {
            if (this.detail.landscape_url[index] != null) {
                return this.detail.landscape_url[index];
            }

            let i = index % (this.detail.landscape_url.length - 1);

            return this.detail.landscape_url[i];
        },
        getFirstImage() {
            return this.getImage(0);
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
    .render {
        background-attachment: fixed;
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
        position: relative;
        height: 100%;
    }

    .parallax-container {
        display:none;
    }

    @supports (-webkit-touch-callout: none) {

        .render {
            background: none;
        }

        .parallax-container {
            display: block;
            width: 100%;
            height: 100%;
            position:relative;
            z-index: 2;
        }

        .parallax-wrapper {
            clip: rect(0, auto, auto, 0);
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 2;
        }

        .parallax-image {
            position: fixed;
            display: block;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            transform: translateZ(0);
            will-change: transform;
            z-index: 1;
            /* background-attachment:scroll; */
            background-position: center center;
            background-repeat: no-repeat;
            background-size: cover;

        }
    }



    .render .artist_info {
        position: absolute;
        top: 50%;
        width: 80%;
        left: 50%;
        transform: translate(-50%, -50%);
        text-align: center;
        z-index: 2;
    }

    .render .artist_info .artist_name {
        font-family: Soulmaze, sans-serif;
        color: orange;
        font-size: 32pt;
        line-height: 1;
    }

    .render .artist_info .artist_detail {
        font-family: 'Nunito', sans-serif;
        color: red;
        font-weight: 400;
        text-transform: uppercase;
        font-size: 12pt;
        line-height: 1;
    }

    .render .artist_info .rank {
        font-weight: bold;
        font-family: Soulmaze, sans-serif;
        font-size: 13pt;
        color: red;
        text-transform: uppercase;
        line-height: 24pt;
    }

    .render .interview_info {
        font-family: sans-serif;
        /* margin-top: 1em; */
        padding-top: 1em;
        position: absolute;
        line-height: .8;
        top: 0%;
        width: 80%;
        left: 50%;
        transform: translateX(-50%);
        text-align: center;
        display: flex;
        flex-direction: row;
        justify-content: space-between;
        z-index: 2;
    }

    .render .interview_info * {
        color: red;
        text-transform: uppercase;
        font-size: 10pt;
        font-weight: 400;
        font-family: sans-serif;
    }

    .render .interview_detail {
        position: absolute;
        top: 50%;
        width: 80%;
        left: 50%;
        transform: translate(-50%, -50%);
        text-align: justify;
        color: black;
        text-shadow: 0px 0px 1px white;
        font-family: sans-serif;
        font-weight: 400;
        text-transform: uppercase;
        font-size: 12pt;
        z-index: 2;
    }

    .render .centering-qa {
        position: absolute;
        top: 50%;
        width: 80%;
        left: 50%;
        transform: translate(-50%, -50%);
        text-align: justify;
        z-index: 2;
    }

    .render .centering-qa * {
        font-family: sans-serif;
        font-weight: bold;
        text-transform: uppercase;
        font-size: 10pt;
    }

    .render .centering-qa .question {
        color: white;
    }

    .render .centering-qa .answer {
        color: red;
    }

    @media only screen and (min-width: 768px) {
        .render .artist_info {
            text-align: left;
        }

        .render .artist_info .rank {
            font-weight: bold;
            font-family: sans-serif;
            font-size: 30pt;
            color: red;
            margin-top: .6em;
            margin-bottom: .8em;
        }

        .render .artist_info .artist_name {
            font-family: Soulmaze, sans-serif;
            color: orange;
            font-size: 72pt;
            line-height: 1;
        }

        .render .artist_info .artist_detail {
            font-weight: bold;
            font-family: sans-serif;
            font-size: 30pt;
            color: red;
            margin-top: .8em;
        }

        .render .interview_info {
            padding-top: 3em;
            margin-left: 4em;
            position: static;
            width: 50%;
            transform: none;
            display: flex;
            flex-direction: row;
            justify-content: space-between;
        }

        .render .interview_info * {
            color: red;
            text-transform: uppercase;
            font-size: 15pt;
            line-height: 1.2;
            font-weight: bolder;
            text-align: left;
        }

        .render .interview_detail {
            position: static;
            width: 50%;
            font-size: 15pt;
            font-weight: bold;
            /* color: white; */
            transform: none;
            margin-top: 2em;
            margin-left: 4em;
        }

        .render .centering-qa * {
            font-family: sans-serif;
            font-weight: bold;
            text-transform: uppercase;
            font-size: 15pt;
        }
    }

</style>
