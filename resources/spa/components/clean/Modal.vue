<template>
  <div>
    <button @click="openModal" class="black-button padding-1">Click to Open Modal</button>

    <div v-show="modal === true" class="modal" :class="{'show': modal}">

      <div class="modal-content content-600 card card-4 animate-top relative">

        <div class="box primary round-top">
          <button @click="closeModal"
                class="close-button fs-18 primary topright round-top-right text-white">
              <font-awesome-icon :icon="['fas', 'times']" />
          </button>
          <h3 class="text-white">

            <slot name="header"></slot>

          </h3>
        </div>
        <div class="box white">

          <slot name="body"></slot>

        </div>
        <div class="box primary round-bottom text-gray-10">

          <slot name="footer"></slot>

        </div>
      </div>

    </div>
  </div>
</template>

<script>
export default {
  name: 'Modal',
  data() {
    return {
      modal: false,
    }
  },
  mounted() {

  },
  methods: {
    openModal() {
      this.modal = true;
    },

    closeModal() {
      this.modal = false;
    }
  },

}

</script>
