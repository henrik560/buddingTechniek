<script setup>
import { Head } from '@inertiajs/vue3';
import { computed, onMounted, ref } from 'vue'
import Swiper, { Navigation } from 'swiper';
import 'swiper/css';
import 'swiper/css/pagination';
import 'swiper/css/navigation';

import ContactPopup from '@/Components/ContactPopup/ContactPopup.vue';

const props = defineProps({
    vehicle: {
        type: Object,
        required: true
    }
})

const swiperThumbnail = ref();
const swiperSlides = ref();
const contactPopupIsOpen = ref(false);

const toggleContactPopup = () => {
    contactPopupIsOpen.value = !contactPopupIsOpen.value;

    if (contactPopupIsOpen.value) {
        window.scrollTo(0, 0);
        return document.body.classList.add('overflow-hidden')
    }

    return document.body.classList.remove('overflow-hidden')
}

const changeSlide = (index) => {
    return swiperSlides.value.slideTo(index);
}

const clickListImage = (index) => {
    swiperThumbnail.value.slideTo(index);
}

const getVehiclePrice = computed(() => {
    if (props.vehicle.price_notk) {
        return 'N.O.T.K';
    }

    return props.vehicle.price;
})

onMounted(() => {
    swiperThumbnail.value = new Swiper('.vehicle-images-thumbnail-swiper', {
        loop: true,
        slidesPerView: 1,
        effect: "creative",
        grabCursor: true,
        creativeEffect: `{
            prev: {
                shadow: true,
                translate: ['-120%', 0, -500],
            },
            next: {
                shadow: true,
                translate: ['120%', 0, -500],
            },
        }"`,
        on: {
            slideChangeTransitionStart: function () {
                changeSlide(swiperThumbnail.value.realIndex)
            },
        }
    });

    swiperSlides.value = new Swiper('.vehicle-images-swiper', {
        slidesPerView: 2,
        spaceBetween: 24,
        breakpoints: {
            440: {
                slidesPerView: 3,
            },
            640: {
                slidesPerView: 4
            }
        },
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
                <div class="section-header flex flex-col md:flex-row">
                    <div class="column column-left w-full md:w-7/12">
                        <div class="page-back-button border-b-2 border-secondary hover:border-gray-200 w-fit mb-6 duration-300 group">
                            <a href="/occasions" class="text-lg flex gap-2 group-hover:text-secondary duration-300"><span class="duration-300 group-hover:text-gray-200 text-secondary font-bold">&lt;</span>Terug naar overzicht</a>
                        </div>
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
                    <div class="column column-right flex flex-col w-full md:w-5/12">
                        <div class="upper">
                            <div class="header mb-6">
                                <div class="title border-b-2 border-gray-200">
                                    <h1 class="text-secondary">{{ vehicle.title }}</h1>
                                </div>
                            </div>
                            <div class="description mb-6">
                                <div class="content">
                                    <div class="row flex p-4 items-center" v-for="specification in vehicle.specifications" :key="specification.id">
                                        <div class="col w-1/2 text-xl text-white font-bold">{{ specification.spec_name }}:</div>
                                        <div class="col w-1/2 text-lg">{{ specification.spec_value }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="lower">
                            <div class="price-tag mb-6 flex items-center justify-end gap-6">
                                <div class="tag-price px-4 py-2">
                                    <p class="price text-2xl font-bold">€ {{ getVehiclePrice }}</p>
                                </div>
                            </div>
                            <div class="contact-us">
                                <div @click="toggleContactPopup" class="button bg-secondary border-2 border-secondary hover:bg-transparent duration-200 cursor-pointer p-4 text-center font-bold text-lg">
                                    <button>Contact opnemen</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <ContactPopup v-if="contactPopupIsOpen" @close-popup="toggleContactPopup" :vehicle="vehicle"></ContactPopup>
</template>