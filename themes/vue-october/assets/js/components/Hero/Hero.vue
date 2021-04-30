<template lang="pug">
  section.hero
    ._container.container
      ._content
        h1._title {{ contacts.title }}
        button.button.button-arrow(type="button" @click="popup = true") Оставить заявку
          icon(name="arrow-right" component="header")._ico

    Popup(v-if="popup" @close="popup = false")
      ContactForm(isModal=true)
</template>
<script>
import Popup from '@vue/components/Popup/Popup.vue'
import ContactForm from '@vue/components/ContactForm/ContactForm.vue';

export default {
  name: 'Hero',
  data() {
    return {
      popup: false
    }
  },
  components: {
    Popup,
    ContactForm,
  },
  computed: {
    contacts() {
      return this.$store.getters.getContactsById(2) || {};
    },
  }
}
</script>
<style lang="scss">

.hero {
  width: 100%;
  min-height: 800px;
  background-image: url('/themes/vue-october/assets/images/hero/hero.jpg');
  background-position: center;
  background-size: cover;
  background-repeat: no-repeat;
  position: relative;
  padding-top: 280px;

  @media(max-width: 991px) {
    padding-top: 230px;
    min-height: 620px;
  }

  @media(max-width: 767px) {
    min-height: 520px;
    background-position: center right;
  }

  &::after {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: #000;
    opacity: .45;
  }
  &__content {
    max-width: 680px;
    position: relative;
    z-index: 1;
  }
  &__title {
    color: #FFF;
    margin-bottom: 50px;

    @media(max-width: 575px) {
      font-size: 35px;
      line-height: 40px;
    }

    @media(max-width: 479px) {
      font-size: 28px;
      line-height: 40px;
    }

    @media(max-width: 410px) {
      font-size: 24px;
      line-height: 36px;
    }

    @media(max-width: 349px) {
      font-size: 22px;
      line-height: 32px;
    }
  }
}
</style>
