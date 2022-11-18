<template>
    <div class="container">
        <input type="text" name="search" class="black-input" placeholder="Search for content ..." v-model="titleSearch" @input="getSearchContents">
    </div>
    <div id="carousel" class="container">
        <div class="container">
            <div class="" v-if="titleSearch != ''">
                <p class="mt-1 fst-italic">You searched for '{{ titleSearch }}' ...</p>
                <template v-for="searchContent in searchContents" class="">
                    <content class="" :title="searchContent.title" :plot="searchContent.plot" :runtime="searchContent.runtime"
                    :genre="searchContent.genre" :released="searchContent.released" :actors="searchContent.actors"
                    :director="searchContent.director" :poster="searchContent.poster" :country="searchContent.country"
                    :imdb_rating="searchContent.imdb_rating" :content="searchContent.id"
                    :category_id="searchContent.category_id"></content>
                </template>
                <hr style="color: white; border: 3px solid white">

            </div>
            <div>
            </div>
            <div v-if="searchContents[0] == null">
                <div>
                    <label for="">No content found</label>
                </div>
            </div>
            <div v-if="searchContents[0] != null">
                <hr>
            </div>
        </div>
    </div>
</template>
<script>
import axios from 'axios';

export default {
    data() {
        return {
            searchContents: [],
            titleSearch: '',

        }
    },
    mounted() {
        this.getSearchContents();
    },
    methods: {
        getSearchContents() {
            if(this.titleSearch != '') {
                axios.get('/api/search/' + this.titleSearch ).then((response) => {
                    this.searchContents = response.data;
                })
            } else {
                this.searchContents[0] = [];
            }
        },
        
        
    },


}
</script>

