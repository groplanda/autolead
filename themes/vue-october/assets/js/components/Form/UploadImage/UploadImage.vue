<template lang="pug">
  .upload-image
    ._item.-default(v-for="(img, index) in gallery" :key="index")
      img(:src="img", alt="alt")._image
      button(type="button" @click="$emit('removeImage', index)")._remove
        icon(name="trash" component="account")._remove-ico

    label._item.-add
      input(type="file" id="uploadImage" multiple @change="handleImageUpload" v-if="multiply")._input
      input(type="file" id="uploadImage" @change="handleImageUpload" v-else)._input
      ._text-add {{ text }}
      icon(name="add-btn" component="account")._plus

</template>
<script>
export default {
  name: "UploadImage",
  props: {
    gallery: {
      type: Array,
      default() {
        return []
      }
    },
    multiply: {
      type: Boolean,
      default: false
    },
    text: {
      type: String,
      default: "Добавить фото"
    }
  },
  data() {
    return {
      uploadImage: this.multiply ? [] : "",
    }
  },
  methods: {
    handleImageUpload(e) {
      this.uploadImage = Array.from(e.target.files);

      if(this.multiply) {
        this.uploadImage.forEach(image => {
          const imgArr = [];
                imgArr.push(image);
                this.uploadPictyre(imgArr);
        });
      } else {
        this.uploadPictyre(this.uploadImage)
      }

    },
    uploadPictyre(image) {
      let reader  = new FileReader();
      reader.addEventListener("load", function () {
        const preview = reader.result;
        if(image && image.length > 0) this.$emit("addToGallery", { image, preview })
      }.bind(this), false);

      if( image && image[0] ){
        if ( /\.(jpe?g|png|gif)$/i.test( image[0].name )) {
          reader.readAsDataURL( image[0] );
        } else {
          console.log("error");
        }
      }
    }
  }
}
</script>
<style lang="scss">
@import '@/scss/vars.scss';
.upload-image {
  display: flex;
  flex-wrap: wrap;
  padding: 0 11px;
  margin-bottom: 20px;

  $root: &;

  &__item {
    width: 80px;
    height: 110px;
    display: flex;
    flex-direction: column;
    justify-content: center;
    margin-right: 5px;
    position: relative;

    &--add {
      background: #FFF;
      align-items: center;
      border: 1px dashed $light-color;
      cursor: pointer;
      padding: 0 10px;
    }

    &--default {

      &::after {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: $dark-color;
        opacity: 0;
        transition: opacity .2s ease;
        z-index: 1;
      }

      &:hover {
        #{$root} {
          &__remove {
            opacity: 1;
            pointer-events: all;
            z-index: 3;
          }
        }

        &::after {
          opacity: .6;
        }
      }
    }
  }

  &__image {
    width: 100%;
    height: 100%;
    object-fit: cover;
  }

  &__text-add {
    color: $light-color;
    font-size: 14px;
    line-height: 18px;
    margin-bottom: 10px;
    text-align: center;
  }

  &__input {
    position: absolute;
    z-index: -1;
    top: 0;
    left: 0;
    visibility: hidden;
  }

  &__plus {
    width: 24px;
    height: 24px;
    cursor: pointer;
    color: $light-color;
  }

  &__remove {
    width: 24px;
    height: 24px;
    position: absolute;
    top: calc(50% - 12px);
    left: calc(50% - 12px);
    opacity: 0;
    pointer-events: none;
    transition: opacity .3s ease;
    cursor: pointer;
  }

  &__remove-ico {
    width: 100%;
    height: 100%;
    color: #FFF;
  }

}
</style>