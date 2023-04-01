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
        <!-- 説明文 -->
        <div class="w-full sm:max-w-md mx-auto mt-6 px-2 py-5 flex-grow">
            <p>このサイトはポートフォリオのデモアプリケーションです</p>
            <p >画像は無料のデザインツール<a href="https://www.design-ac.net/" class="text-Emerald-400 underline hover:opacity-70">「デザインAC」</a>より、アイコンは<a href="https://materialdesignicons.com/"  class="text-Emerald-400 underline hover:opacity-70">「Material Design Icons」</a>より使用しました</p>
            <br>
            <li class="mb-2">管理者ログイン
                <ul>
                    <li class="pl-6">職員番号：9999</li>
                    <li class="pl-6">パスワード：9999</li>
                </ul>
            </li>
            <li>職員ログイン
                <ul>
                    <li class="pl-6">職員番号：1</li>
                    <li class="pl-6">パスワード：1111</li>
                </ul>
            </li>
            <br>
            <p>ソースコードは<a href="https://github.com/iden1107/Medical-device-management-system-ver2.0" target="_blank" class="text-Emerald-400 underline hover:opacity-70">GitHub</a>で公開してます</p>
        </div>
        <!-- フッター -->
        <div class="w-full py-1 bg-Emerald-400 justify-center fixed bottom-0">
            <p class="text-white text-center">&copy; {{ new Date().getFullYear() }}  Kamino Hajime All rights recerved.</p>
        </div>
    </div>
</template>

<style scoped>

</style>
