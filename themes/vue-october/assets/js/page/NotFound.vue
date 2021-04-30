<template lang="pug">
  .page
    ._container.-not-found.container
      h1._not-found 404
      ._lead Страница, на которую вы перешли не существует. Попробуйте вернуться на главную страницу.
      router-link(:to="{ name: 'home' }")._button.button Вернуться на главную

      icon(name="404" component="404")._404
</template>
<script>
export default {
  name: "NotFound"
}
</script>