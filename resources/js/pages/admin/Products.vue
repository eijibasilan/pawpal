<template>
    <div class="m-3">
        <Button variant="ghost" size="icon" @click="openUpsertDialog('insert')">
            <Loader2 class="h-4 w-4 animate-spin" v-if="dialogLoading" />
            <Plus class="h-4 w-4" v-else />
        </Button>

        <DataTable :columns="columns" :data="props.pagination.data" />
    </div>

    <Dialog :open="dialogVisibility">
        <DialogContent class="sm:max-w-[425px]" @close-dialog="() => (dialogVisibility = false)">
            <form @submit.prevent="submit">
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
                        <Label for="quantity">Quantity</Label>
                        <Input
                            type="number"
                            id="quantity"
                            class="mt-1 block w-full"
                            v-model="form.quantity"
                            required
                            autocomplete="name"
                            placeholder="quantity"
                        />
                        <InputError class="mt-2" :message="form.errors.quantity" />
                    </div>
                    <div class="grid gap-2">
                        <Label for="unit">Unit</Label>
                        <Input id="unit" class="mt-1 block w-full" v-model="form.unit" required autocomplete="name" placeholder="unit" />
                        <InputError class="mt-2" :message="form.errors.unit" />
                    </div>
                    <div class="grid gap-2">
                        <Label for="unit">Category</Label>
                        <Select v-model="form.product_category_id">
                            <SelectTrigger>
                                <SelectValue placeholder="Select a category" />
                            </SelectTrigger>
                            <SelectContent>
                                <SelectGroup>
                                    <SelectLabel>Category</SelectLabel>
                                    <SelectItem :value="category.id" v-for="category in props.productCategories" :key="category.id">
                                        {{ category.name }}
                                    </SelectItem>
                                </SelectGroup>
                            </SelectContent>
                        </Select>
                        <InputError class="mt-2" :message="form.errors.product_category_id" />
                    </div>
                </div>
                <DialogFooter class="mt-5">
                    <Button type="submit" :disabled="form.processing">
                        <Loader2 v-if="form.processing" class="h-4 w-4 animate-spin" />
                        Save
                    </Button>
                </DialogFooter>
            </form>
        </DialogContent>
    </Dialog>

    <WarningAlert
        :visibility="warningAlertVisibility"
        :title="'Delete Product'"
        :loading-confirmed="form.processing"
        :description="'Are you sure you want to delete this product'"
        @cancelled="warningAlertVisibility = false"
        @confirmed="deleteRow()"
    />
</template>

<script setup lang="ts">
import DataTable from '@/components/DataTable.vue';
import InputError from '@/components/InputError.vue';
import TableActions from '@/components/TableActions.vue';
import { Button } from '@/components/ui/button';
import { Dialog, DialogContent, DialogDescription, DialogFooter, DialogHeader, DialogTitle } from '@/components/ui/dialog';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { Select, SelectContent, SelectGroup, SelectItem, SelectLabel, SelectTrigger, SelectValue } from '@/components/ui/select';
import { ToastAction } from '@/components/ui/toast';
import { useToast } from '@/components/ui/toast/use-toast';
import WarningAlert from '@/components/WarningAlert.vue';
import AdminLayout from '@/layouts/admin/AdminLayout.vue';
import { PaginationResponse, Product, ProductCategory } from '@/types';
import { router, useForm } from '@inertiajs/vue3';
import { ColumnDef } from '@tanstack/vue-table';
import { Loader2, Plus } from 'lucide-vue-next';
import { h, ref } from 'vue';

type upsertAction = 'update' | 'insert';

const { toast } = useToast();
const selectedAction = ref<upsertAction>('insert');
const selectedRow = ref<Product>();
const dialogLoading = ref<boolean>(false);
const warningAlertVisibility = ref<boolean>(false);

const props = defineProps<{ pagination: PaginationResponse<Product>; productCategories?: ProductCategory[] }>();

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
    {
        id: 'actions',
        enableHiding: false,
        header: () => h('div', { class: 'text-center' }, 'Actions'),
        cell: ({ row }) =>
            h(TableActions, {
                class: 'text-center',
                onUpdate: () => openUpsertDialog('update', row.original as Product),
                onDelete: () => {
                    selectedRow.value = row.original as Product;
                    warningAlertVisibility.value = true;
                },
            }),
    },
]);

const form = useForm({
    name: '',
    product_category_id: 0,
    quantity: 0,
    unit: '',
});

const openUpsertDialog = (action: upsertAction, data?: Product) => {
    if (data) selectedRow.value = data;

    form.name = data?.name ?? '';
    form.product_category_id = data?.category.id ?? 0;
    form.quantity = data?.quantity ?? 0;
    form.unit = data?.unit ?? '';

    dialogLoading.value = true;
    selectedAction.value = action;
    router.reload({
        only: ['productCategories'],
        onSuccess: () => {
            dialogLoading.value = false;
            dialogVisibility.value = true;
        },
    });
};

const submit = () => {
    const method = selectedAction.value === 'insert' ? 'post' : 'patch';
    const routeParams = selectedAction.value === 'update' ? `/${selectedRow.value?.id}` : '';

    form[method](`/admin/products${routeParams}`, {
        onSuccess: () => {
            console.log('success');

            toast({
                duration: 1000,
                title: 'Success!!',
                description: `The data has been ${selectedAction.value}`,
                variant: 'default',
                action: h(
                    ToastAction,
                    {
                        altText: 'Try again',
                    },
                    {
                        default: () => 'Try again',
                    },
                ),
            });
        },
        onError: () => {
            toast({
                duration: 1000,
                title: 'Uh oh! Something went wrong.',
                description: 'There was a problem with your request.',
                variant: 'destructive',
                action: h(
                    ToastAction,
                    {
                        altText: 'Try again',
                    },
                    {
                        default: () => 'Try again',
                    },
                ),
            });
        },
        onFinish: () => {
            form.reset('name', 'product_category_id', 'quantity', 'unit');
            dialogVisibility.value = false;
        },
    });
};

const deleteRow = () => {
    form.delete(`/admin/products/${selectedRow.value?.id}`, {
        preserveScroll: true,
        //onSuccess: () => closeModal(),
        //onError: () => passwordInput.value?.focus(),
        onFinish: () => (warningAlertVisibility.value = false),
    });
};

defineOptions({
    layout: h(AdminLayout),
});
</script>
