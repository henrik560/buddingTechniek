<script setup>

const props = defineProps({
    content: {
        type: Object,
        required: true
    }
})

</script>

<template>
    <div class="vue-header-half-block overflow-hidden">
        <div class="wrapper relative">
            <div class="header-image absolute w-full md:w-8/12 z-0 w-screen">
                <img loading="eager" class="image w-full object-cover h-32 relative sm:h-48 md:h-96 max-h-96" :src="content.thumbnail.permalink" />
            </div>
            <div class="container md:mx-auto relative z-10 h-32 sm:h-48 md:h-96 flex items-center">
                <div class="inner w-full">
                    <div class="content text-white" v-html="content.content"></div>
                </div>
            </div>
        </div>
    </div>
</template>