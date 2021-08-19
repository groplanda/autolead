<template lang="pug">
  form(@submit.prevent="onLogin").form
    Loading(v-if="loader")
    template(v-else)
      ._row
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

      ._row.-align-center
        button._button.button(type='submit') Войти
        ._response.-error(v-if="error") {{ error }}

</template>
<script>
import { required, email } from 'vuelidate/lib/validators';
import { toggleInputType } from '@vue/helpers/input';
import Popup from '@vue/components/Popup/Popup';
import Loading from "@vue/components/Loading/Loading";

export default {
  name: "LoginForm",
  components: {
    Popup,
    Loading
  },
  data() {
    return {
      form: {
        email: '',
        password: '',
      },
      loader: false
    }
  },
  validations: {
    form: {
      email: { required, email },
      password: { required }
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
    onLogin() {
      this.$store.dispatch('setError', false);
      this.$v.$touch();
      if (this.$v.$invalid) return false;
      this.setLoading(true);
      this.$store.dispatch('loginUser', this.form);

    },
    resetForm() {
      this.setSubmitStatus(null);
      this.$v.$reset();
      Object.keys(this.form).forEach(key => this.form[key] = '');
    },

    setLoading(status) {
      this.loader = status;
    },

    toggleInputType(e) {
      toggleInputType(e)
    }
  }
}
</script>