<template lang="pug">
  form(@submit.prevent="onSend" :class="formClassname").form
    h3._title.title Оставьте заявку
    ._row
      ._group(:class="{ 'form__group--error': $v.form.name.$error || nameErr, 'form__group--success': $v.form.name.$anyDirty && !$v.form.name.$anyError && !nameErr }")
        input(
          type="text",
          placeholder="Ваше имя*"
          v-model.trim="form.name"
        )._control
        span._error(
          v-if="!$v.form.name.required"
        ) Укажите имя
        span._error(
          v-else-if="!$v.form.name.minLength"
        ) Не менее {{$v.form.name.$params.minLength.min}} символов
        span._error( v-if="nameErr") {{ nameErr }}
      ._group(
        v-if="!isModal"
        :class="{ 'form__group--error': $v.form.email.$error || emailErr }"
      )
        input(
          type="text",
          placeholder="E-mail"
          v-model.trim="form.email"
        )._control
        span._error(
          v-if="!$v.form.email.email"
        ) Некорректный e-mail
        span._error( v-if="emailErr") {{ emailErr }}
      ._group(
        :class="{ 'form__group--error': $v.form.phone.$error || phoneErr, 'form__group--success': $v.form.phone.$anyDirty && !$v.form.phone.$anyError && !phoneErr }"
      )
        input(
          type="text",
          placeholder="Ваш номер телефона*"
          v-model.trim="form.phone"
          v-mask="'+7 (###) ###-##-##'"
        )._control
        span._error(
          v-if="!$v.form.phone.required"
        ) Укажите номер телефона
        span._error(
          v-else-if="!$v.form.phone.minLength"
        ) Укажите корректно номер телефона
        span._error( v-if="phoneErr") {{ phoneErr }}
      ._group(
        v-if="!isModal"
        :class="{ 'form__group--error': questionErr }"
        )
        input(
          type="text",
          placeholder="Ваш вопрос"
          v-model.trim="form.question"
        )._control
        span._error( v-if="questionErr") {{ questionErr }}
      ._group.-full(
        :class="{ 'form__group--error': $v.form.content.$error || contentErr }"
        )
        textarea(
          placeholder="Ваше сообщение"
          v-model.trim="form.content"
        )._control.-textarea

        span._error(
          v-if="!$v.form.content.minLength"
        ) Не менее {{$v.form.content.$params.minLength.min}} символов
        span._error(
          v-else-if="!$v.form.content.maxLength"
        ) Не более {{$v.form.content.$params.maxLength.max}} символов
        span._error( v-if="contentErr") {{ contentErr }}
    ._row.-align-center
      button._button.button(type='submit')
        | {{ submitMsg === 'PENDING' ? 'Отправка...' : 'Отправить' }}
        icon(name="wheel" component="form"  v-if="submitMsg === 'PENDING'")._loading
      ._response.-success(v-if="result") {{ result }}

</template>
<script>
import { required, minLength, maxLength, email } from 'vuelidate/lib/validators'
import { onValidate, checkErr } from '@vue/helpers/validate.js';

