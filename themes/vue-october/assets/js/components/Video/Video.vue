<template lang="pug">
  section.video
    ._container.container
      ._content
        h3._title Посмотрите видео работы нашего автосервиса!
        button._button(type="button" @click="openModal")
          icon(name="play" component="video")._button-ico
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
            icon(name="play" component="video")._button-ico

          ._controls
            button._controls-btn.-prev(type="button" @click="changeVideo('prev')")
              icon(name="next-video" component="video")._controls-ico

            button._controls-btn.-next(type="button" @click="changeVideo('next')")
              icon(name="next-video" component="video")._controls-ico

            button._controls-btn.-open(type="button" @click="fullscreen = true" v-if="!fullscreen")
              icon(name="fullscreen_open" component="video")._controls-ico

            button._controls-btn.-exit(type="button" @click="fullscreen = false" v-else)
              icon(name="fullscreen_exit" component="video")._controls-ico

</template>
<script>

import Popup from "@vue/components/Popup/Popup";
import axios from "axios";

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