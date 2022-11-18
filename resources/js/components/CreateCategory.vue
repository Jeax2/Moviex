<style>

.black-check {
  position: relative;
  cursor: pointer;
}

.black-check:before {
  content: "";
  position: absolute;
  width: 16px;
  height: 16px;
  top: 0;
  left: 0;
  border: 1px solid white;
  border-radius: 3px;
  padding: 1px;
  background-color: rgb(34, 33, 33);
}

.black-check:checked:before {
  background-color: rgb(34, 33, 33);
}

.black-check:checked:after {
  content: "";
  display: block;
  width: 5px;
  height: 10px;
  border: solid white;
  border-width: 0 2px 2px 0;
  -webkit-transform: rotate(45deg);
  -ms-transform: rotate(45deg);
  transform: rotate(45deg);
  position: absolute;
  top: 2px;
  left: 6px;
}

</style>
<template>
    <div class=container>
        <!-- Section for errors -->
        <section id="section-errors">

        </section>
        <!-- Section for alerts -->
        <section v-if="message_visibility == true">
            <alerts :message="this.message"></alerts>
        </section>
        
        <div class="grey-color">
            <div class="card creator grey-color" id="creator">
                <div class="card-body grey-color">
                    <h4 class="card-title text-center logo">Create Category</h4>
                    <label for="name" class="p-0 mt-2">Name:</label>
                    <input type="text" class="black-input" id="name" v-model="name">
                    <label for="series" class="p-0 mt-2">Series?</label>
                    <input type="checkbox" class="black-check m-3" style="background-color: black;" name="series" id="series" v-model="series"><br>
                    <button class="btn me-2 color" @click="createCategory">Create</button>
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
            name: "",
            series: false,

            //alerts
            message: "",
            message_visibility: false,
        }
    },
    methods: {
        createCategory() {
            axios.post('api/categories', {
                name: this.name,
                series: this.series,
            });
            this.message = 'Category  created successfully!';
            this.message_visibility = true;
            setTimeout(() => {
                this.message_visibility = false;
            }, 3000);
        },
        seeMessage() {
            this.message = 'Category  created successfully!';
            this.message_visibility = true;
            setTimeout(() => {
                this.message_visibility = false;
            }, 3000);

        },



    }
}
</script>