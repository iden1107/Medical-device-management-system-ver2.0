<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import TextInput from '@/Components/TextInput.vue';
import InputLabel from '@/Components/InputLabel.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import NavLink from '@/Components/NavLink.vue';
import { Link, Head, usePage, router } from '@inertiajs/vue3';
import { ref,computed } from 'vue';

const patchData = () => {
    router.patch('/setting', usePage().props.setting);
};
</script>

<template>
    <Head title="設定 - " />
    <AuthenticatedLayout>
        <div class="mt-3 max-w-7xl mx-auto sm:px-6 lg:px-8 border border-gray-200 shadow">
            <div class="grid sm:grid-cols-12 grid-cols-1 gap-4 py-3">
                <!-- 左画面 -->
                <div class="sm:col-span-6 px-3">
                    <InputLabel for="setting_minutes" value="自動ログアウト時間" />
                    <input
                        id="setting_minutes"
                        type="number"
                        class=" w-2/3 mt-1 border-gray-300 px-2 py-1 focus:border-Emerald-300 focus:ring-Emerald-300 shadow-sm"
                        v-model.lazy="$page.props.setting.setting_minutes"
                        autofocus
                        @blur="patchData"
                    > 分
                    <p class="w-2/3 mt-1 px-1 text-[0.8rem]">0.1〜120.0の値で設定してください。画面上をクリックしてから設定した時間が経過すると自動でログアウトします。</p>
                </div>
                <!-- 右画面 -->

                <!-- inputのblurだけで対応できるためコメントアウトする -->
                <!-- <div class="sm:col-span-6 px-3 relative">
                    <br>
                    <div class="absolute bottom-0 right-3">
                        <Link  as="button" @click="patchData">
                            <SecondaryButton class="ml-3">更新</SecondaryButton>
                        </Link>
                    </div>
                </div> -->

            </div>
        </div>
    </AuthenticatedLayout>
</template>

<style scoped >
input[type="number"]::-webkit-outer-spin-button,
input[type="number"]::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
}
</style>
