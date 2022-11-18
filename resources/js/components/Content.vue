<style>
.card-img-overlay:hover, .card-inline-block {
    display: inline-block;
    background-color: rgba(74, 73, 73, 0.73);
    margin-bottom: -2px;
}
.card-img-overlay:hover {
    margin-right: -2px;
}
.card-title-center, .card-title-center:hover {
    display: inline-block;
    background-color: rgba(74, 73, 73, 0);

}
.poster {
    height: 300px;
    width: 200px;
}
@media screen and (max-width: 600px) {
    .poster {
        height: 150px;
        width: 90px;
    }
    .content {
        height: 150px;
        width: 90px;
    }
    .title-content {
        font-size: 1em;
    }

}
</style>
<template class="d-flex justify-content-center">
    <div class="card text-wrap card-inline-block content mx-1" @mouseover="hover = true" @mouseleave="hover = false">
        <img class="item-image poster" :src="poster"/>
        <a :href="'contents/'+ content">
            <div v-if="hover == true" class="card-img-overlay">
                <h3 class="card-img-overlay card-title-center text-center title-content">{{ title }}</h3>
            </div>
        </a>
    </div>   
</template>
<script>
    export default {
         data() {
            return {
                hover: false
            }
         },
        props: {
            title: String,
            plot: String,
            runtime: String,
            genre: String,
            released: String,
            actors: String,
            director: String,
            poster: String,
            country: String,
            youtube: String,
            imbd_rating: String,
            content: Number,
            category: Number,
            category_id: Number,
        },
    }
    
</script>