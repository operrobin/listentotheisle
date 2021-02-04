<template>
    <div class="header-main-container">

        <div class="header" style="border: 1px solid white;">
            <div class="d-flex flex-row h-100">
                <div class=" header-gif">
                    <img src="assets/isle.gif" @click="goToHome()"/>
                </div>
                <div class=" header-text-container" style="border-left: 1px solid white;">
                    <div class="d-table h-100">
                        <div class="d-table-cell h-100 align-middle">
                            <marquee-text :duration="10" :repeat="10" class="header-text"> WATCH LISTEN DANCE &nbsp; </marquee-text>
                        </div>
                    </div>
                </div>
                <div class="header-menu" style="border-left: 1px solid white;">
                    <img src="assets/menu.png" @click="toggleMenu"/>
                </div>
            </div>
        </div>

        <div class="header-floating" :class="{'open': openHeader}" :style="renderImage('assets/bg_cloud.jpg')">

            <div class="row no-gutters menu-button">

                <div class="col-12 col-sm-12 mixes align-self-center">
                    <!-- <img src="assets/mix_to_tape_new.png" @click="goTo('mixtape')"/> -->
                    <div class="running-menu" @click="goTo('conversation')">
                        <marquee-text :duration="5" :repeat="30">
                            <div class="spanContainer">
                                <span class="small">Isle</span> <span class="bigger">Talks</span>
                            </div>
                        </marquee-text>
                    </div>
                </div>

                <div class="col-12 col-sm-12 comunity align-self-center">
                    <!-- <img src="assets/come_unity_new.png" @click="goTo('comunity')"/> -->
                    <div class="running-menu" @click="goTo('mixtape')">
                        <marquee-text :duration="5" :repeat="30" :reverse="true">
                            <div class="spanContainer">
                                <span class="small">Isle</span> <span class="bigger">Mixes</span>
                            </div>
                        </marquee-text>
                    </div>
                </div>

                <div class="col-12 col-sm-12 conversations align-self-center">
                    <!-- <img src="assets/conversation_new.png" @click="goTo('conversation')"/> -->
                    <div class="running-menu" @click="goTo('listhead')">
                        <marquee-text :duration="5" :repeat="30">
                            <div class="spanContainer">
                                <span class="small">Isle</span> <span class="bigger">Special</span>
                            </div>
                        </marquee-text>
                    </div>
                </div>

                <div class="col-12 col-sm-12 list-head align-self-center" >
                    <div class="running-menu" @click="goTo('comunity')">
                        <marquee-text :duration="5" :repeat="30" :reverse="true">
                            <div class="spanContainer">
                                <span class="small">Isle</span> <span class="bigger">Folks</span>
                            </div>
                        </marquee-text>
                    </div>
                    <!-- <img src="assets/list_inside_in_my_head_new.png" @click="goTo('listhead')"/> -->
                </div>

            </div>

        </div>
    </div>
</template>

<script>

import RunningText from '../Helper/RunningText';

export default {
    name: "HeaderComponent",
    data() {
        return {
            openHeader: false
        }
    },
    components: {
        RunningText
    },
    methods: {
        renderImage(url) {
            return 'background-image:url("' + url + '")';
        },
        toggleMenu() {
            this.openHeader = !this.openHeader;
        },
        goToHome() {
            this.$router.push('/');
        },
        goTo(to) {
            this.$router.push(to);
            this.openHeader = false;
        }
    }
}
</script>

<style scoped>

    .header-main-container {
        height: 12vh;
    }

    .running-menu {
        font-family: Soulmaze, sans-serif;
        font-size: 28pt;
        color: red;
        font-weight: bold;
        cursor: pointer;
    }

    .running-menu:hover {
        color: transparent;
        -webkit-text-stroke-color: red;
        -webkit-text-stroke-width: .4pt;
    }

    .running-menu .spanContainer {
        margin:0 1em;
    }

    .running-menu .small {
        float: left;
        -webkit-text-stroke-width: 1pt;
        text-transform: uppercase;
    }

    .running-menu .bigger {
        font-size: 72pt;
        line-height: .9;
        margin-left: 3pt;
        text-transform: uppercase;
    }

    .border-white {
        border: 1px solid white;
    }
    .header {
        background-color: #E91C00;
        /* height: 12vh; */
        /* flex: 1; */
        z-index: 100;
        position: relative;
        /*border: 1px solid #F00;*/
    }

    .header .header-menu {
        width: 25vw;
        position: relative;
    }

    .header .header-gif {
        position: relative;
        overflow: hidden;
        width: 25vw;
        cursor: pointer;
    }

    .header .header-menu img {
        width: 80%;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }

    .header .header-gif img {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 180%;
    }

    .header .header-text-container {
        position: relative;
        overflow: hidden;
        width: 50vw;
    }

    .header-text-wrapper {
        position: absolute;
        top: 25%;
        transform: translate(-50%, -50%);
    }

    .header-text {
        font-family: NeueBit, sans-serif;
        font-size: 42pt;
        height: 40pt;
        font-weight: bold;
        line-height: 1;
        -webkit-text-stroke-color: white;
        -webkit-text-stroke-width: .4pt;
    }

    .header-floating {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: red;
        z-index: 11;
        transform: translate(0, -100%);
        transition: transform .5s;
    }

    .header-floating.open {
        transform: translateY(0%);
        background-position: center;
        background-size: cover;
        background-repeat: no-repeat;
    }

    .header-floating .menu-button img {
        width: 50%;
        margin: 0 auto;
    }

    .header-floating .menu-button .list-head img {
        width: 40%;
        margin: 0 auto;
    }

    .header-floating .menu-button .conversations img {
        width: 60%;
        margin: 0 auto;
    }

    .header-floating .menu-button {
        position:absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 100%;
        height: 80%;
    }

    .header-floating .menu-button .col-12 {
        text-align: center;
    }

    @media only screen and (min-width: 768px) {

        .header-main-container {
            height: 8vh;
        }

        .running-menu {
            font-size: 32pt;
        }

        .running-menu .bigger {
            font-size:92pt;
        }


        .header .header-gif {
            width: 10vw;
        }

        .header .header-gif img {
            width: 100%;
        }

        .header .header-menu {
            width: 12vw;
            text-align:center;
        }

        .header .header-menu img {
            width: 80%;
            /*margin: 0 auto;*/
            /*position: relative;*/
            /*transform: none;*/
            /*top:initial;*/
            /*left: initial;*/
        }

        .header .header-text-container {
            width: 78vw;
        }

        .header-text {
            font-family: NeueBit, sans-serif;
            font-size: 41pt;
            height: 32pt;
            font-weight: bold;
            line-height: 1;
            -webkit-text-stroke-color: white;
            -webkit-text-stroke-width: .6pt;
        }

        .header-floating .menu-button .comunity img {
            width: 65%;
            margin: 0 auto;
        }

    }
</style>
