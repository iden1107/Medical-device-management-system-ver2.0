<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import NavLink from '@/Components/NavLink.vue';
import { Head } from '@inertiajs/vue3';

// export default {
//     name: "Inventory",
//     data() {
//         return {
//             isEnter : false,
//             fileName:'csvファイルをドロップ',
//             updateData: {},
//             status: [
//                 { label: "稼働中", color: "#80E368" },
//                 { label: "待機中", color: "#6B9CE4" },
//                 { label: "点検中", color: "#E3DD68" },
//                 { label: "修理中", color: "#E36868" },
//                 { label: "廃棄", color: "gray" },
//             ],
//             devices: [],
//             order: [
//                 "臨床工学室",
//                 "整形外科",
//                 "眼科",
//                 "内視鏡センター",
//                 "生理検査室",
//                 "皮膚科",
//                 "産婦人科",
//                 "リハビリテーション室",
//                 "外科",
//                 "処置室",
//                 "内科",
//                 "泌尿器科",
//                 "小児科",
//             ],
//         };
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
//         dragEnter() {
//             this.isEnter = true;
//         },
//         dragLeave() {
//             this.isEnter = false;
//         },
//         dropFile(e) {
//             if(e.dataTransfer.files[0].type !== 'text/csv'){
//                 alert('ファイル形式がcsvでありません')
//                 this.isEnter = false
//                 return
//             }
//             this.isEnter = false
//             this.fileName = e.dataTransfer.files[0].name
//             const self = this
//             let obj = {};
//             const reader = new FileReader()
//             reader.onload = function (e) {
//                 let step1 = e.target.result.split(/\n/);
//                 for (let i = 0; i < step1.length - 1 ; i++) {
//                     let step2 = step1[i].split(",")
//                     let key = step2.slice(0, 1)
//                     let val = step2.slice(1).map(Number)
//                     obj[key] = val;
//                 }
//                 self.updateData = obj;
//             };
//             reader.readAsText(e.dataTransfer.files[0])
//         },
//         cancel(){
//             this.updateData = {};
//             this.fileName = 'csvファイルをドロップ'
//         }
//     },
//     watch: {
//         $route() {
//             this.getDevices();
//         },
//     },
//     filters: {
//         zeroPadding(value) {
//             if(value !== 0){
//                 return ("000" + value).slice(-4)
//             }
//         },
//     },
//     created() {
//         this.getDevices();
//     },
// };
</script>


<template>
<AuthenticatedLayout>
    <div>
        <v-row>
        <v-col cols="12">
            <v-card outlined>
            <v-card-title>機器管理台帳</v-card-title>
            <v-card-text>
                <a href="/sample1.csv" download class="mr-4">サンプル1のcsvファイルをダウンロード</a>
                <a href="/sample2.csv" download>サンプル2のcsvファイルをダウンロード</a>
                <v-col class="drop_area"
                    cols="12"
                    md="6"
                    :class="{enter: isEnter}"
                    @dragenter="dragEnter"
                    @dragleave="dragLeave"
                    @dragover.prevent
                    @drop.prevent="dropFile"
                    :style="backgroundColor"
                >
                    {{fileName}}
                </v-col>
                <div class="pb-3 d-flex justify-end">
                    <v-btn
                    tile
                    elevation="1"
                    @click="cancel"
                    class="mr-2"
                    :disabled="fileName == 'csvファイルをドロップ'"
                    >キャンセル</v-btn
                    >
                    <v-btn
                    tile
                    elevation="1"
                    @click="updateLocation"
                    :disabled="fileName == 'csvファイルをドロップ'"
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
                    <tr v-for="location in order" :key="location">
                        <td valign="baseline">{{ location }}</td>
                        <td valign="baseline">
                        <p v-for="device in devices[location]" :key="device.id">
                            {{ device.id | zeroPadding }}
                        </p>
                        </td>
                        <td valign="baseline">
                        <p
                            v-for="device in updateData[location]"
                            :key="device.id"
                        >
                            {{ device | zeroPadding }}
                        </p>
                        </td>
                    </tr>
                    </tbody>

                </v-table>
            </v-card-text>
            </v-card>
        </v-col>
        </v-row>
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
</style>
