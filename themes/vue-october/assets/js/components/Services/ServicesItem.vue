<template lang="pug">
  .item-service
    img(:src="service.ico", :alt="service.title")._ico
    h6._title {{ service.title }}
    p._descr {{ service.description }}
</template>
<script>
export default {
  name: 'ServicesItem',
  props: {
    service: {
      type: Object,
      required: true
    }
  }
}
</script>
<style lang="scss">
.item-service {
  width: 100%;
  flex: 1 1 calc(33.33% - 24px);
  margin: 0 12px 24px 12px;
  background: #fff;
  padding: 50px 44px 49px;
  text-align: center;
  transition: 0.3s ease;

  &:hover {
    box-shadow: 0px 8px 16px rgba(38, 38, 38, 0.24),
      0px 16px 24px rgba(38, 38, 38, 0.2);
  }

  @media(max-width: 991px) {
    flex: 1 1 calc(50% - 24px);
  }

  @media(max-width: 767px) {
    flex: 1 1 calc(100% - 24px);
    max-width: calc(100% - 24px);
    padding: 30px 25px 39px;
    margin: 30px 0;
  }

  @media(max-width: 410px) {
    padding: 20px 15px 29px;
  }

  &__ico {
    margin: 0 auto 33px;
  }
  &__title {
    margin-bottom: 20px;
  }
}
</style>