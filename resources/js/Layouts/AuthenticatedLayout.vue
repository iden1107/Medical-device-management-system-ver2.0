<script setup>
import { ref, computed ,onMounted } from 'vue';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import NavLink from '@/Components/NavLink.vue';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';

import { Link, usePage } from '@inertiajs/vue3';

const showingNavigationDropdown = ref(false);
const drawer = ref(false)

// app/Http/Middleware/HandleInertiaRequests.phpで共通データを設定し、そのデータを引っ張ってくる
const time = computed(() => usePage().props.setting.setting_minutes).value

let timerID = 1;

// setTimeOutをクリアする（クリックイベントでクリアするため）
function clearTime(){
    clearTimeout(timerID);
    timerID = setTimeout(logout, time * 60000);
}
// ログアウトボタンのクリックをシュミレートする
function logout(){
    document.getElementById("logoutButton").click()
}

// 自動ログアウト  データベースに設定した時間が経過したらログアウト
onMounted(() => {
    timerID = setTimeout(function() {
        logout
    }, time * 60000)
})
// クリックするたびclearTime()を実行
document.addEventListener('click',clearTime)
</script>

<template>
    <v-app>
        <div class="min-h-screen pb-0">
            <div class="bg-Emerald-400 shadow w-full fixed z-20">
                <!-- Primary Navigation Menu -->
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between h-10">
                        <div class="flex">
                            <!-- Logo -->
                            <div class="shrink-0 flex items-center" @click="drawer = ! drawer">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 sm:hidden text-white">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                                </svg>
                            </div>
                        </div>

                        <div class="flex text-white items-center font-medium">　　　ログイン名：{{ $page.props.auth.user.name }}</div>

                        <div class="hidden sm:flex sm:items-center sm:ml-6">
                            <Link :href="route('logout')" method="post" as="button">
                                <PrimaryButton class="ml-4 bg-white text-Emerald-300 hover:text-white hover:border-white" id="logoutButton">
                                    ログアウト
                                </PrimaryButton>
                            </Link>
                        </div>

                        <div class="-mr-2 flex items-center sm:hidden">
                            <Link :href="route('logout')" method="post" as="button">
                                <PrimaryButton class="ml-4" >
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15m3 0l3-3m0 0l-3-3m3 3H9" />
                                    </svg>
                                </PrimaryButton>
                            </Link>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Page Menu -->
            <header class="bg-Emerald-300 hidden sm:block mt-10 w-full fixed z-10">
                <div class="max-w-7xl mx-auto pt-2 px-4 sm:px-6 lg:px-8">
                        <NavLink :href="route('floormap')" :active="route().current('floormap') || route().current('deviceDetail*')" >
                            配置図
                        </NavLink>
                        <NavLink :href="route('inventory')" :active="route().current('inventory')">
                            在庫管理
                        </NavLink>
                </div>
            </header>

            <!-- Page Content -->
            <main class="pt-10 sm:pt-20">
                <slot />
            </main>
        </div>

        <!-- Page Drawer -->
        <v-navigation-drawer
            v-model="drawer"
            temporary
        >
            <v-list
            :items="items"
            ></v-list>
        </v-navigation-drawer>
    </v-app>
</template>
