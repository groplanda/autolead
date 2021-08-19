<template lang="pug">
  .post
    Loading(v-if="loading")
    ._content(v-else)
      ._title {{ post.title }}
      ._body(v-if="post.content" v-html="post.content")
</template>
<script>
import axios from "axios";
import Loading from "@vue/components/Loading/Loading";

export default {
  name: "Post",
  components: {
    Loading
  },
  data() {
    return {
      post: {},
      loading: true
    }
  },
  methods: {
    fetchtPost() {
      const name = this.$route.name;
      axios.get(`api/post/${name}`)
        .then(response => {
          this.post = response.data;
          this.loading = false;
        })
        .catch(error => {
          console.log(error);
        })
    }
  },
  created() {
    this.fetchtPost();
  }
};
</script>