<template>
    <UserLayout>
        <div class="m-3">
            <Heading :title="'Vet Appointments'" :description="'Your veterinary appointments.'" />

            <DataTable :columns="columns" :pagination="props.pagination" />
        </div>
    </UserLayout>
</template>

<script setup lang="ts">
import DataTable from '@/components/DataTable.vue';
import Heading from '@/components/Heading.vue';
import Badge from '@/components/ui/badge/Badge.vue';
import ViewImageDialog from '@/components/user/ViewImageDialog.vue';
import UserLayout from '@/layouts/user/UserLayout.vue';
import { PaginationResponse, Upload, VetAppointment, VetAppointmentSchedule } from '@/types';
import { ColumnDef } from '@tanstack/vue-table';
import { h, ref } from 'vue';

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
</script>
