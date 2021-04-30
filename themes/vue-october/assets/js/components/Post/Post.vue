<template lang="pug">
  .post
    ._content(v-if="post")
      ._title {{ post.title }}
      ._body(v-if="post.content" v-html="post.content")
    ._load(v-else)
      icon(name="refresh" component="post")._load-ico
</template>
<script>
export default {
  name: "Post",
  computed: {
    post() {
      return this.$store.getters.getPost;
    }
  }
};
</script>
<style lang="scss">
@import "@/scss/vars.scss";
.post {
  &__title {
    font-size: 36px;
    line-height: 42px;
    margin-bottom: 70px;
    @media (max-width: 1199px) {
      font-size: 28px;
      line-height: 34px;
      margin-bottom: 50px;
    }
    @media (max-width: 767px) {
      font-size: 26px;
      line-height: 32px;
      margin-bottom: 40px;
    }
  }

  &__body {
    margin-bottom: 40px;

    p {
      color: $text-color;
      font-size: 16px;
      line-height: 22px;
      margin-bottom: 20px;
    }
  }

  &__load {
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 40px;
  }

  &__load-ico {
    fill: $red-color;
    width: 50px;
    height: 50px;
    animation: loading 2s linear infinite;
  }
}
@keyframes loading {
  0% {
      transform:rotate(0deg);
  }
  100% {
      transform:rotate(360deg);
  }
}
</style>