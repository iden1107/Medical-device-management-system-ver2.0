<script setup>
import { ref } from 'vue';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import NavLink from '@/Components/NavLink.vue';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
import Signboard from '@/Components/Signboard.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';

import { Link } from '@inertiajs/vue3';

const showingNavigationDropdown = ref(false);
const drawer = ref(false)
</script>

<template>
    <div class="min-h-screen pb-0 ">
        <!-- <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100"> -->
        <nav class="bg-Emerald-400  drop-shadow">
            <!-- Primary Navigation Menu -->
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-center h-10">
                    <div class="flex text-white items-center font-medium">医療機器管理システム</div>
                </div>
            </div>
        </nav>

        <!-- login component -->
        <Signboard class="w-20 h-20 fill-current text-gray-500" />
        <div
            class="w-full sm:max-w-md mx-auto mt-6 px-6 py-4 bg-white shadow-md overflow-hidden"
        >
            <slot />
        </div>
    </div>
</template>
