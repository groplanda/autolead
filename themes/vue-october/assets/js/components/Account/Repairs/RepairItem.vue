<template lang="pug">
  .repair-item
    ._heading(@click="showRepairBody = !showRepairBody")
      ._item-name {{ repair.title }}
      ._item-created_at {{ repair.created_at }}
      ._item-created_at {{ repair.updated_at }}
    ._body(v-if="showRepairBody")
      ._item-name Описание
      ._item-name {{ repair.description }}
      ._item-name Пробег на момент ремонта
      ._item-name {{ repair.mileage }}
      ._item-name Стоимость
      ._item-name {{ repair.price }}
      ._item-name Статус
      ._item-name {{ repair.status }}
      ._item-name Запчасти
      ._item-name(v-for="(sparePart, index) in repair.spare_parts" :key="index")
        span {{ sparePart.name + ' ' + sparePart.cost + ' ' + sparePart.info }}
      ._item-name Фото
      ._clear(style="clear: both")
        img(
          :src="image.path"
          :alt="image.disk_name"
          v-for="(image, imageIndex) in repair.images"
          :key="image.disk_name"
          @click="selectImage(imageIndex)"
          style="width: 50px; float: left")
      ._clear(style="clear: both")
      button._button.button(type="button" @click="$emit('editRepair')") Редактировать
    hr
</template>
<script>

export default {
  name: "RepairItem",
  props: {
    repair: {
      type: Object,
      required: true
    }
  },
  data() {
    return {
      showRepairBody: false,
      gallery: []
    }
  },
  methods: {
    setGallery() {
      this.gallery = this.repair.images.map(img => img.path)
    },
    selectImage(index) {
      this.$emit("selectImage", { index, gallery: this.gallery })
    }
  },
  mounted() {
    this.setGallery();
  }
}
</script>
