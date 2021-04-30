<template lang="pug">
  header.header
    Popup(v-if="popup" @close="popup = false")
      ContactForm(isModal=true)
    ._wrap
      ._container.container
        ._top
          router-link(to="/")._logo
            img(src=`${process.env.MIX_IMG_PATH}/header/logo.png`, alt="Автолидер и партнеры")._img
            span._name
              | Автолидер
              br
              | и партнеры
          ._contact
            ._contact-item.-open
              icon(name="time" component="header")._contact-ico
              | РЕЖИМ РАБОТЫ
              span._contact-text(v-for="(open, index) in contacts.open" :key="index") {{ open }}
            ._contact-item.-phone
              icon(name="call" component="header")._contact-ico
              | ЗВОНИТЕ
              a._contact-text(:href="`tel:${phone}`" v-for="(phone, index) in contacts.phone" :key="index") {{ phone }}
            button.button.button-arrow._button(type="button" @click="popup = true") Оставить заявку
              icon(name="arrow-right" component="header")._ico
        Nav

</template>
<script>
import Nav from '@vue/components/Nav/Nav.vue';
import Popup from '@vue/components/Popup/Popup.vue';
import ContactForm from '@vue/components/ContactForm/ContactForm.vue';

export default {
  name: "Header",
  components: {
    Nav,
    Popup,
    ContactForm
  },
  data() {
    return {
      popup: false
    }
  },
  computed: {
    contacts() {
      return this.$store.getters.getContactsById(2) || {};
    }
  },
};
</script>
<style lang="scss">
@import "@/scss/vars.scss";
.header {
  position: relative;
  &__wrap {
    position: absolute;
    left: 0;
    top: 0;
    width: 100%;
    z-index: 10;
  }
  &__top {
    display: flex;
    align-items: center;
    justify-content: space-between;
    flex-wrap: wrap;
    margin: 26px 0 28px;

    @media (max-width: 991px) {
      margin: 20px 0 23px;
    }
    @media (max-width: 767px) {
      margin: 15px 0 18px;
    }
  }

  &__logo {
    display: flex;
    align-items: center;
    width: 100%;
    flex: 1 1 250px;
    max-width: 250px;

    @media (max-width: 991px) {
      max-width: 195px;
      flex: 1 1 195px;
    }

    @media (max-width: 767px) {
      max-width: 190px;
      flex: 1 1 190px;
    }

    @media (max-width: 575px) {
      max-width: 75px;
      flex: 1 1 75px;
    }
  }

  &__img {
    width: auto;
    height: 55px;
    margin-right: 15px;

    @media (max-width: 767px) {
      height: 50px;
      margin-right: 10px;
    }
  }

  &__name {
    color: #FFF;
    font-size: 20px;
    font-weight: 700;

    @media (max-width: 991px) {
      font-size: 18px;
    }

    @media (max-width: 767px) {
      font-size: 16px;
    }

    @media (max-width: 575px) {
      display: none;
    }
  }

  &__contact {
    max-width: 610px;
    display: flex;
    align-items: center;
    justify-content: flex-end;
  }

  &__contact-ico {
    width: 20px;
    height: 20px;
    color: $red-color;
    position: absolute;
    top: 2px;
    left: 0;

    @media (max-width: 575px) {
      width: 18px;
      height: 18px;
    }
  }

  &__contact-item {
    margin-right: 30px;
    padding-left: 34px;
    position: relative;
    color: #FFF;
    font-weight: bold;
    font-size: 12px;
    line-height: 22px;
    letter-spacing: 0.15px;

    @media (max-width: 575px) {
      padding-left: 28px;
      font-size: 12px;
      line-height: 19px;
      margin-right: 15px;
    }

    @media (max-width: 419px) {
      margin-right: 10px;
    }

    &--open {
      @media (max-width: 410px) {
        display: none;
      }
    }

    &:last-child {
      margin-right: 0;
    }
  }

  &__contact-text {
    display: block;
    color: #FFF;
  }

  &__button {
    padding: 8px 24px 8px 20px;

    @media (max-width: 767px) {
      display: none;
    }

  }
}

</style>
