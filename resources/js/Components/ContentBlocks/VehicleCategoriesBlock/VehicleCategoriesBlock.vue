<script setup>
import { ref, onMounted } from 'vue';

import Category from './Category/Category.vue'

const props = defineProps({
    content: {
        type: Object,
        required: true
    }
});

onMounted(() => {
    fetchCategories();
})

const categories = ref([]);

const fetchCategories = () => {
    axios.get(`/api/taxonomy/tags`)
        .then((response) => {
            if (response.data.taxonomy) {
                categories.value = response.data.taxonomy;
            }
        })
}

</script>

<template>
    <div class="vue-vehicle-categories-block section">
        <div class="container">
            <div class="inner">
                <div class="header mb-12">
                    <div class="content" v-html="content.content"></div>
                </div>
                <div class="body">
                    <div class="categories grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        <Category v-for="category in categories" :key="category.id" :category="category"></Category>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>