<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import TextInput from '@/Components/TextInput.vue';
import InputLabel from '@/Components/InputLabel.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import SelectBox from '@/Components/SelectBox.vue';
import NavLink from '@/Components/NavLink.vue';
import UsersList from '@/Components/UsersList.vue';
import { Link, Head, usePage, router, useForm } from '@inertiajs/vue3';
import { ref,computed } from 'vue';

const props = defineProps({
    users:Object,
    user:Object,
    departments:Object,
})
props.user.password = ''

const patchData = () => {
    router.patch('/user/update', props.user);
};
const deleteData = () => {
    let result =window.confirm('削除してもよろしいですか？');
    if(result){
        router.patch('/user/delete', props.user);
    }else{
        return;
    }
};
const fromJudge = computed(() =>{
    if(
        props.user.id == '' ||
        props.user.name == '' ||
        props.user.kana == '' ||
        props.user.department_id == '' ||
        props.user.employment_date == '' ||
        props.user.password == ''
    ){
        return true;
    }else{
        return false;
    }
});
function zeroPadding(){
    if(user.id == ''){
        return;
    }else{
        user.id =  ( '000' + user.id ).slice( -4 );
    }
}
</script>

<template>
    <Head title="職員設定 - " />
    <AuthenticatedLayout>
        <div class="mt-3 max-w-7xl mx-auto grid sm:grid-cols-12 grid-cols-1 gap-4 py-3">
            <!-- 左画面 -->
            <div class="sm:col-span-4">
                <div class="py-3 sm:px-4 lg:px-8 p-3 border border-gray-200 shadow">
                    <h1 class="mb-3 text-xl font-medium">詳細修正</h1>
                    <InputLabel for="id" value="職員番号" />
                    <TextInput
                        id="id"
                        type="number"
                        class="mt-1 w-4/ text-gray-300"
                        v-model="user.id"
                        @blur="zeroPadding"
                        required
                        disabled
                    />
                    <!-- 職員名 -->
                    <InputLabel for="name" value="職員名" class="mt-5"/>
                    <TextInput
                        id="name"
                        type="text"
                        class="mt-1 w-4/5"
                        v-model="user.name"
                        required
                    />
                    <!-- フリガナ -->
                    <InputLabel for="kana" value="フリガナ" class="mt-5" />
                    <TextInput
                        id="kana"
                        type="text"
                        class="mt-1 w-4/5"
                        v-model="user.kana"
                        required
                    />
                    <!-- 所属部署 -->
                    <InputLabel for="manufacturer_name" value="所属部署" class="mt-5"/>
                    <SelectBox id="manufacturer_name" :optionItems="departments" v-model:selected="user.department_id" class="mt-1 w-4/5"/>
                    <!-- 入職日 -->
                    <InputLabel for="inspection_date" value="入職日" class="mt-5"/>
                    <TextInput
                        id="inspection_date"
                        type="date"
                        class="mt-1 w-4/5"
                        v-model="user.employment_date"
                        required
                    />
                    <!-- パスワード -->
                    <InputLabel for="password" value="パスワード(再設定)" class="mt-5"/>
                    <TextInput
                        id="password"
                        type="password"
                        class="mt-1 w-4/5"
                        v-model="user.password"
                        required
                    />
                    <!-- 操作ボタン -->
                    <div class="bottom-0 right-3 mt-8">
                        <Link as="button" @click="patchData">
                            <SecondaryButton class="ml-3" :disabled="fromJudge">更新</SecondaryButton>
                        </Link>
                        <Link as="button" @click="deleteData">
                            <SecondaryButton class="ml-3">削除</SecondaryButton>
                        </Link>
                    </div>
                </div>
            </div>
            <!-- 右画面 -->
            <UsersList :users="users" :departments="departments"/>
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
