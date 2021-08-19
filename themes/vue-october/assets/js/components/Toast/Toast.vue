<template lang="pug">
  .toast(:class="toastClassname" @click="$emit('closeToast')") {{ message }}


</template>
<script>
export default {
  name: "Toast",
  props: {
    message: {
      type: String,
      required: true
    },
    className: {
      type: String,
      default: "primary"
    }
  },
  computed: {
    toastClassname() {
      return {
        'toast--error': this.className === "error",
        'toast--success': this.className === "success",
        'toast--warn': this.className === "warn"
      }
    }
  }
}
</script>
<style lang="scss">
@import '@/scss/vars.scss';
.toast {
  border-radius: 2px;
  display: inline-flex;
  align-items: center;
  justify-content: center;
  height: 36px;
  line-height: 36px;
  padding: 0 16px;
  text-transform: uppercase;
  color: #FFF;
  font-size: 12px;
  position: fixed;
  top: 7%;
  right: 14%;
  background: $dark-color;
  z-index: 1030;
  cursor: pointer;

  &--error {
    background: $red-color;
  }

  &--success {
    background: $green-color;
  }

  &--warn {
    background: $grey-color;
  }
}
</style>