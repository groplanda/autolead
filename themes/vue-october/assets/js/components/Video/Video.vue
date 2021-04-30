<template lang="pug">
  section.video
    ._container.container
      ._content
        h3._title Посмотрите видео работы нашего автосервиса!
        button._button(type="button" @click="openModal")
          icon(name="play" component="video")._button-ico
      Popup(className="popup__dialog_video" v-if="popup" @close="closeModal" :fullscreen="fullscreen")
        ._wrap(:class="classVideo")
          video(src="/themes/vue-october/assets/videos/video.mp4" data-video="main" autoplay @click="stopVideo")._box
          ._progress(@click="setTime($event)")
             span._percent(data-video="time")

          button._button.-stop(type="button" @click.stop="playVideo" v-if="stop")
            icon(name="play" component="video")._button-ico

          button._controls-btn.-open(type="button" @click="fullscreen = true" v-if="!fullscreen")
            icon(name="fullscreen_open" component="video")._controls-ico

          button._controls-btn.-exit(type="button" @click="fullscreen = false" v-else)
            icon(name="fullscreen_exit" component="video")._controls-ico

</template>
<script>

import Popup from '@vue/components/Popup/Popup.vue';

export default {
  name: 'Video',
  components: {
    Popup
  },
  data() {
    return {
      popup: false,
      stop: false,
      fullscreen: false,
    }
  },
  computed: {
    classVideo() {
      return {
        'video__wrap_stop': this.stop,
        'video__wrap_full': this.fullscreen
      }
    }
  },
  methods: {
    openModal () {
      this.popup = true;

      setTimeout(() => {
        this.setVideo();
      })
    },
    closeModal () {
      this.popup = false;
      this.fullscreen= false;
      this.stop = false;
    },
    setVideo () {
      const video = document.querySelector('[data-video="main"]'),
            time_box = document.querySelector('[data-video="time"]');

      video.addEventListener('timeupdate', function () {
        const percent = this.currentTime / this.duration * 100;
        if (percent) {
          time_box.style.width = percent + '%';
        }
      })
    },
    setTime (event) {
      const video = document.querySelector('[data-video="main"]');
      const pos = 100 * event.offsetX / video.offsetWidth;
      video.currentTime = video.duration / 100 * pos;

    },
    stopVideo () {
      const video = document.querySelector('[data-video="main"]');
      this.stop = true;
      video.pause();
    },
    playVideo () {
      const video = document.querySelector('[data-video="main"]');
      video.play();
      this.stop = false;
    }
  },
}
</script>
<style lang="scss">
@import '@/scss/vars.scss';

.video {
  min-height: 500px;
  display: flex;
  background-image: url(/themes/vue-october/assets/images/video.jpg);
  background-position: center;
  background-size: cover;
  position: relative;
  padding: 112px 0 0;

  $root: &;

  @media(max-width: 767px) {
    padding: 50px 0 80px;
    min-height: auto;
  }

  &::after {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: #000;
    opacity: .4;
  }

  &__box {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
  }

  &__content {
    max-width: 411px;
    margin-left: auto;
    position: relative;
    z-index: 1;
  }

  &__title {
    color: #FFF;
    margin-bottom: 31px;

    @media(max-width: 767px) {
      font-size: 30px;
      line-height: 36px;
    }

    @media(max-width: 479px) {
      font-size: 26px;
      line-height: 32px;
    }

    @media(max-width: 410px) {
      font-size: 24px;
      line-height: 30px;
    }

  }
  &__button {
    width: 86px;
    height: 86px;
    background: #FFF;
    border-radius: 999px;
    display: flex;
    align-items: center;
    justify-content: center;
    animation: pulse 3s linear infinite;
    margin-left: 27px;
    cursor: pointer;
    transition: background .3s ease;
    z-index: 3;

    &:hover, &:focus, &:active {
      background: #f1f1f1;
    }

    &_stop {
      position: absolute;
      margin: 0;
    }

    @media(max-width: 767px) {
      width: 70px;
      height: 70px;
    }

    @media(max-width: 479px) {
      width: 65px;
      height: 65px;
    }
  }

  &__button-ico {
    width: 22px;
    height: 28px;
    margin-left: 6px;
    color: $red-color;

    @media(max-width: 767px) {
      width: 20px;
      height: 26px;
      margin-left: 5px;
    }
    @media(max-width: 479px) {
      width: 16px;
      height: 22px;
      margin-left: 4px;
    }
  }

  &__wrap {
    width: 100%;
    position: relative;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all .3s ease;

    &_stop {
      &::before {
        content: '';
        position: absolute;
        top: 0;
        right: 0;
        bottom: 0;
        left: 0;
        z-index: 1;
        background: #000;
        opacity: .7;
        transition: opacity .2s ease;
      }
    }

    &_full {
      height: 100%;
      &::after {
        padding-top: 0;
      }
      #{$root} {
        &__box {
          @media screen and ( min-width: 1600px ) and ( min-height: 800px ) {
            object-fit: fill;
          }
        }
        &__progress {
          height: 8px;
        }
      }
    }

    &::after {
      content: '';
      display: block;
      padding-top: calc(100% / ( 16 / 9));
      transition: padding .2s ease;
    }
  }

  &__box {
    width: 100%;
    height: 100%;
    position: absolute;
    top: 0;
    left: 0;
    cursor: pointer;
  }

  &__progress {
    display: flex;
    position: absolute;
    width: 100%;
    height: 5px;
    bottom: 0;
    left: 0;
    background: $dark-color;
    cursor: pointer;
    z-index: 3;
    transition: height .3s ease;
  }

  &__percent {
    width: 0;
    height: 100%;
    top: 0;
    left: 0;
    position: absolute;
    background: $red-color;
  }

  &__controls-btn {
    width: 15px;
    height: 15px;
    position: absolute;
    right: 20px;
    bottom: 20px;
    z-index: 3;

    &_open {
      cursor: zoom-in;
    }
    &_exit {
      cursor: zoom-out;
    }

    &:hover, &:focus, &:active {
      color: #f1f1f1;
    }
  }

  &__controls-ico {
    width: 100%;
    height: 100%;
    color: #FFF;
  }
}
@keyframes pulse {
  0% {
    box-shadow: 0 0 0 0px rgba(#FFF, 0), 0 0 0 0px rgba(#FFF, 0);
  }
  40% {
    box-shadow: 0 0 0 15px rgba(#FFF, 0.2), 0 0 0 27px rgba(#FFF, 0.12);
  }
  80% {
    box-shadow: 0 0 0 15px rgba(#FFF, 0), 0 0 0 27px rgba(#FFF, 0);
  }
  100% {
    box-shadow: 0 0 0 0px rgba(#FFF, 0), 0 0 0 27px rgba(#FFF, 0);
  }
}
</style>