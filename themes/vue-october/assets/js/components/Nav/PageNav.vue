<template lang="pug">
  nav.page-nav
    button._mobile(@click="showNav = true")
      icon(name="hamburger" component="nav")._mobile-ico
    router-link(
      :to="{ name: link.name }"
      v-for="(link, index) in links"
      :key="index"
      )._link
      icon(:name="link.ico" component="nav")._ico
      | {{ link.title }}

    //- ._city(@click="$store.dispatch('setPopup', true)")
    ._city
      icon(name="near_me" component="nav")._city-ico
      span._city-name {{ contacts ? contacts.town.name : '' }}


    MobileNav(@close="showNav = false" :links="links" :showNav="showNav" :contacts="contacts")

    Popup(v-if="popup" @close="popup = false" :showClose="false")
      SelectCity

</template>
<script>
import Popup from '@vue/components/Popup/Popup.vue'
import MobileNav from './MobileNav.vue';
import SelectCity from '@vue/components/SelectCity/SelectCity.vue';
export default {
  name: "page-nav",
  components: {
    MobileNav,
    Popup,
    SelectCity
  },
  computed: {
    popup() {
      return this.$store.getters.getPopup;
    },
    contacts() {
      return this.$store.getters.getContactsById(2);
    }
  },
  data() {
    return {
      showNav: false,
      links: [
        {title: 'Главная', name: 'home', ico: 'home'},
        {title: 'О нас', name: 'about', ico: 'about'},
        {title: 'Автосервис', name: 'car-service', ico: 'wrench'},
        // {title: 'Автопрокат', name: 'vehicles', ico: 'car'},
        {title: 'Контакты', name: 'contact', ico: 'place'},
      ]
    }
  }
}
</script>
<style lang="scss">
@import "@/scss/vars.scss";
  .page-nav {
    display: flex;
    align-items: center;
    justify-content: space-between;

    $root: &;

    &__link {
      display: flex;
      align-items: center;
      color: $text-color;
      font-weight: 700;
      font-size: 14px;
      line-height: 22px;
      text-transform: uppercase;
      letter-spacing: .15px;
      cursor: pointer;

      &:hover, &:focus, &:active, &.exact-active {
        color: $red-color;

        #{$root} {
          &__ico {
            color: $red-color;
          }
        }
      }
      @media(max-width: 1199px) {
        font-size: 13px;
        line-height: 19px;
      }

      @media(max-width: 767px) {
        display: none;
      }
    }

    &__city {
      display: flex;
      align-items: center;
    }

    &__city-ico {
      width: 18px;
      height: 22px;
    }

    &__city-name {
      cursor: pointer;
      color: $text-color;
      font-size: 14px;
      line-height: 22px;
      text-transform: uppercase;
      font-weight: 700;
      min-width: 82px;
      margin-left: 4px;
      @media(max-width: 1199px) {
        font-size: 13px;
        line-height: 19px;
        min-width: 76px;
      }
    }

    &__ico {
      width: 15px;
      height: 15px;
      color: $black-color;
      margin-right: 10px;
    }

    &__mobile {
      display: none;
      @media(max-width: 767px) {
        display: flex;
      }
    }

    &__mobile-ico {
      width: 24px;
      height: 16px;
      fill: $black-color;
    }
  }
</style>
