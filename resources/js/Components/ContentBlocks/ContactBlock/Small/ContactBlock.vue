<script setup>
import { ref, computed } from 'vue';

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

</script>

<template>
    <div class="vue-contact-block section">
        <div class="container">
            <div class="inner flex gap-8">
                <div class="column w-1/2" :class="{ 'mx-auto w-full': !content.image_toggle }">
                    <div class="inner-col w-11/12" :class="{'mx-auto' : !content.image_toggle }">
                        <h2 class="title">{{ content.title }}</h2>
                        <p class="description mb-8" v-html="content.content"></p>
                        <div class="form-wrapper">
                            <form class="form">
                                <div class="input flex flex-col mb-6">
                                    <label class="font-bold text-2xl mb-2" for="name">Naam <span class="text-secondary">*</span></label>
                                    <input placeholder="John Doe" id="name" v-model="name" type="text" class="text-primary input-item" name="Naam">
                                </div>
                                <div class="input flex flex-col mb-6">
                                    <label class="font-bold text-2xl mb-2" for="email">E-mailadres <span class="text-secondary">*</span></label>
                                    <input placeholder="JohnDoe@example.com" v-model="email" id="email" type="email" class="text-primary input-item" name="email">
                                </div>
                                <div class="input flex flex-col mb-6">
                                    <label class="font-bold text-2xl mb-2" for="phonenumber">Telefoon nummer <span class="text-secondary">*</span></label>
                                    <input placeholder="0123456789" id="phonenumber" v-model="phonenumber" type="text" class="text-primary input-item" name="phonenumber">
                                </div>
                                <div class="input flex flex-col mb-6">
                                    <label class="font-bold text-2xl mb-2" for="message">Bericht <span class="text-secondary">*</span></label>
                                    <textarea placeholder="Bericht..." class="text-primary" rows="4" id="message" v-model="message" name="message"></textarea>
                                </div>
                                <div class="response flex flex-col mb-6" v-if="formResponse" :class="[ formResponse.status == 200 ? 'success text-green-500' : 'error text-secondary' ]">
                                    <div class="response-message">{{ formResponse.data.message }}</div>
                                </div>
                                <div class="input input-submit flex flex-col mb-6" :class="[formIsValid ? 'valid' : 'invalid']">
                                    <input @click="submitForm" class="p-4 font-bold" type="submit" value="Verzenden"/>
                                </div>
                            </form>
                        </div>      
                    </div>
                </div>
                <div class="column w-1/2 flex items-center" v-if="content.image_toggle">
                    <div class="image-wrapper">
                        <img :src="content.image.permalink" alt="Contact Block Image No Alt">
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>