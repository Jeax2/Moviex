<style>
.color {
    height: 2.5em;
    background-image: linear-gradient(#fe3149, #fb011e);
    transition: 0.5s;
    background-size: 200% auto;
    color: white;
    border-radius: 10px ;
}

.button-selected {
    color: black;
}

.button-selected:hover {
    color: black;
}
@media screen and (max-width: 600px) {
    buttom {
        font-size: 0.5em;
    }
    .color {
        font-size: 0.8em;
        height: 2.5em;
    }
}
</style>
<template>
    <div class="container">
        <section class="mb-2">
            <button id="cat" class="btn me-1 color button-selected" @click="openCat">Category</button>
            <button id="cont" class="btn me-1 color" @click="openCont">Content</button>
        </section>
        <section class="mb-1" v-if="btnCont == 'visible'">
            <button id="cont-see" class="btn me-1 color button-selected" @click="openContSee">See Edit
                Content</button>
            <button id="cont-create" class="btn me-1 color" @click="openContCreate">Create Content</button>
        </section>
        <section class="mb-1" v-if="btnCat == 'visible'">
            <button id="cat-see" class="btn me-1 color button-selected" @click="openCatSee">See Category</button>
            <button id="cat-create" class="btn me-1 color" @click="openCatCreate">Create Category</button>
        </section>
    </div>

    <create-category v-if="btnCat == 'visible' && btnCatCreate == 'visible'"></create-category>
    <admin-category v-if="btnCat == 'visible' && btnCatSee == 'visible'" @editCategory="editCategory"></admin-category>
    <create-content v-if="btnCont == 'visible' && btnContCreate == 'visible'"></create-content>
    <admin-content v-if="btnCont == 'visible' && btnContSee == 'visible'" @editContent="editContent"></admin-content>
    <section v-if="category.idCategory" id="section-edit-category" style="visibility: hidden;">
        <edit-category id="edit-category" :category="category" :singleCategory="singleCategory"
            v-if="category != {} && form_edit_category == 'visible'" @open-edit="seeEditCategory"
            @closeEdit="closeEditCategory" style="visibility: hidden'"></edit-category>
    </section>
    <section v-if="content.idContent" id="section-edit-content" style="visibility: hidden;">
        <edit-content id="edit-content" :content="content" :singleContent="singleContent"
            v-if="singleContent != {} && form_edit_content == 'visible'" @open-edit="seeEditContent"
            @closeEdit="closeEditContent" style="visibility: hidden'"></edit-content>
    </section>
</template>
<script>
export default {
    data() {
        return {
            btnCat: "visible",
            btnCont: "hidden",
            btnContCreate: "hidden",
            btnContSee: "visible",
            btnCatCreate: "hidden",
            btnCatSee: "visible",
            editForm: "hidden",
            form_edit_category: "visible",
            form_edit_content: "visible",

            editTagCategory: document.getElementById('section-edit-category'),
            editTagContent: document.getElementById('section-edit-content'),

            cat: document.getElementById('cat'),
            cont: document.getElementById('cont'),
            catSee: document.getElementById('cat-see'),
            contSee: document.getElementById('cont-see'),
            catCreate: document.getElementById('cat-create'),
            contCreate: document.getElementById('cont-create'),


            category: {},
            singleCategory: {},
            content: {},
            singleContent: {},
        }
    },
    methods: {
        //dati da inviare all'EditCategory.vue
        async getSingleCategories() {

            axios.get('/api/categories/' + this.category.idCategory).then((response) => {
                this.singleCategory = response.data;
                this.seeEditCategory();
            });
        },
        async getSingleContents() {

            axios.get('/api/contents/' + this.content.idContent).then((response) => {
                this.singleContent = response.data;
                this.seeEditContent();
            });
        },
        seeEditCategory() {
            this.form_edit_category = 'visible';
            this.btnCont = 'hidden';
            this.btnCat = 'hidden';
            this.editTagCategory = document.getElementById('section-edit-category');
            this.editTagCategory.style.cssText = 'visibility: visible;'

        },
        seeEditContent() {
            this.form_edit_content = 'visible';
            this.btnCont = 'hidden';
            this.btnCat = 'hidden';
            this.editTagContent = document.getElementById('section-edit-content');


            this.editTagContent.style.cssText = 'visibility: visible;'


        },
        closeEditCategory() {
            this.category.idCategory = "";
            //this.form_edit_category = 'hidden';
            this.btnCat = "visible";

        },
        closeEditContent() {
            this.content.idContent = "";
            //this.form_edit_category = 'hidden';
            this.btnCont = "visible";

        },
        //ricevo l'id category dall' Category.vue
        editCategory(x) {
            this.category = x;
            this.getSingleCategories();
        },
        editContent(x) {
            this.content = x;
            this.getSingleContents();
        },
        openCat() {
            this.btnCat = 'visible';
            this.btnCont = 'hidden';
            this.form_edit_category = 'hidden';
            this.form_edit_content = 'hidden';
            this.cat = document.getElementById('cat'),
                this.cat.classList.add('button-selected');
            this.cont = document.getElementById('cont'),
                this.cont.classList.remove('button-selected');
        },
        openCont() {
            this.btnCat = 'hidden';
            this.btnCont = 'visible';
            this.form_edit_category = 'hidden';
            this.form_edit_content = 'hidden';
            this.cat = document.getElementById('cat'),
                this.cat.classList.remove('button-selected');
            this.cont = document.getElementById('cont'),
                this.cont.classList.add('button-selected');
        },
        openContSee() {
            this.btnContCreate = 'hidden';
            this.btnContSee = 'visible';
            this.form_edit_category = 'hidden';
            this.form_edit_content = 'hidden';
            this.contCreate = document.getElementById('cont-create'),
                this.contCreate.classList.remove('button-selected');
            this.contSee = document.getElementById('cont-see'),
                this.contSee.classList.add('button-selected');
        },
        openContCreate() {
            this.btnContCreate = 'visible';
            this.btnContSee = 'hidden';
            this.form_edit_category = 'hidden';
            this.form_edit_content = 'hidden';
            this.contCreate = document.getElementById('cont-create'),
                this.contCreate.classList.add('button-selected');
            this.contSee = document.getElementById('cont-see'),
                this.contSee.classList.remove('button-selected');
        },
        openCatSee() {
            this.btnCatCreate = 'hidden';
            this.btnCatSee = 'visible';
            this.form_edit_category = 'hidden';
            this.form_edit_content = 'hidden';
            this.catCreate = document.getElementById('cat-create'),
                this.catCreate.classList.remove('button-selected');
            this.catSee = document.getElementById('cat-see'),
                this.catSee.classList.add('button-selected');
        },
        openCatCreate() {
            this.btnCatCreate = 'visible';
            this.form_edit_category = 'hidden';
            this.form_edit_content = 'hidden';
            this.btnCatSee = 'hidden';
            this.catCreate = document.getElementById('cat-create'),
                this.catCreate.classList.add('button-selected');
            this.catSee = document.getElementById('cat-see'),
                this.catSee.classList.remove('button-selected');
        }



    }
}
</script>