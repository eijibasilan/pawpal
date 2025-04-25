<template>
    <AdminLayout>
        <div class="m-3">
            <Heading :title="'Vet Appointments'" :description="'Your veterinary appointments.'" />

            <div class="max-w-[50%]">
                <Select v-model="status">
                    <SelectTrigger>
                        <SelectValue placeholder="Select a vet service" />
                    </SelectTrigger>
                    <SelectContent>
                        <SelectGroup>
                            <SelectLabel>Filter by Status</SelectLabel>
                            <SelectItem :value="status" v-for="(status, key) in statuses" :key="key">
                                {{ status }}
                            </SelectItem>
                        </SelectGroup>
                    </SelectContent>
                </Select>
            </div>
            <DataTable :columns="columns" :pagination="props.pagination" :additional-params="{ status: status }" />
        </div>
    </AdminLayout>
</template>

<script setup lang="ts">
import DataTable from '@/components/DataTable.vue';
import Heading from '@/components/Heading.vue';
import Badge from '@/components/ui/badge/Badge.vue';
import { Select, SelectContent, SelectGroup, SelectItem, SelectLabel, SelectTrigger, SelectValue } from '@/components/ui/select';
import ViewImageDialog from '@/components/user/ViewImageDialog.vue';
import AdminLayout from '@/layouts/admin/AdminLayout.vue';
import { PaginationResponse, Upload, User, VetAppointment, VetAppointmentSchedule } from '@/types';
import { router } from '@inertiajs/vue3';
import { ColumnDef } from '@tanstack/vue-table';
import { h, ref, watch } from 'vue';

const props = defineProps<{ pagination: PaginationResponse<VetAppointment> }>();

const statuses = ref<string[]>(['Pending', 'For Approval', 'Approved', 'Cancelled']);
const status = ref<string>('');

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

const reloadTable = () => {
    router.get('/admin/vet-appointments', {
        status: status.value,
    });
};

watch(
    () => status.value,
    (val) => {
        if (val) reloadTable();
    },
);
</script>
