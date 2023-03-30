<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import TextInput from '@/Components/TextInput.vue';
import InputLabel from '@/Components/InputLabel.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import SelectBox from '@/Components/SelectBox.vue';
import NavLink from '@/Components/NavLink.vue';
import { Link, Head, usePage, router } from '@inertiajs/vue3';
import { ref,computed } from 'vue';

const props = defineProps({
    users:Object,
    departments:Object
})

const patchData = () => {
    router.patch('/setting', usePage().props.setting);
};
</script>

<template>
    <Head title="職員設定 - " />
    <AuthenticatedLayout>
        <!-- <div class=" max-w-7xl mx-auto sm:px-6 lg:px-8 border border-gray-200 shadow"> -->
            <div class="mt-3 max-w-7xl mx-auto grid sm:grid-cols-12 grid-cols-1 gap-4 py-3">
                <!-- 左画面 -->
                <div class="sm:col-span-4 py-3 sm:px-4 lg:px-8 px-3 border border-gray-200 shadow">
                    <InputLabel for="id" value="職員番号" />
                    <TextInput
                        id="id"
                        type="number"
                        class="mt-1 w-2/3"

                        @blur="zeroPadding"
                        required
                    />
                    <!-- 職員名 -->
                    <InputLabel for="name" value="職員名" class="mt-5"/>
                    <TextInput
                        id="name"
                        type="text"
                        class="mt-1 w-2/3"

                        :disabled="!isAdmin"
                        required
                    />
                    <!-- フリガナ -->
                    <InputLabel for="device_name" value="フリガナ" class="mt-5" />
                    <TextInput
                        id="device_name"
                        type="text"
                        class="mt-1 w-2/3"

                        :disabled="!isAdmin"
                        required
                    />
                    <!-- 所属部署 -->
                    <InputLabel for="manufacturer_name" value="所属部署" class="mt-5"/>
                    <!-- <SelectBox id="manufacturer_name" :optionItems="departments" v-model:selected="users.department_id" class="mt-1 w-2/3" :class="{'text-gray-300':!isAdmin}" :disabled="!isAdmin"/> -->
                    <SelectBox id="manufacturer_name" :optionItems="departments" class="mt-1 w-2/3" />
                    <!-- 入職日 -->
                    <InputLabel for="inspection_date" value="入職日" class="mt-5"/>
                    <TextInput
                        id="inspection_date"
                        type="date"
                        class="mt-1 w-2/3"

                        required
                    />
                </div>
                <!-- 右画面 -->
                <div class=" sm:col-span-8 px-3  border border-gray-200 shadow">
                    <br>
                    <div class=" bottom-0 right-3">
                        <p>a</p>
                        <p>a</p>
                        <p>a</p>
                        <Link  as="button" @click="patchData">
                            <SecondaryButton class="ml-3">更新</SecondaryButton>
                        </Link>
                    </div>
                </div>

            </div>
        <!-- </div> -->
    </AuthenticatedLayout>
</template>

<style scoped >
input[type="number"]::-webkit-outer-spin-button,
input[type="number"]::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
}
</style>
