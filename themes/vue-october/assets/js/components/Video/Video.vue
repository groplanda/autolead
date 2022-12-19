<template lang="pug">
  section.video(:style="{'background-image': `url(${video})`}")
    ._container.container
      ._content
        ._title {{title}}
        button._button(type="button" @click="openModal")
          <svg viewBox="0 0 22 28" class="video__button-ico icon-play ">
            <path d="M0 0V28L22 14L0 0Z" fill="currentColor"></path>
          </svg>
      Popup(className="popup__dialog_video" v-if="popup" @close="closeModal" :fullscreen="fullscreen" :orientation="currentVideo.orientation")
        ._wrap(:class="classVideo")
          video(v-if="!loading" :src="'/storage/app/media/' + currentVideo.video" data-video="main" autoplay @click="stopVideo" @ended="changeVideo('next')")._box
          ._loading(v-else)
            ._lds-ripple.lds-ripple
              ._lds-waves.lds-waves
              ._lds-waves.lds-waves
          ._progress(@click="setTime($event)")
             span._percent(data-video="time")

          button._button.-stop(type="button" @click.stop="playVideo" v-if="stop")
            <svg viewBox="0 0 22 28" class="video__button-ico icon-play ">
                <path d="M0 0V28L22 14L0 0Z" fill="currentColor"></path>
            </svg>

          ._controls
            button._controls-btn.-prev(type="button" @click="changeVideo('prev')")
              <svg viewBox="0 0 20 20" class="video__controls-ico icon-next-video ">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M10 0C4.48 0 0 4.48 0 10C0 15.52 4.48 20 10 20C15.52 20 20 15.52 20 10C20 4.48 15.52 0 10 0ZM8 14.5L14 10L8 5.5V14.5ZM2 10C2 14.41 5.59 18 10 18C14.41 18 18 14.41 18 10C18 5.59 14.41 2 10 2C5.59 2 2 5.59 2 10Z" fill="currentColor"></path>
              </svg>

            button._controls-btn.-next(type="button" @click="changeVideo('next')")
              <svg class="video__controls-ico" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M10 0C4.48 0 0 4.48 0 10C0 15.52 4.48 20 10 20C15.52 20 20 15.52 20 10C20 4.48 15.52 0 10 0ZM8 14.5L14 10L8 5.5V14.5ZM2 10C2 14.41 5.59 18 10 18C14.41 18 18 14.41 18 10C18 5.59 14.41 2 10 2C5.59 2 2 5.59 2 10Z" fill="currentColor"/>
              </svg>

            button._controls-btn.-open(type="button" @click="fullscreen = true" v-if="!fullscreen")
              <svg viewBox="0 0 14 14" class="video__controls-ico icon-fullscreen_open ">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M2 5H0V0H5V2H2V5ZM0 9H2V12H5V14H0V9ZM12 12H9V14H14V9H12V12ZM9 2V0H14V5H12V2H9Z" fill="currentColor"></path>
              </svg>

            button._controls-btn.-exit(type="button" @click="fullscreen = false" v-else)
              <svg viewBox="0 0 14 14" class="video__controls-ico icon-fullscreen_exit ">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M0 3H3V0H5V5H0V3ZM3 11H0V9H5V14H3V11ZM9 14H11V11H14V9H9V14ZM11 0V3H14V5H9V0H11Z" fill="currentColor"></path>
              </svg>

</template>
<script>

import Popup from "@vue/components/Popup/Popup";
import axios from "axios";

export default {
  name: 'Video',
  components: {
    Popup
  },
  props: {
    video: {
        type: String,
        default: ''
    },
    title: {
        type: String,
        default: ''
    }
  },
  data() {
    return {
      popup: false,
      stop: false,
      fullscreen: false,
      videos: [],
      videoIndex: 0,
      loading: false
    }
  },
  computed: {
    classVideo() {
      return {
        'video__wrap_stop': this.stop,
        'video__wrap_full': this.fullscreen
      }
    },
    currentVideo() {
      let index = this.videoIndex;
      if(this.videoIndex > this.videos.length - 1) {
        index = 0;
        this.updateVideoIndex(index);
      } else if (this.videoIndex < 0) {
        index = this.videos.length - 1;
        this.updateVideoIndex(index);
      }
      return this.videos[index];
    }
  },
  methods: {
    openModal () {
      this.popup = true;
      setTimeout(() => this.setVideo());
    },
    closeModal () {
      this.popup = false;
      this.fullscreen= false;
      this.stop = false;
    },
    setVideo () {
      const video = document.querySelector('[data-video="main"]');
      video.addEventListener('timeupdate', this.updateVideo);
    },
    updateVideo(e) {
      const time_box = document.querySelector('[data-video="time"]');
      const percent = e.target.currentTime / e.target.duration * 100;
      if (percent && time_box) {
        time_box.style.width = percent + '%';
      }
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
    },
    changeVideo(dir) {
      if(dir === 'next') {
        this.videoIndex = this.videoIndex + 1;
      } else {
        this.videoIndex = this.videoIndex - 1;
      }

      this.loading = true;

      const video = document.querySelector('[data-video="main"]');
      video.removeEventListener("timeupdate", this.updateVideo);
      video.pause();
      video.muted = true;
      setTimeout(() => {
        this.loading = false;
        setTimeout(() => this.setVideo())
      }, 1500)
    },
    updateVideoIndex(val) {
       this.videoIndex = val;
    }
  },
  created() {
    this.loading = true;
    axios.get("/api/videos")
      .then(response => {
        this.videos = response.data;
        this.loading = false;
      })
      .catch(e => {
        console.log(e);
      })
  }
}
</script>
