<template>
    <main>
        <HelloWorld msg="Hello page!"/>
    </main>
</template>


<script>
import Alert from "../../components/clean/Alert.vue";
import HelloWorld from './../../components/HelloWorld.vue'

export default {
    name: "Hello",
    components: {
        Alert,
        HelloWorld,
    },
}
</script>


<style scoped lang="sass">

</style>
