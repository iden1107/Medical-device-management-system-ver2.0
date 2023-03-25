<script setup>
// export default {
//     name: "DeviceDetail",
//     data() {
//         return {
//             src:'',
//             device:{},
//             status:[
//                 {label:'稼働中',color:'#80E368'},
//                 {label:'待機中',color:'#6B9CE4'},
//                 {label:'点検中',color:'#E3DD68'},
//                 {label:'修理中',color:'#E36868'},
//                 {label:'廃棄',color:'gray'},
//             ],
//             currentLocation:'',
//             location:['臨床工学室','整形外科','眼科','内視鏡センター','生理検査室','皮膚科','産婦人科','リハビリテーション室','外科','処置室','内科','泌尿器科','小児科',],
//             color:['#80E368','#6B9CE4','#E3DD68','#E36868','gray'],
//         };
//     },
//     methods: {
//         async getDevice(){
//             this.src = ''
//             await axios.get('/api/getDevice/' + this.$route.params.id).then((res)=>{
//                 this.device = res.data
//             })
//             if(this.device.name === '点滴ポンプ'){
//                 this.src = '/img/device1.jpeg'
//             }else{
//                 this.src = '/img/device2.jpeg'
//             }
//             if(this.$route.params.id){
//                 this.currentLocation = this.device.location.slice()
//                 this.device.id = ( '000' + this.device.id ).slice( -4 )
//             }
//         },
//         changeStatus(val){
//             this.device.status = val
//         },
//         cancel(){
//             this.$router.push('/admin/devices')
//         },
//         async updateDevice(){
//             // 廃棄（status = 4)なら配置場所がないのでlocationを空文字にする
//             if(this.device.status == 4){
//                 this.device.location = ''
//             }
//             await axios.post('/api/updateDevice' , this.device)
//             this.$router.push('/admin/devices')
//         }
//     },
//     watch:{
//         $route(){
//             this.getDevice()
//         }
//     },
//     filters :{
//         zeroPadding(value){
//             return ( '000' + value ).slice( -4 );
//         }
//     },
//     created(){
//         this.getDevice()
//     }
// };
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import TextInput from '@/Components/TextInput.vue';
import InputLabel from '@/Components/InputLabel.vue';
import SelectBox from '@/Components/SelectBox.vue';
import SelectButton from '@/Components/SelectButton.vue';

import PrimaryButton from '@/Components/PrimaryButton.vue';


import { Link, Head,usePage } from '@inertiajs/vue3';
import { ref,computed } from 'vue';

const props = defineProps({
    device:Object,
    manufacturers:Object
})
const locations = computed(() => usePage().props.locations).value
const imgSrc = computed(() => {
    if(props.device.device_name == '点滴ポンプ'){
        return '/img/device1.jpeg';
    }else if(props.device.device_name == '心電図モニター'){
        return '/img/device2.jpeg';
    }else{
        return '/img/noImage.jpeg'
    }
});
// ボタンのクラス制御
const active = computed(() =>{
    return function(arg){
        switch (arg){
            case 0:
                if(props.device.status == arg){
                    return 'text-white bg-[#6B9CE4] hover:bg-[#6B9CE4]';
                }else{
                    return 'text-[#6B9CE4] border-[#6B9CE4] hover:bg-[#6B9CE4]';
                }
            case 1:
                if(props.device.status == arg){
                    return 'text-white bg-[#80E368] hover:bg-[#80E368]';
                }else{
                    return 'text-[#80E368] border-[#80E368] hover:bg-[#80E368]';
                }
            case 2:
                if(props.device.status == arg){
                    return 'text-white bg-[#E3DD68] hover:bg-[#E3DD68]';
                }else{
                    return 'text-[#E3DD68] border-[#E3DD68] hover:bg-[#E3DD68]';
                }
            case 3:
                if(props.device.status == arg){
                    return 'text-white bg-[#E36868] hover:bg-[#E36868]';
                }else{
                    return 'text-[#E36868] border-[#E36868] hover:bg-[#E36868]';
                }
            case 4:
                if(props.device.status == arg){
                    return 'text-white bg-[#979797] hover:bg-[#979797]';
                }else{
                    return 'text-[#979797] border-[#979797] hover:bg-[#979797]';
                }
        }
    }
});
const statuses = [
    {id:0,label:'稼働中',color:'#6B9CE4'},
    {id:1,label:'待機中',color:'#80E368'},
    {id:2,label:'点検中',color:'#E3DD68'},
    {id:3,label:'修理中',color:'#E36868'},
    {id:4,label:' 廃棄 ',color:'#979797'},
]


