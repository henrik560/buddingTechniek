<script setup>

const props = defineProps({
    content: {
        type: Object, 
        required: true
    }
})

</script>

<template>
    <div class="vue-text-with-image section" :class="{ 'bg-custom-gray-200' : content.image_text_format }">
        <div class="container">
            <div class="inner flex items-start" :class="[ content.image_text_format ? 'flex-col-reverse md:flex-row-reverse' : 'flex-col md:flex-row' ]">
                <div class="column-left w-full md:w-1/2 my-auto">
                    <div class="content" v-html="content.content"></div>
                </div>
                <div class="column-right w-full md:w-1/2 my-auto flex items-center">
                    <div class="image-wrapper w-full h-full">
                        <img loading="lazy" :src="content.image.permalink" alt="content Image" class="image w-full h-full object-cover" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>