<template>
  <div>
    <section class="banner">
      <h1 class="h3">Section Banner</h1>
      <p>This is a description of this section</p>
      <div class="searchbar relative">
        <input @keydown="searchByTitle('/api-url-here/')"
               v-model="searchTerm"
               @click="togglePanel" type="search"
               placeholder="Search in entries"/>
        <b class="left margin-left-0-5">
            <font-awesome-icon :icon="['fas', 'search']" />
        </b>
      </div>
    </section>

    <div class="search-results relative">
      <div v-show="panelOpen === true" :class="{'show': panelOpen === true }"
           class="card white absolute padding-1 z-2 hide">
            <button @click="clearSearch"
                  class="close-button large topright round-large-top-right">
                <font-awesome-icon :icon="['fas', 'times']" />
            </button>
        <h2 class="fs-16 margin-top-0" v-text="'Results (' + count + ')'"></h2>
        <div id="search-results">
          <template v-for="item in results">
            <div class="box round border border-default">
              <b>
                <a :href="'/item/url/' + item.id" v-html="item.title"></a>
              </b>
              <p class="fs-14" v-html="item.content.substr(0, 120) + '...'"></p>
            </div>
          </template>
        </div>

      </div>
    </div>
  </div>
</template>

<script>
const config = {
  method: 'GET', // *GET, POST, PUT, DELETE, etc.
  mode: 'same-origin', // no-cors, *cors, same-origin
  cache: 'no-cache', // *default, no-cache, reload, force-cache, only-if-cached
  credentials: 'same-origin', // include, *same-origin, omit
  headers: {
    'Content-Type': 'application/json'
    // 'Content-Type': 'application/x-www-form-urlencoded',
  },
  redirect: 'follow', // manual, *follow, error
  referrerPolicy: 'no-referrer', // no-referrer, *no-referrer-when-downgrade, origin, origin-when-cross-origin, same-origin, strict-origin, strict-origin-when-cross-origin, unsafe-url
  // body: JSON.stringify(params) // body data type must match "Content-Type" header
};

// https://css-tricks.com/snippets/javascript/strip-html-tags-in-javascript/
const stripTagsRegex = new RegExp('(<([^>]+)>)', 'ig');


/*
*  Ajax search in entries action
*
* */
export default {
  name: 'SearchBanner',
  data() {
    return {
      searchTerm: '',
      panelOpen: false,
      count: 0,
      results: [],
    }
  },
  methods: {

    searchByTitle(apiPath, columnName = 'title') {
      // decrease the number of HTTP calls
      if (this.searchTerm.length >= 3) {
        const key = columnName + ' LIKE';
        let args = {};
        args[key] = '%' + this.searchTerm + '%';

        const queryParams = new URLSearchParams(args);

        // Send request to the api endpoint
        fetch(apiPath + '?' + queryParams.toString(), config)
            .then((response) => response.json())
            .then((data) => {
              if (!data) {
                return;
              }
              let newData = [];
              let searchTermRegex = new RegExp(`${this.searchTerm}`, "ig"); // search for all instances

              for (let i = 0; i < data.length; i++) {
                // remove html tags
                let title = data[i].title.replaceAll(stripTagsRegex, '');
                let content = data[i].content.replaceAll(stripTagsRegex, '');

                // add marks to highlight the search term in the text
                // https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/String/replace#specifying_a_string_as_the_replacement
                title = title.replaceAll(searchTermRegex, '<mark>$&</mark>');
                content = content.replaceAll(searchTermRegex, '<mark>$&</mark>');

                newData[i] = data[i];
                newData[i].title = title;
                newData[i].content = content;
              }

              this.panelOpen = true;
              this.results = newData;
              this.count = newData.length;

            });
      } else {
        // this.searchTerm = '';
        this.initializeProperties();
      }
    },

    clearSearch() {
      this.searchTerm = '';
      this.initializeProperties();
    },

    togglePanel() {
      this.panelOpen = !this.panelOpen;
    },

    initializeProperties() {
      this.count = 0;
      this.panelOpen = false;
      this.results = [];
    }

  }
}

</script>
