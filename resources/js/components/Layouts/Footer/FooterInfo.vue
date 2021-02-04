<template>
    <div class="height-100">
        <div class="row no-gutters height-100 info-1 ">
            <div class="col-8 align-self-center text-covid">
                <marquee-text :duration="15" :repeat="10">COVID-19 HAS IMPACTED THE CREATIVE COMMUNITY AROUND THE WORLD &nbsp;</marquee-text>
            </div>

            <div class="col-4 text-center info-2 d-sm-none" style="border-left: 1px solid white;">
                <div>DEVELOPED BY</div>
                <div>KUASA WORLD</div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "FooterInfo"
}
</script>

<style scoped>

    .info-1 {
        background-color: red;
        color: orange;
        font-weight: normal;
        font-size: 20pt;
        line-height: 1;
    }

    .text-covid {
        font-family: NeueBit, sans-serif;
    }

    .info-2 {
        font-weight: bold;
        background-color: black;
        line-height: 1;
        color: red;
        padding: .5em 0;
    }

    .info-2 div:first-child {
        font-size:7.5pt;
        -webkit-text-stroke-color: white;
        -webkit-text-stroke-width: .2pt;
    }

    .info-2 div:last-child {
        font-size:7pt;
        -webkit-text-stroke-color: white;
        -webkit-text-stroke-width: .2pt;
    }

    @media only screen and (min-width: 768px) {
        .height-100 {
            height: 100%;
        }

        .info-1 {
            font-size: 21pt;
            border-top: 1px solid white;
            border-bottom: 1px solid white;
        }
    }
</style>
