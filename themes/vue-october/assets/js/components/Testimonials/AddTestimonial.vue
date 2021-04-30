<template lang="pug">
  .add-testimonial

    form(@submit.prevent="onSend").form.-modal
      h5._title.title Добавить отзыв
      ._row
        ._group.-full(:class="{ 'form__group--error': $v.form.name.$error || nameErr  }")
          input(
            type="text",
            placeholder="Как вас зовут?*"
            v-model.trim="form.name"
          )._control
          span._error(
            v-if="!$v.form.name.required"
          ) Укажите имя
          span._error(
            v-else-if="!$v.form.name.minLength"
          ) Не менее {{$v.form.name.$params.minLength.min}} символов
          span._error( v-if="nameErr") {{ nameErr }}

        ._group.-full(:class="{ 'form__group--error': $v.form.description.$error || descrErr }")
          textarea(
            placeholder="Ваш отзыв*"
            v-model.trim="form.description"
          )._control.-textarea
          span._error(
            v-if="!$v.form.description.required"
          ) Напишите текст отзыва
          span._error(
            v-if="!$v.form.description.minLength"
          ) Не менее {{$v.form.description.$params.minLength.min}} символов
          span._error(
            v-else-if="!$v.form.description.maxLength"
          ) Не более {{$v.form.description.$params.maxLength.max}} символов
          span._error( v-if="descrErr") {{ descrErr }}

        transition(name="slide")
          ._group.-full(v-if="previewImg")
            ._preview
              img(:src="previewImg", alt="preview")._preview-thumb
        ._group.-full(:class="{ 'form__group--error': avatarErr }")
          label._label.-file(:class="labelClass")
            ._file-btn
              icon(name="attach" component="form")._file-ico
            ._file-name {{ previewName }}
            input(type="file" id="file" @change="handleFileUpload")._file-input
            ._file-btn.-remove(v-if="deletePreview" @click.prevent="removePreview")
              icon(name="remove" component="form")._file-ico

          span._error( v-if="avatarErr") {{ avatarErr }}

      ._row.-align-center
        button._button.button(type='submit')
          | {{ submitStatus === 'PENDING' ? 'Отправка...' : 'Добавить' }}
          icon(name="wheel" component="form"  v-if="submitStatus === 'PENDING'")._loading
        ._response.-success(v-if="result") {{ result }}

</template>
<script>
import { required, minLength, maxLength } from 'vuelidate/lib/validators';
import { onValidate, checkErr } from '@vue/helpers/validate.js';
export default {
  name: 'AddTestimonial',
  data() {
    return {
      form: {
        name: '',
        description: '',
        avatar: '',
      },
      previewPlaceholder: 'Добавьте фото*',
      deletePreview: false,
      previewSrc: '',
      submitStatus: null,
      errors: []
    }
  },
  validations: {
    form: {
      name: {
        required,
        minLength: minLength(4),
      },
      description: {
        required,
        minLength: minLength(20),
        maxLength: maxLength(250)
      },
    }

  },
  computed: {
    nameErr() {
      return checkErr('name', this.errors);
    },

    descrErr() {
      return checkErr('description', this.errors);
    },

    avatarErr() {
      return checkErr('avatar', this.errors);
    },

    result() {
      let message = ''
      const response = this.$store.getters.getTestimonialResponse;

      if(response.status === 'error') {
        this.onValidate(response)
        this.setSubmitStatus(null);

      } else if(response.status === 'success') {
        message = response.message;
        this.resetForm();
      }

      return message;
    },

    previewName() {
      if ((this.form.avatar.length > 0) && 'name' in this.form.avatar[0]) {
        return this.form.avatar[0].name;
      }

      return this.previewPlaceholder;
    },

    previewImg() {
      return this.previewSrc;
    },

    labelClass() {
      return {
        'form__label--success': this.deletePreview && !this.avatarErr
      }
    }
  },

  methods: {
    handleFileUpload(e) {
      this.form.avatar = Array.from(e.target.files);

      let reader  = new FileReader();

      reader.addEventListener("load", function () {
        this.deletePreview = true;
        this.previewSrc = reader.result;
      }.bind(this), false);

      if( this.form.avatar ){
        if ( /\.(jpe?g|png|gif)$/i.test( this.form.avatar[0].name )) {
          reader.readAsDataURL( this.form.avatar[0] );
        }
      }
    },

    onValidate(response) {
      this.errors = onValidate(response, this.form);
    },

    setSubmitStatus(status) {
      this.submitStatus = status;
    },

    removePreview() {
      this.deletePreview = false;
      this.previewSrc = '';
      this.form.avatar = '';
    },

    onSend() {
      this.errors = [];
      this.$v.$touch();
      if (this.$v.$invalid) {
        return false;
      } else {
        this.submitStatus = 'PENDING';
        this.$store.dispatch('AddTestimonial', this.form);
      }
    },

    resetForm() {
      this.errors = [];
      this.submitStatus = false;
      this.removePreview();
      this.$v.$reset();
      Object.keys(this.form).forEach(key => this.form[key] = '');
    }

  }
}
</script>
<style lang="scss">
.slide-enter-active {
  transition: .3s ease-in;
}
.slide-leave-active {
  transition: .3s cubic-bezier(0, 1, 0.5, 1);
}
.slide-enter-to, .slide-leave {
   overflow: hidden;
   max-height: 100px;
}
.slide-enter, .slide-leave-to {
   overflow: hidden;
   max-height: 0;
}
</style>