const changeStatus = (id) =>{
    props.device.status = id;
    // 廃棄(4)の場合はlocation_idを99にする
    if(id == 4){
        props.device.location_id = 99;
    }
}
</script>


<template>
    <Head title="詳細 - " />
    <AuthenticatedLayout>

    <div class="mt-3 max-w-7xl mx-auto sm:px-6 lg:px-8 border border-gray-200 shadow">
        <!-- サンプル -->
        <!-- <div class="grid sm:grid-cols-12 grid-cols-1 gap-3">
            <div class="sm:col-span-5 bg-blue-400 text-center text-white p-2 rounded">1</div>
            <div class="sm:col-span-7 bg-blue-400 text-center text-white p-2 rounded">2</div>
            <div class="sm:col-span-6 bg-blue-400 text-center text-white p-2 rounded">1</div>
            <div class="sm:col-span-6 bg-blue-400 text-center text-white p-2 rounded">2</div>
        </div> -->

            {{device}}
        <div class="grid sm:grid-cols-12 grid-cols-1 gap-4 py-6">
            <!-- 左画面 -->
            <div class="sm:col-span-6 px-3">
                <!-- 画像 -->
                <InputLabel for="device_id" value="写真画像"/>
                <div class="w-full pb-3">
                    <img :src="imgSrc" alt="" class="w-full">
                </div>
                <!-- 管理番号 -->
                <InputLabel for="device_id" value="管理番号" />
                <TextInput
                    id="device_id"
                    type="text"
                    class="mt-1 w-2/3 text-gray-300"
                    v-model="device.device_id"
                    disabled
                    required
                />
                <!-- 製品名 -->
                <InputLabel for="device_name" value="製品名" class="mt-5"/>
                <TextInput
                    id="device_name"
                    type="text"
                    class="mt-1 w-2/3"
                    v-model="device.device_name"
                    required
                />
                <!-- メーカー -->
                <InputLabel for="manufacturer_name" value="メーカー" class="mt-5"/>
                <SelectBox id="manufacturer_name" :optionItems="manufacturers" v-model:selected="device.manufacturer_id"/>
                <!-- 状態 -->
                <InputLabel value="状態" class="mt-5"/>
                <SelectButton v-for="status in statuses" :key="status.id" :class="active(status.id)" @click="changeStatus(status.id)">
                    {{status.label}}
                </SelectButton>
            </div>
            <!--右画面  -->
            <div class="sm:col-span-6 px-3 pb-5 relative">
                <!-- 次回点検日 -->
                <InputLabel for="inspection_date" value="次回点検日"/>
                <TextInput
                    id="inspection_date"
                    type="date"
                    class="mt-1 w-2/3"
                    v-model="device.inspection_date"
                    required
                />
                <!-- 現在配置 -->
                <InputLabel for="location" value="現在配置" class="mt-5"/>
                <SelectBox id="location" :optionItems="locations" v-model:selected="device.location_id" :disabled="device.status == 4? true:false"/>
                <div class="map w-full pb-5" >
                    <img :src="'/img/map.png'" alt="" class="pb-5">
                    <div class="ce subject">
                        <svg v-if="device.location_id == 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6" :color="statuses[device.status].color">
                            <path fill-rule="evenodd" d="M11.54 22.351l.07.04.028.016a.76.76 0 00.723 0l.028-.015.071-.041a16.975 16.975 0 001.144-.742 19.58 19.58 0 002.683-2.282c1.944-1.99 3.963-4.98 3.963-8.827a8.25 8.25 0 00-16.5 0c0 3.846 2.02 6.837 3.963 8.827a19.58 19.58 0 002.682 2.282 16.975 16.975 0 001.145.742zM12 13.5a3 3 0 100-6 3 3 0 000 6z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="orthopedics subject">
                        <svg v-if="device.location_id == 2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6" :color="statuses[device.status].color">
                            <path fill-rule="evenodd" d="M11.54 22.351l.07.04.028.016a.76.76 0 00.723 0l.028-.015.071-.041a16.975 16.975 0 001.144-.742 19.58 19.58 0 002.683-2.282c1.944-1.99 3.963-4.98 3.963-8.827a8.25 8.25 0 00-16.5 0c0 3.846 2.02 6.837 3.963 8.827a19.58 19.58 0 002.682 2.282 16.975 16.975 0 001.145.742zM12 13.5a3 3 0 100-6 3 3 0 000 6z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ophthalmology subject">
                        <svg v-if="device.location_id == 3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6" :color="statuses[device.status].color">
                            <path fill-rule="evenodd" d="M11.54 22.351l.07.04.028.016a.76.76 0 00.723 0l.028-.015.071-.041a16.975 16.975 0 001.144-.742 19.58 19.58 0 002.683-2.282c1.944-1.99 3.963-4.98 3.963-8.827a8.25 8.25 0 00-16.5 0c0 3.846 2.02 6.837 3.963 8.827a19.58 19.58 0 002.682 2.282 16.975 16.975 0 001.145.742zM12 13.5a3 3 0 100-6 3 3 0 000 6z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="endoscope subject">
                        <svg v-if="device.location_id == 4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6" :color="statuses[device.status].color">
                            <path fill-rule="evenodd" d="M11.54 22.351l.07.04.028.016a.76.76 0 00.723 0l.028-.015.071-.041a16.975 16.975 0 001.144-.742 19.58 19.58 0 002.683-2.282c1.944-1.99 3.963-4.98 3.963-8.827a8.25 8.25 0 00-16.5 0c0 3.846 2.02 6.837 3.963 8.827a19.58 19.58 0 002.682 2.282 16.975 16.975 0 001.145.742zM12 13.5a3 3 0 100-6 3 3 0 000 6z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="physiological-laboratory subject">
                        <svg v-if="device.location_id == 5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6" :color="statuses[device.status].color">
                            <path fill-rule="evenodd" d="M11.54 22.351l.07.04.028.016a.76.76 0 00.723 0l.028-.015.071-.041a16.975 16.975 0 001.144-.742 19.58 19.58 0 002.683-2.282c1.944-1.99 3.963-4.98 3.963-8.827a8.25 8.25 0 00-16.5 0c0 3.846 2.02 6.837 3.963 8.827a19.58 19.58 0 002.682 2.282 16.975 16.975 0 001.145.742zM12 13.5a3 3 0 100-6 3 3 0 000 6z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="dermatology subject">
                        <svg v-if="device.location_id == 6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6" :color="statuses[device.status].color">
                            <path fill-rule="evenodd" d="M11.54 22.351l.07.04.028.016a.76.76 0 00.723 0l.028-.015.071-.041a16.975 16.975 0 001.144-.742 19.58 19.58 0 002.683-2.282c1.944-1.99 3.963-4.98 3.963-8.827a8.25 8.25 0 00-16.5 0c0 3.846 2.02 6.837 3.963 8.827a19.58 19.58 0 002.682 2.282 16.975 16.975 0 001.145.742zM12 13.5a3 3 0 100-6 3 3 0 000 6z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="gynecology subject">
                        <svg v-if="device.location_id == 7" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6" :color="statuses[device.status].color">
                            <path fill-rule="evenodd" d="M11.54 22.351l.07.04.028.016a.76.76 0 00.723 0l.028-.015.071-.041a16.975 16.975 0 001.144-.742 19.58 19.58 0 002.683-2.282c1.944-1.99 3.963-4.98 3.963-8.827a8.25 8.25 0 00-16.5 0c0 3.846 2.02 6.837 3.963 8.827a19.58 19.58 0 002.682 2.282 16.975 16.975 0 001.145.742zM12 13.5a3 3 0 100-6 3 3 0 000 6z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="rehabilitation subject">
                        <svg v-if="device.location_id == 8" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6" :color="statuses[device.status].color">
                            <path fill-rule="evenodd" d="M11.54 22.351l.07.04.028.016a.76.76 0 00.723 0l.028-.015.071-.041a16.975 16.975 0 001.144-.742 19.58 19.58 0 002.683-2.282c1.944-1.99 3.963-4.98 3.963-8.827a8.25 8.25 0 00-16.5 0c0 3.846 2.02 6.837 3.963 8.827a19.58 19.58 0 002.682 2.282 16.975 16.975 0 001.145.742zM12 13.5a3 3 0 100-6 3 3 0 000 6z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="surgery subject">
                        <svg v-if="device.location_id == 9" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6" :color="statuses[device.status].color">
                            <path fill-rule="evenodd" d="M11.54 22.351l.07.04.028.016a.76.76 0 00.723 0l.028-.015.071-.041a16.975 16.975 0 001.144-.742 19.58 19.58 0 002.683-2.282c1.944-1.99 3.963-4.98 3.963-8.827a8.25 8.25 0 00-16.5 0c0 3.846 2.02 6.837 3.963 8.827a19.58 19.58 0 002.682 2.282 16.975 16.975 0 001.145.742zM12 13.5a3 3 0 100-6 3 3 0 000 6z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="treatment-room subject">
                        <svg v-if="device.location_id == 10" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6" :color="statuses[device.status].color">
                            <path fill-rule="evenodd" d="M11.54 22.351l.07.04.028.016a.76.76 0 00.723 0l.028-.015.071-.041a16.975 16.975 0 001.144-.742 19.58 19.58 0 002.683-2.282c1.944-1.99 3.963-4.98 3.963-8.827a8.25 8.25 0 00-16.5 0c0 3.846 2.02 6.837 3.963 8.827a19.58 19.58 0 002.682 2.282 16.975 16.975 0 001.145.742zM12 13.5a3 3 0 100-6 3 3 0 000 6z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="internal-medicine subject">
                        <svg v-if="device.location_id == 11" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6" :color="statuses[device.status].color">
                            <path fill-rule="evenodd" d="M11.54 22.351l.07.04.028.016a.76.76 0 00.723 0l.028-.015.071-.041a16.975 16.975 0 001.144-.742 19.58 19.58 0 002.683-2.282c1.944-1.99 3.963-4.98 3.963-8.827a8.25 8.25 0 00-16.5 0c0 3.846 2.02 6.837 3.963 8.827a19.58 19.58 0 002.682 2.282 16.975 16.975 0 001.145.742zM12 13.5a3 3 0 100-6 3 3 0 000 6z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="urology subject">
                        <svg v-if="device.location_id == 12" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6" :color="statuses[device.status].color">
                            <path fill-rule="evenodd" d="M11.54 22.351l.07.04.028.016a.76.76 0 00.723 0l.028-.015.071-.041a16.975 16.975 0 001.144-.742 19.58 19.58 0 002.683-2.282c1.944-1.99 3.963-4.98 3.963-8.827a8.25 8.25 0 00-16.5 0c0 3.846 2.02 6.837 3.963 8.827a19.58 19.58 0 002.682 2.282 16.975 16.975 0 001.145.742zM12 13.5a3 3 0 100-6 3 3 0 000 6z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="pediatrics subject">
                        <svg v-if="device.location_id == 13" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6" :color="statuses[device.status].color">
                            <path fill-rule="evenodd" d="M11.54 22.351l.07.04.028.016a.76.76 0 00.723 0l.028-.015.071-.041a16.975 16.975 0 001.144-.742 19.58 19.58 0 002.683-2.282c1.944-1.99 3.963-4.98 3.963-8.827a8.25 8.25 0 00-16.5 0c0 3.846 2.02 6.837 3.963 8.827a19.58 19.58 0 002.682 2.282 16.975 16.975 0 001.145.742zM12 13.5a3 3 0 100-6 3 3 0 000 6z" clip-rule="evenodd" />
                        </svg>
                    </div>
                </div>
                <!-- 操作ボタン -->
                <div class="absolute bottom-0 right-3">
                <PrimaryButton >キャンセル</PrimaryButton>
                <PrimaryButton class="ml-3">更新</PrimaryButton>
                </div>
            </div>
        </div>
    </div>
    </AuthenticatedLayout>
