<style>
.grey-color {
    background-color: rgb(61, 62, 60) !important;
    color: white;
}
</style>
<template>
    <div class="container">
        <div class="table-responsive grey-color">
            <table class="table grey-color">
                <thead>
                    <tr class="grey-color">
                        <th scope="col grey-color">Name</th>
                        <th scope="col">Is a serie tv?</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="" v-for="category in categories">
                        <td scope="row">{{ category.name }}</td>
                        <td v-if="category.series == 1">Yes</td>
                        <td v-if="category.series == 0">No</td>
                        <td><button class="me-2 btn color" @click="edit(category.id)">Edit</button><button class="me-2 btn color" @click="destroy" :value="category.id">Delete</button></td>
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
        categories: [],
        }
    },
    methods: {
        edit(id) {
            this.$emit('edit-category', {
                idCategory: id,
            })
        },
        getCategories() {
            axios.get('/api/categories').then((response) => {
                this.categories = response.data;
            })
        },
        destroy(content) {
            axios.delete('api/categories/' + content.target.value);
            this.getCategories();
        },
    },
    mounted() {
        this.getCategories();
    }
}
</script>