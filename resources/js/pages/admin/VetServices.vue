<template>
    <AdminLayout>
        <div class="m-3">
            <Heading :title="'Veterinary Services'" :description="'Manage your vet services here.'" />

            <Button variant="ghost" size="icon" @click="openUpsertDialog('insert')">
                <Plus class="h-4 w-4" />
            </Button>

            <DataTable :columns="columns" :pagination="props.pagination" />
        </div>

        <Dialog :open="dialogVisibility">
            <DialogContent class="max-h-[90dvh] overflow-y-auto sm:max-w-[425px]" @close-dialog="() => (dialogVisibility = false)">
                <form @submit.prevent="submit">
                    <DialogHeader>
                        <DialogTitle>{{ selectedAction.toUpperCase() }} VET SERVICE</DialogTitle>
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
                                    <Button variant="ghost" size="icon" @click.prevent="showDeleteImageWarning(image)">
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
            :title="'Delete Vet Service'"
            :loading-confirmed="form.processing"
            :description="'Are you sure you want to delete this veterinary service'"
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
import { Textarea } from '@/components/ui/textarea';
import { useToast } from '@/components/ui/toast/use-toast';
import WarningAlert from '@/components/WarningAlert.vue';
import AdminLayout from '@/layouts/admin/AdminLayout.vue';
import { PaginationResponse, Upload, UpsertAction, VetService } from '@/types';
import { useForm, usePage } from '@inertiajs/vue3';
import { ColumnDef } from '@tanstack/vue-table';
import { Loader2, Plus, X } from 'lucide-vue-next';
import { h, ref } from 'vue';

const { toast } = useToast();
const selectedAction = ref<UpsertAction>('insert');
const selectedRow = ref<VetService | null>();
const warningAlertVisibility = ref<boolean>(false);
const warningDeleteFileVisibility = ref<boolean>(false);

const selectedImage = ref<Upload>();

const props = defineProps<{ pagination: PaginationResponse<VetService> }>();

const dialogVisibility = ref<boolean>(false);

const columns = ref<ColumnDef<VetService>[]>([
    {
        accessorKey: 'name',
        header: () => h('div', { class: 'text-center' }, 'Name'),
        cell: ({ row }) => h('div', { class: 'text-center' }, row.getValue('name')),
    },
    {
        accessorKey: 'description',
        header: () => h('div', { class: 'text-center' }, 'Description'),
        cell: ({ row }) => h('div', { class: 'text-center' }, row.getValue('description')),
    },
    {
        id: 'actions',
        enableHiding: false,
        header: () => h('div', { class: 'text-center' }, 'Actions'),
        cell: ({ row }) =>
            h(TableActions, {
                class: 'text-center',
                onUpdate: () => openUpsertDialog('update', row.original as VetService),
                onDelete: () => {
                    selectedRow.value = row.original as VetService;
                    warningAlertVisibility.value = true;
                },
            }),
    },
]);

const form = useForm<{ name: string; description?: string; images: File[]; _method?: string }>({
    name: '',
    description: '',
    images: [],
    _method: '',
});

const openUpsertDialog = (action: UpsertAction, data?: VetService) => {
    selectedRow.value = data ?? null;

    form.name = data?.name ?? '';
    form.description = data?.description ?? '';
    form._method = action === 'update' ? 'patch' : '';
    selectedAction.value = action;
    dialogVisibility.value = true;
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

const showDeleteImageWarning = (image: Upload) => {
    selectedImage.value = image;
    warningDeleteFileVisibility.value = true;
};

const submit = () => {
    const routeParams = selectedAction.value === 'update' ? `/${selectedRow.value?.id}` : '';

    form.post(`/admin/vet-services${routeParams}`, {
        onSuccess: () => {
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
            form.reset('name', 'images');
            dialogVisibility.value = false;
        },
    });
};

const deleteRow = () => {
    form.delete(`/admin/vet-services/${selectedRow.value?.id}`, {
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
            warningAlertVisibility.value = false;
        },
    });
};

const deleteImage = () => {
    form.delete(`/admin/vet-services/image/${selectedImage.value?.id}`, {
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
