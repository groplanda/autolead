<template lang="pug">
  .page
    ._tips.-error(v-if="errorAuth" @click="clearErrorAuth")
      ._tips-text {{ errorAuth }}

    ._tips.-success(v-if="logoutAuth" @click="clearLogoutAuth")
      ._tips-text {{ logoutAuth }}

    ._container.container
      .tabs
        ._wrapper
          ._heading
            ._heading-item(:class="{'tabs__heading-item--active': currentTabIndex === 0}" @click="changeTab(0)") Войти
            ._heading-item(:class="{'tabs__heading-item--active': currentTabIndex === 1}" @click="changeTab(1)") Зарегистрироваться
          ._body
            ._item(v-if="currentTabIndex === 0")
              LoginForm
            ._item(v-else)
              RegisterForm

</template>
<script>
import RegisterForm from '@vue/components/Form/AccountForm/RegisterForm';
import LoginForm from '@vue/components/Form/AccountForm/LoginForm';

export default {
  name: "Auth",
  data() {
    return {
      currentTabIndex: 0,
      errorAuth: null,
      logoutAuth: null
    }
  },
  components: {
    RegisterForm,
    LoginForm
  },
  methods: {
    changeTab(index) {
      this.currentTabIndex = index;
      this.$store.dispatch('setError', false);
    },
    clearErrorAuth() {
      this.errorAuth = null;
      this.$router.replace({ query: [] });
    },
    clearLogoutAuth() {
      this.logoutAuth = null;
      this.$router.replace({ query: [] });
    }
  },
  created () {
    if (this.$route.query.error) {
      this.errorAuth = "Вначале авторизируйтесь!";
    }

    if (this.$route.query.logout) {
      this.logoutAuth = "Вы успешно вышли";
    }

    const user = this.$store.getters.getUserAuth;
    if(user) {
      this.$router.push({ name: "account" })
    }
  }
}
</script>
<style lang="scss">
@import '@/scss/vars.scss';
.tabs {
  padding: 30px 0;
  display: flex;
  flex-direction: column;
  align-items: center;

  &__wrapper {
    width: 100%;
    max-width: 585px;
    padding: 60px 40px;
    box-shadow: 0 2px 4px rgb(38 38 38 / 24%), 0 4px 8px rgb(38 38 38 / 20%);
    background: #FFF;
  }

  &__heading {
    display: flex;
    justify-content: center;
    align-items: center;
  }

  &__heading-item {
    color: $dark-color;
    font-size: 26px;
    line-height: 32px;
    padding: 20px;
    cursor: pointer;
    transition: color .3s ease;

    &--active, &:hover {
      color: $red-color;
    }
  }
}
</style>