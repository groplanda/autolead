<template lang="pug">
  section.props
    ._container.container
      ._header
        .suptitle._suptitle
          icon(name="mark" component="about")._ico
          | Наши преимущества
        h3._title.title.
          Почему выбирают нас?
      ._row
        ._item
          icon(name="car_quality_service" component="props")._item-ico
          ._item-content
            h6._item-title Высокое качество.
            p._item-description Все работы выполняем качественно, профессионально и в установленный срок.
        ._item
          icon(name="car_certified_pros" component="props")._item-ico
          ._item-content
            h6._item-title Самые лучшие мастера.
            p._item-description Команда специалистов, занимающихся диагностикой, ремонтом и ТО автомобилей на профессиональном уровне.
        ._item
          icon(name="car_team" component="props")._item-ico
          ._item-content
            h6._item-title Честный подход.
            p._item-description Наши клиенты всегда советуют нас своим друзьям и знакомым. Приезжайте и убедитесь сами!
</template>
<script>


export default {
  name: 'Props',
}
</script>
<style lang="scss">
.props {
  padding-bottom: 100px;

  @media(max-width: 767px) {
    padding-bottom: 50px;
  }

  &__header {
    margin-bottom: 42px;
  }

  &__suptitle {
    margin-bottom: 30px;
  }

  &__row {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
    margin-left: -12px;
    margin-right: -12px;

    @media(max-width: 767px) {
      flex-direction: column;
      margin: 0;
    }
  }

  &__item {
    width: 100%;
    flex: 1 1 calc(33.33% - 24px);
    align-items: flex-start;
    display: flex;
    padding: 26px 0 22px;
    margin: 0 12px;
  }
  &__item-ico {
    width: 63px;
    height: 63px;
    margin-right: 23px;
    align-self: flex-start;

    @media(max-width: 991px) {
      width: 50px;
      height: 50px;
      margin-right: 15px;
    }
  }

  &__item-content {
    margin-top: 4px;
    max-width: calc(100% - 86px);

    @media(max-width: 991px) {
      max-width: calc(100% - 65px);
    }
  }

  &__item-title {
    margin-bottom: 20px;
    @media(max-width: 1199px) {
      font-size: 16px;
      margin-bottom: 10px;
    }
  }
  &__item-description {
    @media(max-width: 1199px) {
      font-size: 14px;
    }
  }
}
</style>
