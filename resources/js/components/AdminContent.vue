<style>
.poster-admin {
        height: 150px;
        width: 75px;
    }
@media screen and (max-width: 600px) {
    .poster-admin {
        height: 90px;
        width: 75px;
    }
    tr {
        font-size: 0.7em;;
    }
}
</style>
<template>
    <div class="container">
        <div class="table-responsive">
            <table class="table grey-color">
                <thead>
                    <tr>
                        <th scope="col">Title</th>
                        <!-- <th scope="col">Plot</th> -->
                        <!-- <th scope="col">Genre</th> -->
                        <!-- <th scope="col">Released</th> -->
                        <!-- <th scope="col">Actors</th> -->
                        <!-- <th scope="col">Director</th> -->
                        <th scope="col">Poster</th>
                        <!-- <th scope="col">Country</th> -->
                        <!-- <th scope="col">Imdb Rating</th> -->
                        <th scope="col">Category</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="" v-for="content in contents">
                        <td>{{ content.title }}</td>
                        <!-- <td>{{ content.plot }}</td> -->
                        <!-- <td>{{ content.genre }}</td> -->
                        <!-- <td>{{ content.released }}</td> -->
                        <!-- <td>{{ content.actors }}</td> -->
                        <!-- <td>{{ content.director }}</td> -->
                        <td><img class="poster-admin" :src="content.poster" alt=""></td>
                        <!-- <td>{{ content.country }}</td> -->
                        <!-- <td>{{ content.imdb_rating }}</td> -->
                        <template v-for="category in categories">
                            <td v-if="category.id == content.category_id">{{ category.name}}</td>
                        </template>
                        <td><button  class="me-2 mb-2 btn color" @click="edit(content.id)">Edit</button><button class="me-2 btn color" @click="destroy" :value="content.id">Delete</button></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>
<script>
import axios from 'axios';

export default {
    data() {
        return {
            contents: [],
            categories: [],
            title: '',
            plot: '',
            runtime: '',
            genre: '',
            released: '',
            actors: '',
            director: '',
            poster: '',
            country: '',
            imbd_rating: '',
            content: '',
        }
    },
    methods: {
        edit(id) {
            this.$emit('edit-content', {
                idContent: id,
            });
        },
        destroy(content) {
            axios.delete('api/contents/' + content.target.value);
            this.getContents();
        },
        getContents() {
            axios.get('/api/contents').then((response) => {
                this.contents = response.data;
            })
        },
        getCategories() {
            axios.get('/api/categories').then((response) => {
                this.categories = response.data;
            })
        }
    },
    mounted() {
        this.getContents();
        this.getCategories();
    }
}

</script>