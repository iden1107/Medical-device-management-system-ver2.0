<script setup>
import { computed } from 'vue';

const emit = defineEmits(['update:selected']);

const props = defineProps({
    selected: Number,
    value: {
        default: null,
    },
    optionItems:Object,
});

const proxySelected = computed({
    get() {
        return props.selected;
    },

    set(val) {
        emit('update:selected', val);
    },
});

</script>

<template>
    <select name="example" class="block w-2/3 border-gray-300 px-2 py-1 focus:border-Emerald-300 focus:ring-Emerald-300  shadow-sm" v-model="proxySelected">
        <option v-for="optionItem in optionItems" :key="optionItem.id" :value="optionItem.id">{{optionItem.name}}</option>
    </select>
</template>
