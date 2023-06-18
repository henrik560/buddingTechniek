<script setup>
import axios from 'axios';
import { onMounted, ref, computed } from 'vue';

import vehicleCard from '@/Components/Vehicle/vehicle.vue';
import SearchBar from '@/Components/ContentBlocks/VehiclesBlock/Searchbar/searchbar.vue'
import TopBar from '@/Components/ContentBlocks/VehiclesBlock/TopBar/TopBar.vue';

const props = defineProps({
    content: {
        type: Object,
        required: true
    }
});

const vehicles = ref([]);
const searchKey = ref(null);
const sortOption = ref(null);

onMounted(() => {
    fetchVehicles();
});

const fetchVehicles = () => {
    axios.get('/api/vehicles')
        .then((response) => {
            vehicles.value = response.data.vehicles
        })
}

const handleSearchKeyChanged = (value) => {
    searchKey.value = value;
}

const toggleSortFilterOption = (option) => {
    sortOption.value = option;
}

const getVehicles = computed(() => {
    const isSearchKeyEmpty = _.isNil(searchKey.value) || _.isEmpty(searchKey.value);

    let filteredVehicles = vehicles.value;
    if (!isSearchKeyEmpty) {
        const searchValue = searchKey.value.toLowerCase();
        filteredVehicles = _.filter(filteredVehicles, (vehicle) => {
            const title = vehicle.title.toLowerCase();
            const searchKeys = vehicle.search_keys.map(key => key.toLowerCase());
            return _.includes(title, searchValue) || searchKeys.some(key => {
                const tagKey = key.replace(/-/g, ' ');
                return tagKey.includes(searchValue);
            });
        });
    }

    if (sortOption.value == 'price_low_to_high') {
        filteredVehicles = _.orderBy(filteredVehicles, ['price_notk', 'price'], ['desc', 'asc']);
    } else if (sortOption.value == 'price_high_to_low') {
        filteredVehicles = _.orderBy(filteredVehicles, ['price_notk', 'price'], ['desc', 'desc']);
    }

    return filteredVehicles;
});

</script>

<template>
    <div class="vue-vehicle-block">
        <div class="occasions-wrapper container mx-auto">
            <div class="row">
                <TopBar @toggle-sort-filter-option="toggleSortFilterOption"></TopBar>
            </div>
            <div class="row flex gap-8 md:gap-16 md:flex-row flex-col">
                <div class="column-left w-full md:w-80">
                    <div class="row">
                        <SearchBar @search-key-changed="handleSearchKeyChanged"></SearchBar>
                    </div>
                </div>
                <div class="column-right w-full">
                    <div class="vehicles-wrapper flex flex-wrap gap-6">
                        <vehicleCard v-for="vehicle in getVehicles" :key="vehicle.id" :vehicle="vehicle"></vehicleCard>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>