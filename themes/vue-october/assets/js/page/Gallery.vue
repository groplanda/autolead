<template lang="pug">
  .page
    ._container.container
      Post
      MasonryGallery

</template>
<script>
import Post from '@vue/components/Post/Post';
import MasonryGallery from '@vue/components/Gallery/MasonryGallery.vue';


export default {
  name: "About",
  components: { Post, MasonryGallery }
}
</script>