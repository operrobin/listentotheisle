<template>
    <marquee-text :duration="duration" :repeat="repeat"> {{ text }} &nbsp; / &nbsp; </marquee-text>
</template>

<script>

import * as actions from '../Store/actions-types'
import * as getters from '../Store/getters-type'
import {mapActions, mapGetters} from "vuex";

export default {
    name: "RunningText",
    props: {
        slug: String,
        fallback: String
    },
    data() {
        return {
            duration: 5,
            repeat: 50,
        }
    },
    computed: {
        ...mapGetters({
           word: getters.GET_WORD
        }),
        text() {
            let word = this.word;

            if (word[this.slug] != null) {
                return word[this.slug];
            }

            return this.fallback;
        }
    },
    methods: {
        ...mapActions({
            getWord: actions.WORD_SET
        })
    },
    mounted() {
        this.getWord({
            slug: this.slug,
            fallback: this.fallback
        });
    }
}
</script>

<style scoped>

    .marquee-text-text {
        text-transform: uppercase;
        font-family: NeueBit, sans-serif;
        font-size: 16pt;
        margin-top: 5px;
        line-height: 1;
    }
</style>
