<template>
    <div class="m-3">
        <Heading :title="'Admin Accounts'" :description="'Manage your admin accounts here.'" />

        <Button variant="ghost" size="icon" @click="openUpsertDialog('insert')">
            <Plus class="h-4 w-4" />
        </Button>

        <DataTable :columns="columns" :data="props.pagination.data" />
    </div>

    <Dialog :open="dialogVisibility">
        <DialogContent class="sm:max-w-[425px]" @close-dialog="() => (dialogVisibility = false)">
            <form @submit.prevent="submit">
                <DialogHeader>
                    <DialogTitle>{{ selectedAction.toUpperCase() }} ADMIN</DialogTitle>
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
        :title="'Delete Account'"
        :loading-confirmed="form.processing"
        :description="'Are you sure you want to delete this account'"
        @cancelled="warningAlertVisibility = false"
        @confirmed="deleteRow()"
    />
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
import { ToastAction } from '@/components/ui/toast';
import { useToast } from '@/components/ui/toast/use-toast';
import WarningAlert from '@/components/WarningAlert.vue';
import AdminLayout from '@/layouts/admin/AdminLayout.vue';
import { Admin, PaginationResponse, Role } from '@/types';
import { useForm } from '@inertiajs/vue3';
import { ColumnDef } from '@tanstack/vue-table';
import { Loader2, Plus } from 'lucide-vue-next';
import { h, ref } from 'vue';

type upsertAction = 'update' | 'insert';

const { toast } = useToast();
const selectedAction = ref<upsertAction>('insert');
const selectedRow = ref<Admin>();
const warningAlertVisibility = ref<boolean>(false);

const props = defineProps<{ pagination: PaginationResponse<Admin> }>();

const dialogVisibility = ref<boolean>(false);

const columns = ref<ColumnDef<Admin>[]>([
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
        accessorKey: 'roles',
        header: () => h('div', { class: 'text-center' }, 'Role'),
        cell: ({ row }) => {
            const roles = row.getValue('roles') as Role[];

            return h('div', { class: 'text-center' }, roles[0]?.name);
        },
    },
    {
        id: 'actions',
        enableHiding: false,
        header: () => h('div', { class: 'text-center' }, 'Actions'),
        cell: ({ row }) =>
            h(TableActions, {
                class: 'text-center',
                onUpdate: () => openUpsertDialog('update', row.original as Admin),
                onDelete: () => {
                    selectedRow.value = row.original as Admin;
                    warningAlertVisibility.value = true;
                },
            }),
    },
]);

const form = useForm({
    name: '',
});

const openUpsertDialog = (action: upsertAction, data?: Admin) => {
    if (data) selectedRow.value = data;

    form.name = data?.name ?? '';
    selectedAction.value = action;
    dialogVisibility.value = true;
};

const submit = () => {
    const method = selectedAction.value === 'insert' ? 'post' : 'patch';
    const routeParams = selectedAction.value === 'update' ? `/${selectedRow.value?.id}` : '';

    form[method](`/admin/accounts${routeParams}`, {
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
            form.reset('name');
            dialogVisibility.value = false;
        },
    });
};

const deleteRow = () => {
    form.delete(`/admin/accounts/${selectedRow.value?.id}`, {
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
