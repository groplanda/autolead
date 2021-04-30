<template lang="pug">
  section.stats(data-js="stats")
      ._container.container
        ._header
          ._row.row
            ._content
              .suptitle._suptitle
                icon(name="mark" component="about")._ico
                | наши цифры
              h3._title.title.
                Индивидуальный подход к каждому клиенту.
            img(src=`${process.env.MIX_IMG_PATH}/stats/stats-car.jpg`, alt="alt")._img
        ._list
          ._item(v-for="(item, index) in stats", :key="index")
            icon(:name="item.ico" component="stats")._item-ico
            ._item-content
              h3._item-title <span :data-num="item.num">0</span>k+
              p._item-description {{ item.description }}


</template>
<script>

export default {
  name: 'Stats',
  data() {
    return {
      stats: [
        { num: 86, description: 'Замен масла', ico: 'car_oil' },
        { num: 23, description: 'Отремонтировано КПП', ico: 'car_transmission' },
        { num: 11, description: 'Переобуто авто', ico: 'car_alignment' },
        { num: 32, description: 'Обслужено двигателей', ico: 'car_engine_2' },
      ],
    }
  },
  mounted() {
    const states = document.querySelectorAll('[data-num]');
    const stat = document.querySelector('[data-js="stats"]');
    const options = { threshold: .7 };

    const stateCounter = () => {
      states.forEach(state =>  {
        setInterval(incState, 100)

        function incState() {
          if(state.dataset.num > Number(state.textContent)) {
            Number(state.textContent++);
          }
        }

      });
    };

    const observer = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) stateCounter();
      })
    }, options);

    observer.observe(stat);

  }
}
</script>
<style lang="scss">
@import '@/scss/vars.scss';
.stats {
  padding-bottom: 190px;
  background-color: $dark-color;
  background-image: url('/themes/vue-october/assets/images/stats/stats-bg.png');
  background-position: center;
  background-repeat: no-repeat;
  background-size: auto;

  @media(max-width: 991px) {
    padding-bottom: 160px;
  }

  @media(max-width: 767px) {
    padding-bottom: 100px;
  }

  &__header {
    margin-bottom: 75px;
    position: relative;

    @media(max-width: 767px) {
      margin-bottom: 30px;
    }
  }

  &__row {
    display: flex;
    justify-content: space-between;
    flex-wrap: wrap;
    align-items: flex-end;
    @media(max-width: 991px) {
      justify-content: center;
      margin-bottom: 24px;
    }
  }

  &__content {
    max-width: 411px;
    flex: 1 1 411px;
    margin-right: 15px;
    @media(max-width: 991px) {
      max-width: 100%;
      flex: 1 1 100%;
      order: 1;
      text-align: center;
    }
  }

  &__img {
    margin: -80px 0 12px;
    max-width: 498px;
    flex: 1 1 498px;
    @media(max-width: 991px) {
      order: 0;
    }
    @media(max-width: 539px) {
      max-width: 100%;
    }
  }

  &__suptitle {
    color: #D5D5D5;
    @media(max-width: 991px) {
      justify-content: center;
    }
  }

  &__title {
    color: #FFFFFF;

    @media(max-width: 767px) {
      font-size: 30px;
    }

    @media(max-width: 575px) {
      font-size: 24px;
    }

    @media(max-width: 359px) {
      font-size: 18px;
    }
  }

  &__list {
    display: flex;
    flex-wrap: wrap;
    margin: 0 -12px 24px;
    @media(max-width: 991px) {
      margin-bottom: 0;
    }
    @media(max-width: 575px) {
      justify-content: center;
    }
  }

  &__item {
    max-width: calc(25% - 24px);
    flex: 1 1 calc(25% - 24px);
    display: flex;
    align-items: flex-start;
    margin: 0 12px;

    @media(max-width: 991px) {
      max-width: calc(50% - 24px);
      flex: 1 1 calc(50% - 24px);
      margin-bottom: 24px;
    }

    @media(max-width: 575px) {
      max-width: 320px;
      flex: 1 1 320px;
      margin-bottom: 20px;

      &:last-child {
        margin-bottom: 0;
      }
    }

  }

  &__item-ico {
    fill: #FFFFFF;
    max-width: 71px;
    height: 76px;
    margin-right: 11px;
  }

  &__item-content {
    margin-top: 5px;
  }

  &__item-title {
    color: $red-color;
    margin-bottom: 3px;
  }

  &__item-description {
    color: #F5F5F5;
  }

}
</style>
