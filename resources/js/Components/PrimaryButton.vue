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
        class="shadow inline-flex items-center px-4 py-2 bg-Emerald-400 border border-transparent font-semibold text-xs uppercase tracking-widest hover:bg-Emerald-400 focus:bg-Emerald-300 active:Emerald-300 transition ease-in-out duration-150"
    >
        <slot />
    </button>
</template>
