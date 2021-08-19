<template lang="pug">
.single-car
  Toast(:message="toast.message" :className="toast.type" @closeToast="closeToast" v-if="toast")
  Loading(v-if="loading")
  template(v-else)
    EditCarForm(:vehicle="vehicle" :user="user" @cancelEditForm="isEdit = $event" v-if="isEdit")
    .car(v-else)
      img(:src="vehicle.image ? vehicle.image.path : noImage", :alt="vehicle.brand")
      p {{ vehicle.brand }} {{ vehicle.model }}
      p {{ vehicle.year }}
      p {{ vehicle.color }}
      input(type="text" ref="inputVin" :value="vehicle.vin")
      button(type="button" @click="copyVin")._copy
        icon(name="account-copy" component="account")._copy-ico
      p {{ vehicle.description }}
      button.button(type="button" @click="isEdit = true") Edit
    div
    AccountRepair(:vehicleId="vehicle.id" :repairs="vehicle.repairs" v-if="!isEdit")

</template>
<script>
import Loading from "@vue/components/Loading/Loading";
import Toast from "@vue/components/Toast/Toast";
import EditCarForm from "@vue/components/Form/AccountForm/EditCarForm";
import AccountRepair from "@vue/components/Account/AccountRepair";
import axios from "axios";

export default {
  name: "SingleCar",
  components: {
    Loading,
    Toast,
    EditCarForm,
    AccountRepair
  },
  data() {
    return {
      vehicle: null,
      user: null,
      loading: true,
      isEdit: false,
      noImage: "/themes/vue-october/assets/images/account/no-image.jpg",
      toast: false
    }
  },
  methods: {
    fetchCarByIds(data) {
      axios.get(`/api/account/${data.user_id}/cars/${data.id}`)
      .then(response => {
        this.vehicle = response.data;
        this.loading = false;
      })
      .catch(function (error) {
        console.log(error);
      });
    },
    closeToast() {
      this.toast = false;
      this.$router.push(this.$route.path).catch(() => {})
    },
    copyVin() {
      const vin = this.$refs.inputVin;
      vin.focus();
      vin.select();

      try {
        const successful = document.execCommand('copy');
        const msg = successful ? 'Скопировано' : 'Ошибка!';
        this.toast = {
          message: msg,
          type: "success"
        };
      } catch (err) {
        this.toast = {
          message: err,
          type: "warn"
        };
      }
    }
  },
  created() {
    if (this.$route.query.message) {
      this.toast = {
        message: this.$route.query.message,
        type: this.$route.query.type
      };
    }
    const vehicleId = this.$route.params.id;
          this.user = this.$store.getters.getUserAuth;
    if (vehicleId ) {
      this.fetchCarByIds({ user_id: this.user.id, id: vehicleId });
    }
  }
}
</script>
<style lang="scss">
.car {

  &__copy {
    width: 20px;
    height: 20px;
    cursor: pointer;
  }

  &__copy-ico {
    width: 100%;
    height: 100%;
    color: #000;
  }
}
</style>