export default {
  name: 'ContactForm',
  props: {
    isModal: {
      type: Boolean,
      default: false
    }
  },
  data() {
    return {
      form: {
        name: '',
        email: '',
        phone: '',
        question: '',
        content: ''
      },
      submitStatus: null,
      errors: []
    }
  },
  validations: {
    form: {
      name: { required, minLength: minLength(4) },
      email: { email },
      phone: { required, minLength: minLength(18) },
      content: {  minLength: minLength(20), maxLength: maxLength(250) }
    }

  },
  computed: {
    formClassname() {
      return {
        'form--shadow': this.isModal == false
      }
    },
    result() {
      let message = ''
      const response = this.$store.getters.getResult;

      if(response.status === 'error') {
        this.onValidate(response)
        this.setSubmitStatus(null);

      } else if(response.status === 'success') {
        message = response.message;
        this.resetForm();
      }

      return message;

    },

    nameErr() {
      return checkErr('name', this.errors);
    },

    phoneErr() {
      return checkErr('phone', this.errors);
    },

    questionErr() {
      return checkErr('question', this.errors);
    },

    emailErr() {
      return checkErr('email', this.errors);
    },

    contentErr() {
      return checkErr('content', this.errors);
    },

    submitMsg () {
      return this.submitStatus;
    }

  },
  methods: {
    onSend() {
      this.errors = [];
      this.$v.$touch();
      if (this.$v.$invalid) return false;

      this.setSubmitStatus('PENDING');
      this.$store.dispatch('sendMessage', this.form);

    },
    resetForm() {
      this.errors = [];
      this.setSubmitStatus(null);
      this.$v.$reset();
      Object.keys(this.form).forEach(key => this.form[key] = '');
    },

    onValidate(response) {
      this.errors = onValidate(response, this.form);
    },

    setSubmitStatus(status) {
      this.submitStatus = status;
    }
  }
}
</script>
<style lang="scss">
@import '@/scss/vars.scss';
@import '@/scss/mixins.scss';
.form {
  background: #FFFFFF;

  $root: &;

  &--shadow {
    flex: 0 1 585px;
    padding: 76px 57px;
    box-shadow: 0px 2px 4px rgba(38, 38, 38, 0.24), 0px 4px 8px rgba(38, 38, 38, 0.2);

    @media(max-width: 991px) {
      padding: 50px 25px;
    }

    @media(max-width: 767px) {
      max-width: 100%;
      flex: 1 1 100%;
      order: 1;
    }

    @media(max-width: 575px) {
      padding: 50px 25px;
    }
  }

  &__title {
    text-align: center;
    margin-bottom: 48px;
  }
  &__row {
    display: flex;
    flex-wrap: wrap;
    margin: 0 -11px;

    &--align-center {
      align-items: center;
    }

    @media(max-width: 575px) {
      margin: 0;
    }
  }
  &__group {
    max-width: calc(50% - 22px);
    flex: 1 1 calc(50% - 22px);
    margin: 0 11px 22px 11px;

    &--full {
      max-width: calc(100% - 22px);
      flex: 1 1 calc(100% - 22px);
    }

    &--error {
      #{$root} {
        &__control {
          border-color: $red-color;
        }
        &__error {
          display: block;
        }
        &__label {
          &--file {
            border-color: $red-color;
          }
        }
        &__file-ico {
          color: $red-color;
        }
      }
    }

    &--success {
      #{$root} {
        &__control {
          border-color: #4cf17e;
          background-image: url("data:image/svg+xml;base64,PHN2ZyB2aWV3Qm94PSIwIDAgMTggMTQiIGZpbGw9Im5vbmUiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+CiAgPHBhdGggZD0iTTUuNzk1MDggMTAuODc1TDEuNjI1MDggNi43MDVMMC4yMDUwNzggOC4xMTVMNS43OTUwOCAxMy43MDVMMTcuNzk1MSAxLjcwNUwxNi4zODUxIDAuMjk0OTk4TDUuNzk1MDggMTAuODc1WiIgZmlsbD0iIzRjZjE3ZSIvPgo8L3N2Zz4K");
          background-size: 16px;
          background-repeat: no-repeat;
          background-position: right 13px center;
        }
      }
    }

    @media(max-width: 575px) {
      margin: 0 0 20px 0;
      max-width: 100%;
      flex: 100%;
    }
  }

  &__control {
    font-size: 16px;
    line-height: 16px;
    color: $dark-color;
    letter-spacing: 0.15px;
    background-color: #f1f1f1;
    padding: 15px 23px;
    border: 1px solid #f1f1f1;
    transition: border-color .3s ease;

    &--textarea {
      height: 180px;
      resize: none;
    }

    @include placeholder($light-color);
  }

  &__error {
    margin-top: 3px;
    font-size: 12px;
    line-height: 14px;
    color: $red-color;
    display: none;
  }

  &__button {
    display: inline-flex;
    align-items: center;
    margin-top: 5px;
    padding: 13px 30px 11px 30px;
    margin: 0 11px;
  }

  &__response {
    font-size: 14px;
    font-weight: 700;
    line-height: 16px;
    margin: 0 11px;

    &--error {
      color: $red-color;
    }

    &--success {
      color: $dark-color;
    }
  }

  &__loading {
    margin-left: 10px;
    width: 20px;
    height: 20px;
    color: #FFF;
    fill: #FFF;
    animation: loading 2s linear infinite;
  }

  &__label {

    &--file {
      color: $dark-color;
      font-size: 16px;
      line-height: 16px;
      letter-spacing: 0.15px;
      cursor: pointer;
      position: relative;
      width: 100%;
      height: 50px;
      padding: 0 0 0 70px;
      display: flex;
      align-items: center;
      background-color: #f1f1f1;
      border: 1px solid #f1f1f1;
    }

    &--success {
      #{$root} {
        &__file-ico {
          color: #4cf17e;
        }
      }
    }
  }

  &__file-input {
    position: absolute;
    height: 1px;
    width: 1px;
    padding: 0;
    overflow: hidden;
    clip: rect(0, 0, 0, 0);
    z-index: -1;
  }

  &__file-btn {
    width: 24px;
    height: 24px;
    position: absolute;
    left: 23px;
    top: calc(50% - 12px);
    display: flex;
    align-items: center;
    justify-content: center;

    &--remove {
      left: auto;
      right: 23px;

      #{$root} {
        &__file-ico {
          color: $red-color;
        }
      }
    }
  }

  &__file-ico {
    color: $dark-color;
    width: 100%;
    height: 100%;
  }

  &__preview {
    max-width: 100px;
    position: relative;

    &::after {
      display: block;
      content: '';
      padding-top: 100%;
    }
  }

  &__preview-thumb {
    width: 100%;
    height: 100%;
    position: absolute;
    left: 0;
    top: 0;
    object-fit: cover;
    border-radius: 50px;
    box-shadow: 0px 2px 4px rgba(38, 38, 38, 0.24), 0px 4px 8px rgba(38, 38, 38, 0.2);
  }

  @keyframes loading {
    0% {
        transform:rotate(0deg);
    }
    100% {
        transform:rotate(360deg);
    }
  }

}
</style>