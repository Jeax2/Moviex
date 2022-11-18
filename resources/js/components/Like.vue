<style>
.scrolling-wrapper {
  overflow-x: scroll;
  overflow-y: hidden;
  white-space: nowrap;
}
</style>
<template>
    <h3 v-if="contentsId[0] != undefined" class="m-3" id="liked-title">Liked</h3>
    <div id="carousel" class="container mb-3">
            <div class="scrolling-wrapper">
                <template v-for="contentId in contentsId">
                    <template v-for="likeContent in likeContents">
                        <template v-if="likeContent.id == contentId">
                            <content class="m-2" :title="likeContent.title" :plot="likeContent.plot" :runtime="likeContent.runtime"
                            :genre="likeContent.genre" :released="likeContent.released" :actors="likeContent.actors"
                            :director="likeContent.director" :poster="likeContent.poster" :country="likeContent.country" :youtube="likeContent.youtube"
                            :imdb_rating="likeContent.imdb_rating" :content="likeContent.id"
                            :category="category" :category_id="likeContent.category_id"></content>
                        </template>
                    </template>
                </template>
             </div>
    </div>
</template>
<script>
import axios from 'axios';

export default {
    data() {
        return {
            likeContents: {},
            contentsId: {},
            likeTitle: "hidden",
            titleTag: document.getElementById('liked-title'),

        }
    },
    props: {
        user_id: String,
        name: String,
        series: String,
        category: Number,
    },
    mounted() {
        this.getContentsId();
    },
    methods: {
        getContentsId() {
            axios.get('/api/like-user/' + this.user_id).then((response) => {
                this.contentsId = response.data.reverse(); //.reverse utilizzato per mettere i contenuti in ordine dal like più recente a quello più vecchio.
                this.getContents();

                
            })
        },
        getContents() {
                axios.get('/api/contents').then((response) => {
                    this.likeContents = response.data;
                })
            }        
        
    },


}
</script>

