<script setup>
defineProps({
    type: {
        type: String,
        default: 'submit',
    },
});
</script>

<template>
    <button
        :type="type"
        class="mr-3 mt-2 shadow inline-flex items-center px-4 py-2 border border-transparent font-semibold text-xs uppercase tracking-widest ransition ease-in-out duration-150"
    >
        <slot />
    </button>
</template>
