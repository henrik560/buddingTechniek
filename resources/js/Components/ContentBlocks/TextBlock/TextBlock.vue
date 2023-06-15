<script setup>
import { computed } from 'vue';

const props = defineProps({
    content: {
        type: Object,
        required: true
    }
});

</script>

<template>
    <div class="vue-text-block section">
        <div class="container">
            <div class="inner">
                <div class="content" v-html="content.content"></div>
            </div>
        </div>
    </div>
</template>