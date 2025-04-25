<template>
    <AdminLayout>
        <div class="m-3">
            <Heading :title="'Inventory'" :description="'Manage your inventories here.'" />

            <Button variant="ghost" size="icon" @click="openUpsertDialog('insert')">
                <Loader2 class="h-4 w-4 animate-spin" v-if="dialogLoading" />
                <Plus class="h-4 w-4" v-else />
            </Button>

            <DataTable :columns="columns" :pagination="props.pagination" />
        </div>

        <Dialog :open="dialogVisibility">
            <DialogContent class="max-h-[90dvh] overflow-y-auto sm:max-w-[425px]" @close-dialog="() => (dialogVisibility = false)">
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
                            <Label for="description">Description</Label>
                            <Textarea
                                id="description"
                                class="mt-1 block w-full"
                                v-model="form.description"
                                autocomplete="description"
                                placeholder="description"
                            />
                            <InputError class="mt-2" :message="form.errors.description" />
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
                            <Label for="quantity">Price</Label>
                            <Input
                                type="number"
                                id="quantity"
                                class="mt-1 block w-full"
                                v-model="form.price"
                                step=".01"
                                required
                                autocomplete="name"
                                placeholder="price"
                            />
                            <InputError class="mt-2" :message="form.errors.price" />
                        </div>
                        <div class="grid gap-2">
                            <Label for="brand">Brand</Label>
                            <Select v-model="form.product_brand_id">
                                <SelectTrigger>
                                    <SelectValue placeholder="Select a brand" />
                                </SelectTrigger>
                                <SelectContent>
                                    <SelectGroup>
                                        <SelectLabel>Brand</SelectLabel>
                                        <SelectItem :value="brand.id" v-for="brand in props.productBrands" :key="brand.id">
                                            {{ brand.name }}
                                        </SelectItem>
                                    </SelectGroup>
                                </SelectContent>
                            </Select>
                            <InputError class="mt-2" :message="form.errors.product_brand_id" />
                        </div>
                        <div class="grid gap-2">
                            <Label for="category">Category</Label>
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
                        <div class="grid gap-2">
                            <Label for="images">Images</Label>
                            <Input
                                id="images"
                                type="file"
                                class="mt-1 block w-full"
                                accept="image/png, image/jpeg"
                                multiple
                                @change="handleFileUpload"
                                autocomplete="images"
                                placeholder="images"
                            />
                            <InputError class="mt-2" :message="form.errors.images" />
                        </div>
                        <!-- Images -->
                        <div>
                            <div v-for="(image, key) in selectedRow?.uploads" :key="key" class="mb-4">
                                <div class="flex justify-between">
                                    <img :src="`${usePage().props.appUrl}${image.url}`" alt="" class="max-w-[80%]" />
                                    <Button
                                        variant="ghost"
                                        size="icon"
                                        @click.prevent="
                                            () => {
                                                selectedImage = image;
                                                warningDeleteFileVisibility = true;
                                            }
                                        "
                                    >
                                        <X class="h-4 w-4 text-red-500" />
                                    </Button>
                                </div>
                            </div>
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

        <WarningAlert
            :visibility="warningDeleteFileVisibility"
            :title="'Delete this image'"
            :loading-confirmed="form.processing"
            :description="'Are you sure you want to delete this image'"
            @cancelled="warningDeleteFileVisibility = false"
            @confirmed="deleteImage()"
        />
    </AdminLayout>
</template>

<script setup lang="ts">
import DataTable from '@/components/DataTable.vue';
import Heading from '@/components/Heading.vue';
import InputError from '@/components/InputError.vue';
import TableActions from '@/components/TableActions.vue';
import { Button } from '@/components/ui/button';
import { Dialog, DialogContent, DialogDescription, DialogFooter, DialogHeader, DialogTitle } from '@/components/ui/dialog';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { Select, SelectContent, SelectGroup, SelectItem, SelectLabel, SelectTrigger, SelectValue } from '@/components/ui/select';
import { Textarea } from '@/components/ui/textarea';
import { useToast } from '@/components/ui/toast/use-toast';
import WarningAlert from '@/components/WarningAlert.vue';
import AdminLayout from '@/layouts/admin/AdminLayout.vue';
import { PaginationResponse, Product, ProductBrand, ProductCategory, Upload, UpsertAction } from '@/types';
import { router, useForm, usePage } from '@inertiajs/vue3';
import { ColumnDef } from '@tanstack/vue-table';
import { Loader2, Plus, X } from 'lucide-vue-next';
import { h, ref } from 'vue';

