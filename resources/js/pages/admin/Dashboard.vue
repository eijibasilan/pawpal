<template>
    <div>admins dashboard</div>
</template>

<script setup lang="ts">
//import AdminLayout from '@/layouts/admin/AdminLayout.vue';
import AppHeaderLayout from '@/layouts/app/AppHeaderLayout.vue';
import { h } from 'vue';

defineOptions({
    layout: h(AppHeaderLayout),
});
</script>
