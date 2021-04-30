<template lang="pug">
  .home
    Hero
    About
    Props
    Video
    Services
    Appointment
    Gallery
    Testimonials
    Stats
    AppointmentSmall

</template>
<script>

import Hero from "@vue/components/Hero/Hero.vue";
import About from '@vue/components/About/About.vue';
import Props from '@vue/components/Props/Props.vue';
import Video from '@vue/components/Video/Video.vue';
import Services from '@vue/components/Services/Services.vue';
import Appointment from '@vue/components/Appointment/Appointment.vue';
import Testimonials from '@vue/components/Testimonials/Testimonials.vue';
import Gallery from '@vue/components/Gallery/Gallery.vue';
import Stats from '@vue/components/Stats/Stats.vue';
import AppointmentSmall from '@vue/components/AppointmentSmall/AppointmentSmall.vue';

export default {
  name: "Home",
  components: {
    Hero,
    About,
    Props,
    Video,
    Services,
    Appointment,
    Testimonials,
    Gallery,
    Stats,
    AppointmentSmall
  }
}
</script>
