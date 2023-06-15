<script setup>
import { onMounted, ref } from 'vue';
import Swiper, { Pagination } from 'swiper';
import 'swiper/css';
import 'swiper/css/pagination';

import vehicleCard from '@/Components/Vehicle/vehicle.vue';

const props = defineProps({
    content: {
        type: Object,
        required: true
    }
});

const vehicles = ref([]);

const fetchRecentVehicles = () => {
    axios.get('/api/vehicles/recent')
        .then((response) => {
            vehicles.value = response.data.vehicles;
        });
};

onMounted(() => {
    fetchRecentVehicles();

    let swiperOptions = {
        slidesPerView: 1.25,
        spaceBetween: 24,
        breakpoints: {
            460: {
                slidesPerView: 2.1,
            },
            630: {
                slidesPerView: 3.1,
            },
            1024: {
                slidesPerView: 4,
            },
        },
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
            dynamicBullets: true,
        },
        modules: [Pagination]
    };

    const swiper = new Swiper('.recent-vehicles-block-swiper', swiperOptions);
});
</script>

<template>
    <div class="vue-recent-vehicles-block section">
        <div class="container">
            <div class="inner">
                <div class="header mb-12">
                    <div class="content" v-html="content.content"></div>
                </div>
                <div class="body recent-vehicles-block-swiper swiper">
                    <div class="vehicles swiper-wrapper">
                        <vehicle-card class="swiper-slide" v-for="vehicle in vehicles" :key="vehicle.id"
                            :vehicle="vehicle"></vehicle-card>
                    </div>
                </div>
                <div class="swiper-pagination mx-auto flex gap-2 justify-center"></div>
            </div>
        </div>
    </div>
</template>