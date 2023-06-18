<script setup>
import headerHalfBlock from '@/Components/ContentBlocks/HeaderBlock/Half/headerBlock.vue';
import headerFullBlock from '@/Components/ContentBlocks/HeaderBlock/Full/headerBlock.vue';
import headerVideoBlock from '@/Components/ContentBlocks/HeaderBlock/Video/HeaderBlock.vue';
import vehiclesBlock from '@/Components/ContentBlocks/VehiclesBlock/vehiclesBlock.vue';
import RecentVehiclesBlock from '@/Components/ContentBlocks/RecentVehiclesBlock/RecentVehiclesBlock.vue';
import TextWithImageBlock from '@/Components/ContentBlocks/TextWithImageBlock/TextWithImageBlock.vue';
import VehicleCategoriesBlock from '@/Components/ContentBlocks/VehicleCategoriesBlock/VehicleCategoriesBlock.vue';
import ImageBlock from '@/Components/ContentBlocks/ImageBlock/ImageBlock.vue';
import ImagesSwiperBlock from '@/Components/ContentBlocks/ImagesSwiperBlock/ImagesSwiperBlock.vue';
import TextBlock from '@/Components/ContentBlocks/TextBlock/TextBlock.vue';
import ContactBlockSmall from '@/Components/ContentBlocks/ContactBlock/Small/ContactBlock.vue';
import ContactBlockLarge from '@/Components/ContentBlocks/ContactBlock/Large/ContactBlock.vue';

const props = defineProps({
    contentBlocks: {
        type: Object,
        required: true
    }
});

</script>

<template>
    <div class="page-content">
        <div v-for="block in contentBlocks" :key="block.id">
            <headerHalfBlock v-if="block.blueprint.handle == 'header_block'" :content="block"></headerHalfBlock>
            <headerFullBlock v-if="block.blueprint.handle == 'header_full_block'" :content="block"></headerFullBlock>
            <headerVideoBlock v-if="block.blueprint.handle == 'header_video_block'" :content="block"></headerVideoBlock>
            <vehiclesBlock v-if="block.blueprint.handle == 'vehicles_block'" :content="block"></vehiclesBlock>
            <RecentVehiclesBlock v-if="block.blueprint.handle == 'recent_vehicles_block'" :content="block"></RecentVehiclesBlock>
            <TextWithImageBlock v-if="block.blueprint.handle == 'text_with_image_block'" :content="block"></TextWithImageBlock>
            <VehicleCategoriesBlock v-if="block.blueprint.handle == 'vehicle_categories_block'" :content="block"></VehicleCategoriesBlock>
            <ImageBlock v-if="block.blueprint.handle == 'image_block'" :content="block"></ImageBlock>
            <ImagesSwiperBlock v-if="block.blueprint.handle == 'images_swiper_block'" :content="block"></ImagesSwiperBlock>
            <TextBlock v-if="block.blueprint.handle == 'text_block'" :content="block"></TextBlock>
            <ContactBlockSmall v-if="block.blueprint.handle == 'contact_block'" :content="block"></ContactBlockSmall>
            <ContactBlockLarge v-if="block.blueprint.handle == 'contact_block_large'" :content="block"></ContactBlockLarge>
        </div>
    </div>
</template>