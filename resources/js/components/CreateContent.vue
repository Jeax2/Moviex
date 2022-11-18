<template>
    <div class=container>
        <!-- Section for errors -->
        <section id="section-errors">

        </section>
        <!-- Section for alerts -->
        <section v-if="message_visibility == true">
            <alerts :message="this.message"></alerts>
        </section>
        <div class="">
            <div class="card creator grey-color" id="creator" v-if="this.creator  == 'visible'">
                <div class="card-body">
                    <h4 class="card-title text-center logo mb-3">Create content</h4>
                    <label for="imdb_rating" class="p-0 mt-2">Category:</label>
                    <select  style="color: white" class="black-input" name="" id="" v-model="category_id">
                        <option value="default" disabled class="white-text">Select a category...</option>
                        <option :value="category.id" v-for="category in categories">{{ category.name }}</option>
                    </select>
                    <label for="title" class="p-0 mt-2">Title:</label>
                    <input type="text" class="black-input" id="title" v-model="title"  placeholder="Insert title ...">
                    <label for="title" class="p-0 mt-2 me-2">Flag if it is a Series Tv:</label>
                    <input type="checkbox"  name="series" id="series" v-model="series"><br>
                    <section v-if="this.series == true">
                        <label for="season" class="p-0 mt-2">Number season:</label>
                        <input type="number" class="black-input" id="season" v-model="season" min="1">
                        <label for="episode" class="p-0 mt-2">Number episode:</label>
                        <input type="number" class="black-input mb-2" id="episode" v-model="episode" min="1">
                    </section>
                    <label for="youtube" class="p-0 mt-2">Youtube:</label>
                    <input type="text" class="black-input" id="youtube" v-model="youtube"  placeholder="Insert code video youtube ...">
                    <button class="btn color mt-3 mb-3" @click="getImdbContent">Get imdb data</button><br>
                    <label for="plot" class="p-0 mt-2">Plot:</label>
                    <input type="text" class="black-input" id="plot" v-model="plot"  placeholder="Insert plot ...">
                    <label for="runtime" class="p-0 mt-2">Runtime:</label>
                    <input type="text" class="black-input" id="runtime" v-model="runtime"  placeholder="Insert untime ...">
                    <label for="genre" class="p-0 mt-2">Genre:</label>
                    <input type="text" class="black-input" id="genre" v-model="genre"  placeholder="Insert genre ...">
                    <label for="released" class="p-0 mt-2">Released:</label>
                    <input type="number" class="black-input" id="released" v-model="released" min="1" placeholder="Insert released year ...">
                    <label for="actors" class="p-0 mt-2">Actors:</label>
                    <input type="text" class="black-input" id="actors" v-model="actors" placeholder="Insert actors ...">
                    <label for="director" class="p-0 mt-2">Director:</label>
                    <input type="text" class="black-input" id="director" v-model="director" placeholder="Insert director ...">
                    <label for="poster" class="p-0 mt-2">Poster:</label>
                    <input type="text" class="black-input" id="poster" v-model="poster" placeholder="Insert url poster ...">
                    <label for="country" class="p-0 mt-2">Country:</label>
                    <input type="text" class="black-input" id="country" v-model="country" placeholder="Insert country ...">
                    <label for="imdb_rating" class="p-0 mt-2">IMDB Rating:</label>
                    <input type="text" class="black-input" id="imdb_rating" v-model="imdb_rating" placeholder="Insert Imdb rating ...">
                    <br>
                    <button class="btn color" @click="seePreview">See preview</button>
                </div>
            </div>
            <div class="card preview-content" id="preview" v-if="this.preview == 'visible'">
                <div class="card-body grey-color">
                    <h4 class="card-title text-center logo mb-3">Preview content</h4>
                    <img  class="mt-2" width="200" :src="poster" alt=""><br>
                    <label for="title" class="p-0 mt-2"><span class="logo">Title: </span><small>{{ title }}</small></label><br>
                    <label for="imdb_rating" class="p-0 mt-1"><span class="logo">Category: </span><small>{{ categories[category_id-1].name }}</small></label><br>
                    <label for="plot" class="p-0 mt-1"><span class="logo">Plot: </span><small>{{ plot }}</small></label><br>
                    <label for="runtime" class="p-0 mt-1"><span class="logo">Runtime: </span><small>{{ runtime }}</small></label><br>
                    <label for="genre" class="p-0 mt-1"><span class="logo">Genre: </span><small>{{ genre }}</small></label><br>
                    <label for="released" class="p-0 mt-1"><span class="logo">Released: </span><small>{{ released }}</small></label><br>
                    <label for="actors" class="p-0 mt-1"><span class="logo">Actors: </span><small>{{ actors }}</small></label><br>
                    <label for="director" class="p-0 mt-1"><span class="logo">Director: </span><small>{{ director }}</small></label><br>
                    <label for="country" class="p-0 mt-1"><span class="logo">Country: </span><small>{{ country }}</small></label><br>
                    <label for="toutube" class="p-0 mt-1"><span class="logo">Link youtube: </span><small>{{ youtube }}</small></label><br>
                    <label for="imdb_rating" class="p-0 my-2"><span class="logo">IMDB Rating: </span><small>{{ imdb_rating }}</small></label><br>
                    <button v-if="created == false" class="btn color me-2" @click="createContent">Create</button>
                    <button v-if="created == false" class="btn color me-2" @click="editCreateContent">Edit create content</button>
                    <button v-if="created == false" class="btn color me-2" @click="resetCreateContent">Reset create content</button>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import axios from 'axios';

