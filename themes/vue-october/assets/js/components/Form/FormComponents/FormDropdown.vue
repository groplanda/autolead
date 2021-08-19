<template lang="pug">
  .form__dropdown(:class="{ 'form__dropdown--active':  showDropdown }")
    input(
      type="text",
      :placeholder="placeholder"
      :value="prepareValue.value"
      @click="showDropdown = !showDropdown"
      readonly
    ).form__control
    icon(name="arrow-down" component="form").form__arrow-down
    .form__dropdown-list
      .form__dropdown-item(v-for="dropdownItem in dropdownList" :key="dropdownItem.key" @click="selectItem(dropdownItem.key)") {{ dropdownItem.value }}
</template>
<script>
export default {
  name: "FormDropdown",
  props: {
    inputVal: {
      type: String,
      default: ""
    },
    placeholder: {
      type: String,
      default: ""
    },
    dropdownList: {
      type: Array,
      required: true
    }
  },
  data() {
    return {
      showDropdown: false
    }
  },
  computed: {
    prepareValue() {
      let result = null;
      result = this.dropdownList.find(item => item.key === this.inputVal);
      return result ? result : "";
    }
  },
  methods: {
    selectItem(key) {
      this.showDropdown = false;
      this.$emit("selectDropdown", key);
    }
  }
}
</script>
