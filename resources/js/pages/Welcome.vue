<script setup lang="ts">
import UserLayout from '@/layouts/user/UserLayout.vue';
import { h } from 'vue';

defineOptions({
    layout: h(UserLayout),
});
</script>

<template>
    <div>Welcome Page</div>
</template>
