<script setup lang="ts">
import { Head } from '@inertiajs/vue3';

import AppearanceTabs from '@/components/AppearanceTabs.vue';
import HeadingSmall from '@/components/HeadingSmall.vue';
import UserLayout from '@/layouts/user/UserLayout.vue';
import { LayoutOptions, type BreadcrumbItem } from '@/types';
import { h } from 'vue';

import UserSettingsLayout from '@/layouts/user/UserSettingsLayout.vue';

defineOptions({
    layout: h(UserLayout, {
        breadcrumbs: [
            {
                title: 'Appearance settings',
                href: '/settings/appearance',
            },
        ] as BreadcrumbItem[],
    }),
} as LayoutOptions);
</script>

<template>
    <Head title="Appearance settings" />

    <UserSettingsLayout>
        <div class="space-y-6">
            <HeadingSmall title="Appearance settings" description="Update your account's appearance settings" />
            <AppearanceTabs />
        </div>
    </UserSettingsLayout>
</template>
