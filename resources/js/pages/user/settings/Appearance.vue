<script setup lang="ts">
import { Head } from '@inertiajs/vue3';

import AppearanceTabs from '@/components/AppearanceTabs.vue';
import HeadingSmall from '@/components/HeadingSmall.vue';
import UserLayout from '@/layouts/user/UserLayout.vue';
import { type BreadcrumbItem } from '@/types';

import UserSettingsLayout from '@/layouts/user/UserSettingsLayout.vue';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Appearance settings',
        href: '/settings/appearance',
    },
];
</script>

<template>
    <Head title="Appearance settings" />
    <UserLayout :breadcrumbs="breadcrumbs">
        <UserSettingsLayout>
            <div class="space-y-6">
                <HeadingSmall title="Appearance settings" description="Update your account's appearance settings" />
                <AppearanceTabs />
            </div>
        </UserSettingsLayout>
    </UserLayout>
</template>
