<template lang="pug">
  .masonry-gallery
    VueGallery(:images="images" :index="index" @close="index = null")
    ._container
      Waterfall(:options="options")
        WaterfallItem(v-for="(img, idx) in gallery" :key="idx")._item
          img(:src="img.src", :alt="img.title" @click="index = idx")._img
          ._item-title(v-if="img.title") {{ img.title }}
          ._item-descr(v-if="img.info") {{ img.info }}
          ._item-overlay

</template>
<script>
import {Waterfall, WaterfallItem} from 'vue2-waterfall';
import VueGallery from 'vue-gallery';
export default {
  name: 'Gallery',
  components: {
    Waterfall, WaterfallItem, VueGallery
  },
  data() {
    return {
      index: null,
      options: {}
    }
  },
  computed: {
    gallery() {
      const res = this.$store.getters.getGallery;
      let output = [];
      if (res.images) {
        output = res.images;
      }
      return output;
    },
    images() {
      const res = this.$store.getters.getGallery;
      let output = [];
      if (res.images) {
        output = res.images.map(img => img.src);
      }
      return output;
    }
  },
  methods: {
    getData() {
      const name = this.$route.name;
      this.$store.dispatch('fetchGallery', name);
    }
  },
  created() {
    this.getData();
  }
}
</script>
<style lang="scss">
@import '@/scss/vars.scss';
.masonry-gallery {
  width: 100%;
  position: relative;
  $root: &;

  &__item {
    cursor: pointer;
    width: 100%;
    max-width: calc(33.333% - 10px);
    margin: 5px;
    overflow: hidden;
    border-radius: 2.5px;

    @media(max-width: 767px) {
      max-width: calc(50% - 5px);
      margin: 2.5px;
    }

    &:hover {
      #{$root} {
        &__item-overlay {
          opacity: 0;
          pointer-events: none;
        }
        &__item-title, &__item-descr {
          transform: translateY(0);
        }
      }
    }
  }

  &__img {
    max-width: 100%;
    height: auto;
    display: flex;
  }

  &__item-title, &__item-descr, &__item-overlay {
    position: absolute;
  }

  &__item-title, &__item-descr {
    padding: 0 15px;
    color: #FFF;
    z-index: 2;
    transition: transform .3s ease;
    transform: translateY(150px);
  }

  &__item-title {
    font-size: 16px;
    line-height: 18px;
    bottom: 50px;
  }

  &__item-descr {
    font-size: 14px;
    line-height: 16px;
    bottom: 25px;
  }

  &__item-overlay {
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-image: linear-gradient(to bottom , rgba(0,0,0,0), rgba($dark-color, .7));
    z-index: 1;
    opacity: 1;
    transition: opacity .3s ease;
  }
}
</style>