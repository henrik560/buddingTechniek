<script setup>
import { ref, computed, onMounted } from 'vue';

const props = defineProps({
    content: {
        type: Object,
        required: true
    }
})

const name = ref(null);
const email = ref(null);
const phonenumber = ref(null);
const message = ref(null);
const formResponse = ref(null);
const companyDetails = ref([]);

const formIsValid = computed(() => {
    return !_.isNil(name.value) && !_.isNil(email.value) && !_.isNil(phonenumber.value) && !_.isNil(message.value);
})

const clearForm = () => {
    name.value = null;
    email.value = null;
    phonenumber.value = null;
    message.value = null;
}

const submitForm = (event) => {
    event.preventDefault();

    axios.post('/api/contact-form', {
        name: name.value,
        email: email.value,
        phonenumber: phonenumber.value,
        message: message.value
    })
        .then((response) => {
            formResponse.value = response

            clearForm();
        })
        .catch((error) => {
            formResponse.value = error.response
        })
}

const fetchCompanyDetails = () => {
    axios.get('/api/global/company')
        .then((response) => {
            companyDetails.value = response.data.globals.data
        })
}

onMounted(() => {
    fetchCompanyDetails();
});

</script>

<template>
    <div class="vue-contact-block large-contact-block section">
        <div class="container">
            <div class="inner flex gap-8 flex-col-reverse md:flex-row">
                <div class="column w-full md:w-1/2 flex flex-col items-center">
                    <div class="content w-full">
                        <h1 class="hidden md:block"><a>Contact</a> gegevens:</h1>
                        <div class="details flex flex-col gap-2">
                            <p class="address flex items-center gap-2">{{ companyDetails.address }}</p>
                            <p class="phonenumber flex items-center gap-2">{{ companyDetails.phonenumber }}</p>
                            <p class="email flex items-center gap-2">{{ companyDetails.email }}</p>
                            <p class="kvk flex items-center gap-2">{{ companyDetails.kvk_number }}</p>
                            <p class="tax flex items-center gap-2">{{ companyDetails.tax_number }}</p>
                        </div>
                        <p class="visit_by_appointment">U kunt ons alleen bezoeken op afspraak!</p>
                        <div class="office-hours mt-4 mb-12 flex flex-col gap-2">
                            <div class="row flex justify-between border-b-2 border-gray-200 pb-px">
                                <div class="col w-1/2">Maandag</div>
                                <div class="col w-1/2">{{ companyDetails.monday }}</div>
                            </div>
                            <div class="row flex justify-between border-b-2 border-gray-200 pb-px">
                                <div class="col w-1/2">Dinsdag</div>
                                <div class="col w-1/2">{{ companyDetails.tuesday }}</div>
                            </div>
                            <div class="row flex justify-between border-b-2 border-gray-200 pb-px">
                                <div class="col w-1/2">Woensdag</div>
                                <div class="col w-1/2">{{ companyDetails.wednesday }}</div>
                            </div>
                            <div class="row flex justify-between border-b-2 border-gray-200 pb-px">
                                <div class="col w-1/2">Donderdag</div>
                                <div class="col w-1/2">{{ companyDetails.thursday }}</div>
                            </div>
                            <div class="row flex justify-between border-b-2 border-gray-200 pb-px">
                                <div class="col w-1/2">Vrijdag</div>
                                <div class="col w-1/2">{{ companyDetails.friday }}</div>
                            </div>
                            <div class="row flex justify-between border-b-2 border-gray-200 pb-px">
                                <div class="col w-1/2">Zaterdag</div>
                                <div class="col w-1/2">{{ companyDetails.saturday }}</div>
                            </div>
                            <div class="row flex justify-between border-b-2 border-gray-200 pb-px">
                                <div class="col w-1/2">Zondag</div>
                                <div class="col w-1/2">{{ companyDetails.sundag }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="google-maps-embed w-full h-full">
                        <iframe class="gmap_embed" :src="content.google_maps_embed" width="100%" height="600" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                    </div>
                </div>
                <div class="column w-full md:w-1/2">
                    <div class="inner-col w-ful">
                        <h1 class="md:hidden block"><a>Contact</a> gegevens:</h1>
                        <p class="description mb-8" v-html="content.content"></p>
                        <div class="form-wrapper">
                            <form class="form">
                                <div class="input flex flex-col mb-6">
                                    <label class="font-bold text-2xl mb-2" for="name">Naam <span
                                            class="text-secondary">*</span></label>
                                    <input placeholder="John Doe" id="name" v-model="name" type="text"
                                        class="text-primary input-item" name="Naam">
                                </div>
                                <div class="input flex flex-col mb-6">
                                    <label class="font-bold text-2xl mb-2" for="email">E-mailadres <span
                                            class="text-secondary">*</span></label>
                                    <input placeholder="JohnDoe@example.com" v-model="email" id="email" type="email"
                                        class="text-primary input-item" name="email">
                                </div>
                                <div class="input flex flex-col mb-6">
                                    <label class="font-bold text-2xl mb-2" for="phonenumber">Telefoon nummer <span
                                            class="text-secondary">*</span></label>
                                    <input placeholder="0123456789" id="phonenumber" v-model="phonenumber" type="text"
                                        class="text-primary input-item" name="phonenumber">
                                </div>
                                <div class="input flex flex-col mb-6">
                                    <label class="font-bold text-2xl mb-2" for="message">Bericht <span
                                            class="text-secondary">*</span></label>
                                    <textarea placeholder="Bericht..." class="text-primary" rows="4" id="message"
                                        v-model="message" name="message"></textarea>
                                </div>
                                <div class="response flex flex-col mb-6" v-if="formResponse"
                                    :class="[formResponse.status == 200 ? 'success text-green-500' : 'error text-secondary']">
                                    <div class="response-message">{{ formResponse.data.message }}</div>
                                </div>
                                <div class="input input-submit flex flex-col mb-6"
                                    :class="[formIsValid ? 'valid' : 'invalid']">
                                    <input @click="submitForm" class="p-4 font-bold" type="submit" value="Verzenden" />
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>