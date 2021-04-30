<template lang="pug">
  .container
    section.about
      ._header
        .suptitle._suptitle
          icon(name="mark" component="about")._ico
          | Почему мы?
        h3._title.title {{ post.title }}
      ._body(v-html="post.content")
      ._image
        img(src=`${process.env.MIX_IMG_PATH}/about/about.jpg`, :alt="post.title")._poster
</template>
<script>

export default {
  name: "About",
  computed: {
    post () {
      return this.$store.getters.getPost;
    },
  },
};
</script>
<style lang="scss">
.about {
  padding: 100px 87px 0 87px;
  background-color: #fff;
  background-image: url(/themes/vue-october/assets/images/gears.png);
  background-position: top right;
  background-repeat: no-repeat;
  background-size: auto;
  margin: -80px 0 230px;
  position: relative;
  z-index: 1;

  @media(max-width: 991px) {
    padding: 80px 60px 0 60px;
    margin: -60px 0 170px;

    br {
      display: none;
    }
  }

  @media(max-width: 767px) {
    background-size: 50%;
    padding: 60px 40px 0 40px;
    margin: -60px 0 120px;
  }

  @media(max-width: 374px) {
    padding: 40px 20px 0 20px;
    margin: -40px 0 100px;
  }

  &__header {
    margin-bottom: 36px;
  }
  &__body {
    margin-bottom: 54px;
  }
  &__image {
    margin-top: -120px;
    transform: translateY(120px);

    @media(max-width: 990px) {
      margin-top: -80px;
      transform: translateY(80px);
    }

    @media(max-width: 767px) {
      margin-top: -60px;
      transform: translateY(60px);
    }

    @media(max-width: 374px) {
      margin-top: -30px;
      transform: translateY(30px);
    }
  }
}
</style>