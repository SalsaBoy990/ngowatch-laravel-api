<template>
    <div v-if="openAlert === true" role="alert"
         class="alert relative" :class="[color !== '' ? alertClass : '']">
        <button v-if="showCloseButton === true" @click="hideAlert()" class="close-button topright">
            <font-awesome-icon :icon="['fas', 'times']"/>
        </button>

        <div class="h5 bold text-black"><font-awesome-icon :icon="icon" class="margin-right-0-5" />{{ heading }}</div>
        <p class="alert-message">
            <slot></slot>
        </p>

    </div>
</template>

<script>
export default {
    name: 'Alert',
    props: [
        'showCloseButton',
        'open',
        'color',
        'heading'
    ],
    data() {
        return {
            openAlert: true,
        }
    },
    mounted() {
        this.openAlert = true;
    },
    methods: {
        showAlert() {
            this.openAlert = true;
        },

        hideAlert() {
            this.openAlert = false;
        }
    },

    computed: {
        alertClass() {
            switch (this.$props.color) {
                case 'danger':
                    return 'danger';
                case 'warning':
                    return 'warning';
                case 'success':
                    return 'success';
                case 'info':
                    return 'info';
                default:
                    return 'info';
            }
        },
        icon() {
            switch (this.$props.color) {
                case 'danger':
                    return 'fa-solid fa-circle-exclamation margin-right-0-5';
                case 'warning':
                    return 'fa-solid fa-triangle-exclamation margin-right-0-5';
                case 'success':
                    return 'fa-solid fa-circle-check margin-right-0-5';
                case 'info':
                    return 'fa-solid fa-circle-info margin-right-0-5';
                default:
                    return 'fa-solid fa-circle-info margin-right-0-5';
            }
        }
    }
}

</script>
