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
            <div class="card creator grey-color" id="creator">
                <div class="card-body">
                    <h4 class="card-title">Edit Category  {{ category.id }}</h4>
                    <label for="name" class="p-0 mt-2">Name: {{ singleCategory.name }}</label>
                    <input type="text" class="black-input" id="name" v-model="name_edit">
                    <label for="series" class="p-0 mt-2">Is a series?</label>
                    <input class="black-check ms-2" type="checkbox" name="series" id="series" v-model="series_edit"><br>
                    <button class="btn color" @click="editCategory">Edit</button>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import axios from 'axios';

export default {
    props: {
        category: Object,
        singleCategory: Object,
    },
    data() {
        return {
            name_edit: "",
            series_edit: false,
            xxx: "",
            category_edit: "",

            //alerts
            message: "",
            message_visibility: false,
        }
    },
    mounted() {
            this.getCategories();
    },
    methods: {
         getCategories() { // soluzione da usare siccome il valore di this.singleCategory.id arriva in ritardo
            axios.get('/api/categories/' + '1').then( (response) => {
            axios.get('/api/categories/' + this.singleCategory.id).then((response) => {
                this.category_edit = response.data;
                this.name_edit = this.singleCategory.name;
                if(this.singleCategory.series == 1) {
                    this.series_edit = true;
                }else {
                    this.series_edit = false;
                }
                this.$emit('open-edit');
            });
            });
        },
        editCategory() {
            axios.put('api/categories/' + this.category_edit.id, {
                name: this.name_edit,
                series: this.series_edit,
            }).then(response => {
                console.log(response);
            });
            this.message = 'Category  edited successfully!';
            this.message_visibility = true;
            setTimeout(() => {
                this.message_visibility = false;
            }, 3000);
            this.$emit('closeEdit');
        },
    }
}
</script>