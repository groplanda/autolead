<template lang="pug">
  .select-city
    h5._title.title Выберите ваш город:
    form(@submit.prevent="onConfirm")._form
      ._row
        ._input(
          :data-id="city.id"
          :class="{ 'select-city__input_active': city.selected }"
          @click="onSelect(city.id)"
          v-for="city in cities"
          :key="city.id"
          )
          span._radio
          | {{ city.name }}

      button.button._button(type="submit") Применить
</template>
<script>
export default {
  name: 'SelectCity',
  data() {
    return {
      selectedTownId: null
    }
  },
  computed: {
    cities() {
      return this.$store.getters.getTowns;
    }
  },
  methods: {
    onSelect (id) {
      const inputs = document.querySelectorAll('[data-id]'),
            selectedInput = document.querySelector(`[data-id="${id}"]`),
            activeClass = 'select-city__input_active';

      inputs.forEach(i => i.classList.remove(activeClass));
      selectedInput.classList.add(activeClass);

      this.selectedTownId = id;


    },
    onConfirm () {
      const id = this.selectedTownId;
      if (id) {
        this.$store.dispatch('selectTownById', id);
        localStorage.townId = id;
      }
      this.$store.dispatch('setPopup', false);
    }
  }
}
</script>
<style lang="scss">
  .select-city {

    $root: &;

    &__title {
      text-align: center;
      margin-bottom: 30px;
    }

    &__form {
      display: flex;
      flex-direction: column;
      align-items: center;
    }

    &__row {
      display: flex;
      align-items: center;
      justify-content: center;
      margin-bottom: 15px;
    }

    &__input {
      font-size: 16px;
      line-height: 16px;
      color: #02133C;
      position: relative;
      display: flex;
      align-items: center;
      cursor: pointer;
      margin: 0 15px 15px;

      &_active {
        #{$root} {
          &__radio {
            &::after {
              width: 10px;
              height: 10px;
            }
          }
        }
      }
    }

    &__radio {
      width: 20px;
      height: 20px;
      margin-right: 10px;
      border-radius: 10px;
      border: 2px solid #02133C;
      position: relative;

      &::after {
        content: '';
        position: absolute;
        width: 0;
        height: 0;
        background: #02133C;
        transform: translate(-50%, -50%);
        top: 50%;
        left: 50%;
        border-radius: 50%;
        transition: width .2s linear .1s, height .2s linear .1s;
        z-index: 1;
      }
    }

    &__button {
      width: 100%;
      max-width: 250px;
    }
  }
</style>