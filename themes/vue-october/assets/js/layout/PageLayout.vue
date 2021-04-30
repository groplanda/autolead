<template lang="pug">
  .is-page
    HeaderPage
    router-view
    Footer
</template>
<script>
import HeaderPage from '@vue/components/Header/HeaderPage.vue'
import Footer from '@vue/components/Footer/Footer.vue'

export default {
  name: 'page-layout',
  components: {
    Footer,
    HeaderPage
  }
}
</script>