<template>
    <div class="m-3">
        <DataTable :columns="columns" :data="props.pagination.data" />
    </div>
</template>

<script setup lang="ts">
import DataTable from '@/components/DataTable.vue';
import AdminLayout from '@/layouts/admin/AdminLayout.vue';
import { PaginationResponse, Product, ProductCategory } from '@/types';
import { ColumnDef } from '@tanstack/vue-table';
import { h, ref } from 'vue';

const props = defineProps<{ pagination: PaginationResponse<Product> }>();

const columns = ref<ColumnDef<Product>[]>([
    {
        accessorKey: 'name',
        header: () => h('div', { class: 'text-center' }, 'Name'),
        cell: ({ row }) => h('div', { class: 'text-center' }, row.getValue('name')),
    },
    {
        accessorKey: 'category',
        header: () => h('div', { class: 'text-center' }, 'Category'),
        cell: ({ row }) => {
            const category = row.getValue('category') as ProductCategory;

            return h('div', { class: 'text-center' }, category.name);
        },
    },
    {
        accessorKey: 'quantity',
        header: () => h('div', { class: 'text-center' }, 'Quantity'),
        cell: ({ row }) => h('div', { class: 'text-center' }, row.getValue('quantity')),
    },
    {
        accessorKey: 'unit',
        header: () => h('div', { class: 'text-center' }, 'Unit'),
        cell: ({ row }) => h('div', { class: 'text-center' }, row.getValue('unit')),
    },
    {
        accessorKey: 'updated_at',
        header: () => h('div', { class: 'text-center' }, 'Last Updated At'),
        cell: ({ row }) => h('div', { class: 'text-center' }, row.getValue('updated_at') ?? '-'),
    },
]);

defineOptions({
    layout: h(AdminLayout),
});
</script>
