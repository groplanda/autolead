<template lang="pug">
  .page
    ._container.container
      Post
      Faq

</template>
<script>
import Faq from '@vue/components/Faq/Faq';
import Post from '@vue/components/Post/Post';

export default {
  name: "About",
  components: { Faq, Post }
}
</script>
