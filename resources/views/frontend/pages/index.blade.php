@extends('frontend.layouts.app')

@section('style')

    <style>



        /* _::-webkit-full-page-media, _:future, :root .content-container{
            flex: 10;
            max-height: 100%;
        } */

        .slide-left-enter-active,
        .slide-left-leave-active,
        .slide-right-enter-active,
        .slide-right-leave-active {
            transition-duration: 0.5s;
            transition-property: height, opacity, transform;
            transition-timing-function: cubic-bezier(0.55, 0, 0.1, 1);
            overflow: hidden;
        }

        .slide-left-enter,
        .slide-right-leave-active {
            opacity: 0;
            transform: translate(2em, 0);
        }

        .slide-left-leave-active,
        .slide-right-enter {
            opacity: 0;
            transform: translate(-2em, 0);
        }
    </style>

@endsection

@section('content')

    <div class="content-container" style="background-image: url('{{ url('assets/bg_cloud_anim.gif') }}');">
        <transition name="slide" mode="out-in">
            <router-view></router-view>
        </transition>
    </div>

@endsection
