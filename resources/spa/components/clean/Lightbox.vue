<template>
  <div>
    <div v-show="lightboxOpened === true" class="gallery-modal black" :class="{'show': lightboxOpened === true }">

      <button class="text-white margin-top-0 white-transparent fs-24 hover-text-grey-20 padding-0-5 topright pointer"
              title="Close Lightbox" @click="closeLightbox">
          <font-awesome-icon :icon="['fas', 'times']" />
      </button>

      <div class="modal-content content-1024">

        <div class="content-960 margin-left-right-auto">
          <img class="lightbox-item" src="/images/img_nature_wide.jpg"
               alt="Nature">
          <img class="lightbox-item" src="/images/img_snow_wide.jpg"
               alt="Snow">
          <img class="lightbox-item" src="/images/img_mountains_wide.jpg"
               alt="Mountains">
          <div class="row black center">
            <div class="box relative">
              <p id="lightbox-caption-id" class="text-center"></p>
              <span class="middle hover-text-accent padding-0-5 large pointer" style="left:2%"
                    @click="() => stepLightbox(-1)" title="Previous image">
                  <font-awesome-icon :icon="['fas', 'chevron-left']" />
              </span>
              <span class="middle hover-text-accent padding-0-5 large pointer" style="left:98%"
                    @click="() => stepLightbox(1)" title="Next image">
                  <font-awesome-icon :icon="['fas', 'chevron-right']" />
              </span>
            </div>

            <div class="col s4">
              <img class="lightbox-dots opacity hover-opacity-off pointer"
                   src="/images/img_nature_wide.jpg"
                   @click="() => currentLightbox(1)" alt="Nature and sunrise">
            </div>
            <div class="col s4">
              <img class="lightbox-dots opacity hover-opacity-off pointer"
                   src="/images/img_snow_wide.jpg"
                   @click="() => currentLightbox(2)" alt="French Alps">
            </div>
            <div class="col s4">
              <img class="lightbox-dots opacity hover-opacity-off pointer"
                   src="/images/img_mountains_wide.jpg"
                   @click="() => currentLightbox(3)" alt="Mountains and fjords">
            </div>
          </div> <!-- End row -->
        </div> <!-- End content-960 -->

      </div> <!-- End modal content -->
    </div> <!-- End modal -->

    <div class="row-padding">
      <div class="col s4">
        <img src="/images/img_nature_wide.jpg"
             @click="() => {openLightbox();currentLightbox(1)}" class="hover-shadow pointer" alt="Nature">
      </div>
      <div class="col s4">
        <img src="/images/img_snow_wide.jpg"
             @click="() => {openLightbox();currentLightbox(2)}" class="hover-shadow pointer" alt="Snow">
      </div>
      <div class="col s4">
        <img src="/images/img_mountains_wide.jpg"
             @click="() => {openLightbox();currentLightbox(3)}" class="hover-shadow pointer" alt="Mountains">
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'Lightbox',
  data() {
    return {
      lightboxOpened: false,
      slideIndex: 1,
      slideItemClass: 'slide-item',
      slideDotsClass: 'slide-dots',
    }
  },
  mounted() {
    this.lightboxOpened = false;
    this.slideIndexLightbox = 1;
    this.lightboxItemClass = "lightbox-item";
    this.dotsClass = "lightbox-dots";
    this.captionId = "lightbox-caption-id";
  },
  methods: {
    openLightbox() {
      this.lightboxOpened = true;
    },

    closeLightbox() {
      this.lightboxOpened = false;
    },


    stepLightbox(n) {
      this.showLightboxItems(this.slideIndexLightbox += n);
    },

    currentLightbox(n) {
      this.showLightboxItems(this.slideIndexLightbox = n);
    },

    showLightboxItems(n) {
      const x = document.getElementsByClassName(this.lightboxItemClass);
      const dots = document.getElementsByClassName(this.dotsClass);
      const captionText = document.getElementById(this.captionId);
      if (n > x.length) {
        this.slideIndexLightbox = 1;
      }
      if (n < 1) {
        this.slideIndexLightbox = x.length;
      }
      for (let i = 0; i < x.length; i++) {
        x[i].style.display = "none";
      }
      for (let i = 0; i < dots.length; i++) {
        dots[i].className = dots[i].className.replace(" opacity-off", "");

      }
      x[this.slideIndexLightbox - 1].style.display = "block";
      dots[this.slideIndexLightbox - 1].className += " opacity-off";
      captionText.textContent = dots[this.slideIndexLightbox - 1].alt;
    }

  },

}

</script>
