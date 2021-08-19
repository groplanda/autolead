<template lang="pug">
  section.account-sidebar
    h4._title Ваш аккаунт
    ._menu
      router-link(:to="{ name: 'account' }")._menu-item
        icon(name="account-user" component="account")._menu-ico.-red
        span {{ fullname }}
      button._menu-item.-leave(type="button" @click="onLogout") Выйти
        icon(name="account-logout" component="account")._menu-ico
      router-link(:to="{ name: 'account-cars' }")._menu-item
        icon(name="account-car" component="account")._menu-ico
        span Мои автомобили
      router-link(:to="{ name: 'account-repairs' }")._menu-item
        icon(name="account-calendar" component="account")._menu-ico
        span Мои ремонты

</template>
<script>
export default {
  name: "AccountSidebar",
  props: {
    fullname: {
      type: String,
      required: true
    }
  },
  methods: {
    onLogout() {
      this.$store.dispatch("logoutUser");
    }
  }
}
</script>
<style lang="scss">
@import '@/scss/vars.scss';
.account-sidebar {

  $root: &;

  &__title {
    color: $dark-color;
    margin-bottom: 20px;
  }

  &__menu-item {
    color: $dark-color;
    padding-left: 30px;
    font-size: 16px;
    line-height: 20px;
    display: flex;
    align-items: center;
    position: relative;
    margin-bottom: 20px;
    cursor: pointer;

    &:last-child {
      margin-bottom: 0;
    }

    &--leave {
      font-weight: 600;
      padding: 0;
      color: $red-color;
      #{$root} {
        &__menu-ico {
          color: $red-color;
          margin-left: 10px;
          top: calc(50% - 6px);
          position: inherit;
          width: 20px;
          height: 12px;
          transform: translateX(0);
          transition: transform .2s ease;
        }
      }

      &:hover, &:focus {
        #{$root} {
          &__menu-ico {
            transform: translateX(5px);
          }
        }
      }
    }
  }

  &__menu-ico {
    color: $dark-color;
    display: flex;
    max-width: 20px;
    max-height: 20px;
    margin: 0;
    position: absolute;
    left: 0;
    top: calc(50% - 10px);

    &--red {
      color: $red-color;
    }
  }

}
</style>