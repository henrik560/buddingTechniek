<script setup>

const props = defineProps({
    content: {
        type: Object,
        required: true
    }
})

</script>

<template>
    <div class="vue-header-video-block vue-header-full-block overflow-hidden">
        <div class="wrapper relative">
            <div class="header-video relative h-full w-screen z-0"> 
                <video autoplay muted playsinline loop controls="false" class="mx-auto pointer-events-none object-scale-down">
                    <source :src="content.video.permalink" type="video/mp4">
                </video>
            </div>
            <div class="container mx-auto left-0 right-0 top-0 relative md:absolute z-10 w-full flex h-fit pt-12 lg:pt-44 xl:pt-80">
                <div class="inner w-full md:w-2/4 p-6 rounded-2xl">
                    <div class="content text-white" v-html="content.content"></div>
                </div>
            </div>
        </div>
    </div>
</template>