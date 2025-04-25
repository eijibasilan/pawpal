<template>
    <AdminLayout>
        <div class="m-3">
            <Heading :title="'User Accounts'" :description="'Manage your user accounts here.'" />

            <DataTable :columns="columns" :pagination="props.pagination" />
        </div>
    </AdminLayout>
</template>

<script setup lang="ts">
import DataTable from '@/components/DataTable.vue';
import Heading from '@/components/Heading.vue';
import AdminLayout from '@/layouts/admin/AdminLayout.vue';
import { PaginationResponse, User } from '@/types';
import { ColumnDef } from '@tanstack/vue-table';
import { h, ref } from 'vue';

const props = defineProps<{ pagination: PaginationResponse<User> }>();

const columns = ref<ColumnDef<User>[]>([
    {
        accessorKey: 'name',
        header: () => h('div', { class: 'text-center' }, 'Name'),
        cell: ({ row }) => h('div', { class: 'text-center' }, row.getValue('name')),
    },
    {
        accessorKey: 'email',
        header: () => h('div', { class: 'text-center' }, 'Email'),
        cell: ({ row }) => h('div', { class: 'text-center' }, row.getValue('email')),
    },
    {
        accessorKey: 'mobile_number',
        header: () => h('div', { class: 'text-center' }, 'Contact Number'),
        cell: ({ row }) => h('div', { class: 'text-center' }, row.getValue('mobile_number')),
    },
]);
</script>
