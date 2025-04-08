<template>
    <div>admins dashboard</div>
</template>

<script setup lang="ts">
import AdminLayout from '@/layouts/admin/AdminLayout.vue';
import { h } from 'vue';

defineOptions({
    layout: h(AdminLayout),
});
</script>
