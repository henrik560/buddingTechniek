<script setup>
import { ref } from "vue";

const emit = defineEmits(['toggle-sort-filter-option']);

const activeSortFilter = ref('Relevantie');
const filterOpen = ref(false);

const toggleFilter = () => {
    filterOpen.value = !filterOpen.value;
}

const toggleOption = (event, option) => {
    activeSortFilter.value = event.target.innerText;
    emit('toggle-sort-filter-option', option);
    toggleFilter();
}

</script>

<template>
    <div class="vue-vehicle-topbar mb-8">
        <div class="inner flex justify-end">
            <div class="sort-filter flex gap-4">
                <div class="info flex items-center justify-center">
                    <span class="text-secondary text-lg font-medium">Sorteren op: </span>
                </div>
                <div class="filter-container relative w-48">
                    <div @click="toggleFilter" class="title cursor-pointer p-2 flex justify-between border-2 border-primary gap-3">
                        <span class="text text-black">{{ activeSortFilter }}</span>
                        <span class="icon">
                            <i class="fa-solid fa-chevron-down" style="color: #000000;"></i>
                        </span>
                    </div>
                    <div :class="{'hidden' : !filterOpen}" class="options absolute z-10 bg-white w-48 flex border-l-2 border-r-2 border-primary flex-col gap-2">
                        <div @click="toggleOption($event, 'relevance')" class="option text-black cursor-pointer hover:bg-gray-200 p-2">
                            <span>Relevantie</span>
                        </div>
                        <div @click="toggleOption($event, 'price_low_to_high')" class="option text-black cursor-pointer hover:bg-gray-200 p-2">
                            <span>Prijs laag - hoog</span>
                        </div>
                        <div @click="toggleOption($event, 'price_high_to_low')" class="option text-black cursor-pointer hover:bg-gray-200 p-2">
                            <span>Prijs hoog - laag</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>