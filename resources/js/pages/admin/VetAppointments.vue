<template>
    <AdminLayout>
        <div class="m-3">
            <Heading :title="'Vet Appointments'" :description="'Your veterinary appointments.'" />

            <DataTable :columns="columns" :pagination="props.pagination" />
        </div>
        <Dialog :open="dialogVisibility">
            <DialogContent class="sm:max-w-[425px]" @close-dialog="() => (dialogVisibility = false)">
                <form @submit.prevent="submit">
                    <DialogHeader>
                        <DialogTitle>Update Appointment Status</DialogTitle>
                        <DialogDescription> </DialogDescription>
                    </DialogHeader>
                    <div class="mt-2 grid grid-cols-1 gap-3">
                        <div class="grid gap-2">
                            <Label for="status">Status</Label>
                            <Select v-model="form.status">
                                <SelectTrigger>
                                    <SelectValue placeholder="Status" />
                                </SelectTrigger>
                                <SelectContent>
                                    <SelectGroup>
                                        <SelectLabel>Select Status</SelectLabel>
                                        <SelectItem :value="status" v-for="(status, key) in statuses" :key="key">
                                            {{ status }}
                                        </SelectItem>
                                    </SelectGroup>
                                </SelectContent>
                            </Select>
                            <InputError class="mt-2" :message="form.errors.status" />
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
    </AdminLayout>
</template>

<script setup lang="ts">
import DataTable from '@/components/DataTable.vue';
import Heading from '@/components/Heading.vue';
import InputError from '@/components/InputError.vue';
import TableActions from '@/components/TableActions.vue';
import { Button } from '@/components/ui/button';
import { Dialog, DialogContent, DialogDescription, DialogFooter, DialogHeader, DialogTitle } from '@/components/ui/dialog';
import { Label } from '@/components/ui/label';
import { Select, SelectContent, SelectGroup, SelectItem, SelectLabel, SelectTrigger, SelectValue } from '@/components/ui/select';
import { useToast } from '@/components/ui/toast/use-toast';
import ViewImageDialog from '@/components/user/ViewImageDialog.vue';
import AdminLayout from '@/layouts/admin/AdminLayout.vue';
import { PaginationResponse, Upload, User, VetAppointment, VetAppointmentSchedule } from '@/types';
import { useForm } from '@inertiajs/vue3';
import { Loader2 } from 'lucide-vue-next';

import Badge from '@/components/ui/badge/Badge.vue';
import { ColumnDef } from '@tanstack/vue-table';
import { h, ref } from 'vue';

const { toast } = useToast();

const dialogVisibility = ref<boolean>(false);
const selectedRow = ref<VetAppointment>();
const form = useForm<{ status: string }>({
    status: '',
});

const statuses = ref(['Approved', 'Cancelled']);

const props = defineProps<{ pagination: PaginationResponse<VetAppointment> }>();

const columns = ref<ColumnDef<VetAppointment>[]>([
    {
        accessorKey: 'upload',
        header: () => h('div', { class: 'text-center' }, 'View Transaction'),
        cell: ({ row }) => {
            const upload = row.getValue('upload') as Upload;
            return h(ViewImageDialog, { upload: upload, title: 'Proof of Transaction' });
        },
    },
    {
        accessorKey: 'schedule',
        header: () => h('div', { class: 'text-center' }, 'User'),
        cell: ({ row }) => {
            const vetAppointmentSchedule = row.getValue('schedule') as VetAppointmentSchedule;

            return h('div', { class: 'text-center' }, vetAppointmentSchedule.scheduled_date);
        },
    },
    {
        accessorKey: 'user',
        header: () => h('div', { class: 'text-center' }, 'Date'),
        cell: ({ row }) => {
            const user = row.getValue('user') as User;

            return h('div', { class: 'text-center' }, user.name);
        },
    },
    {
        accessorKey: 'schedule',
        header: () => h('div', { class: 'text-center' }, 'Time'),
        cell: ({ row }) => {
            const vetAppointmentSchedule = row.getValue('schedule') as VetAppointmentSchedule;

            return h('div', { class: 'text-center' }, `${vetAppointmentSchedule.start_time}-${vetAppointmentSchedule.end_time}`);
        },
    },
    {
        accessorKey: 'schedule',
        header: () => h('div', { class: 'text-center' }, 'Service'),
        cell: ({ row }) => {
            const vetAppointmentSchedule = row.getValue('schedule') as VetAppointmentSchedule;

            return h('div', { class: 'text-center' }, vetAppointmentSchedule.service.name);
        },
    },
    {
        accessorKey: 'status',
        header: () => h('div', { class: 'text-center' }, 'Status'),
        cell: ({ row }) => h(Badge, { text: row.getValue('status') as string, variant: badgeVariant(row.getValue('status')) }),
    },
    {
        accessorKey: 'created_at',
        header: () => h('div', { class: 'text-center' }, 'Booked at'),
        cell: ({ row }) => h('div', { class: 'text-center' }, row.getValue('created_at')),
    },
    {
        id: 'actions',
        enableHiding: false,
        header: () => h('div', { class: 'text-center' }, 'Actions'),
        cell: ({ row }) =>
            h(TableActions, {
                class: 'text-center',
                hideDelete: true,
                onUpdate: () => openUpdateDialog(row.original as VetAppointment),
            }),
    },
]);

const badgeVariant: (text: string) => 'secondary' | 'destructive' | 'default' | 'outline' = (text: string) => {
    let variant: 'secondary' | 'destructive' | 'default' | 'outline' = 'secondary';
    switch (text) {
        case 'Approved':
            variant = 'default';
            break;
        case 'Cancelled':
            variant = 'destructive';
            break;
    }

    return variant;
};
const openUpdateDialog = (data: VetAppointment) => {
    dialogVisibility.value = true;
    selectedRow.value = data;
};

const submit = () => {
    form.patch(`/admin/vet-appointments/${selectedRow.value?.id}`, {
        onSuccess: () => {
            toast({
                duration: 1000,
                title: 'Success!!',
                description: `The appointment status has been updated`,
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
            dialogVisibility.value = false;
        },
    });
};
</script>
