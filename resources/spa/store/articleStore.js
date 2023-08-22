import {reactive} from "vue";
import axios from "../api/Api";


// Set state object with values that are changed programmatically
export const articleStore = reactive({
    articles: {},
    article: null,
    errors: {},

    // status message and color for the alerts
    message: '',
    color: 'success',


    getErrors(error, log = true) {
        if (log === true) {
            console.error(error)
        }
        this.errors = error.response.data.errors
    },

    clearFeedback() {
        this.errors = {}
        this.message = '';
        this.color = '';
    },

    setNotification(message = 'Article saved successfully!', color = 'success') {
        this.message = message;
        this.color = color;
    },


    // Get latest 10 posts from the WP REST API
    getArticles() {
        axios.get('article', {}).then((res) => {
            if (200 === res.status || 204 === res.status) {
                this.articles = res.data.result.data
            }
            console.log(res.status)
        }).catch(err => {
            this.getErrors(err)
        });
    },


    // Get one post by id
    showArticle(id) {
        axios.get('article/' + id).then(res => {
            if (200 === res.status || 204 === res.status) {
                console.log(res)
                this.article = res.data.result;
            }
        }).catch(err => {
            this.getErrors(err)
        });
    },


    // Save new post
    createArticle(data) {
        const request = {
            // Setup method
            method: 'post',
            // Setup rest url
            url: 'article',
            // Setup the post object to send
            data,
            //  Headers are setup up in the interceptor of axios
        };

        // Save post
        axios(request)
            .then(res => {
                this.setNotification();
                this.getArticles();
            })
            .catch(err => {
                this.setNotification('Failed to save the post!', 'danger');
                this.getErrors(err)
            });
    },


    // Update existing post
    updateArticle(data, id) {
        if (!id) {
            return false;
        }

        const request = {
            // Setup method
            method: "put",
            // Setup url
            url: "article/" + id,
            // Setup the post object to send
            data,
            //  Headers are setup up in the interceptor of axios
        };


        // Update existing post
        axios(request)
            .then(res => {
                this.setNotification();
                this.getArticles();
                this.article = null;
            })
            .catch(err => {
                this.setNotification('Failed to save the post!', 'danger');
                this.getErrors(err);
            });
    },


    // Deletes one post
    deleteArticle() {
        // Confirm that user wants to delete post
        const confirm = window.confirm(`Delete Article: "${this.article?.title}"`);

        // If user confirms delete then proceed
        if (true === confirm) {
            // Setup the API request
            axios({
                // Set method to delete
                method: "delete",
                // Setup the URL for the post to delete
                url: 'article/' + this.article.id,
            })
                .then(res => {
                    this.setNotification('Deleted the post!');
                    this.getArticles();
                    this.article = null;
                })
                .catch(err => {
                    this.setNotification('Failed to delete the post!', 'danger');
                    this.getErrors(err);
                });
        }
    }

});

