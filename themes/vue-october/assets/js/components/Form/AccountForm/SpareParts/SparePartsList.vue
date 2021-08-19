<template lang="pug">
  .spare-part(style="width: 100%")
    ._item(v-for="(item, index) in spareParts" :key="index")
      ._item-title {{ item.name }}
      ._item-price {{ item.cost }}
      ._item-descr {{ item.info }}
      button._button.button(@click="$emit('removeSparePart', index)") Удалить

</template>
<script>
export default {
  name: "SparePartsList",
  props: {
    spareParts: {
      type: Array,
      default() {
        return []
      }
    }
  }
}
</script>