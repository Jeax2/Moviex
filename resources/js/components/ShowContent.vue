<style>
iframe {
    height: 230px;
    width: 350px;
}
@media screen and (min-width: 600px) {
    video, iframe {
        width: 500px;
        height: 300px;
    }
}

@media screen and (min-width: 900px) {
    video, iframe {
        width: 800px;
        height: 500px;
    }
}
.heart {cursor: pointer;}
</style>
<template>
    <p>
        <span class="logo" style="font-size:large">{{ contentTitle }}</span>
        <div class="float-end">

            <span class="" v-if="like == 1">
                <img class="heart" src="https://www.freepnglogos.com/uploads/heart/clip-art-black-outline-heart-images-39.png" alt=""
                    width="25" @click="removeLike()"></span>
            <span class="" v-if="like == 0">
                <img class="heart" src="https://www.freepnglogos.com/uploads/heart/black-and-white-heart-clipart-4.png" alt="" width="25"
                    @click="addLike()">
            </span>
            <span style="font-size:x-small"> Total like: {{ totalLikes }}</span>
        </div>
    </p>
    <div class="row">
        <div class="col d-flex justify-content-center">
            <iframe class="" :src="'https://www.youtube.com/embed/' + contentYoutube " title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        </div>
    </div>
    <p>
        <span style="font-size:large; font-weight: bold;">Plot: </span><span>{{ contentPlot }}</span>
    </p>
    <p><span style="font-size:large; font-weight: bold;">Genre: </span>{{ contentGenre }}</p>
    <p><span style="font-size:large; font-weight: bold;">Runtime: </span>{{ contentRuntime }}</p>
    <p><span style="font-size:large; font-weight: bold;">Released: </span>{{ contentReleased }}</p>
    <p><span style="font-size:large; font-weight: bold;">Actors: </span>{{ contentActors }}</p>
    <p><span style="font-size:large; font-weight: bold;">Director: </span>{{ contentDirector }}</p>
    <p><span style="font-size:large; font-weight: bold;">Country: </span>{{ contentCountry }}</p>
    <p><span style="font-size:large; font-weight: bold;">IMDB rating: </span>{{ contentImdbRating }}</p>

</template>
<script>
export default {
    data() {
        return {
            contentData: {},
            contentTitle: "",
            contentPlot: "",
            contentGenre: "",
            contentRuntime: "",
            contentReleased: "",
            contentActors: "",
            contentDirector: "",
            contentCountry: "",
            contentYoutube: "",
            contentImdbRating: "",

            //Likes
            contentLikeData: {},
            like: 0,
            like_id: "",
            totalLikes: 0,
        }
    },
    props: {
        content_id: String,
        user: String,
    },
    methods: {
        getContentData() {
            axios.get('/api/contents/' + this.content_id).then((response) => {
                this.contentData = response.data;
                this.contentTitle = this.contentData.title
                this.contentPlot = this.contentData.plot
                this.contentGenre = this.contentData.genre
                this.contentRuntime = this.contentData.runtime
                this.contentReleased = this.contentData.released
                this.contentActors = this.contentData.actors
                this.contentDirector = this.contentData.director
                this.contentCountry = this.contentData.country
                this.contentYoutube = this.contentData.youtube
                this.contentImdbRating = this.contentData.imdb_rating
                this.getContentLike();
                this.getTotalLike();
            })
        },
        getTotalLike() {
            axios.get('/api/like/content/' + this.content_id).then((response) => {
                this.totalLikes = response.data;
            });
        },
        getContentLike() {
            axios.get('/api/like/' + this.user + '/content/' + this.content_id).then((response) => {
                this.contentLikeData = response.data;
                if (this.contentLikeData.content_id == this.content_id) {
                    this.like = 1;
                    this.like_id = this.contentLikeData.id;
                } else {

                    this.like = 0;
                }
            });
        },
        addLike() {
            axios.post('/api/likes', {
                content_id: this.content_id,
                user_id: this.user,
            })
            this.getContentData();
        },
        removeLike() {
            this.getContentData();
            axios.delete('/api/likes/' + this.like_id);
        }
    },
    mounted() {
        this.getContentData();
    }
}

</script>