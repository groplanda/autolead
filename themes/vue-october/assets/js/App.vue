<template lang="pug">
  .app
    Preloader(v-if="loader")
    component(v-else :is="layout" name="fade")
</template>

<script>
import Preloader from '@vue/components/Preloader/Preloader'

export default {
  components: {
    Preloader
  },
  computed: {
    layout() {
      if(!this.$route.meta.layout) {
        return () => import(/* webpackChunkName: "page" */ '@vue/layout/PageLayout');
      }
      return () => import(/* webpackChunkName: "home" */ '@vue/layout/HomeLayout');
    },
    loader() {
      return this.$store.getters.getPreloader
    }
  },
  watch: {
    $route() {
      document.body.classList.remove("open-modal");
      this.$el.scrollIntoView({
        behavior: 'smooth',
        block: 'start'
      })
    }
  },
  created() {
    this.$store.dispatch('getContactsById', 2);
  }
}
</script>
<style lang="scss">
  .fade-enter-active, .fade-leave-active {
    transition: opacity .5s;
  }
  .fade-enter, .fade-leave-to /* .fade-leave-active до версии 2.1.8 */ {
    opacity: 0;
  }
</style>
