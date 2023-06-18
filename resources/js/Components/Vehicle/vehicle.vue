<script setup>
import { computed } from 'vue';

const props = defineProps({
    vehicle: {
        type: Object,
        required: true
    }
});

const getThumbnail = computed(() => {
    return props.vehicle.thumbnail.permalink;
});

const getSpecifications = computed(() => {
    return props.vehicle.specifications;
})

const getViewableUrl = computed(() => {
    return `/occasions/vehicle/${props.vehicle.slug}`;
})

const getPrice = computed(() => {
    return props.vehicle.price_notk ? 'N.O.T.K' : `€${props.vehicle.price},-`;
})

const getTitle = computed(() => {
    return _.truncate(props.vehicle.title, { 'length': 19, 'omission': '...'});
})

</script>

<template>
    <div class="vue-vehicle-template w-full relative h-full">
        <div class="vehicle-container">
            <div class="inner flex flex-col">
                <div class="thumbnail">
                    <img :src="getThumbnail" loading="lazy" class="thumbnail-image aspect-video w-full h-full object-cover" alt="vehicle thumbnail" />
                </div>
                <div class="content p-4">
                    <h3 class="price">{{ getPrice }}</h3>
                    <h2 class="title">{{ getTitle }}</h2>
                    <div class="specifications-wrapper">
                        <ul class="specifications">
                            <li v-for="specification in getSpecifications" :key="specification.id" class="spec">
                                <div class="spec-container flex justify-between gap-4">
                                    <p class="spec-title w-full flex justify-between">{{ specification.spec_name }}</p>
                                    <p class="spec-value w-full">{{ specification.spec_value }}</p>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="view-button absolute bottom-0 right-0">
                        <a :href="getViewableUrl" class="button">Bekijken</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>