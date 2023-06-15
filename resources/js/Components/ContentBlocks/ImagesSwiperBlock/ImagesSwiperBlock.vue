<script setup>
import { computed, onMounted } from 'vue';
import Swiper, { Pagination, Navigation } from 'swiper';
import 'swiper/css';
import 'swiper/css/pagination';
import 'swiper/css/navigation';

const props = defineProps({
    content: {
        type: Object,
        required: true
    }
});

const getSlides = computed(() => {
    return props.content.images;
});

onMounted(() => {
        let swiperOptions = {
        slidesPerView: 1,
        spaceBetween: 24,
        loop: true,
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
            dynamicBullets: true,
        },
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
        modules: [Pagination, Navigation]
    };

    const swiper = new Swiper('.images-slide-block', swiperOptions);
})

</script>

<template>
    <div class="vue-images-swiper-block section">
        <div class="container">
            <div class="inner relative">
                <div class="swiper images-slide-block mb-6">
                    <div class="swiper-wrapper h-full">
                        <div class="swiper-slide" v-for="slide in getSlides" :key="slide.id">
                            <img loading="lazy" :src="slide.permalink" alt="Swiper slide no alt" class="slide-image h-full w-full object-cover" />
                        </div>
                    </div>
                </div>
                <!-- Pagination Dots -->
                <div class="swiper-pagination flex gap-2 justify-center"></div>
                <!-- Navigation Arrows -->
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>
        </div>
    </div>
</template>