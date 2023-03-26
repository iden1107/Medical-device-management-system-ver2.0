<script setup>

defineProps({
    canResetPassword: Boolean,
    status: String,
});


</script>

<template>
        <div class="w-full sm:max-w-md mx-auto mt-6 px-6 py-5 bg-Emerald-400 shadow-md h-32 sm:h-36">
            <div class="flex justify-center">
                <img :src="'img/logo.png'" alt="" class="h-16 sm:h-24">
                <div class="pl-4">
                    <h2 class="text-1xl sm:text-2xl text-white">医療法人 サンプル</h2>
                    <h1 class="text-4xl sm:text-5xl text-white  font mt-2">サンプル病院</h1>
                </div>
            </div>
        </div>
</template>

<style scoped>
.font{
    font-family: 'Shippori Mincho', serif !important;
    font-weight: 900;
}

</style>
