<template>
    <div class="m-3">
        <Button variant="ghost" size="icon" @click="openUpsertDialog('insert')">
            <Plus class="h-4 w-4" />
        </Button>

        <DataTable :columns="columns" :data="props.pagination.data" />
    </div>

    <Dialog :open="dialogVisibility">
        <form @submit.prevent="submit">
            <DialogContent class="sm:max-w-[425px]" @close-dialog="() => (dialogVisibility = false)">
                <DialogHeader>
                    <DialogTitle>{{ selectedAction.toUpperCase() }} INVENTORY</DialogTitle>
                    <DialogDescription> </DialogDescription>
                </DialogHeader>
                <div class="grid grid-cols-1 gap-3">
                    <div class="grid gap-2">
                        <Label for="name">Name</Label>
                        <Input id="name" class="mt-1 block w-full" v-model="form.name" required autocomplete="name" placeholder="name" />
                        <InputError class="mt-2" :message="form.errors.name" />
                    </div>
                    <div class="grid gap-2">
                        <Label for="unit">Unit</Label>
                        <Input id="unit" class="mt-1 block w-full" v-model="form.unit" required autocomplete="name" placeholder="unit" />
                        <InputError class="mt-2" :message="form.errors.unit" />
                    </div>
                </div>
                <DialogFooter>
                    <Button type="submit"> Save </Button>
                </DialogFooter>
            </DialogContent>
        </form>
    </Dialog>
</template>

<script setup lang="ts">
import DataTable from '@/components/DataTable.vue';
import InputError from '@/components/InputError.vue';
import { Button } from '@/components/ui/button';
import { Dialog, DialogContent, DialogDescription, DialogFooter, DialogHeader, DialogTitle } from '@/components/ui/dialog';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import AdminLayout from '@/layouts/admin/AdminLayout.vue';
import { PaginationResponse, Product, ProductCategory } from '@/types';
import { useForm } from '@inertiajs/vue3';
import { ColumnDef } from '@tanstack/vue-table';
import { Plus } from 'lucide-vue-next';
import { h, ref } from 'vue';

type upsertAction = 'update' | 'insert';

const selectedAction = ref<upsertAction>('insert');

const props = defineProps<{ pagination: PaginationResponse<Product> }>();

const dialogVisibility = ref<boolean>(false);

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

const form = useForm({
    name: '',
    product_category_id: '',
    quantity: '',
    unit: '',
});

const openUpsertDialog = (action: upsertAction) => {
    selectedAction.value = action;

    dialogVisibility.value = true;
};

const submit = () => {
    console.log('ASDF');

    //form.patch(route('user.profile.update'), {
    //    preserveScroll: true,
    //});
};

defineOptions({
    layout: h(AdminLayout),
});
</script>
