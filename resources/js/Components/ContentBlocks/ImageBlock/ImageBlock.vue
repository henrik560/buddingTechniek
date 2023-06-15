<script setup>

const props = defineProps({
    content: {
        type: Object,
        required: true
    }
})

</script>


<template>
    <div class="vue-image-block section">
        <div class="container">
            <div class="inner">
                <img :src="content.image.permalink" loading="lazy" alt="Content Image No Alt" class="object-cover aspect-video w-3/4 mx-auto max-h-3/4" />
            </div>
        </div>
    </div>
</template>