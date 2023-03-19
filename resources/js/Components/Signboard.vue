<script setup>

defineProps({
    canResetPassword: Boolean,
    status: String,
});


</script>

<template>
        <div class="w-full sm:max-w-md mx-auto mt-6 px-6 py-4 bg-Emerald-400 shadow-md h-40">
            <div class="flex">
                <img :src="'img/logo.png'" alt="">
                <div class="pl-2">
                    <h2 class="text-2xl text-white">医療法人 サンプル</h2>
                    <h1 class="text-h4 text-white ff">サンプル病院</h1>
                </div>
            </div>
        </div>
</template>

<style scoped>
.ff{
    font-family: 'Shippori Mincho', serif !important;
    font-weight: 900;
    font-size: 48px;
    color: #FFF;
}
img{
    height: 120px;
}
</style>
