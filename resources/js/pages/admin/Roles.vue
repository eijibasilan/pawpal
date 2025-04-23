<template>
    <AdminLayout>
        <div class="m-3">
            <Heading :title="'Roles'" :description="'Manage your admin roles here.'" />

            <Button variant="ghost" size="icon" @click="openUpsertDialog('insert')">
                <Plus class="h-4 w-4" />
            </Button>

            <DataTable :columns="columns" :pagination="props.pagination" />
        </div>

        <Dialog :open="dialogVisibility">
            <DialogContent class="sm:max-w-[425px]" @close-dialog="() => (dialogVisibility = false)">
                <form @submit.prevent="submit">
                    <DialogHeader>
                        <DialogTitle>{{ selectedAction.toUpperCase() }} ROLE</DialogTitle>
                        <DialogDescription> </DialogDescription>
                    </DialogHeader>
                    <div class="grid grid-cols-1 gap-3">
                        <div class="grid gap-2">
                            <Label for="name">Name</Label>
                            <Input id="name" class="mt-1 block w-full" v-model="form.name" required autocomplete="name" placeholder="name" />
                            <InputError class="mt-2" :message="form.errors.name" />
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
            :title="'Delete Role'"
            :loading-confirmed="form.processing"
            :description="'Are you sure you want to delete this role'"
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
import { useToast } from '@/components/ui/toast/use-toast';
import WarningAlert from '@/components/WarningAlert.vue';
import AdminLayout from '@/layouts/admin/AdminLayout.vue';
import { PaginationResponse, Role, UpsertAction } from '@/types';
import { useForm } from '@inertiajs/vue3';
import { ColumnDef } from '@tanstack/vue-table';
import { Loader2, Plus } from 'lucide-vue-next';
import { h, ref } from 'vue';

const { toast } = useToast();
const selectedAction = ref<UpsertAction>('insert');
const selectedRow = ref<Role>();
const warningAlertVisibility = ref<boolean>(false);

const props = defineProps<{ pagination: PaginationResponse<Role> }>();

const dialogVisibility = ref<boolean>(false);

const columns = ref<ColumnDef<Role>[]>([
    {
        accessorKey: 'name',
        header: () => h('div', { class: 'text-center' }, 'Name'),
        cell: ({ row }) => h('div', { class: 'text-center' }, row.getValue('name')),
    },
    {
        id: 'actions',
        enableHiding: false,
        header: () => h('div', { class: 'text-center' }, 'Actions'),
        cell: ({ row }) =>
            h(TableActions, {
                class: 'text-center',
                onUpdate: () => openUpsertDialog('update', row.original as Role),
                onDelete: () => {
                    selectedRow.value = row.original as Role;
                    warningAlertVisibility.value = true;
                },
            }),
    },
]);

const form = useForm({
    name: '',
});

const openUpsertDialog = (action: UpsertAction, data?: Role) => {
    if (data) selectedRow.value = data;

    form.name = data?.name ?? '';
    selectedAction.value = action;
    dialogVisibility.value = true;
};

const submit = () => {
    const method = selectedAction.value === 'insert' ? 'post' : 'patch';
    const routeParams = selectedAction.value === 'update' ? `/${selectedRow.value?.id}` : '';

    form[method](`/admin/roles${routeParams}`, {
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
    form.delete(`/admin/roles/${selectedRow.value?.id}`, {
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
