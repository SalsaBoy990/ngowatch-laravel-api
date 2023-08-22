<template>
    <div class="dashboard">
        <h1>Articles</h1>

        <div class="dashboard-container">
            <aside>
                <Editor :key="articleStore.article"/>
            </aside>
            <main>
                <Articles></Articles>
            </main>

        </div>
    </div>

</template>

<script>
import Articles from "../../components/private/Articles.vue";
import {articleStore} from "../../store/articleStore.js";
import Editor from "../../components/private/Editor.vue";

export default {
    name: "Dashboard",
    data() {
        return {
            articleStore: articleStore,
            articlesChanged: false,
        }
    },
    components: {
        Editor,
        Articles,
    },
}
</script>

<style scoped lang="sass">

.dashboard
    .dashboard-container
        display: flex
        flex-direction: row
        flex-wrap: wrap
        gap: 2em

        aside
            width: 400px
            @media screen and (max-width: 700px)
                width: 100%

        main
            width: calc(100% - 432px)
            @media screen and (max-width: 900px)
                width: 100%

</style>
