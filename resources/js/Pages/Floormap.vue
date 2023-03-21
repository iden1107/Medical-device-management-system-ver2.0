<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import NavLink from '@/Components/NavLink.vue';
import { Head } from '@inertiajs/vue3';
</script>

<template>
    <Head title="フロアマップ" />

    <AuthenticatedLayout>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900"></div>
                    <div class="p-6 text-gray-900">{{ $page.props.auth.user }}</div>
                </div>
                <img :src="'/img/map.png'" alt="" >
            </div>
        </div>
    </AuthenticatedLayout>
</template>
