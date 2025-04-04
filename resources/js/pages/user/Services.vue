<template>services</template>

<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { BreadcrumbItem, LayoutOptions } from '@/types';
import { h } from 'vue';

defineOptions({
    layout: h(AppLayout, {
        breadcrumbs: [
            {
                title: 'Credentials',
                href: '/credentials/Index',
            },
        ] as BreadcrumbItem[],
    }),
} as LayoutOptions);
</script>
