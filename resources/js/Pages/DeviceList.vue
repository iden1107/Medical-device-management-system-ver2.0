<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import DeviceDetail from '@/Pages/DeviceDetail.vue';
import NavLink from '@/Components/NavLink.vue';
import { Head, usePage, Link, router } from '@inertiajs/vue3';
import { ref,computed } from 'vue';

defineProps({
    devices:Object,
});

const status = [
    {label:'稼働中',color:'#6B9CE4'},
    {label:'待機中',color:'#80E368'},
    {label:'点検中',color:'#E3DD68'},
    {label:'修理中',color:'#E36868'},
    {label:'廃棄',color:'#979797'},
]

const isAdmin = computed(() => {
    if(usePage().props.auth.user.id == 9999){
        return true;
    }else{
        return false;
    }
});

const link = (device_id) =>{
    router.get(`/device_detail/${device_id}`);
}

function zeroPadding(id){
    return ( '000' + id ).slice( -4 );
}
</script>

<template>
    <Head title="機器管理 - " />
    <AuthenticatedLayout>
        <div class="mt-3 max-w-7xl mx-auto sm:px-6 lg:px-8 border border-gray-200 shadow">
            <v-card-title>機器管理<v-spacer></v-spacer> <v-btn tile elevation="1" to="/admin/devices/create">台帳追加</v-btn></v-card-title>
            <v-card-text>
                <v-table density="compact" fixed-header height="75vh">
                    <template v-slot:default >
                        <thead>
                            <tr>
                                <th class="text-left">管理番号</th>
                                <th class="text-left">製品名</th>
                                <th class="text-left">メーカー</th>
                                <th class="text-left">状態</th>
                                <th class="text-left">次回点検日</th>
                                <th class="text-left">現在地</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr
                                v-for="device in devices"
                                :key="device.id"
                                style="cursor: pointer"
                                @click="link(device.device_id)"
                            >
                            <td>{{ zeroPadding(device.device_id) }}</td>
                            <td>{{ device.device_name }}</td>
                            <td>{{ device.manufacturer_name }}</td>
                            <td :style="{ color: status[device.status].color }">{{ status[device.status].label }}</td>
                            <td>{{ device.inspection_date }}</td>
                            <td>{{ device.location_name }}</td>
                            </tr>
                        </tbody>
                    </template>
                </v-table>
            </v-card-text>
        </div>
    </AuthenticatedLayout>
</template>

<style scoped>
.v-card-text{
    overflow-x: scroll;
}
.v-table{
    min-width: 700px;
}
</style>
