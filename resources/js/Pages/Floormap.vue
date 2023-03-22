<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import NavLink from '@/Components/NavLink.vue';
import { Link,Head } from '@inertiajs/vue3';

defineProps({
    devices:Object,
});

const status =
[
    {label:'稼働中',color:'#80E368'},
    {label:'待機中',color:'#6B9CE4'},
    {label:'点検中',color:'#E3DD68'},
    {label:'修理中',color:'#E36868'},
    {label:'廃棄',color:'gray'},
]

</script>

<template>
    <Head title="フロアマップ" />
    <AuthenticatedLayout>
        <div class="py-12">
            <p>{{devices}}</p>
            <div class="map max-w-7xl mx-auto sm:px-6 lg:px-8 border border-gray-200 shadow">
                <img :src="'/img/map.png'" alt="" >
                <div class="ce subject">
                    <!-- <router-link  v-for="device in devices.臨床工学室" :key="device.id" :to="'/floormap/DeviceDetailEdit/' + device.id">
                        <p :style="{ color: status[device.status].color }">{{device.id | zeroPadding}}
                        <v-icon color="#FFFF00" v-show="judgeExpired(device.inspection_date)" size="1vw">mdi-hammer-wrench</v-icon></p>
                    </router-link> -->
                    <Link v-for="device in devices[1]" :key="device.id" :href="route('floormap',device.id)">
                        <p :style="{ color: status[device.status].color }">{{device.id}}</p>
                        <!-- <v-icon color="#FFFF00" v-show="judgeExpired(device.inspection_date)" size="1vw">mdi-hammer-wrench</v-icon></p> -->

                    </Link>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<style scoped >
.v-application a{
    text-decoration: none;
    padding: 0 ;
}
.router-link-exact-active{
    background-color: #20C4AF;
}
p{
    font-size: 0.8vw;
    margin: 0;
}
.v-icon{
    padding-bottom: 0.2vw;
    animation: flash 3s linear infinite;
}
/* 各科目の位置 */
.map{
    overflow: scroll;
    position: relative;
}
.subject{
    position: absolute;
    box-sizing: border-box;
}
.ce{
    left: 13.5%;
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
    left: 67%;
    bottom: 76.5%;
}
.dermatology{
    left: 73.5%;
    bottom: 69%;
}
.gynecology{
    left: 85%;
    bottom: 41%;
}
.rehabilitation{
    left: 15%;
    bottom: 35.5%;
}
.surgery{
    left: 22%;
    bottom: 17%;
}
.treatment-room{
    left: 40%;
    bottom: 21%;
}
.internal-medicine{
    left: 48.3%;
    bottom: 10%;
}
.urology{
    left: 68%;
    bottom: 10%;
}
.pediatrics{
    left: 80.8%;
    bottom: 10%;
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
