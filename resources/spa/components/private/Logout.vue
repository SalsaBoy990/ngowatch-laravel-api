<template>

    <div class="logout">
        <form @submit.prevent="onLogout">
            <button type="submit" class="logout-button">
                <font-awesome-icon :icon="['fas', 'sign-in-alt']"/>
                Logout
            </button>
        </form>
    </div>

</template>

<script>
import {FontAwesomeIcon} from "@fortawesome/vue-fontawesome";
import User from "../../api/User.js";

export default {
    name: "Logout",
    mixins: [User],
    components: {FontAwesomeIcon},
    methods: {
        onLogout() {
            this.logout();
            this.$emit('onLogout', true)
        },
    },

}
</script>

<style scoped lang="sass">
.logout
    display: inline-block

    button[type="submit"]
        margin-top: 0
</style>
