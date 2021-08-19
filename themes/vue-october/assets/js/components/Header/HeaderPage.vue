<template lang="pug">
  header.header-page
    Popup(v-if="popup" @close="popup = false")
      ContactForm(isModal=true)
    ._top
      ._container.container
        ._wrap
          router-link(to="/")._logo
            img(src=`${process.env.MIX_IMG_PATH}/header/logo.png`, alt="Автолидер и партнеры")._logo-img
            ._name
              | Автолидер
              br
              | и партнеры
          ._contact
            ._social
              a(
                v-for="(link, idx) in social"
                :key="idx"
                :href="link.url"
                target="_blank"
                rel="noopener noreferrer"
              )._social-link
                icon(:name="link.ico" component="header")._social-ico
            ._phone
              icon(name="call" component="header")._phone-ico
              a(:href="`tel:${contacts.phone[0]}`")._phone-text {{ contacts.phone[0] }}

            button.button.button-arrow._button(type="button" @click="popup = true") Оставить заявку
              icon(name="arrow-right" component="header")._ico
    ._bottom
      ._container.container
        PageNav

</template>
<script>
import Popup from '@vue/components/Popup/Popup';
import ContactForm from '@vue/components/Form/ContactForm';
import PageNav from '@vue/components/Nav/PageNav';
import { formattedPhone } from '@vue/helpers/formatted';

export default {
  name: "Header-page",
  components: {
    Popup,
    ContactForm,
    PageNav
  },
  data() {
    return {
      phone: '',
      popup: false,
    }
  },
  computed: {
    contacts() {
      return this.$store.getters.getContactsById || {};
    },
    social() {
      return [
        { url: '#!', ico: 'tg' },
        { url: `whatsapp://send?phone=${formattedPhone(this.phone)}`, ico: 'whatsapp' },
        { url: `viber://chat?number=${formattedPhone(this.phone)}`, ico: 'viber' },
      ]
    }
  },
  created() {
    this.phone = this.$store.getters.getContactsById.phone[0] || '';
  }
}
</script>
<style lang="scss">
  @import "@/scss/vars.scss";

  .header-page {
    position: relative;

    &__top {
      background: $black-color;
      padding: 15px 0;
    }

    &__wrap {
      display: flex;
      flex-wrap: wrap;
      align-items: center;
      justify-content: space-between;
    }

    &__logo {
      display: flex;
      align-items: center;
    }

    &__logo-img {
      width: auto;
      height: 70px;
      margin-right: 15px;

      @media (max-width: 991px) {
        height: 60px;
        margin-right: 10px;
      }
      @media (max-width: 767px) {
        height: 50px;
      }
    }

    &__name {
      color: #fff;
      font-size: 20px;
      font-weight: 700;

      @media (max-width: 991px) {
        font-size: 18px;
      }
      @media (max-width: 767px) {
        font-size: 16px;
      }
      @media (max-width: 479px) {
        display: none;
      }
    }

    &__contact {
      display: flex;
      align-items: center;
      @media (max-width: 389px) {
        flex-direction: column-reverse;
        align-items: flex-start;
      }
    }

    &__social {
      display: flex;
      align-items: center;
      margin-right: 30px;
      @media (max-width: 991px) {
        margin-right: 20px;
      }
      @media (max-width: 389px) {
        margin: 5px 0 0 0;
      }
    }

    &__social-link {
      display: flex;
      margin-right: 15px;

      @media (max-width: 767px) {
        margin-right: 10px;
      }

      &:last-child {
        margin-right: 0;
      }
    }

    &__social-ico {
      color: #FFF;
      width: 30px;
      height: 30px;
      @media (max-width: 1199px) {
        width: 28px;
        height: 28px;
      }
      @media (max-width: 767px) {
        width: 26px;
        height: 26px;
      }
      @media (max-width: 389px) {
        width: 24px;
        height: 24px;
      }
    }

    &__phone {
      display: flex;
      align-items: center;
      margin-right: 12px;
      @media (max-width: 389px) {
        margin-right: 0;
      }
    }

    &__phone-ico {
      width: 14px;
      height: 14px;
      color: #FFF;
      margin: 0;
    }

    &__phone-text {
      color: #FFF;
      font-size: 15px;
      line-height: 18px;
      margin-left: 4px;
    }

    &__button {
      @media (max-width: 767px) {
        display: none;
      }
    }

    &__bottom {
      background: #F2F2F3;
      padding: 15px 0;
    }
  }
</style>