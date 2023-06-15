<script setup>

const props = defineProps({
    content: {
        type: Object,
        required: true
    }
})

</script>

<template>
    <div class="vue-header-full-block overflow-hidden">
        <div class="wrapper relative">
            <div class="header-image absolute h-full w-full z-0 w-screen">
                <img loading="eager" class="image w-full h-full object-cover"
                    :src="content.thumbnail.permalink" />
            </div>
            <div class="container mx-auto relative z-10 h-full w-full flex items-center">
                <div class="inner w-full md:w-2/4 p-6 rounded-2xl">
                    <div class="content text-white" v-html="content.content"></div>
                </div>
            </div>
        </div>
    </div>
</template>