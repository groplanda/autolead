<template lang="pug">
  .page
    ._container.container
      Post
    Services(:showFooter="false")

</template>
<script>
import Services from '@vue/components/Services/Services';
import Post from '@vue/components/Post/Post';

export default {
  name: "Repair",
  components: { Services, Post },
}
</script>