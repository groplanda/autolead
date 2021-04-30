<template lang="pug">
  .faq
    ._title Часто задаваемые вопросы
    ._list
      ._item(v-for="(item, idx) in faq" :key="idx")
        ._item-heading(@click="toggleFaq(idx)")
          ._item-title {{ item.question }}
          ._item-btn
            icon(name="faq" component="about")._item-ico
        ._item-body(v-html="item.answer")
</template>
<script>
export default {
  name: "Faq",
  data() {
    return {
      activeFaq: null,
      faqActiveClass: 'faq__item--active'
    }
  },
  computed: {
    faq() {
      return this.$store.getters.getFaq;
    }
  },
  methods: {
    toggleFaq(idx) {
      this.activeFaq = idx;

      const faq = event.target.closest('.faq__item');
      const faqBody = faq.querySelector('.faq__item-body');
      faq.classList.toggle(this.faqActiveClass);

      this.hideFaqs();

      if (faq.classList.contains(this.faqActiveClass)) {
        faqBody.style.height = faqBody.scrollHeight + 20 + 'px';
      } else {
        faqBody.style.height = 0;
      }
    },

    hideFaqs() {
      const faqs = document.querySelectorAll('.faq__item');

      for(let i = 0; i < faqs.length; i++) {
        if(i !== this.activeFaq && this.activeFaq !== null) {
          faqs[i].classList.remove(this.faqActiveClass);
          faqs[i].querySelector('.faq__item-body').style.height = 0;
        }
      }

    }
  },
  mounted() {
    this.$store.dispatch('fetchFaq');
  },

}
</script>
<style lang="scss">
@import "@/scss/vars.scss";
.faq {

  $root: &;

  &__title {
    font-size: 36px;
    line-height: 42px;
    margin-bottom: 70px;
    @media(max-width: 1199px) {
      font-size: 28px;
      line-height: 34px;
      margin-bottom: 40px;
    }
    @media(max-width: 767px) {
      font-size: 26px;
      line-height: 32px;
      margin-bottom: 30px;
    }
    @media(max-width: 575px) {
      font-size: 22px;
      line-height: 28px;
    }
    @media(max-width: 349px) {
      font-size: 20px;
      line-height: 26px;
    }
  }

  &__item {
    background: #FFF;
    margin-bottom: 15px;
    padding: 0 40px;
    box-shadow: 0px 5px 48px rgba(49, 47, 47, 0.1);
    border-radius: 43px;
    transition: all .3s ease;

    &:last-child {
      margin-bottom: 0;
    }

    &--active {
      border-radius: 10px;

      #{$root} {
        &__item-btn {
          transform: rotate(180deg);
        }
      }
    }

    @media(max-width: 767px) {
      padding: 0 25px;
    }
  }

  &__item-heading {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 15px 0;
    cursor: pointer;
  }

  &__item-title {
    width: 100%;
    max-width: calc(100% - 42px);
    color: $text-color;
    font-size: 20px;
    line-height: 24px;
    font-weight: 700;
    @media(max-width: 1199px) {
      font-size: 18px;
      line-height: 21px;
    }
    @media(max-width: 767px) {
      font-size: 16px;
      line-height: 19px;
    }
  }

  &__item-btn {
    width: 32px;
    height: 32px;
    background: $red-color;
    border-radius: 16px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    transition: transform .2s ease;
    @media(max-width: 767px) {
      width: 28px;
      height: 28px;
    }
  }

  &__item-ico {
    color: #FFF;
    width: 13px;
    height: 9px;
    @media(max-width: 767px) {
      width: 11px;
      height: 8px;
    }
  }

  &__item-body {
    height: 0;
    overflow: hidden;
    transition: all .3s ease;

    p {
      color: $text-color;
      font-size: 15px;
      line-height: 18px;

      @media(max-width: 767px) {
        font-size: 14px;
      }
    }

  }
}
</style>