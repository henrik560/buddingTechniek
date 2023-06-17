<script setup>
import { computed, ref, onMounted } from 'vue';
import Swiper, { Pagination, Navigation } from 'swiper';
import 'swiper/css';
import 'swiper/css/pagination';
import 'swiper/css/navigation';

const emit = defineEmits(['close-popup']);

const props = defineProps({
    vehicle: {
        type: Object,
        required: true
    }
});

const name = ref();
const email = ref();
const phonenumber = ref();
const message = ref();
const formResponse = ref();

const formIsValid = computed(() => {
    return !_.isNil(name.value) && !_.isNil(email.value) && !_.isNil(phonenumber.value) && !_.isNil(message.value);
})

const getVehiclePrice = computed(() => {
    if (props.vehicle.price_notk) {
        return 'N.O.T.K';
    }

    return props.vehicle.price;
})

const closePopup = () => {
    emit('close-popup');
}

const submitForm = (event) => {
    event.preventDefault();

    if (!formIsValid.value) {
        return;
    }

    axios.post('/api/contact-form', 
        {
            name: name.value,
            email: email.value,
            phonenumber: phonenumber.value,
            message: message.value,
            vehicle: {title: props.vehicle.title , permalink: window.location.href}
        })
            .then((response) => {
                formResponse.value = response;
            })
            .catch((error) => {
                formResponse.value = error.response
            })
            .finally(() => {
                setTimeout(() => {
                    closePopup();
                }, 2500);
            })

}

onMounted(() => {
    let swiperOptions = {
        slidesPerView: 1,
        spaceBetween: 24,
        loop: true,
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
        modules: [Navigation]
    };

    const swiper = new Swiper('.vehicle-images-swiper', swiperOptions);
})

</script>

<template>
    <div class="vue-contact-popup absolute top-0 left-0 w-full h-full z-50">
        <div class="wrapper w-screen h-screen flex items-center justify-center">
            <div class="container bg-primary p-6">
                <div class="inner flex gap-8 flex-col md:flex-row relative">
                    <div class="column w-full md:w-7/12">
                        <h1 class="text-secondary w-11/12 md:w-full">{{ vehicle.title }}</h1>
                        <div class="form flex flex-col gap-6">
                            <div class="form-item flex flex-col">
                                <label class="text-2xl font-bold mb-3" for="name">Naam <span class="text-secondary">*</span></label>
                                <input class="form-input text-black" v-model="name" name="name" id="name" type="text" placeholder="John Doe" />
                            </div>
                            <div class="form-item flex flex-col">
                                <label class="text-2xl font-bold mb-3" for="email">E-Mailadres <span class="text-secondary">*</span></label>
                                <input class="form-input text-black" v-model="email" name="email" id="email" type="email" placeholder="JohnDoe@example.com" />
                            </div>
                            <div class="form-item flex flex-col">
                                <label class="text-2xl font-bold mb-3" for="phonenumber">Telefoonnummer <span class="text-secondary">*</span></label>
                                <input class="form-input text-black" v-model="phonenumber" name="phonenumber" id="phonenumber" type="text" placeholder="0123456789" />
                            </div>
                            <div class="form-item flex flex-col">
                                <label class="text-2xl font-bold mb-3" for="message">Message <span class="text-secondary">*</span></label>
                                <textarea class="form-input text-black" v-model="message" name="message" rows="4" id="message" placeholder="Bericht..."></textarea>
                            </div>
                            <div class="response flex flex-col" v-if="formResponse"
                                :class="[formResponse.status == 200 ? 'success text-green-500' : 'error text-secondary']">
                                <div class="response-message">{{ formResponse.data.message }}</div>
                            </div>
                            <div :class="[ formIsValid ? 'bg-secondary valid': 'bg-custom-gray-200 text-secondary invalid' ]" class="form-item button-wrapper p-4 group font-bold duration-300 flex flex-col">
                                <button @click="submitForm" class="button duration-100">Contact opnemen</button>
                            </div>
                        </div>
                    </div>
                    <div class="column w-full md:w-5/12">
                        <div class="close-page flex justify-end cursor-pointer" @click="closePopup">
                            <div class="close-icon absolute top-0">
                                <i class="fa-solid fa-xmark text-white icon text-3xl"></i>
                            </div>
                        </div>
                        <div class="swiper block-mobile-hidden vehicle-images-swiper relative mt-12 mb-6">
                            <div class="swiper-wrapper">
                                <div class="swiper-slide" v-for="image in vehicle.images" :key="image.id">
                                    <img :src="image.permalink" alt="vehicle image no alt" class="w-full h-full aspect-video object-cover" />
                                </div>
                            </div>
                            <div class="swiper-button-next"></div>
                            <div class="swiper-button-prev"></div>
                        </div>
                        <div class="specifications mb-6 block-mobile-hidden">
                             <div class="row flex p-4 items-center" v-for="specification in vehicle.specifications" :key="specification.id">
                                <div class="col w-1/2 text-xl text-white font-bold">{{ specification.spec_name }}:</div>
                                <div class="col w-1/2 text-lg">{{ specification.spec_value }}</div>
                            </div>
                        </div>
                        <div class="price-tag flex items-center justify-end block-mobile-hidden">
                            <div class="tag-price px-4 py-2">
                                <p class="price text-2xl font-bold">€ {{ getVehiclePrice }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>