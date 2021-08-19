<template lang="pug">
  .add-car
    AddCarForm(:user="user")
</template>
<script>
import AddCarForm from "@vue/components/Form/AccountForm/AddCarForm"

export default {
  name: "AddCar",
  components: {
    AddCarForm
  },
  data() {
    return {
      user: {}
    }
  },
  created() {
    this.user = this.$store.getters.getUserAuth;
  }
}
</script>
<style lang="scss">

</style>