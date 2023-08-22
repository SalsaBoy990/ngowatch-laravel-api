<template>
    <div class="articles-container">
        <div class="articles-grid">
            <Article v-for="article in articleStore.articles" :key="article.id" :article="article"></Article>
        </div>
    </div>
</template>

<script>
import {articleStore} from "../../store/articleStore";
import Article from "./Article.vue";

export default {
    name: "Articles",
    components: {
        Article,
    },
    data() {
        return {
            articleStore: articleStore,
            params: [],
        }
    },

    mounted() {
        articleStore.getArticles();
    },
}
</script>

<style scoped lang="sass">
.articles-container
    .articles-grid
        display: grid
        grid-template-columns: repeat(auto-fill, minmax(240px, 1fr))
        row-gap: 2em
        column-gap: 1em
</style>
