<template>
  <div class="content-960 margin-left-right-auto relative">
    <div class="relative slide-item">
      <img src="/images/img_nature_wide.jpg" alt="Beautiful Nature">
      <div class="topleft padding-1 text-white black-transparent fs-14">
        1 / 3
      </div>
      <div class="topright text-white black-transparent padding-1 hide-mobile">
        Beautiful Nature
      </div>
    </div>
    <div class="relative slide-item">
      <img src="/images/img_snow_wide.jpg" alt="French Alps">
      <div class="topleft text-white black-transparent padding-1 fs-14">
        2 / 3
      </div>
      <div class="topright text-white black-transparent padding-1 hide-mobile">
        French Alps
      </div>
    </div>
    <div class="relative slide-item">
      <img src="/images/img_mountains_wide.jpg" alt="Mountains">
      <div class="topleft text-white black-transparent padding-1 fs-14">
        3 / 3
      </div>
      <div class="topright text-white black-transparent padding-1 hide-mobile">
        Mountains
      </div>
    </div>
    <div class="slider-nav center section fs-18 text-white bottomleft">
      <div class="float-left hover-text-accent padding-0-5 large pointer" @click="switchSlide(-1)">
          <font-awesome-icon :icon="['fas', 'chevron-left']" />
      </div>
      <div class="float-right hover-text-accent padding-0-5 large pointer" @click="switchSlide(1)">
          <font-awesome-icon :icon="['fas', 'chevron-right']" />
      </div>
      <div class="margin-top-1 text-center slide-dots-bar">
        <span class="slide-dots border hover-white" @click="currentSlide(1)"></span>
        <span class="slide-dots border hover-white" @click="currentSlide(2)"></span>
        <span class="slide-dots border hover-white" @click="currentSlide(3)"></span>
      </div>

    </div>
  </div>
</template>

<script>
export default {
  name: 'ImageSlider',
  data() {
    return {
      slideIndex: 1,
      slideItemClass: 'slide-item',
      slideDotsClass: 'slide-dots',
    }
  },
  mounted() {
    this.slideIndex = 1;
    this.showSlides(this.slideIndex);
  },
  methods: {
    switchSlide(n) {
      this.slideIndex = this.slideIndex + n;
      this.showSlides(this.slideIndex);
    },

    currentSlide(n) {
      this.showSlides(this.slideIndex = n);
    },

    showSlides(n) {
      const x = document.getElementsByClassName(this.slideItemClass);
      const dots = document.getElementsByClassName(this.slideDotsClass);
      if (n > x.length) {
        this.slideIndex = 1;
      }
      if (n < 1) {
        this.slideIndex = x.length;
      }

      for (let i = 0; i < x.length; i++) {
        x[i].style.display = "none";
      }
      for (let i = 0; i < dots.length; i++) {
        dots[i].className = dots[i].className.replace(" white", "");
      }
      x[this.slideIndex - 1].style.display = "block";
      dots[this.slideIndex - 1].className += " white";
    },

  },

}

</script>

<style scoped lang="sass">
.slide-dots-bar
    display: inline-flex
    column-gap: 0.25em

</style>
