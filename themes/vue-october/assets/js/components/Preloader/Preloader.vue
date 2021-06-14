<template lang="pug">
  transition(name="fade")
    .preloader
      ._inner
        ._lds-ripple.lds-ripple
          ._lds-waves.lds-waves
          ._lds-waves.lds-waves

</template>
<script>
export default {
  name: 'Preloader',

}
</script>
<style lang="scss">
@import "@/scss/vars.scss";
.preloader {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  display: flex;
  align-items: center;
  justify-content: center;
  background: #FFF;
  z-index: 1030;

  &__lds-ripple {
    width: 80px;
    height: 80px;
  }

  &__lds-waves {
    border-color:  $dark-color;
  }

}
.lds-ripple {
  display: inline-block;
  position: relative;
  width: 60px;
  height: 60px;
}

.lds-waves {
  position: absolute;
  border: 4px solid #FFF;
  opacity: 1;
  border-radius: 50%;
  animation: lds-ripple 1s cubic-bezier(0, 0.2, 0.8, 1) infinite;

  &:nth-child(2) {
    animation-delay: -0.5s;
  }
}

.fade-enter-active, .fade-leave-active {
  transition: opacity .5s;
}
.fade-enter, .fade-leave-to {
  opacity: 0;
}
@keyframes lds-ripple {
  0% {
    top: 36px;
    left: 36px;
    width: 0;
    height: 0;
    opacity: 1;
  }
  100% {
    top: 0px;
    left: 0px;
    width: 72px;
    height: 72px;
    opacity: 0;
  }
}
</style>