<template lang="pug">
  transition(name="fade" appear)
    .popup(:class="scrollClass")
      ._dialog(:class="[className, popupFull]")
        ._content
          button(type="button" @click="onClose" v-if="showClose")._close
            <svg viewBox="0 0 14 14" class="popup__close-ico icon-popup-close ">
              <path d="M14 1.41L12.59 0L7 5.59L1.41 0L0 1.41L5.59 7L0 12.59L1.41 14L7 8.41L12.59 14L14 12.59L8.41 7L14 1.41Z" fill="currentColor"></path>
            </svg>
          slot
</template>
<script>

export default {
  name: "Popup",
  props: {
    showClose: {
      type: Boolean,
      default: true
    },
    className: {
      type: String,
      default: ''
    },
    fullscreen: {
      type: Boolean,
      default: false
    },
    hasSroll: {
      type: Boolean,
      default: false
    }
  },
  computed: {
    popupFull() {
      return {
        'popup__dialog_full': this.fullscreen
      }
    },
    scrollClass() {
      return {
        'popup_scroll': this.hasSroll
      }
    }
  },
  methods: {
    onClose() {
      this.$emit('close');
    },
    getScrollBarWith() {
      const documentWidth = parseInt(document.documentElement.clientWidth);
      const windowsWidth = parseInt(window.innerWidth);
      return windowsWidth - documentWidth;
    },
    setOffset(elem, width) {
      elem.style.paddingRight = `${width}px`;
    }
  },
  created() {
    const width  = this.getScrollBarWith();
    document.body.classList.add('open-modal');
    this.setOffset(document.body, width);
  },
  mounted() {
    this.$el.classList.add("popup--show");
  },
  destroyed() {
    this.$el.classList.remove("popup--show");
    setTimeout(() => {
    this.setOffset(document.body, 0);
    document.body.classList.remove('open-modal');
    }, 500)
  },
}
</script>
<style lang="scss">
.popup {
  z-index: 1050;
  position: fixed;
  top: 0;
  right: 0;
  bottom: 0;
  left: 0;
  background: rgba($color: #000, $alpha: .7);

  &_scroll {
    overflow-x: hidden;
    overflow-y: auto;
  }

  $root: &;

  &__dialog {
    max-width: 585px;
    min-height: calc(100% - 40px);
    margin: 20px auto;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all .3s ease;

    @media(max-width: 624px) {
      max-width: calc(100% - 40px);
    }

    &_video {
      max-width: 1024px;

      @media(max-width: 1064px) {
        max-width: calc(100% - 40px);
      }

      #{$root} {
        &__content {
          padding: 0;
          background: #000;
        }
        &__close-ico {
          color: #FFF;

          &:hover, &:focus, &:active {
            color: #f1f1f1;
          }
        }
      }
    }
    &_full {
      max-width: 100%;
      width: auto;
      height: 100%;
      min-height: auto;
      margin: 0;
      #{$root} {
        &__content {
          height: 100%;
        }
      }
    }

    &_large {
      max-width: 1200px;
      @media(max-width: 1199px) {
        max-width: calc(100% - 40px);
      }
      @media(max-width: 767px) {
        max-width: calc(100% - 20px);
      }
    }
  }

  &__content {
    width: 100%;
    padding: 76px 57px;
    background: #FFF;
    position: relative;

    @media(max-width: 991px) {
      padding: 60px 40px;
    }

    @media(max-width: 767px) {
      padding: 60px 30px;
    }

    @media(max-width: 575px) {
      padding: 40px 20px;
    }
  }

  &__close {
    position: absolute;
    width: 20px;
    height: 20px;
    top: 20px;
    right: 20px;
    cursor: pointer;
    z-index: 3;
  }

  &__close-ico {
    width: 100%;
    height: 100%;
    transition: color .2s ease;
  }

}
.fade-enter-active, .fade-leave-active {
  transition: opacity .5s;
}

.fade-enter, .fade-leave-to {
  opacity: 0;
}

</style>
