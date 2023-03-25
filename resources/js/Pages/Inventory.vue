<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import NavLink from '@/Components/NavLink.vue';
import { Head,usePage } from '@inertiajs/vue3';
import { ref, computed } from 'vue'

defineProps({
    devices:Object,
});

const locations = computed(() => usePage().props.locations).value
const status = [
    {label:'稼働中',color:'#80E368'},
    {label:'待機中',color:'#6B9CE4'},
    {label:'点検中',color:'#E3DD68'},
    {label:'修理中',color:'#E36868'},
    {label:'廃棄',color:'gray'},
];
let updateData = ref({});
let fileName = 'csvファイルをドロップ'
let isEnter = ref(false)

function zeroPadding(id){
    return ( '000' + id ).slice( -4 );
}

const isUpdateData = computed(() =>{
        if(Object.keys(updateData.value).length){
            return true
        } else {
            return false
    }
})
// export default {
//     name: "Inventory",
//     data() {
//         return {
//             updateData: {},
//             status: [
//                 { label: "稼働中", color: "#80E368" },
//                 { label: "待機中", color: "#6B9CE4" },
//                 { label: "点検中", color: "#E3DD68" },
//                 { label: "修理中", color: "#E36868" },
//                 { label: "廃棄", color: "gray" },
//             ],
//             devices: [],
//     },
//     computed: {
//         backgroundColor(){
//             if(this.fileName === 'csvファイルをドロップ'){
//                 return "background-color: #E0E0E0;"
//             }else{
//                 "background-color: white;"
//             }
//         }
//     },
//     methods: {
//         getDevices() {
//             axios.get("/api/getDevicesByLocation").then((res) => {
//                 this.devices = res.data;
//             });
//         },
//         async updateLocation() {
//             // 変更後のオブジェクトに変換する処理
//             const self = this;
//             let arr = [];
//             Object.keys(this.updateData).forEach(function (key) {
//                 self.updateData[key].forEach((val) => {
//                 let obj = { id: "", location: "" };
//                 obj.id = val;
//                 obj.location = key;
//                 arr.push(obj);
//                 });
//             });
//             await axios.post("/api/updateLocation", arr);
//             this.updateData = {};
//             this.fileName = 'csvファイルをドロップ'
//             this.getDevices();
//         },
        function dragEnter() {
            console.log("enter")
            isEnter.value = true;
        };
        function dragLeave() {
            isEnter.value = false;
        };
        function dropFile(e) {
            if(e.dataTransfer.files[0].type !== 'text/csv'){
                alert('ファイル形式がcsvでありません')
                isEnter.value = false
                return
            }
            isEnter.value = false
            fileName = e.dataTransfer.files[0].name
            let obj = {};
            const reader = new FileReader()
            reader.onload = function (e) {
                let step1 = e.target.result.split(/\n/);
                for (let i = 0; i < step1.length - 1 ; i++) {
                    let step2 = step1[i].split(",")
                    let key = step2.slice(0, 1)
                    let val = step2.slice(1).map(Number)
                    obj[key] = val;
                }
                updateData.value = obj;
            };
            reader.readAsText(e.dataTransfer.files[0])
        };
        function cancel(){
            updateData = {};
            fileName.value = 'csvファイルをドロップ'
        }
//     },
//     watch: {
//         $route() {
//             this.getDevices();
//         },
//     },

// };
</script>


<template>
    <Head title="在庫管理 - " />
    <AuthenticatedLayout>
        <div class="mt-3 max-w-7xl mx-auto sm:px-6 lg:px-8 border border-gray-200 shadow">
                <v-card-title>在庫管理</v-card-title>
                <v-card-text>
                    <a href="csv/sample1.csv" download class="block text-base text-Emerald-300 hover:underline mr-4 ">・サンプル1のcsvファイルをダウンロード</a>
                    <a href="csv/sample2.csv" download class="block text-base text-Emerald-300 hover:underline">・サンプル2のcsvファイルをダウンロード</a>
                    <v-col class="drop_area"
                        cols="12"
                        md="6"
                        :class="{enter: isEnter}"
                        @dragenter="dragEnter"
                        @dragleave="dragLeave"
                        @dragover.prevent
                        @drop.prevent="dropFile"
                        :style="isUpdateData ? 'background-color:#FFF;':'background-color:#E0E0E0'"
                    >
                        {{fileName}}
                    </v-col>
                    <div class="pb-3 d-flex justify-end">
                        <v-btn
                        tile
                        elevation="1"
                        @click="cancel"
                        class="mr-2"
                        :disabled="!isUpdateData"
                        >キャンセル</v-btn
                        >
                        <v-btn
                        tile
                        elevation="1"
                        @click="updateLocation"
                        :disabled="!isUpdateData"
                        >更新</v-btn
                        >
                    </div>
                    <v-table dense fixed-header height="75vh">

                        <thead>
                        <tr>
                            <th class="text-left">配置場所</th>
                            <th class="text-left">更新前</th>
                            <th class="text-left">更新後</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="location in locations" :key="location.id">
                            <td valign="baseline">{{ location.name }}</td>
                            <td valign="baseline">
                            <p v-for="device in devices[location.id]" :key="device.id" class="device-id">
                                {{ zeroPadding(device.id) }}
                            </p>
                            </td>
                            <td valign="baseline">
                            <p
                                v-for="device in updateData[location.id]"
                                :key="device.id"
                                class="device-id"
                            >
                                {{ zeroPadding(device) }}
                            </p>
                            </td>
                        </tr>
                        </tbody>
                    </v-table>
                </v-card-text>
        </div>
    </AuthenticatedLayout>
</template>

<style scoped >
.drop_area {
    margin: 30px auto;
    color: gray;
    font-weight: bold;
    font-size: 1.2em;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 15vh;
    border: 2px solid gray;
}
.enter {
    border: 2px dashed gray;
    opacity: 0.7;
}
.device-id{
    font-family:monospace, serif;
}
</style>
