<template lang="pug">
  .loading
    ._wrapper
      ._layer(:style="{'border-color': color}")
        ._circle-clipper.-left
          ._circle
        ._gap-path
          ._circle
        ._circle-clipper.-right
          ._circle
</template>
<script>
export default {
  name: "Loading",
  props: {
    color: {
      type: String,
      default: "#C40B0B"
    }
  }
}
</script>