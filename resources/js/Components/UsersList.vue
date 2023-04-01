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

function zeroPadding(id){
    return ( '000' + id ).slice( -4 );
}
function link(id){
    router.get(`/user/detail/${id}`);
}
</script>

<template>
    <div class=" sm:col-span-8">
        <div class=" px-3  border border-gray-200 shadow">
            <v-table fixed-header density="compact" class="p-3">
                <template v-slot:default >
                    <thead>
                        <tr>
                            <th class="text-left">職員番号</th>
                            <th class="text-left">氏名</th>
                            <th class="text-left">フリガナ</th>
                            <th class="text-left">部署</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr
                        v-for="user in users"
                        :key="user.id"
                        style="cursor: pointer"
                        @click="link(user.users_id)"
                        >
                        <td>{{ zeroPadding(user.users_id) }}</td>
                        <td>{{ user.users_name }}</td>
                        <td>{{ user.kana }}</td>
                        <td>{{ user.department_name }}</td>
                        </tr>
                    </tbody>
                </template>
            </v-table>
        </div>
    </div>
</template>
