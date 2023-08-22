<template>
  <div>
    <div class="center">
      <button class="success" @click="animate('top')">Top
      </button>
      <button class="success" @click="animate('bottom')">
        Bottom
      </button>
      <button class="success" @click="animate('left')">Left
      </button>
      <button class="success" @click="animate('right')">Right
      </button>
      <button class="success" @click="animate('fade')">Fade In
      </button>
      <button class="success" @click="animate('zoom')">Zoom
      </button>
      <button class="success" @click="animate('spin')">Spin
      </button>
    </div>
    <div class="center">
      <div v-show="target === 'top'" class="panel animate animate-top">Animation is Fun!</div>
      <div v-show="target === 'bottom'" class="panel animate animate-bottom">Animation is Fun!</div>
      <div v-show="target === 'left'" class="panel animate animate-left">Animation is Fun!</div>
      <div v-show="target === 'right'" class="panel animate animate-right">Animation is Fun!</div>
      <div v-show="target === 'fade'" class="panel animate animate-opacity">Animation is Fun!</div>
      <div v-show="target === 'zoom'" class="panel animate animate-zoom">Animation is Fun!</div>
      <div v-show="target === 'spin'" class="panel animate spin">Animation is Fun!</div>
      <div v-show="target === 'normal'" class="panel animate ">Animation is Fun!</div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'Animate',
  data() {
    return {
      target: '',
    }
  },
  mounted() {

  },
  methods: {
    animate(animationName) {
      this.target = animationName || 'normal';
    },
  },

}

</script>
