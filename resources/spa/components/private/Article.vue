<template>

    <article class="post card white padding-0-5" article="">
        <h2 class="margin-top-0 fs-24">
            <a href="#" target="_blank">{{ article.title }}</a>
        </h2>
        <div v-html="article.body"></div>

        <div class="button-group">
            <button @click="loadArticle" class="primary fs-12">
                <font-awesome-icon :icon="['fas', 'pencil-alt']"/>
                Edit
            </button>
            <button @click="deleteArticle" class="danger fs-12">
                <font-awesome-icon :icon="['fas', 'trash']"/>
                Delete
            </button>
        </div>
    </article>

</template>

<script>
import {articleStore} from "../../store/articleStore";

export default {
    name: "Article",
    props: {
        article: {
            required: true,
        }
    },


    data() {
        return {
            articleStore: articleStore
        }
    },


    methods: {
        loadArticle() {
            articleStore.showArticle(this.$props.article.id);
        },


        deleteArticle() {
            articleStore.article = this.$props.article
            articleStore.deleteArticle();
        }

    }
}
</script>
