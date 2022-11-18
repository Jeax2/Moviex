<template>
    <div class=container>
        <!-- Section for errors -->
        <section id="section-errors">

        </section>
        <!-- Section for alerts -->
        <section v-if="message_visibility == true">
            <alerts :message="this.message"></alerts>
        </section>

        <div class="card creator grey-color">
            <div class="card-body">
                    <h4 class="card-title">Edit content</h4>
                    <label for="imdb_rating" class="p-0 mt-2">Category</label>
                    <select class="black-input" style="color: white" name="" id="" v-model="singleContent.category_id">
                        <option :value="category.id" v-for="category in categories">{{ category.name }}</option>
                    </select>
                    <label for="title" class="p-0 mt-2">Title: {{ singleContent.title }}</label>
                    <input type="text" class="black-input" id="title" v-model="singleContent.title">
                    <label for="plot" class="p-0 mt-2">Plot:</label>
                    <input type="text" class="black-input" id="plot" v-model="singleContent.plot">
                    <label for="runtime" class="p-0 mt-2">Runtime</label>
                    <input type="text" class="black-input" id="runtime" v-model="singleContent.runtime">
                    <label for="genre" class="p-0 mt-2">Genre</label>
                    <input type="text" class="black-input" id="genre" v-model="singleContent.genre">
                    <label for="released" class="p-0 mt-2">Released</label>
                    <input type="text" class="black-input" id="released" v-model="singleContent.released">
                    <label for="actors" class="p-0 mt-2">Actors</label>
                    <input type="text" class="black-input" id="actors" v-model="singleContent.actors">
                    <label for="director" class="p-0 mt-2">Director</label>
                    <input type="text" class="black-input" id="director" v-model="singleContent.director">
                    <label for="poster" class="p-0 mt-2">Poster</label>
                    <input type="text" class="black-input" id="poster" v-model="singleContent.poster">
                    <label for="country" class="p-0 mt-2">Country</label>
                    <input type="text" class="black-input" id="country" v-model="singleContent.country">
                    <label for="youtube" class="p-0 mt-2">Youtube</label>
                    <input type="text" class="black-input" id="youtube" v-model="singleContent.youtube">
                    <label for="imdb_rating" class="p-0 mt-2">IMDB Rating</label>
                    <input type="text" class="black-input" id="imdb_rating" v-model="singleContent.imdb_rating">
                    <br>
                    <button class="btn color" @click="editContent">Edit</button>
                </div>
        </div>
        
    </div>
</template>
<script>
import axios from 'axios';

export default {
    props: {
        content: Object,
        singleContent: Object,
    },
    data() {
        return {
            title_edit: "",
            plot_edit: "",
            runtime_edit: "",
            genre_edit: "",
            released_edit: "",
            actors_edit: "",
            director_edit: "",
            poster_edit: "",
            country_edit: "",
            youtube_edit: "",
            imdb_rating_edit: "",
            category_id_edit: "",
            xxx: "",
            content_edit: "",
            categories: {},

            //alerts
            message: "",
            message_visibility: false,
        }
    },
    mounted() {
        this.getCategories();
    },
    methods: {


        getCategories() {
            axios.get('api/categories').then((response) => {
                this.categories = response.data;
                this.$emit('open-edit');
            })

        },
        editContent() {
            axios.post('api/contents/' + this.singleContent.id, {
                title: this.singleContent.title,
                plot: this.singleContent.plot,
                genre: this.singleContent.genre,
                runtime: this.singleContent.runtime,
                released: this.singleContent.released,
                actors: this.singleContent.actors,
                director: this.singleContent.director,
                poster: this.singleContent.poster,
                country: this.singleContent.country,
                youtube: this.singleContent.youtube,
                imdb_rating: this.singleContent.imdb_rating,
                category_id: this.singleContent.category_id,
                '_method': 'put',
            }).then(response => {
                console.log(response);
            });
            this.message = 'Content  edited successfully!';
            this.message_visibility = true;
            setTimeout(() => {
                this.message_visibility = false;
            }, 3000);
            this.$emit('closeEdit');
        },
    }
}
</script>