export default {
    data() {
        return {
            title: "",
            plot: "",
            runtime: 0,
            genre: "",
            released: 0,
            actors: "",
            director: "",
            poster: "",
            country: "",
            youtube: "",
            imdb_rating: 0,
            imdb_contents: "",
            series: false,
            preview: "hidden",
            creator: "visible",
            season: 1,
            episode: 1,
            categories: [],
            category_id: 'default',
            categories_name: '',
            categories_id: '',
            test: [],
            link: 'https://www.omdbapi.com/?apikey=83cf2de0&t=',
            created: false,

            //Alerts
            message: "",
            message_visibility: false,
        }
    },
    mounted() {
        this.getCategories();
    },
    methods: {
        createContent() {
            axios.post('api/contents', {
                title: this.title,
                plot: this.plot,
                runtime: this.runtime,
                genre: this.genre,
                released: this.released,
                actors: this.actors,
                director: this.director,
                poster: this.poster,
                country: this.country,
                youtube: this.youtube,
                imdb_rating: this.imdb_rating,
                category_id: this.category_id,
            });
            this.message = 'Content created successfully!';
            this.created = true;
            this.message_visibility = true;
            setTimeout(() => {
                this.message_visibility = false;
            }, 3000);
        },
        getCategories() {
            axios.get('api/categories').then((response) => {
                this.categories = response.data;
                categories_name = this.name;
                categories_id = this.id;

            })

        },
        seePreview() {
            this.creator = "hidden";
            this.preview = "visible";
        },
        getImdbContent() {
            this.link = 'https://www.omdbapi.com/?apikey=83cf2de0&t=';
            if (this.series == false) {
                this.link += this.title;
            } else {
                this.link += this.title + '&Season=' + this.season + '&Episode=' + this.episode
            }
            console.log(this.link);
            axios.get(this.link).then((response) => {
                this.contents = response.data;
                this.title = this.contents.Title,
                    this.plot = this.contents.Plot,
                    this.runtime = this.contents.Runtime,
                    this.genre = this.contents.Genre,
                    this.released = this.contents.Year,
                    this.actors = this.contents.Actors,
                    this.director = this.contents.Director,
                    this.poster = this.contents.Poster,
                    this.country = this.contents.Country,
                    this.imdb_rating = this.contents.imdbRating
            })
            this.seePreview();
        },
        resetCreateContent() {
            this.title = "",
                this.plot = "",
                this.runtime = "",
                this.genre = "",
                this.released = "",
                this.actors = "",
                this.director = "",
                this.poster = "",
                this.country = "",
                this.youtube = "",
                this.imdb_rating = ""
            this.preview = "hidden";
            this.creator = "visible";
        },
        editCreateContent() {
            this.creator = "visible";
            this.preview = "hidden";
        }


    }
}
</script>