</template>

<style scoped >
.device-img{
    width: 40vh;
    height: 40vh;
}
.v-input{
    border-radius: 0px;
    padding: 0px;
}
.v-subheader{
    padding: 0  0 0 5px  ;
}
p{
    font-size: 0.11vw;
    margin: 0;
    padding: 0;
    /* text-shadow: 1px 1px 1px #FFF; */
}
.current-location-textarea{
    user-select: none;
}
/* 各科目の位置 */
.map{
    position: relative;
    padding: 10px;
}
.subject{
    position: absolute;
    box-sizing: border-box;
}
.ce{
    left: 12.8%;
    bottom: 76%;
}
.orthopedics{
    left: 36%;
    bottom: 79%;
}
.ophthalmology{
    left: 47%;
    bottom: 79%;
}
.endoscope{
    left: 56%;
    bottom: 78%;
}
.physiological-laboratory{
    left: 64.5%;
    bottom: 76.5%;
}
.dermatology{
    left: 70.5%;
    bottom: 68%;
}
.gynecology{
    left: 83%;
    bottom: 41%;
}
.rehabilitation{
    left: 15%;
    bottom: 35.5%;
}
.surgery{
    left: 21%;
    bottom: 18%;
}
.treatment-room{
    left: 38.5%;
    bottom: 23%;
}
.internal-medicine{
    left: 46%;
    bottom: 12%;
}
.urology{
    left: 65.5%;
    bottom: 12%;
}
.pediatrics{
    left: 77.8%;
    bottom: 12%;
}
</style>
