<script setup>

const props = defineProps({
    category: {
        type: Object,
        required: true
    }
})

</script>

<template>
    <a href="/occasions" class="vue-vehicle-category bg-custom-gray-200 p-4 rounded-2xl cursor-pointer">
        <div class="inner flex gap-6">
            <div class="icon w-16 h-16">
                <img class="aspect-square object-contain" :src="category.tag_icon.permalink" alt="Machine Category Icon">
            </div>
            <div class="title my-auto">
                <h3 class="duration-300 text-2xl mb-0 text-white tracking-wide">{{ category.title }}</h3>
            </div>
        </div>
    </a>
</template>