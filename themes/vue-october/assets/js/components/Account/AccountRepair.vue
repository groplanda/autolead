<template lang="pug">
  .account-repair
    <RepairList v-if="repairs.length > 0" :repairs="repairs" :vehicleId="vehicleId" />
    ._add(v-else)
      ._add-text Ремонтов пока нет!

    button.button(@click="popup = true") Добавить ремонт
    Popup(className="popup__dialog_large" :hasSroll="true" v-if="popup" @close="popup = false")
      RepairForm(:vehicleId="vehicleId")


</template>
<script>
import Popup from '@vue/components/Popup/Popup';
import RepairForm from '@vue/components/Form/AccountForm/RepairForm';
import RepairList from './Repairs/RepairList.vue';

export default {
  name: "AccountRepair",
  components: {
    Popup,
    RepairForm,
    RepairList
  },
  data() {
    return {
      popup: false
    }
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
  }
}
</script>