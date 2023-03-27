<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import DeviceDetail from '@/Pages/DeviceDetail.vue';
import NavLink from '@/Components/NavLink.vue';
import { Link,Head } from '@inertiajs/vue3';
import { ref,computed } from 'vue';

defineProps({
    devices:Object,
});

const status =
[
    {label:'稼働中',color:'#6B9CE4'},
    {label:'待機中',color:'#80E368'},
    {label:'点検中',color:'#E3DD68'},
    {label:'修理中',color:'#E36868'},
    {label:'廃棄',color:'#979797'},
]
const dialog = ref(false);

function zeroPadding(id){
    return ( '000' + id ).slice( -4 );
}
// 点検日超過の判定
function isExpired(inspection_date){
    let today = new Date()
    let date = new Date(inspection_date)
    if(date <= today){
        return true
    } else {
        return false
    }
}
</script>

<template>
    <Head title="設定 - " />
    <AuthenticatedLayout>
        <div class="mt-3 py-3 max-w-7xl mx-auto sm:px-6 lg:px-8 border border-gray-200 shadow">
            setting画面
        </div>
    </AuthenticatedLayout>
</template>

<style scoped >
p{
    font-size: 1vw;
    margin: 0;
}
.inspection-icon{
    width:1.2vw;
    /* min-width: 10px; */
    animation: flash 3s linear infinite;
}
.device-id{
    font-family:monospace, serif;
}
/* 各科目の位置 */
.map{
    position: relative;
}
.subject{
    position: absolute;
    box-sizing: border-box;
}
.ce{
    left: 15%;
    bottom: 76%;
}
.orthopedics{
    left: 38%;
    bottom: 80%;
}
.ophthalmology{
    left: 49%;
    bottom: 80%;
}
.endoscope{
    left: 58%;
    bottom: 79%;
}
.physiological-laboratory{
    left: 66%;
    bottom: 76.5%;
}
.dermatology{
    left: 72.5%;
    bottom: 69%;
}
.gynecology{
    left: 84%;
    bottom: 41%;
}
.rehabilitation{
    left: 17%;
    bottom: 35.5%;
}
.surgery{
    left: 23%;
    bottom: 16%;
}
.treatment-room{
    left: 41%;
    bottom: 21%;
}
.internal-medicine{
    left: 48.5%;
    bottom: 9%;
}
.urology{
    left: 67%;
    bottom: 9%;
}
.pediatrics{
    left: 79%;
    bottom: 9%;
}
/* 点検項目のフラッシュアニメーション */
@keyframes flash {
    0% {
        opacity: 1;
    }
    90% {
        opacity: 1;
    }
    100% {
        opacity: 0;
    }
}
</style>
