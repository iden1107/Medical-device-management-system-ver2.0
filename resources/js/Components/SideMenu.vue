<script setup>
import { computed } from 'vue';
import { Link } from '@inertiajs/vue3';

const props = defineProps(['href', 'active']);

const classes = computed(() =>
    props.active
        ? 'mx-2 my-1 p-4 block shadow border border-gray-100 font-medium leading-5 text-Emerald-300 focus:outline-none transition duration-150 ease-in-out'
        : 'mx-2 my-1 p-4 block shadow border border-gray-100 font-medium leading-5 hover:opacity-70 focus:outline-none transition duration-150 ease-in-out'
);
</script>

<template>
    <div class="item">
        <Link :href="href" :class="classes">
            <slot />
        </Link>
    </div>
</template>
