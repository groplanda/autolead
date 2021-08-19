import Vue from 'vue';
import Icon from '@vue/components/app/icon/icon.vue';
import Video from '@vue/components/Video/Video.vue';
Vue.component('icon', Icon);
import Swiper from 'swiper';
import IMask from 'imask';
import lightGallery from 'lightgallery';
import MiniMasonry from './modules/minimasonry.js';
import $ from 'jquery';
window.jQuery = $;

document.addEventListener("DOMContentLoaded", () => {

  setTimeout(() => document.body.classList.add('loaded'), 200);

  const videoVue = document.getElementById('video');

  if (videoVue) {
    new Vue({
      el: videoVue,
      components: { App: Video }
    })
  }

  const servicesSliderEl = document.querySelector('[data-js-action="services-slider"]');
  const testimonialsSliderEl = document.querySelector('[data-js-action="testimonials-slider"]');
  const testimonialUploadInput = document.querySelector('[data-js-action="upload-avatar"]');
  const galleryEl = document.querySelector('[data-js-action="gallery"]');
  const masonryGalleryEl = document.querySelector('[data-gallery="masonry"]');

  disabledForm("checkbox-form", "confirm-form");

  if (galleryEl) {
    lightGallery(galleryEl, {
      speed: 500
    });
  }

  if (masonryGalleryEl) {
    const layout = new MiniMasonry({
      container: masonryGalleryEl,
      gutter: 10,
      ultimateGutter: 5
    })

    layout.layout();
  }

  const stat = document.querySelector('[data-js-action="stats"]');

  if (stat) {
    const states = stat.querySelectorAll('[data-num]');
    const options = { threshold: .7 };

    const stateCounter = () => {
      states.forEach(state =>  {
        setInterval(incState, 100)

        function incState() {
          if(state.dataset.num > Number(state.textContent)) {
            Number(state.textContent++);
          }
        }

      });
    };
    const observer = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) stateCounter();
      })
    }, options);

    observer.observe(stat);
  }

  const faqs = document.querySelectorAll('[data-js-action="toggle-faq"]');
  if (faqs) {
    faqs.forEach(faq => {
      faq.addEventListener("click", toggleFaq);
    })
  }

  openMobileNav('[data-js-action="open-mobile-nav"]', '[data-js-action="mobile-nav"]', '[data-js-action="close-mobile-nav"]');
  closeMobileNav('[data-js-action="close-mobile-nav"]', '[data-js-action="mobile-nav"]');

  openPopup('[data-js-action="open-popup"]');
  closePopup('[data-js-action="close-popup"]', '[data-js-action="popup"]');
  closePopupOnOverlay('[data-js-action="popup"]');

  if (servicesSliderEl) {
    const servicesBreakpoints = {
      320: {
        slidesPerView: 1.2,
      },
      640: {
        slidesPerView: 2.2,
      }
    }
    swiperSlider(servicesSliderEl, servicesBreakpoints);
  }

  if (testimonialsSliderEl) {
    const servicesBreakpoints = {
      320: {
        slidesPerView: 1.2,
      },
      640: {
        slidesPerView: 2,
      }
    }
    swiperSlider(testimonialsSliderEl, servicesBreakpoints);
  }

  if (testimonialUploadInput) {
    const imageForm = document.querySelector('[data-js-action="form-group-avatar"]'),
          previewImage = imageForm.querySelector('[ data-js-action="avatar-preview"]'),
          removePreviewImage = document.querySelector('[data-js-action="remove-avatar-preview"]');

    testimonialUploadInput.addEventListener("change", (e) => { uploadPreviewImage(e,
      { formGroupEl: imageForm, previewImageEl: previewImage, removeBtnEl: removePreviewImage })
    });
    removePreviewImage.addEventListener("click", (e) => { resetPreviewImage(e,
      { formGroupEl: imageForm, previewImageEl: previewImage, uploadInputEl: testimonialUploadInput , removeBtnEl: removePreviewImage })
    })

    $(".form").on("ajaxSuccess", function(event) {
      event.currentTarget.reset();
      resetPreviewImage(event, { formGroupEl: imageForm, previewImageEl: previewImage, uploadInputEl: testimonialUploadInput , removeBtnEl: removePreviewImage, isPrevent: false })
    });
  }

  function uploadPreviewImage(e, { formGroupEl, previewImageEl, removeBtnEl }) {
    const avatar = Array.from(e.target.files);
    let reader  = new FileReader();

    reader.addEventListener("load", function () {
      formGroupEl.classList.remove("form__group--hidden");
      removeBtnEl.classList.remove("form__file-btn--hide");
      previewImageEl.src = reader.result;
    }.bind(this), false);

    if( avatar && avatar[0] ){
      if ( /\.(jpe?g|png|gif)$/i.test( avatar[0].name )) {
        reader.readAsDataURL( avatar[0] );
      }
    }
  }

  function resetPreviewImage(e, { formGroupEl, previewImageEl, uploadInputEl, removeBtnEl, isPrevent = true }) {
    if (isPrevent) e.preventDefault();
    formGroupEl.classList.add("form__group--hidden");
    previewImageEl.src = "";
    uploadInputEl.value= null;
    removeBtnEl.classList.add("form__file-btn--hide");
  }

  function swiperSlider(el, breakpoints) {
    new Swiper(el, {
      loop: true,
      slidesPerView: 2.2,
      breakpoints: breakpoints
    });
  }

  function openPopup($trigger) {
    const trigger = document.querySelectorAll($trigger);
    trigger.forEach(btn => {
      btn.addEventListener("click", () => {
        const typeModal = btn.dataset.modalFor,
              popup = document.querySelector(`[data-modal="${typeModal}"]`)
        popup.classList.add("popup--show");
        document.body.classList.add("open-modal");
        const offset = getScrollBarWith();
        setOffset(document.body, offset);
      })
    });
  }

  function closePopup($trigger, $popup) {
    const closeBtn = document.querySelectorAll($trigger);

    closeBtn.forEach(close => {
      close.addEventListener("click", () => {
        const popup = close.closest($popup);
              popup.classList.remove("popup--show");
              document.body.classList.remove("open-modal");
              setOffset(document.body, 0);
      })
    })
  }

  function closePopupOnOverlay($popup) {
    const popups = document.querySelectorAll($popup);

    popups.forEach(popup => {
      popup.addEventListener("click", e => {
        if (!e.target.closest('[data-js-action="popup-body"]') && popup.classList.contains("popup--show")) {
          popup.classList.remove("popup--show");
          document.body.classList.remove("open-modal");
          setOffset(document.body, 0);
        }
      })
    })
  }

  function getScrollBarWith() {
    const documentWidth = parseInt(document.documentElement.clientWidth);
    const windowsWidth = parseInt(window.innerWidth);
    return windowsWidth - documentWidth;
  }

  function setOffset(elem, width) {
    elem.style.paddingRight = `${width}px`;
  }

  function openMobileNav($trigger, $nav, $closeBtn) {
    const trigger = document.querySelector($trigger),
          nav = document.querySelector($nav),
          close = document.querySelector($closeBtn);

    trigger.addEventListener("click", () => {
      nav.classList.add("mobile-nav_active");
      close.classList.add("mobile-nav__close_active");
      document.body.classList.add("open-modal");
    })
  }

  function closeMobileNav($closeBtn, $nav) {
    const close = document.querySelector($closeBtn),
          nav = document.querySelector($nav);

    close.addEventListener("click", () => {
      nav.classList.remove("mobile-nav_active");
      close.classList.remove("mobile-nav__close_active");
      document.body.classList.remove("open-modal");
    })
  }

  function toggleFaq(event) {
    const faq = event.target.closest(".faq__item");
    const faqBody = faq.querySelector(".faq__item-body");
    faq.classList.toggle("faq__item--active");

    hideFaqs(faq);

    if (faq.classList.contains("faq__item--active")) {
      faqBody.style.height = faqBody.scrollHeight + 20 + 'px';
    } else {
      faqBody.style.height = 0;
    }
  }

  function hideFaqs(activeItem) {
    const faqs = document.querySelectorAll(".faq__item");

    for(let i = 0; i < faqs.length; i++) {
      if(faqs[i] !== activeItem && activeItem !== null) {
        faqs[i].classList.remove("faq__item--active");
        faqs[i].querySelector(".faq__item-body").style.height = 0;
      }
    }
  }

  function disabledForm(triggerEl, parentEl) {
    const triggers = document.querySelectorAll(`[data-js-action="${triggerEl}"]`);

    if (triggers) {
      triggers.forEach(trigger => {
        trigger.addEventListener("change", function() {
          const parent = trigger.closest(`[data-js-action="${parentEl}"]`);
          if (parent) {
            trigger.checked
            ? parent.nextElementSibling.disabled = false
            : parent.nextElementSibling.disabled = true;
          }
        })
      })
    }
  }

  $(window).on("ajaxInvalidField", function(event, fieldElement) {
    $(fieldElement).closest(".form__group").addClass("form__group--error");
  });

  $(document).on("ajaxPromise", '[data-request]', function() {
    $(this).closest(".form").find(".form__group.form__group--error").removeClass("form__group--error");
  });

  $(".form").on("ajaxSuccess", function(event) {
    event.currentTarget.reset();
  });

  const phones = document.querySelectorAll('[data-js-action="phone"]');
  if (phones) {
    const maskOptions = {
      mask: '+{7}(000)000-00-00'
    };
    phones.forEach(p => IMask(p, maskOptions));
  }
});