const { toast } = useToast();
const selectedAction = ref<UpsertAction>('insert');
const selectedRow = ref<Product | null>();
const dialogLoading = ref<boolean>(false);
const warningAlertVisibility = ref<boolean>(false);
const warningDeleteFileVisibility = ref<boolean>(false);

const selectedImage = ref<Upload>();

const props = defineProps<{ pagination: PaginationResponse<Product>; productCategories?: ProductCategory[]; productBrands?: ProductBrand[] }>();

const dialogVisibility = ref<boolean>(false);

const columns = ref<ColumnDef<Product>[]>([
    {
        accessorKey: 'name',
        header: () => h('div', { class: 'text-center' }, 'Name'),
        cell: ({ row }) => h('div', { class: 'text-center' }, row.getValue('name')),
    },
    {
        accessorKey: 'brand',
        header: () => h('div', { class: 'text-center' }, 'Brand'),
        cell: ({ row }) => {
            const brand = row.getValue('brand') as ProductBrand;

            return h('div', { class: 'text-center' }, brand.name);
        },
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
        accessorKey: 'price',
        header: () => h('div', { class: 'text-center' }, 'Price'),
        cell: ({ row }) => h('div', { class: 'text-center' }, row.getValue('price')),
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

const form = useForm<{
    name: string;
    description: string;
    product_brand_id: number;
    product_category_id: number;
    quantity: number;
    price: number;
    images: File[];
    _method?: string;
}>({
    name: '',
    description: '',
    product_category_id: 0,
    product_brand_id: 0,
    quantity: 0,
    price: 0.0,
    images: [],
    _method: '',
});

const openUpsertDialog = (action: UpsertAction, data?: Product) => {
    selectedRow.value = data ?? null;

    form.name = data?.name ?? '';
    form.product_category_id = data?.category.id ?? 0;
    form.product_brand_id = data?.brand.id ?? 0;
    form._method = action === 'update' ? 'patch' : '';
    form.quantity = data?.quantity ?? 0;
    form.price = data?.price ?? 0.0;

    dialogLoading.value = true;
    selectedAction.value = action;
    router.reload({
        only: ['productCategories', 'productBrands'],
        onSuccess: () => {
            dialogLoading.value = false;
            dialogVisibility.value = true;
        },
    });
};

const handleFileUpload = (event: Event) => {
    const target = event.target as HTMLInputElement;
    const files: FileList | null = target.files;

    if (files) {
        form.images.length = 0;

        for (let i = 0; i < files.length; i++) {
            const file = files.item(i);
            if (file) {
                form.images.push(file);
            }
        }
    }
};

const submit = () => {
    const routeParams = selectedAction.value === 'update' ? `/${selectedRow.value?.id}` : '';

    form.post(`/admin/products${routeParams}`, {
        onSuccess: () => {
            dialogVisibility.value = false;
            toast({
                duration: 1000,
                title: 'Success!!',
                description: `The data has been ${selectedAction.value}`,
                variant: 'default',
            });
        },
        onError: () => {
            toast({
                duration: 1000,
                title: 'Uh oh! Something went wrong.',
                description: 'There was a problem with your request.',
                variant: 'destructive',
            });
        },
        onFinish: () => {
            form.reset('name', 'product_category_id', 'quantity', 'price');
        },
    });
};

const deleteRow = () => {
    form.delete(`/admin/products/${selectedRow.value?.id}`, {
        preserveScroll: true,
        onSuccess: () => {
            toast({
                duration: 1000,
                title: 'Success!!',
                description: `The data has been deleted`,
                variant: 'default',
            });
        },
        onError: () => {
            toast({
                duration: 1000,
                title: 'Uh oh! Something went wrong.',
                description: 'There was a problem with your request.',
                variant: 'destructive',
            });
        },
        onFinish: () => {
            form.reset('name', 'images');
            warningAlertVisibility.value = false;
        },
    });
};

const deleteImage = () => {
    form.delete(`/admin/products/image/${selectedImage.value?.id}`, {
        preserveScroll: true,
        onSuccess: () => {
            toast({
                duration: 1000,
                title: 'Success!!',
                description: `The image has been deleted`,
                variant: 'default',
            });
        },
        onError: () => {
            toast({
                duration: 1000,
                title: 'Uh oh! Something went wrong.',
                description: 'There was a problem with your request.',
                variant: 'destructive',
            });
        },
        onFinish: () => {
            warningDeleteFileVisibility.value = false;

            selectedRow.value = props.pagination.data.find((item) => item.id === selectedRow.value?.id);
        },
    });
};
</script>
