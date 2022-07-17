<template>
    <div class="search">
        <form action="">
            <input
                type="text"
                class="form-control"
                placeholder="Whatre you looking for?"
                v-model="search"
                @input="searchAll()"
            />
            <button class="btn btn-primary">
                <i class="fas fa-search"></i>
            </button>
        </form>
    </div>
    <div v-if="data">
        <li v-for="item in data" :key="item.name">
            <a :href="'/product/' + item.product_slug">
                {{ item.product_name }}
            </a>
        </li>
    </div>
</template>

<script>
import { ref } from "vue";
import axios from "axios";
export default {
    setup() {
        var search = ref("");
        var data = ref("");
        const searchAll = function () {
            axios
                .post("/product-search", {
                    search: this.search,
                })
                .then(function (response) {
                    data.value = response.data;
                })
                .catch(function (error) {
                    console.log(error);
                });
        };
        return {
            search,
            searchAll,
            data,
        };
    },
};
</script>

<style></style>
