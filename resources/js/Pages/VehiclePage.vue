<script setup>
import { Head } from '@inertiajs/vue3';
import { computed, onMounted, ref } from 'vue'
import Swiper, { Navigation } from 'swiper';
import 'swiper/css';
import 'swiper/css/pagination';
import 'swiper/css/navigation';

const props = defineProps({
    vehicle: {
        type: Object,
        required: true
    }
})

const swiperThumbnail = ref();
const swiperSlides = ref();

const changeSlide = (index) => {
    return swiperSlides.value.slideTo(index);
}

const clickListImage = (index) => {
    swiperThumbnail.value.slideTo(index);
}

onMounted(() => {
    swiperThumbnail.value = new Swiper('.vehicle-images-thumbnail-swiper', {
        loop: true,
        slidesPerView: 1,
        on: {
            slideChangeTransitionStart: function () {
                changeSlide(swiperThumbnail.value.realIndex)
            },
        }
    });

    swiperSlides.value = new Swiper('.vehicle-images-swiper', {
        slidesPerView: 4,
        spaceBetween: 24,
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
        modules: [Navigation]
    });
})

</script>

<template>
    <Head :title="vehicle.title"></Head>

    <div class="vue-vehicle-detail-page section">
        <div class="container">
            <div class="inner">
                <div class="section-header flex">
                    <div class="column column-left w-7/12">
                        <div class="vehicle-swiper">
                            <div class="vehicle-thumbnail mb-6">
                                <div class="image-wrapper">
                                    <div class="swiper vehicle-images-thumbnail-swiper">
                                        <div class="swiper-wrapper">
                                            <div class="swiper-slide" v-for="image in vehicle.images" :key="image.id">
                                                <img :src="image.permalink" class="swiper-image w-full h-full aspect-square object-cover" alt="Vehicle image no alt" loading="lazy" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="images-slides relative">
                                <div class="swiper vehicle-images-swiper">
                                    <div class="swiper-wrapper">
                                        <div class="swiper-slide" v-for="image, index in vehicle.images" :key="image.id">
                                            <img @click="clickListImage(index)" :src="image.permalink" class="swiper-image w-full h-full object-cover" alt="Vehicle image no alt" loading="lazy" />
                                        </div>
                                    </div>
                                </div>
                                <div class="swiper-button-next next"></div>
                                <div class="swiper-button-prev prev"></div>
                            </div>
                        </div>
                    </div>
                    <div class="column column-right w-5/12">
                        <div class="header">
                            <div class="title border-b-2 border-gray-200">
                                <h1 class="text-secondary">{{ vehicle.title }}</h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>