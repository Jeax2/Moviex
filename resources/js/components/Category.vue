<style>
h3, label, p {
    color: white
}
input {
    background-color: rgb(42, 40, 40);
    color: white;
}
  
</style>
<template>
    <h3 class="m-3">{{ name }}</h3>
    <div id="carousel" class="container mb-3">
        <div class="container">
            <div class="scrolling-wrapper">
                <template v-for="content in contents" class="">
                    <content class="mx-1" :title="content.title" :plot="content.plot" :runtime="content.runtime"
                    :genre="content.genre" :released="content.released" :actors="content.actors"
                    :director="content.director" :poster="content.poster" :country="content.country" :youtube="content.youtube"
                    :imdb_rating="content.imdb_rating" :content="content.id"
                    :category="category" :category_id="content.category_id" v-if="content.category_id == category"></content>
                </template>
             </div>
        </div>
    </div>
</template>
<script>
import axios from 'axios';

export default {
    data() {
        return {
            contents: [],

        }
    },
    props: {
        name: String,
        series: String,
        category: Number,
    },
    mounted() {
        this.getContents();
    },
    methods: {
        getContents() {
            axios.get('/api/contents').then((response) => {
                this.contents = response.data.reverse();
            })
        },
    },


}
</script>

