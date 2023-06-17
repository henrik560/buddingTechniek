<script setup>
import { ref, watch } from 'vue';

const emit = defineEmits(['search-key-changed']);

const searchKey = ref(null);

watch(searchKey, (newValue) => {
    // Emit the custom event 'search-key-changed' with the new value
    emit('search-key-changed', newValue);
});

</script>

<template>
    <div class="vue-vehicle-searchbar">
        <div class="searchbar-wrapper">
            <div class="inner w-full">
                <input class="w-full text-black" type="text" v-model="searchKey" placeholder="Zoeken..." />
            </div>
        </div>
    </div>
</template>
