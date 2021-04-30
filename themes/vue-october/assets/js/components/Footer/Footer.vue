<template lang="pug">
  footer.footer
    ._container.container
      ._top
          ._content
            img(src=`${process.env.MIX_IMG_PATH}/header/logo.png`, alt="Автолидер и партнеры")._logo
            p._description.
              Мы занимаемся ремонтом и обслуживанием отечественных и иностранных автомобилей.

            ._social
              a(
                :href="link.url"
                target="_blank"
                rel="noopener noreferrer"
                v-for="(link, index) in links"
                :key="index")._social-link
                  icon(:name="link.ico" component="footer")._social-ico

          ._nav
            ._menu
              h3._title ССЫЛКИ
              router-link(:to="{ name: link.name }" v-for="(link, index) in nav_left" :key="index")._menu-link {{ link.title }}

            ._menu
              router-link(:to="{ name: link.name }" v-for="(link, index) in nav_right" :key="index")._menu-link {{ link.title }}

          ._contact
            h3._title КОНТАКТЫ
            ._contact-item
              icon(name="place" component="footer")._contact-ico
              span._contact-text {{ contacts.address }}
            ._contact-item
              icon(name="mobile_phone" component="footer")._contact-ico
              a._contact-text.-link(:href="`tel:${phone}`" v-for="(phone, index) in contacts.phone" :key="index") {{ phone }}
            ._contact-item
              icon(name="email" component="footer")._contact-ico
              a._contact-text.-link(:href="`mailto:${contacts.email}`") {{ contacts.email }}
            ._contact-item
              icon(name="timer" component="footer")._contact-ico
              span._contact-text(v-for="(open, index) in contacts.open" :key="index") {{ open }}
    ._bottom
      ._bottom-container.container
        span._info Ремонт автомобилей любых марок.
        ._links
          span._info © 2021 Автолидер и партнеры.
          router-link(:to="{ name: 'privacy' }")._link Политика конфиденциальности

</template>
<script>
export default {
  name: 'Footer',
  data() {
    return {
      links: [
        { url: '#!', ico: 'vk' },
        { url: '#!', ico: 'instagram' },
        { url: '#!', ico: 'youtube' },
      ],
      nav_left: [
        { name: 'about', title: 'О нас' },
        { name: 'car-service', title: 'Автосервис' },
        { name: 'contact', title: 'Контакты' },
      ],
      nav_right: [],
    }
  },
  computed: {
    contacts() {
      return this.$store.getters.getContactsById(2) || {};
    }
  },
}
</script>
<style lang="scss">
@import '@/scss/vars.scss';

.footer {
  padding-top: 70px;

  @media(max-width: 767px) {
    padding-top: 35px;
  }

  $root: &;

  &__top {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    flex-wrap: wrap;
    margin: 15px 0 80px;

    @media(max-width: 991px) {
      margin: 15px 0 60px;
    }

    @media(max-width: 767px) {
      margin: 15px 0 30px;
      flex-direction: column;
      align-items: center;
    }
  }

  &__content {
    width: 100%;
    max-width: 235px;
    margin-right: 60px;

    @media(max-width: 991px) {
      max-width: 215px;
      margin-right: 30px;
    }

    @media(max-width: 767px) {
      max-width: 320px;
      margin: 0 0 30px 0;
    }
  }

  &__logo {
    max-width: 120px;
    margin-bottom: 23px;
  }

  &__description {
    font-size: 14px;
    line-height: 22px;
    margin-bottom: 31px;
  }

  &__title {
    font-weight: bold;
    font-size: 14px;
    line-height: 22px;
    letter-spacing: 0.15px;
    margin-bottom: 28px;
  }

  &__social {
    display: flex;
    align-items: center;
  }

  &__social-link {
    display: flex;
    margin-right: 20px;
    &:last-child {
      margin-right: 0;
    }
    &:hover, &:focus, &:active {
      #{$root} {
        &__social-ico {
          color: $dark-color;
        }
      }
    }
  }

  &__social-ico {
    color: $red-color;
    width: 18px;
    height: 18px;
    transition: color .3s ease;
  }

  &__nav {
    width: 100%;
    max-width: 357px;
    display: flex;
    justify-content: space-between;
    align-items: flex-end;
    margin-top: 13px;

    @media(max-width: 991px) {
      max-width: 260px;
    }

    @media(max-width: 767px) {
      max-width: 320px;
      margin: 0 0 30px 0;
    }
  }

  &__menu {
    flex: 1 1 160px;
    max-width: 160px;
    display: flex;
    flex-direction: column;
    margin-right: 37px;

    &:last-child {
      margin-right: 0;
    }

    @media(max-width: 991px) {
      flex: 1 1 140px;
      max-width: 140px;
      margin-right: 20px;
    }
  }

  &__menu-link {
    display: block;
    font-weight: bold;
    font-size: 14px;
    line-height: 22px;
    letter-spacing: 0.15px;
    color: $grey-color;
    margin-bottom: 12px;
    transition: color .3s ease;

    &:last-child {
      margin-bottom: 0;
    }

    &:hover, &:focus, &:active {
      color: $dark-color;
    }
  }

  &__contact {
    width: 100%;
    max-width: 237px;
    margin-top: 14px;

    @media(max-width: 991px) {
      max-width: 220px;
    }

    @media(max-width: 767px) {
      max-width: 320px;
      margin-top: 0;
    }
  }

  &__contact-item {
    margin-bottom: 16px;
    position: relative;
    padding-left: 30px;
    &:nth-last-child(2) {
      margin-bottom: 17px;
    }
  }

  &__contact-ico {
    position: absolute;
    top: 3px;
    left: 0;
    color: $red-color;
    width: 14px;
    height: 14px;
  }

  &__contact-text {
    display: block;
    color: $grey-color;
    font-size: 14px;
    line-height: 20px;
    letter-spacing: 0.15px;

    &_link {
      text-decoration: none;
      &:hover, &:focus, &:active {
      color: $dark-color;
    }
    }
  }

  &__bottom {
    background: $dark-color;
    padding: 23px 0 18px;
    @media(max-width: 575px) {
      text-align: center;
    }
  }

  &__bottom-container {
    max-width: 1120px;
    display: flex;
    justify-content: space-between;
    align-items: center;

    @media(max-width: 991px) {
      flex-direction: column;
    }
  }

  &__links {
    @media(max-width: 991px) {
      margin-top: 10px;
    }

    @media(max-width: 575px) {
      #{$root} {
        &__info {
          display: block;
        }
      }
    }
  }

  &__info, &__link {
    color: $light-color;
    font-size: 12px;
    line-height: 18px;
    letter-spacing: 0.15px;
  }

  &__link {
    font-weight: 700;
    margin-left: 6px;
    transition: color .3s ease;
    &:hover, &:focus, &:active {
      color: #FFF;
    }
  }
}
</style>
