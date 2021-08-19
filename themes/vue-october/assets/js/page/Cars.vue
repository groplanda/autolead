<template lang="pug">
  .account-cars
    Toast(:message="toast.message" :className="toast.type" @closeToast="closeToast" v-if="toast")
    Loading(v-if="loading")
    ._row(v-else)
      ._item.-default(v-for="vehicle in vehicles" :key="vehicle.id")
        router-link(:to="{ name: 'single-car', params: { id: vehicle.id }}")._url
        img(:src="vehicle.image", :alt="vehicle.model")._image
        ._descr
          ._descr-title {{ vehicle.brand }}  {{ vehicle.model }}
          ._descr-year {{ vehicle.year }}
      ._item.-add(@click="addCar")
        ._text-add Добавить авто
        button._add-btn(type="button")
          icon(name="add-btn" component="account")._add-ico

</template>
<script>
import axios from "axios";
import Loading from "@vue/components/Loading/Loading";
import Toast from "@vue/components/Toast/Toast";


export default {
  name: "Cars",
  components: {
    Loading,
    Toast
  },
  props: {
    user: {
      type: Object,
      required: true
    }
  },
  data() {
    return {
      vehicles: [],
      loading: true,
      toast: false,
      noImage: "/themes/vue-october/assets/images/account/no-image.jpg"
    }
  },
  methods: {
    addCar() {
      this.$router.push( {name: "add-car"} )
    },
    fetchCars(userId) {
      axios.get(`/api/account/${userId}/cars`)
      .then(response => {
        this.vehicles = response.data.map(vehicle => {
          return {
            id: vehicle.id,
            brand: vehicle.brand,
            model: vehicle.model,
            year: vehicle.year,
            image: vehicle.image ? vehicle.image.path : this.noImage
          }
        })
        this.loading = false;
      })
      .catch(function (error) {
        console.log(error);
      });
    },
    closeToast() {
      this.toast = false;
      this.$router.replace({ query: [] });
    }
  },
  created() {
    if (this.$route.query.message) {
      this.toast = {
        message: this.$route.query.message,
        type: this.$route.query.type
      };
    }
    this.fetchCars(this.user.id);
  }
}
</script>
<style lang="scss">
@import '@/scss/vars.scss';
.account-cars {
  width: 100%;
  position: relative;

  &__row {
    display: flex;
    flex-wrap: wrap;
    margin: 0 -12px;
  }

  &__item {
    width: 100%;
    max-width: calc(50% - 24px);
    margin: 0 12px 24px 12px;
    background: #FFF;
    display: flex;
    flex-direction: column;
    justify-content: center;
    min-height: 195px;
    position: relative;
    transition: box-shadow .2s ease;

    &--add {
      align-items: center;
      border: 1px dashed $light-color;
      cursor: pointer;
    }

    &--default {

      &:hover {
        box-shadow: 0px 2px 4px rgba(38, 38, 38, 0.24), 0px 4px 8px rgba(38, 38, 38, 0.2);
      }

      &::before {
        content: "";
        width: 100%;
        height: 100%;
        background: $black-color;
        opacity: .6;
        z-index: 1;
        position: absolute;
      }
    }
  }

  &__url {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: 3;
  }

  &__image {
    width: 100%;
    height: 100%;
    object-fit: cover;
    left: 0;
    top: 0;
    position: absolute;
  }

  &__descr {
    position: relative;
    padding: 0 20px;
    z-index: 1;
  }

  &__descr-title {
    color: #FFF;
    font-size: 18px;
    font-weight: 600;
    line-height: 24px;
    margin-bottom: 10px;
  }

  &__descr-year {
    color: #FFF;
    font-size: 14px;
    line-height: 18px;
  }

  &__text-add {
    color: $light-color;
    font-size: 16px;
    line-height: 30px;
  }

  &__add-btn {
    width: 25px;
    height: 25px;
    cursor: pointer;
  }

  &__add-ico {
    width: 100%;
    height: 100%;
    color: $light-color;
  }
}
</style>