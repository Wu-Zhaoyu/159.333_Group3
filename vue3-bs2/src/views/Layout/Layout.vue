<template>
    <LayoutNav></LayoutNav>
    <LayoutHeader></LayoutHeader>
    <router-view :key="$route.fullPath"/>
    <LayoutFooter></LayoutFooter>

</template>
    
<script setup>
import LayoutNav from '@/views/Layout/components/LayoutNav.vue';
import LayoutFooter from '@/views/Layout/components/LayoutFooter.vue';
import LayoutHeader from '@/views/Layout/components/LayoutHeader.vue';


</script>
    
<style scoped>

</style>