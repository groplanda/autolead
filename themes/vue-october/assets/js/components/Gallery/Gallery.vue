<template lang="pug">
  section.gallery
    VueGallery(:images="gallery.images" :index="index" @close="index = null")
    ._container.container
      ._inner
        .suptitle._suptitle
          icon(name="mark" component="about")._ico
          | {{ gallery.title }}
        h3._title.title {{ gallery.description }}
        ._row
          ._item(
            v-for="(image, imageIndex) in gallery.images"
            :key="imageIndex"
            @click="index = imageIndex")
            img(:src="image")._thumb


</template>
<script>
import VueGallery from 'vue-gallery';
export default {
  name: 'Gallery',
  components: {
    VueGallery
  },
  data() {
    return {
      index: null
    }
  },
  computed: {
    gallery() {
      return this.$store.getters.getGallery;
    }
  },
  created() {
    const name = this.$route.name;
    this.$store.dispatch('fetchGallery', name);
  }
}
</script>
<style lang="scss">
@import '@/scss/vars.scss';
.gallery {
  padding-bottom: 50px;
  position: relative;

  &::after {
    content: "";
    background: url(/themes/vue-october/assets/images/gears.png);
    background-repeat: no-repeat;
    background-position: top left;
    width: 100%;
    height: 100%;
    top: 0;
    left: 0;
    position: absolute;
    transform: matrix(1, 0, 0, -1, 0, 0);
  }

  &__inner {
    margin: -80px 0 150px;
    padding: 100px 87px 0px 87px;
    position: relative;
    z-index: 1;
    background-color: #FFF;

    @media(max-width: 991px) {
      padding: 80px 60px 0 60px;
      margin: -60px 0 120px;
    }

    @media(max-width: 767px) {
      padding: 60px 40px 0 40px;
      margin: -40px 0 100px;
    }

    @media(max-width: 374px) {
      padding: 40px 20px 0 20px;
      margin: -40px 0 100px;
    }
  }

  &__suptitle {
    margin-bottom: 28px;

    @media(max-width: 767px) {
      margin-bottom: 20px;
    }
  }

  &__title {
    margin-bottom: 55px;

    @media(max-width: 767px) {
      margin-bottom: 30px;
    }
  }

  &__row {
    display: flex;
    align-items: flex-start;
    flex-wrap: wrap;
    margin: -120px -15px 0;
    transform: translateY(120px);

    @media(max-width: 575px) {
      margin: -120px 0 0;
      flex-direction: column;
      align-items: center;
    }
  }

  &__item {
    max-width: calc(50% - 30px);
    width: 100%;
    margin: 0 15px 30px;
    position: relative;
    cursor: pointer;
    border-radius: 2px;
    overflow: hidden;

    &::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-image: linear-gradient(to bottom , rgba(0,0,0,0), rgba($dark-color, .7));
      z-index: 1;
      opacity: 1;
      transition: opacity .3s ease;
    }

    &::after {
      content: '';
      display: block;
      padding-top: calc(100% / ( 16 / 9));
    }

    &:hover, &:focus, &:active {
      &::before {
        opacity: 0;
      }
    }

    @media(max-width: 575px) {
      max-width: 400px;
      margin: 0 0 20px 0;

      &:last-child {
        margin-bottom: 0;
      }
    }

  }

  &__thumb {
    top: 0;
    left: 0;
    position: absolute;
    width: 100%;
    height: 100%;
    object-fit: cover;
  }
}

</style>