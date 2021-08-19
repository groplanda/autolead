<template lang="pug">
  .accout-header
    h2.title._title Аккаунт
</template>
<script>
export default {
  name: "AccountHeader"
}
</script>
<style lang="scss">
.accout-header {
  width: 100%;
  min-height: 320px;
  background-image: url('/themes/vue-october/assets/images/hero/hero.jpg');
  background-position: center;
  background-size: cover;
  background-repeat: no-repeat;
  position: relative;
  padding-top: 210px;
  display: flex;
  justify-content: center;

  &::after {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: #000;
    opacity: .6;
  }

  &__title {
    color: #FFF;
    position: relative;
    z-index: 1;
  }

}
</style>