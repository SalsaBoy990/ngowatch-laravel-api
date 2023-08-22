<template>
  <div>
    <div class="row-padding">
      <div class="col s3 box">
        <a href="javascript:void(0)" class="hover-opacity tabbed-image-gallery-button"
           @click="openTabbedImage('Nature');">
          <img src="/images/img_nature.jpg" alt="Nature">
        </a>
      </div>
      <div class="col s3 box">
        <a href="javascript:void(0)" class="hover-opacity tabbed-image-gallery-button"
           @click="openTabbedImage('Snow');">
          <img src="/images/img_snowtops.jpg" alt="Fjords">
        </a>
      </div>
      <div class="col s3 box">
        <a href="javascript:void(0)" class="hover-opacity tabbed-image-gallery-button"
           @click="openTabbedImage('Mountains');">
          <img src="/images/img_mountains.jpg" alt="Mountains">
        </a>
      </div>
      <div class="col s3 box">
        <a href="javascript:void(0)" class="hover-opacity tabbed-image-gallery-button"
           @click="openTabbedImage('Lights');">
          <img src="/images/img_lights.jpg" alt="Lights">
        </a>
      </div>
    </div>
    <br>
    <div id="Nature" class="picture relative tabbed-image-gallery-item">
      <img src="/images/img_nature_wide.jpg" alt="Nature">
      <button @click="hide($event)"
            class="topright close-button fs-18 transparent text-white">
          <font-awesome-icon :icon="['fas', 'times']" />
      </button>
      <div class="bottomleft box padding-0-5 text-white black-transparent">Nature</div>
    </div>

    <div id="Snow" class="picture relative tabbed-image-gallery-item">
      <img src="/images/img_snow_wide.jpg" alt="Snow">
      <button @click="hide($event)"
            class="topright close-button fs-18 transparent text-white">
          <font-awesome-icon :icon="['fas', 'times']" />
      </button>
      <div class="bottomleft box padding-0-5 text-white black-transparent">Snow</div>
    </div>

    <div id="Mountains" class="picture relative tabbed-image-gallery-item">
      <img src="/images/img_mountains_wide.jpg" alt="Mountains">
      <button @click="hide($event)"
            class="topright close-button fs-18 transparent">
          <font-awesome-icon :icon="['fas', 'times']" />
      </button>
      <div class="bottomleft box padding-0-5 text-white black-transparent">Mountains</div>
    </div>

    <div id="Lights" class="picture relative tabbed-image-gallery-item">
      <img src="/images/img_lights_wide.jpg" alt="Lights">
      <button @click="hide($event)"
            class="topright close-button fs-18 transparent text-white">
          <font-awesome-icon :icon="['fas', 'times']" />
      </button>
      <div class="bottomleft box padding-0-5 text-white black-transparent">Northern Lights</div>
      <div class="bottomleft box padding-0-5 text-white black-transparent">Northern Lights</div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'ImageTabs',
  props: [
    'imageClass',
    'buttonClass',
  ],
  data() {
    return {
      imageId: '',
      tabbedImageClass: '',
      tabbedImageButtonClass: '',
    }
  },
  mounted() {
    this.tabbedImageClass = this.$props.imageClass ?? "tabbed-image-gallery-item";
    this.tabbedImageButtonClass = this.$props.buttonClass ?? "tabbed-image-gallery-button";

    this.hideAllTabs();
  },
  methods: {
    openTabbedImage(imageId) {
      this.imageId = imageId;
      this.hideAllTabs();

      document.getElementById(this.imageId).style.display = "block";
    },

    hideAllTabs() {
      const x = document.getElementsByClassName(this.tabbedImageClass);
      for (let i = 0; i < x.length; i++) {
        x[i].style.display = "none";
      }
    },

    hide(event) {
      console.log(event)
      const btn = event.target;
      if (btn.parentNode) {
        btn.parentNode.style.display = 'none';
      }
    },

    show(event) {
      const btn = event.target;
      if (btn.parentNode) {
        btn.parentNode.style.display = 'block';
      }
    }

  },

}

</script>
