<template>
  <div>

    <div class="gray-20">
      <div class="box green" style="width:5%; height: 24px" :style="{ width: (width + '%') }">{{ label }}</div>
    </div>
    <button class="black-button" @click="triggerMove">
      Click Me
    </button>

  </div>
</template>

<script>
export default {
  name: 'ProgressBar',
  data() {
    return {
      speed: 15,
      width: 2,
      label: '0',
      id: 0,
    }
  },
  mounted() {

  },
  methods: {
    triggerMove() {
      this.id = window.setInterval(() => this.move(), this.speed);
    },

    move() {
      if (this.width === 100) {
        clearInterval(this.id);
        this.width = 2;
        this.label = '';
      } else {
        this.width++;
        this.label = this.width + '%';
      }
    }
  },

}

</script>
