<template lang="pug">
  nav.nav
    button._mobile(@click="showNav = true")
      icon(name="hamburger" component="nav")._mobile-ico

    ul._list
      li(v-for="(link, index) in links" :key="index")._item
        router-link(:to="{ name: link.name }")._link
          icon(:name="link.ico" component="nav")._ico
          | {{ link.title }}
    ._city(@click="$store.dispatch('setPopup', true)")
      icon(name="near_me" component="nav")._city-ico
      span._city-name {{ contacts ? contacts.town.name : '' }}

    MobileNav(@close="showNav = false" :links="links" :showNav="showNav" :contacts="contacts")

    Popup(v-if="popup" @close="popup = false" :showClose="false")
      SelectCity


</template>
<script>
import Popup from '@vue/components/Popup/Popup'
import MobileNav from './MobileNav';
import SelectCity from '@vue/components/SelectCity/SelectCity';


export default {
  name: "Nav",
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
      return this.$store.getters.getContactsByTown;
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

.nav {
  background: #FFF;
  padding: 10px 40px;
  display: flex;
  align-items: center;
  justify-content: space-between;
  position: relative;

  $root: &;

  @media(max-width: 991px) {
    padding: 10px 20px;
  }
  @media(max-width: 767px) {
    padding: 20px;
  }

  &__list {
    list-style: none;
    display: flex;
    align-items: center;
    @media(max-width: 767px) {
      display: none;
    }
  }

  &__item {
    margin-right: 37px;
    @media(max-width: 1199px) {
      margin-right: 30px;
    }
    @media(max-width: 991px) {
      margin-right: 20px;
    }
    &:last-child {
      margin-right: 0;
    }
  }

  &__link {
    display: flex;
    align-items: center;
    color: $dark-color;
    font-weight: bold;
    font-size: 14px;
    line-height: 22px;
    text-transform: uppercase;
    letter-spacing: 0.15px;
    padding: 9px 0;
    transition: color .2s ease;

    @media(max-width: 1199px) {
      font-size: 13px;
      line-height: 19px;
    }

    &:hover, &:focus, &:active, &.exact-active {
      color: $red-color;

      #{$root} {
        &__ico {
          color: $red-color;
        }
      }
    }
  }

  &__ico {
    width: 20px;
    height: 17px;
    position: relative;
    margin-top: -1px;
    color: $dark-color;
    margin-right: 5px;
    transition: color .3s ease-in-out;
  }

  &__city {
    display: flex;
    align-items: center;
    cursor: pointer;

    &:hover, &:focus, &:active {
      #{$root} {
        &__city-name {
          color: $red-color;
        }

        &__city-ico {
          color: $red-color;
        }
      }
    }
  }

  &__city-name {
    color: $dark-color;
    font-size: 14px;
    line-height: 22px;
    font-weight: bold;
    text-transform: uppercase;
    transition: color .3s ease;
    margin-left: 4px;

    @media(max-width: 1199px) {
      font-size: 13px;
      line-height: 19px;
    }

    @media(max-width: 991px) {
      font-size: 12px;
    }

    @media(max-width: 349px) {
      font-size: 10px;
    }

  }

  &__city-ico {
    display: block;
    width: 18px;
    height: 22px;
    color: $dark-color;
    transition: color .3s ease;
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
    fill: $dark-color;
  }
}


</style>