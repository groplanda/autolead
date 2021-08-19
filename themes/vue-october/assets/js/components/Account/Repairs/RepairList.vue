<template lang="pug">
  .repair-list
    Loading(v-if="repairs && repairs.length === 0")
    ._inner(v-else)
      RepairItem(v-for="(repair, index) in repairs" :key="index" :repair="repair" @selectImage="openGallery" @editRepair="openModal(index)")
      VueGallery(:images="gallery" :index="galleryIndex" @close="galleryIndex = null")
      Popup(className="popup__dialog_large" :hasSroll="true" v-if="popup" @close="popup = false")
        RepairForm(:vehicleId="vehicleId" :repair="repairs[repairIndex]")
</template>
<script>
import RepairItem from './RepairItem.vue'
import Loading from '@vue/components/Loading/Loading';
import VueGallery from 'vue-gallery';
import RepairForm from '@vue/components/Form/AccountForm/RepairForm.vue';
import Popup from '@vue/components/Popup/Popup';

export default {
  name: "RepairList",
  components: {
    RepairItem,
    Loading,
    VueGallery,
    RepairForm,
    Popup
  },
  props: {
    vehicleId: {
      type: Number,
      required: true
    },
    repairs: {
      type: Array,
      default() {
        return []
      }
    }
  },
  data() {
    return {
      galleryIndex: null,
      repairIndex: null,
      gallery: [],
      popup: false
    }
  },
  methods: {
    openGallery(data) {
      this.gallery = data.gallery;
      this.galleryIndex = data.index;
    },
    openModal(index) {
      this.popup = true;
      this.repairIndex = index;
    }
  }
}
</script>