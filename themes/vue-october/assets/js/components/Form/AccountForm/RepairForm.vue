<template lang="pug">
  form(@submit.prevent="onAddRepair" enctype="multipart/form-data").form.-modal
    Loading(v-if="loading")
    template(v-else)
    h5._title.title Добавить ремонт
    ._row
      ._group(:class="{ 'form__group--error': titleErr }")
        input(
          type="text",
          placeholder="Название ремонта (кратко)*"
          v-model.trim="form.title"
        )._control
        span._error( v-if="titleErr") {{ titleErr }}

      ._group(:class="{ 'form__group--error': standingErr }")
        FormDropdown(placeholder="Статус ремонта*" :inputVal="form.standing" :dropdownList="standingList" @selectDropdown="form.standing = $event")
        span._error( v-if="standingErr") {{ standingErr }}

      ._group(:class="{ 'form__group--error': mileageErr }")
        input(
          type="text",
          placeholder="Пробег на момент ремонта*"
          v-model.trim="form.mileage"
        )._control
        span._error( v-if="mileageErr") {{ mileageErr }}

      ._group(:class="{ 'form__group--error': priceErr }")
        input(
          type="text",
          placeholder="Стоимость ремонта*"
          v-model.trim="form.price"
        )._control
        span._error(v-if="priceErr") {{ priceErr }}

      ._group.-full(:class="{ 'form__group--error': descriptionErr }")
        textarea(
          placeholder="Описание ремонта (подробно)"
          v-model.trim="form.description"
        )._control.-textarea
        span._error( v-if="descriptionErr") {{ descriptionErr }}
    ._row
      UploadImage(:gallery="images" @addToGallery="addToGallery" @removeImage="removeImage" :multiply="true")
      span._error( v-if="imagesErr") {{ imagesErr }}
    ._row.-full
      SparePartList(:spareParts="form.spare_parts" @removeSparePart="removeSparePart")
      SparePartsAdd(@addSparePart="addSparePart")
    ._row.-align-center
      button._button.button(type='submit') Добавить ремонт
</template>
<script>

import axios from "axios";
import { onValidate, checkErr, fillForm, createFormData } from '@vue/helpers/validate.js';
import Loading from '@vue/components/Loading/Loading';
import UploadImage from '@vue/components/Form/UploadImage/UploadImage';
import SparePartList from './SpareParts/SparePartsList';
import SparePartsAdd from './SpareParts/SparePartsAdd';
import FormDropdown from '@vue/components/Form/FormComponents/FormDropdown';

export default {
  name: "RepairForm",
  components: {
    Loading,
    UploadImage,
    SparePartList,
    SparePartsAdd,
    FormDropdown
  },
  props: {
    vehicleId: {
      type: Number,
      required: true
    },
    repair: {
      type: Object,
      default() {
        return {}
      }
    }
  },
  data() {
    return {
      form: {},
      keys: [ {key:'title', default: "" }, {key:'standing', default: "waiting" }, {key:'mileage', default: "" }, {key:'price', default: "" }, {key:'description', default: "" }, {key:'spare_parts', default: [] }, {key:'images', default: [] }, {key:'vehicle_id', default: 0 }],
      errors: [],
      images: [],
      loading: false,
      standingList: [
        { key: "waiting", value: "Ожидание" },
        { key: "canceled", value: "Отменен" },
        { key: "done", value: "Выполнено" },
        { key: "process", value: "В работе" },
        { key: "another", value: "Другое" }
      ]
    }
  },
  computed: {
    titleErr() {
      return checkErr('title', this.errors);
    },

    standingErr() {
      return checkErr('standing', this.errors);
    },

    mileageErr() {
      return checkErr('mileage', this.errors);
    },

    priceErr() {
      return checkErr('price', this.errors);
    },

    descriptionErr() {
      return checkErr('description', this.errors);
    },

    imagesErr() {
      return checkErr('images', this.errors);
    }
  },
  methods: {
    onValidate(response) {
      this.errors = onValidate(response, this.form);
    },
    addToGallery(data) {
      const {image, preview } = data;
      this.form.images.push(image);
      this.images.push(preview);
    },
    removeImage(index) {
      this.form.images.splice(index, 1);
      this.images.splice(index, 1);
    },
    addSparePart(data) {
      this.form.spare_parts.push(data);
    },
    removeSparePart(index) {
      this.form.spare_parts.splice(index, 1);
    },
    onAddRepair() {
      axios.post('/api/account/repair/add',
      createFormData(this.keys, this.form),
      {
        headers: {
          'Content-Type': 'multipart/form-data'
        }
      })
      .then(response => {
        const data = response.data;
        if (data.status === "error") {
          let formatted = {}
          for (let key in data) {
            if (key.indexOf("images") !== -1) {
              formatted.images = data[key];
            } else {
              formatted[key] = data[key];
            }
          }
          this.onValidate(formatted);
        } else if(data.status === 'success') {
          this.$router.push({ name: "account-cars", query: { message: data.message, type: 'success' }} );
        }
      })
      .catch(function (error) {
        console.log(error);
      });
    }
  },
  created() {
    this.form = fillForm(this.repair, this.keys);
    this.form.vehicle_id =  this.vehicleId;
  }
}
</script>