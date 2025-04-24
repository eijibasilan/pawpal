<template>
    <AdminLayout>
        <div class="m-3">
            <Heading :title="'Admin Accounts'" :description="'Manage your admin accounts here.'" />

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
                        <DialogTitle>{{ selectedAction.toUpperCase() }} ADMIN</DialogTitle>
                        <DialogDescription> </DialogDescription>
                    </DialogHeader>
                    <div class="grid grid-cols-1 gap-3">
                        <div class="grid gap-2">
                            <Label for="name">Name</Label>
                            <Input id="name" class="mt-1 block w-full" v-model="form.name" required autocomplete="name" placeholder="name" />
                            <InputError class="mt-2" :message="form.errors.name" />
                        </div>
                        <div class="grid gap-2">
                            <Label for="email">Email</Label>
                            <Input
                                id="email"
                                type="email"
                                class="mt-1 block w-full"
                                v-model="form.email"
                                required
                                autocomplete="email"
                                placeholder="email"
                            />
                            <InputError class="mt-2" :message="form.errors.email" />
                        </div>
                        <div class="grid gap-2" v-if="selectedAction === 'insert'">
                            <Label for="password">Password</Label>
                            <Input
                                id="password"
                                ref="passwordInput"
                                v-model="form.password"
                                type="password"
                                class="mt-1 block w-full"
                                autocomplete="new-password"
                                placeholder="password"
                            />
                            <InputError :message="form.errors.password" />
                        </div>

                        <div class="grid gap-2" v-if="selectedAction === 'insert'">
                            <Label for="password_confirmation">Confirm password</Label>
                            <Input
                                id="password_confirmation"
                                v-model="form.password_confirmation"
                                type="password"
                                class="mt-1 block w-full"
                                autocomplete="new-password"
                                placeholder="Confirm password"
                            />
                            <InputError :message="form.errors.password_confirmation" />
                        </div>
                        <div class="grid gap-2">
                            <Label for="roles">Roles</Label>
                            <Select v-model="form.roles" :multiple="true">
                                <SelectTrigger>
                                    <SelectValue placeholder="Assign roles for this user" />
                                </SelectTrigger>
                                <SelectContent>
                                    <SelectGroup>
                                        <SelectLabel>Role</SelectLabel>
                                        <SelectItem :value="role.id" v-for="role in props.roles" :key="role.id">
                                            {{ role.name }}
                                        </SelectItem>
                                    </SelectGroup>
                                </SelectContent>
                            </Select>
                            <InputError class="mt-2" :message="form.errors.roles" />
                        </div>
                    </div>

                    <DialogFooter class="mt-5">
                        <Button type="submit" :disabled="formProcessing">
                            <Loader2 v-if="formProcessing" class="h-4 w-4 animate-spin" />
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
import { useToast } from '@/components/ui/toast/use-toast';
import WarningAlert from '@/components/WarningAlert.vue';
import AdminLayout from '@/layouts/admin/AdminLayout.vue';
import { Admin, PaginationResponse, Role, UpsertAction } from '@/types';
import { router, useForm } from '@inertiajs/vue3';
import { ColumnDef } from '@tanstack/vue-table';
import { Loader2, Plus } from 'lucide-vue-next';
import { h, ref } from 'vue';

const { toast } = useToast();
const selectedAction = ref<UpsertAction>('insert');
const selectedRow = ref<Admin>();
const formProcessing = ref<boolean>(false);
const warningAlertVisibility = ref<boolean>(false);
const dialogLoading = ref<boolean>(false);
const props = defineProps<{ pagination: PaginationResponse<Admin>; roles?: Role[] }>();

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

            const data = roles.map((role) => role.name).join(',');

            return h('div', { class: 'text-center' }, data);
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

const form = useForm<{ name: string; email: string; password?: string; password_confirmation?: string; roles: number[] }>({
    name: '',
    email: '',
    roles: [],
    password: '',
    password_confirmation: '',
});

const openUpsertDialog = (action: UpsertAction, data?: Admin) => {
    if (data) selectedRow.value = data;

    form.name = data?.name ?? '';
    form.email = data?.email ?? '';
    form.roles = data?.roles.map((role) => role.id) ?? [];

    selectedAction.value = action;
    dialogVisibility.value = true;

    dialogLoading.value = true;
    router.reload({
        only: ['roles'],
        onSuccess: () => {
            dialogLoading.value = false;
            dialogVisibility.value = true;
        },
    });
};

const submit = () => {
    const payload: any = { ...form };

    const method = selectedAction.value === 'insert' ? 'post' : 'patch';
    const routeParams = selectedAction.value === 'update' ? `/${selectedRow.value?.id}` : '';

    if (selectedAction.value === 'update') {
        delete payload['password'];
        delete payload['password_confirmation'];
    }

    formProcessing.value = true;

    router[method](`/admin/accounts${routeParams}`, payload, {
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
            formProcessing.value = false;
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
</script>
