<template lang="pug">
  .account
    AccountHeader
    ._container.container
      ._row
        ._sidebar
          AccountSidebar(:fullname="fullname")

        ._content
          router-view(:user="user")

</template>
<script>
import AccountHeader from "@vue/components/Account/AccountHeader";
import AccountSidebar from "@vue/components/Account/AccountSidebar";

export default {
  name: "Account",
  components: {
    AccountHeader,
    AccountSidebar,
  },
  computed: {
    fullname() {
      return this.user.name + ' ' + this.user.surname;
    }
  },
  data() {
    return {
      user: {}
    }
  },
  created() {
    this.user = this.$store.getters.getUserAuth;
    // const routeUserId = this.$route.params.user_id;
    // if (routeUserId && routeUserId !== this.user.id) {
    //   this.$router.push({ name: "account", params: { user_id: this.user.id } });
    // }
  }
}
</script>
<style lang="scss">
@import '@/scss/vars.scss';
.account {

  &__container {
    padding-top: 20px;
    padding-bottom: 60px;
  }

  &__row {
    display: flex;
    flex-wrap: wrap;
    margin: 0 -12px;
  }

  &__sidebar {
    width: 100%;
    flex: 1 1 calc(33.333% - 24px);
    padding: 40px 30px;
    margin: 0 12px;
    box-shadow: 0px 2px 4px rgba(38, 38, 38, 0.24),
        0px 4px 8px rgba(38, 38, 38, 0.2);
  }

  &__content {
    width: 100%;
    flex: 1 1 calc(66.666% - 24px);
    margin: 0 12px;
  }
}
</style>