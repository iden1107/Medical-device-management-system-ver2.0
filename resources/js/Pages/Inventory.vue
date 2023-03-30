<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import NavLink from '@/Components/NavLink.vue';
import { Head, usePage, Link, router } from '@inertiajs/vue3';
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
    {label:'廃棄',color:'#979797'},
];
let updateData = ref({});
let fileName = 'csvファイルをドロップ'
let isEnter = ref(false)

const isUpdateData = computed(() =>{
    if(Object.keys(updateData.value).length){
        return true;
    } else {
        return false;
    }
});

function zeroPadding(id){
    return ( '000' + id ).slice( -4 );
};
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
    updateData.value = {};
    fileName = 'csvファイルをドロップ'
}
// 配置先の更新
const updateLocation = () => {
    router.patch('/device/update_location', updateData.value);
    updateData.value = {};
    fileName = 'csvファイルをドロップ';
};
</script>


<template>
    <Head title="在庫管理 - " />
    <AuthenticatedLayout>
        <div class="mt-3 max-w-7xl mx-auto sm:px-6 lg:px-8 border border-gray-200 shadow">
                <v-card-title>在庫管理</v-card-title>
                <v-card-text>
                    <p class="text-base">以下のデモ用ファイルをダウンロードしてください</p>
                    <a href="csv/sample1.csv" download class="text-base text-Emerald-300 hover:underline mr-4 ">・sample1.csvをダウンロード</a><br/>
                    <a href="csv/sample2.csv" download class="text-base text-Emerald-300 hover:underline">・sample2.csvをダウンロード</a>
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
                    <div class="flex justify-end">
                        <SecondaryButton @click="cancel" :disabled="Object.keys(updateData).length ? false:true">キャンセル</SecondaryButton>
                        <Link as="button" @click="updateLocation" preserve-scroll>
                            <SecondaryButton class="ml-3" :disabled="Object.keys(updateData).length ? false:true">更新</SecondaryButton>
                        </Link>
                    </div>
                    <!-- 現在地表示テーブル -->
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
