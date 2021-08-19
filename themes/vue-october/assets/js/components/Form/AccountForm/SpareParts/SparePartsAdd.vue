<template lang="pug">
  .spare-parts
    form.form.-modal(v-if="showForm" @submit.prevent="addSparePart")
      ._row
        ._group(:class="{ 'form__group--error': $v.name.$error }")
          input(
            type="text",
            placeholder="Наименование запчасти"
            v-model.trim="name"
          )._control
          span._error( v-if="!$v.name.required") Обязательно к заполнению
          span._error( v-if="!$v.name.minLength") Не менее {{$v.name.$params.minLength.min}} символов

        ._group(:class="{ 'form__group--error': $v.cost.$error }")
          input(
            type="text",
            placeholder="Стоимость запчасти"
            v-model.trim="cost"
          )._control
          span._error( v-if="!$v.cost.required") Обязательно к заполнению
          span._error( v-if="!$v.cost.integer") Только цифры

        ._group.-full
          textarea(
            placeholder="Описание запчасти"
            v-model.trim="info"
          )._control.-textarea
        ._row.-align-center
          button._button.button(type="submit") Сохранить
          button._button.button(type="button" @click="showForm = false") Отменить

    button._button.button(type="button" v-else @click="showForm = true") Добавить запчасть
</template>
<script>
import { required, minLength, integer } from 'vuelidate/lib/validators'

export default {
  name: "SparePartsAdd",
  data() {
    return {
      showForm: false,
      name: "",
      cost: "",
      info: ""
    }
  },
  validations: {
    name: { required, minLength: minLength(4) },
    cost: {  required, integer }
  },
  methods: {
    addSparePart() {
      this.$v.$touch();
      if (this.$v.$invalid) return false;
      const data = {
        name: this.name,
        cost: this.cost,
        info: this.info
      };
      this.$emit("addSparePart", data);
      this.resetForm();
    },
    resetForm() {
      this.$v.$reset();
      this.showForm = false;
      const keys = ['name', 'cost', 'info'];
      keys.forEach(key => this[key] = "");
    }
  }
}
</script>
