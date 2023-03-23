<script setup>
import { computed } from 'vue';
import { Link } from '@inertiajs/vue3';

const props = defineProps(['href', 'active']);

const classes = computed(() =>
    props.active
        ? 'bg-white block rounded-t-lg items-center px-3 py-2 text-sm font-medium leading-5 text-gray-900 focus:outline-none transition duration-150 ease-in-out'
        : 'bg-Emerald-300 block items-center px-3  border-transparent text-sm font-medium leading-5 text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out'
);
</script>

<template>
<div class="item">
    <Link :href="href" :class="classes">
        <slot />
    </Link>
</div>
</template>


<style scoped>
.item{
    display: inline-block;
    width: 150px;
}
</style>
