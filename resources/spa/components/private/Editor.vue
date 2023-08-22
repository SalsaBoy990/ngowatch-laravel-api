<template>
    <div class="editor">

        <h3 v-if="id !== null">Edit Article</h3>
        <h3 v-else>Add New Article</h3>


        <Alert v-if="articleStore.message !== ''" :heading="articleStore.color" :showCloseButton="false" :color="articleStore.color">
            {{ articleStore.message }}
        </Alert>


        <form @submit.prevent="createOrUpdateArticle">

            <div class="fs-18 bold margin-bottom-1">
                <input type="text"
                       v-model="title"
                       name="title"
                       placeholder="Enter title here"
                       :class="{ 'border border-red' : articleStore.errors?.title}"
                >
                <div v-if="articleStore.errors?.title" class="margin-bottom-1" :class="['error-message']">
                    {{ articleStore.errors?.title && articleStore.errors.title[0] }}
                </div>
            </div>


            <div class="round margin-bottom-1" :class="{ 'border border-red' : articleStore.errors?.title}">
                <QuillEditor :key="id"
                             v-model:content="body"
                             contentType="html"
                             theme="snow">
                </QuillEditor>

                <div v-show="articleStore.errors?.body" :class="['error-message']">
                    {{ articleStore.errors?.body && articleStore.errors.body[0] }}
                </div>
            </div>


            <div class="button-group margin-top-1">
                <button type="submit" class="primary">Save</button>
                <button @click="clearAll" type="button" class="primary alt">Clear all</button>
            </div>
        </form>
        <hr>

    </div>
</template>

<script>
import {QuillEditor} from '@vueup/vue-quill'
import '@vueup/vue-quill/dist/vue-quill.snow.css';

import {articleStore} from "../../store/articleStore";
import Alert from "../clean/Alert.vue";


export default {
    name: "Editor",
    props: {
        articleId: {
            required: false,
        }
    },
    components: {
        Alert,
        QuillEditor
    },


    data() {
        return {
            articleStore,
            // Get the article id
            id: null,
            // Get the editor title
            title: '',
            // Get the editor body
            body: '',
        }
    },


    mounted() {
        this.initialize();
        this.id = articleStore.article?.id || null;
        this.title = articleStore.article?.title || '';
        this.body = articleStore.article?.body || '';

        window.scrollTo(0, 50);
    },


    methods: {
        initialize() {
            this.id = null;
            this.title = '';
            this.body = '';
            this.alertMessage = '';
            this.alertColor = 'success';
        },


        clearAll() {
            articleStore.clearFeedback();
            this.initialize();
        },


        createOrUpdateArticle() {
            const article = {
                // Get the editor title
                title: this.title,
                // Get the editor content
                body: this.body,
            };


            // Create new article
            if (this.id === null) {
                this.errors = articleStore.createArticle(article);

                // Clear the editor
                this.initialize();

            } else {
                // Update existing article
                this.errors = articleStore.updateArticle(article, this.id);

                // Clear the editor
                this.initialize();
            }

        },
    }
}
</script>
