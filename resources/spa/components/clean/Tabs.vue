<template>
  <div class="border round">
    <div class="bar">
      <a v-for="item in contents" :key="'tab-link-' + item.id"
         @click="switchTab(item.id)"
         href="javascript:void(0)"
         class="bar-item tab-switcher"
         :class="{'red': tabId === item.id}"
      >
        {{ item.title }}
      </a>
    </div>

    <div v-for="item in contents" :key="'tab-content-' + item.id" :id="item.id" class="box tabs animate-opacity red">

      <h2 class="text-white">{{ item.title }}</h2>
      <div v-html="item.data"></div>

    </div>

  </div>
</template>

<script>
export default {
  name: 'Tabs',
  props: [
    'activeTab',
      'activeColor'
  ],
  data() {
    return {
      tabId: '',
      tabsClass: "",
      buttonClass: "",
      activeButtonClass: '',

      contents: [
        {
          id: 'London',
          title: 'London',
          data: '<p>London is the capital of England.</p>\n' +
              '      <p>It is the most populous city in the United Kingdom,\n' +
              '        with a metropolitan area of over 9 million inhabitants.</p>'
        },
        {
          id: 'Paris',
          title: 'Paris',
          data: '<p>Paris is the capital of France.</p>\n' +
              '      <p>The Paris area is one of the largest population centers in Europe,\n' +
              '        with more than 12 million inhabitants.</p>'
        },
        {
          id: 'Tokyo',
          title: 'Tokyo',
          data: '<p>Tokyo is the capital of Japan.</p>\n' +
              '      <p>It is the center of the Greater Tokyo Area,\n' +
              '        and the most populous metropolitan area in the world.</p>'
        },
      ]
    }
  },

  mounted() {
    this.tabId = this.$props.activeTab ?? 'London';
    this.tabsClass = "tabs";
    this.buttonClass = "tab-switcher";
    this.activeButtonClass = this.$props.activeColor ?? 'red';

    this.switchTab(this.tabId);
  },
  methods: {
    switchTab(tabId) {
      this.tabId = tabId;
      const x = document.getElementsByClassName(this.tabsClass);
      for (let i = 0; i < x.length; i++) {
        x[i].style.display = "none";
      }
      const activeButton = document.getElementsByClassName(this.buttonClass);
      const activeButtonClassString = " " + this.activeButtonClass;
      for (let i = 0; i < x.length; i++) {
        activeButton[i].className = activeButton[i].className.replace(activeButtonClassString, "");
      }
      const currentTab = document.getElementById(this.tabId);
      if (currentTab) {

        document.getElementById(this.tabId).style.display = "block";
      }

    }
  },

}

</script>
