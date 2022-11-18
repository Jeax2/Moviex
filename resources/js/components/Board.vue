<template>
        <div>
            <search></search>
        </div>
        <div >
            <like :user_id="user_id"></like>
        </div>
        <div class="row">
            <h2 class="logo text-center mt-1 mb-0">Films</h2>
            <template v-for="category in categories">
                <category
                v-if="category.series == 0"
                :name="category.name"
                :series="category.series"
                :category="category.id"
                ></category>
            </template>
            <h2 class="logo text-center mt-3 mb-0">Tv series</h2>
        <template v-for="category in categories">
            <category
            v-if="category.series == 1"
            :name="category.name"
            :series="category.series"
            :category="category.id"
            ></category>
        </template>
    </div>
</template>
<script>
import axios from 'axios';

export default {
    props: {
        user_id: String,
    },
    data() {
        return { 
        contents: [],
        categories: [],
        }
    },
    mounted() {
        this.getContents();
        this.getCategories();
    },
    methods: {
        deleteContent(e) {
            this.contents = this.contents.filter( o => o.id !== e);
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
    }
}
</script>