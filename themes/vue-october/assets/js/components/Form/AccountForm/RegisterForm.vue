<template lang="pug">
  form(@submit.prevent="onRegister").form
    Loading(v-if="loader")
    template(v-else)
      ._row
        ._group.-full(:class="{ 'form__group--error': $v.form.name.$error }")
          input(
            type="text",
            placeholder="Ваше имя *"
            v-model.trim="form.name"
          )._control
          span._error(
            v-if="!$v.form.name.required"
          ) Укажите имя
          span._error(
            v-else-if="!$v.form.name.minLength"
          ) Не менее {{$v.form.name.$params.minLength.min}} символов

        ._group.-full(:class="{ 'form__group--error': $v.form.surname.$error }")
          input(
            type="text",
            placeholder="Ваша Фамилия *"
            v-model.trim="form.surname"
          )._control
          span._error(
            v-if="!$v.form.surname.required"
          ) Укажите фамилию
          span._error(
            v-if="!$v.form.surname.minLength"
          ) Не менее {{$v.form.surname.$params.minLength.min}} символов

        ._group.-full(:class="{ 'form__group--error': $v.form.email.$error }")
          input(
            type="text",
            placeholder="E-mail *"
            v-model.trim="form.email"
          )._control
          span._error(
            v-if="!$v.form.email.required"
          ) Укажите e-mail
          span._error(
            v-if="!$v.form.email.email"
          ) Некорректный e-mail

        ._group.-full(:class="{ 'form__group--error': $v.form.password.$error }")
          input(
            type="password",
            placeholder="Пароль *"
            v-model.trim="form.password"
          )._control
          button._show-password(type="button" @click="toggleInputType")
            icon(name="visible" component="form" data-js="show-password")._show-password-ico
            icon(name="unvisible" component="form" data-js="hide-password")._show-password-ico.-hide
          span._error(
            v-if="!$v.form.password.required"
          ) Укажите пароль
          span._error(
            v-if="!$v.form.password.minLength"
          ) Не менее {{$v.form.password.$params.minLength.min}} символов

        ._group.-full(:class="{ 'form__group--error': $v.form.password_confirmation.$error }")
          input(
            type="password",
            placeholder="Повторите пароль *"
            v-model.trim="form.password_confirmation"
          )._control
          button._show-password(type="button" @click="toggleInputType")
            icon(name="visible" component="form" data-js="show-password")._show-password-ico
            icon(name="unvisible" component="form" data-js="hide-password")._show-password-ico.-hide
          span._error(
            v-if="!$v.form.password_confirmation.sameAs"
          ) Пароли не совпадают!

      ._row.-align-center
        button._button.button(type='submit') Зарегистрироваться
        ._response.-error(v-if="error") {{ error }}

</template>
<script>
import { required, minLength, email, sameAs } from 'vuelidate/lib/validators'
import { toggleInputType } from '@vue/helpers/input';
import Loading from "@vue/components/Loading/Loading";

export default {
  name: "RegisterForm",
  components: {
    Loading
  },
  data() {
    return {
      form: {
        name: '',
        surname: '',
        username: '',
        email: '',
        password: '',
        password_confirmation: ''
      },
      loader: false
    }
  },
  props: {
    isModal: {
      type: Boolean,
      default: false
    }
  },
  validations: {
    form: {
      name: { required, minLength: minLength(4) },
      surname: {  required, minLength: minLength(4) },
      email: { required, email },
      password: { required, minLength: minLength(8) },
      password_confirmation: { sameAsPassword: sameAs('password') }
    }
  },
  watch: {
    error() {
      this.setLoading(false);
    }
  },
  computed: {
    error() {
      return this.$store.getters.getAuthError;
    }
  },
  methods: {
    onRegister() {
      this.$store.dispatch('setError', false);
      this.$v.$touch();
      if (this.$v.$invalid) return false;
      this.setLoading(true);
      this.$store.dispatch('registerUser', this.form);
    },

    setLoading(status) {
      this.loader = status;
    },

    toggleInputType(e) {
      toggleInputType(e);
    }
  }
}
</script>