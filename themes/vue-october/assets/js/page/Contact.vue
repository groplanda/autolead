<template lang="pug">
  .page
    ._container.container
      Post

    ._map
      yandex-map(:coords="coords" :zoom="zoom")._map-container
        ymap-marker(
          marker-id="123"
          :coords="coords"
          :zoom="zoom"
          :icon="markerIcon"
          :balloon-template="balloonTemplate"
        )


</template>
<script>
import { yandexMap, ymapMarker } from 'vue-yandex-maps';
import Post from '@vue/components/Post/Post';
export default {
  name: "Contact",
  components: { yandexMap, ymapMarker, Post },
  data() {
    return {
      zoom: 16,
      markerIcon: {
        layout: 'default#image',
        imageHref: `${process.env.MIX_IMG_PATH}/map/map.svg`,
        imageSize: [60, 60],
        imageOffset: [-35, -55],
      }
    }
  },
  computed: {
    coords() {
      const contacts = this.$store.getters.getContactsById(2).coords;
      const output = contacts.split(',');
      return output;
    },
    balloonTemplate() {
      const contacts = this.$store.getters.getContactsById(2);
      return `
        <div class="page__map-title">Автолидер и партнеры</div>
        <p class="page__map-address">${contacts.address}</p>
      `
    }
  },
}
</script>
