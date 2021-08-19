<template lang="pug">
  form(@submit.prevent="onEditCar").form.-modal
    Loading(v-if="loading")
    template(v-else)
      h5._title.title Изменить авто
      ._row
        ._group(:class="{ 'form__group--error': brandErr }")
          input(
            type="text",
            placeholder="Марка авто*"
            v-model.trim="form.brand"
          )._control
          span._error( v-if="brandErr") {{ brandErr }}

        ._group(:class="{ 'form__group--error': modelErr }")
          input(
            type="text",
            placeholder="Модель авто*"
            v-model.trim="form.model"
          )._control
          span._error( v-if="modelErr") {{ modelErr }}

        ._group(:class="{ 'form__group--error': yearErr }")
          input(
            type="text",
            placeholder="Год выпуска*"
            v-model.trim="form.year"
          )._control
          span._error( v-if="yearErr") {{ yearErr }}

        ._group(:class="{ 'form__group--error': colorErr }")
          input(
            type="text",
            placeholder="Цвет авто*"
            v-model.trim="form.color"
          )._control
          span._error(v-if="colorErr") {{ colorErr }}

        ._group.-full(:class="{ 'form__group--error': vinErr }")
          input(
            type="text",
            placeholder="VIN авто"
            v-model.trim="form.vin"
          )._control
          span._error( v-if="vinErr") {{ vinErr }}

        ._group.-full(:class="{ 'form__group--error': descriptionErr }")
          textarea(
            placeholder="Описание авто"
            v-model.trim="form.description"
          )._control.-textarea
          span._error( v-if="descriptionErr") {{ descriptionErr }}
      ._row
        UploadImage(:gallery="gallery" @addToGallery="addToGallery" @removeImage="removeImage" text="Изменить фото")
      ._row.-align-center
        button._button.button(type="submit") Обновить
        button.button(type="button" @click="$emit('cancelEditForm', false)") Отменить

</template>
<script>
import axios from "axios";
import { onValidate, checkErr, createFormData, createFormState } from '@vue/helpers/validate.js';
import Loading from '@vue/components/Loading/Loading';
import UploadImage from '@vue/components/Form/UploadImage/UploadImage';


export default {
  name: "EditCarForm",
  components: {
    Loading,
    UploadImage
  },
  props: {
    user: {
      type: Object,
      required: true
    },
    vehicle: {
      type: Object,
      required: true
    }
  },
  data() {
    return {
      form: {},
      errors: [],
      gallery: [],
      loading: false
    }
  },

  computed: {
    brandErr() {
      return checkErr('brand', this.errors);
    },

    modelErr() {
      return checkErr('model', this.errors);
    },

    yearErr() {
      return checkErr('year', this.errors);
    },

    colorErr() {
      return checkErr('color', this.errors);
    },

    descriptionErr() {
      return checkErr('description', this.errors);
    },

    vinErr() {
      return checkErr('vin', this.errors);
    }
  },
  methods: {
    onValidate(response) {
      this.errors = onValidate(response, this.form);
    },
    onEditCar() {
      this.errors = [];
      this.loading = true;
      const keys = ['id', 'brand', 'model', 'year', 'color', 'vin', 'description', 'image', 'user_id'];
      axios.post(
      `/api/account/${this.user.id}/cars/update`,
      createFormData(keys, this.prepareFormData(this.form, this.gallery)),
      {
        headers: {
          'Content-Type': 'multipart/form-data'
        }
      })
        .then(response => {
          const data = response.data;
          this.loading = false;
          if (data.status === "error") {
            this.onValidate(data);
          } else if(data.status === 'success') {
            this.$router.push({ name: "account-cars", query: { message: data.message, type: 'success' }} );
          }
        })
        .catch(error => {
          console.log(error);
        })
    },
    addToGallery(data) {
      const {image, preview } = data;
      this.form.image = image;
      this.gallery.push(preview);
      this.gallery = this.gallery.slice(-1);
    },
    removeImage(index) {
      this.form.image = "";
      this.gallery.splice(index, 1);
    },
    prepareFormData(data, gallery) {
      let newForm = data;
      if(gallery.length === 0) newForm.image = "remove";
      return newForm;
    }
  },
  created() {
    const { items, gallery } = createFormState(this.vehicle, 'image');
    this.form = items;
    this.gallery = gallery;
    this.form.user_id = this.user.id;
  }
}
</script>