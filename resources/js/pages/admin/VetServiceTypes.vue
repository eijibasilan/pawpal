<template>
    <AdminLayout>
        <div class="m-3">
            <Heading :title="'Veterinary Services'" :description="'Manage your vet service types here.'" />

            <Button variant="ghost" size="icon" @click="openUpsertDialog('insert')">
                <Loader2 class="h-4 w-4 animate-spin" v-if="dialogLoading" />
                <Plus class="h-4 w-4" v-else />
            </Button>

            <DataTable :columns="columns" :pagination="props.pagination" />
        </div>

        <Dialog :open="dialogVisibility">
            <DialogContent class="sm:max-w-[425px]" @close-dialog="() => (dialogVisibility = false)">
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
                            <Label for="vetServiceType">Service</Label>
                            <Select v-model="form.vet_service_id">
                                <SelectTrigger>
                                    <SelectValue placeholder="Select a vet service" />
                                </SelectTrigger>
                                <SelectContent>
                                    <SelectGroup>
                                        <SelectLabel>Vet Services</SelectLabel>
                                        <SelectItem :value="vetService.id" v-for="vetService in props.vetServices" :key="vetService.id">
                                            {{ vetService.name }}
                                        </SelectItem>
                                    </SelectGroup>
                                </SelectContent>
                            </Select>
                            <InputError class="mt-2" :message="form.errors.vet_service_id" />
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
            :description="'Are you sure you want to delete this veterinary service type'"
            @cancelled="warningAlertVisibility = false"
            @confirmed="deleteRow()"
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
import { PaginationResponse, UpsertAction, VetService, VetServiceType } from '@/types';
import { router, useForm } from '@inertiajs/vue3';
import { ColumnDef } from '@tanstack/vue-table';
import { Loader2, Plus } from 'lucide-vue-next';
import { h, ref } from 'vue';

const { toast } = useToast();
const selectedAction = ref<UpsertAction>('insert');
const selectedRow = ref<VetServiceType>();
const dialogLoading = ref<boolean>(false);
const warningAlertVisibility = ref<boolean>(false);

const props = defineProps<{ pagination: PaginationResponse<VetServiceType>; vetServices?: VetService[] }>();

const dialogVisibility = ref<boolean>(false);

const columns = ref<ColumnDef<VetServiceType>[]>([
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
        accessorKey: 'service',
        header: () => h('div', { class: 'text-center' }, 'Service'),
        cell: ({ row }) => {
            const service = row.getValue('service') as VetService;

            return h('div', { class: 'text-center' }, service.name);
        },
    },
    {
        id: 'actions',
        enableHiding: false,
        header: () => h('div', { class: 'text-center' }, 'Actions'),
        cell: ({ row }) =>
            h(TableActions, {
                class: 'text-center',
                onUpdate: () => openUpsertDialog('update', row.original as VetServiceType),
                onDelete: () => {
                    selectedRow.value = row.original as VetServiceType;
                    warningAlertVisibility.value = true;
                },
            }),
    },
]);

const form = useForm({
    name: '',
    description: '',
    vet_service_id: 0,
});

const openUpsertDialog = (action: UpsertAction, data?: VetServiceType) => {
    if (data) selectedRow.value = data;

    form.name = data?.name ?? '';
    form.description = data?.description ?? '';
    form.vet_service_id = data?.service.id ?? 0;

    selectedAction.value = action;
    dialogLoading.value = true;
    router.reload({
        only: ['vetServices'],
        onSuccess: () => {
            dialogLoading.value = false;
            dialogVisibility.value = true;
        },
    });
};

const submit = () => {
    const method = selectedAction.value === 'insert' ? 'post' : 'patch';
    const routeParams = selectedAction.value === 'update' ? `/${selectedRow.value?.id}` : '';

    form[method](`/admin/vet-service-types${routeParams}`, {
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
            form.reset('name');
            dialogVisibility.value = false;
        },
    });
};

const deleteRow = () => {
    form.delete(`/admin/vet-service-types/${selectedRow.value?.id}`, {
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
</script>
