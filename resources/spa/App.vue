<template>
    <div class="spa-container relative" :class="{ dark: this.darkModeOn === true}">
        <Header @darkmodechanged="onDarkModeChange"/>

            <div class="content-960 card white margin-left-right-auto margin-top-1-5">
                <div class="bar primary round-top">
                    <router-link class="bar-item button" active-class="red" :to="{ name: 'Home' }">
                        <font-awesome-icon :icon="['fas', 'home']"/>
                        Home
                    </router-link>

                    <router-link class="bar-item button" active-class="red" :to="{ name: 'Hello' }">
                        <font-awesome-icon :icon="['fas', 'user']"/>
                        Hello
                    </router-link>

                    <router-link class="bar-item button" active-class="red" :to="{ name: 'Dashboard' }">
                        <font-awesome-icon :icon="['fas', 'dashboard']"/>
                        Dashboard
                    </router-link>

                </div>

                <div class="box animate-opacity">

                    <component :is="layout">
                        <router-view :layout.sync="layout"/>
                    </component>

                </div>

            </div>


        <span v-if="showScrollToTopButton() === true"
              class="light-gray pointer scroll-to-top-button padding-0-5 round"
              role="button" aria-label="To the top button"
              title="Toggle table of content"
              @click="scrollToTop"
        >
        <font-awesome-icon :icon="['fas', 'chevron-up']"/>
    </span>

        <Footer/>
    </div>
</template>


<script>
import {markRaw} from "vue";
import {debounce} from "lodash";
import {authStore} from "./store/authStore";

import Guest from "./layout/Guest.vue";
import Header from "./components/public/Header.vue";
import Footer from "./components/public/Footer.vue";


export default {
    name: "App",
    components: {
        Footer,
        Header,
    },

    data() {
        return {
            authStore,
            layout: markRaw(Guest),
            darkModeOn: localStorage.getItem('darkMode') === 'true',
            scrollTop: 0,
            threshold: 800,
        }
    },


    created() {
        this.$emit('update:layout', Guest);
    },


    beforeMount() {
        // remove previous
        window.removeEventListener("wheel", this.setScrollToTop);
    },

    mounted() {
        // listen to scroll event
        window.addEventListener("wheel",
            this.setScrollToTop);
    },


    methods: {
        // change in dark/light mode (event emitted from Header -> observed here)
        onDarkModeChange(val) {
            console.log(val);
            this.darkModeOn = val;
        },

        // to the top
        scrollToTop() {
            this.scrollTop = 0;
            document.body.scrollTop = 0;
        },

        // only show the button if scrolled over the threshold
        showScrollToTopButton() {
            return this.scrollTop > this.threshold
        },

        // delay invoking the method (only invokes the last callback after the timeout to have less function calls)
        setScrollToTop: debounce(function () {
            this.scrollTop = document.body.scrollTop;
            console.log(document.body.scrollTop);
        }, 300),

    },


}
</script>


<style scoped lang="sass">

</style>
