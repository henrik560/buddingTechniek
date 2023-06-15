<script setup>
import { Head } from '@inertiajs/vue3';
import ContentBlocks from '@/Components/ContentBlocks/ContentBlocks.vue';

const props = defineProps({
    title: {
        type: String,
        required: true,
    },
    content: {
        type: Object,
        required: true
    }
});

</script>

<template>
    <Head :title="title"></Head>

    <div class="page-wrapper">
        <ContentBlocks :content-blocks="content.content_blocks"></ContentBlocks>
    </div>
</template>