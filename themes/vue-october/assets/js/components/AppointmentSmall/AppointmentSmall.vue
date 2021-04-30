<template lang="pug">
  section.appointment-small
    Popup(v-if="popup" @close="popup = false")
      ContactForm(isModal=true)
    ._container.container
      ._content
        h5._title.title Проводим полную проверку и диагностику авто перед сдачей клиенту.
        button.button.button-arrow(type='button' @click="popup = true") Оставить заявку
          icon(name="arrow-right" component="header")._ico
</template>
<script>
import Popup from '@vue/components/Popup/Popup.vue'
import ContactForm from '@vue/components/ContactForm/ContactForm.vue';

export default {
  name: "Appointment-small",
  components: {
    Popup,
    ContactForm,
  },
  data() {
    return {
      popup: false
    }
  }
}
</script>
<style lang="scss">
.appointment-small {
  &__content {
    background: #FFF;
    padding: 43px 76px 48px 70px;
    position: relative;
    margin-top: -78px;
    display: flex;
    justify-content: space-between;
    align-items: center;

    @media(max-width: 767px) {
     flex-direction: column;
     padding: 30px;
    }
    @media(max-width: 575px) {
      padding: 30px 15px;
    }
  }
  &__title {
    width: 100%;
    max-width: 65%;
    margin-right: 15px;

    @media(max-width: 991px) {
      max-width: calc(100% - 226px);
    }

    @media(max-width: 767px) {
      max-width: 450px;
      text-align: center;
      margin-bottom: 15px;
    }

    @media(max-width: 575px) {
      font-size: 18px;
    }

    @media(max-width: 359px) {
      font-size: 16px;
      line-height: 21px;
    }
  }
}
</style>