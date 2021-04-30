<template lang="pug">
  section.services
    ._container.container
      ._header
        .suptitle._suptitle
          icon(name="mark" component="about")._ico
          | Наши услуги
        h3._title.title.
          Ремонт и обслуживание авто любых моделей
      template(v-if="services.length > 0")
        ._row(v-if="window.width > 767")
          ServicesItem(v-for="service in services" :service="service" :key="service.id")
        carousel._slider(v-else :per-page="1.2" :loop="true" :scrollPerPage="false" :paginationEnabled="false" :perPageCustom="[[640, 2.2]]")
          slide(v-for="service in services" :key="service.id")
            ServicesItem(:service="service")
      ._footer(v-if="showFooter")
        button.button.button-arrow(type='button' @click="$router.push({ name: 'car-service'})") Все услуги
          icon(name="arrow-right" component="header")._ico
</template>
<script>
import ServicesItem from './ServicesItem.vue';
import { Carousel, Slide } from 'vue-carousel';

export default {
  name: "Services",
  props: {
    showFooter: {
      type: Boolean,
      default: true
    }
  },
  components: {
    ServicesItem,
    Carousel,
    Slide
  },
  data() {
    return {
      currentSlide: 0,
      window: {
        width: 0
      }
    }
  },
  computed: {
    services () {
      return this.$store.getters.getServices;
    },
  },
  methods: {
    handleResize() {
      this.window.width = window.innerWidth;
    }
  },
  mounted() {
    this.$store.dispatch('fetchServices');
    window.addEventListener('resize', this.handleResize);
    this.handleResize();
  },
  destroyed() {
    window.removeEventListener('resize', this.handleResize);
  }
};
</script>
<style lang="scss">
.services {
  padding: 105px 0 122px;
  position: relative;

  @media(max-width: 767px) {
    padding: 50px 0 60px;
  }

  &::after,
  &::before {
    content: "";
    background: url(/themes/vue-october/assets/images/gears.png);
    background-repeat: no-repeat;
    width: 100%;
    height: 100%;
    top: 0;
    left: 0;
    position: absolute;

    @media(max-width: 767px) {
      background-size: 400px;
    }
  }

  &::before {
    background-position: top right;
    transform: matrix(-1, 0, 0, 1, 0, 0);
  }

  &::after {
    background-position: top right;
    transform: matrix(1, 0, 0, -1, 0, 0);
  }

  &__container {
    position: relative;
    z-index: 1;

    @media(max-width: 767px) {
      padding-right: 0;
    }
  }

  &__suptitle {
    margin-bottom: 33px;
  }

  &__title {
    margin-bottom: 78px;
    @media(max-width: 767px) {
      padding-right: 20px;
    }
  }

  &__row {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
    margin-left: -12px;
    margin-right: -12px;
  }

  &__slider {
    margin: -30px 0;
  }

  &__footer {
    margin-top: 69px;
    text-align: center;
  }

}
</style>