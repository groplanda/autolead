<template lang="pug">
  section.testimonials
    Popup(v-if="popup" @close="popup = false")
      AddTestimonial
    ._container.container
      ._row
        ._content
          .suptitle._suptitle
            icon(name="mark" component="about")._ico
            | наши клиенты
          h3._title.title.
            Отзывы наших клиентов

          button.button(type="button" @click="popup = true") Добавить отзыв

        carousel(:per-page="1.2" :loop="true" :scrollPerPage="false" :paginationEnabled="false" :perPageCustom="[[768, 2]]")._slider
          slide(v-for="(testimonial, index) in testimonials" :key="index")._item
            ._item-content
              p._item-description {{ testimonial.description }}
            ._item-footer
              img(
                  :src="testimonial.avatar"
                  :alt="testimonial.name"
                )._item-avatar
              span._item-name {{ testimonial.name }}
</template>
<script>

import { Carousel, Slide } from 'vue-carousel';
import Popup from '@vue/components/Popup/Popup.vue'
import AddTestimonial from './AddTestimonial.vue';
export default {
  name: 'Testimonials',
  components: {
    Carousel,
    Slide,
    Popup,
    AddTestimonial
  },
  data() {
    return {
      popup: false
    }
  },
  computed: {
    testimonials () {
      return this.$store.getters.getTestimonials;
    },
  },
  mounted() {
    this.$store.dispatch('fetchTestimonials');
  },
}
</script>
<style lang="scss">
.testimonials {
  padding-bottom: 210px;

  @media(max-width: 991px) {
    padding-bottom: 160px;
  }

  @media(max-width: 767px) {
    padding-bottom: 130px;
  }

  &__container {
    @media(max-width: 767px) {
      padding-right: 0;
    }
  }

  &__row {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    flex-wrap: wrap;
  }

  &__content {
    max-width: 324px;
    flex: 1 1 324px;
    margin-right: 24px;
    @media(max-width: 1199px) {
      max-width: 260px;
      flex: 1 1 260px;
      margin-right: 20px;
    }
    @media(max-width: 991px) {
      max-width: 100%;
      flex: 1 1 100%;
      margin-right: 0;
    }
  }

  &__title {
    margin-bottom: 20px;
  }

  &__slider {
    max-width: calc(100% - 348px);
    flex: 1 1 calc(100% - 348px);

    @media(max-width: 1199px) {
      max-width: calc(100% - 280px);
      flex: 1 1 calc(100% - 280px);
    }

    @media(max-width: 991px) {
      max-width: 100%;
      flex: 1 1 100%;
    }
  }

  &__item {
    padding: 47px 44px 40px 44px;
    @media(max-width: 991px) {
      padding: 30px 20px;
    }
  }

  &__item-content {
    margin-bottom: 18px;
    min-height: 189px;
  }

  &__item-description {
    font-size: 15px;
  }

  &__item-footer {
    display: flex;
    align-items: center;
  }

  &__item-avatar {
    width: 48px;
    height: 48px;
    border-radius: 24px;
    object-fit: cover;
    margin-right: 17px;
  }
  &__item-name {
    font-weight: bold;
  }
}
</style>
