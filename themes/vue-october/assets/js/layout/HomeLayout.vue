<template lang="pug">
  .is-home
    Header
    router-view
    Footer
</template>
<script>
import Header from '@vue/components/Header/Header.vue'
import Footer from '@vue/components/Footer/Footer.vue'

export default {
  name: 'home-layout',
  components: {
    Header,
    Footer
  }
}
</script>
