<template>
    <UserLayout>
        <div class="m-3">
            <Heading :title="'Vet Appointments'" :description="'Your veterinary appointments.'" />

            <DataTable :columns="columns" :data="props.pagination.data" />
        </div>
    </UserLayout>
</template>

<script setup lang="ts">
import DataTable from '@/components/DataTable.vue';
import Heading from '@/components/Heading.vue';
import UserLayout from '@/layouts/user/UserLayout.vue';
import { PaginationResponse, VetAppointmentSchedule } from '@/types';
import { ColumnDef } from '@tanstack/vue-table';
import { h, ref } from 'vue';

const props = defineProps<{ pagination: PaginationResponse<VetAppointmentSchedule> }>();

const columns = ref<ColumnDef<VetAppointmentSchedule>[]>([
    {
        accessorKey: 'schedule',
        header: () => h('div', { class: 'text-center' }, 'Date'),
        cell: ({ row }) => {
            const schedule = row.getValue('schedule') as VetAppointmentSchedule;

            return h('div', { class: 'text-center' }, schedule.scheduled_date);
        },
    },
    {
        accessorKey: 'schedule',
        header: () => h('div', { class: 'text-center' }, 'Time'),
        cell: ({ row }) => {
            const schedule = row.getValue('schedule') as VetAppointmentSchedule;

            return h('div', { class: 'text-center' }, `${schedule.start_time}-${schedule.end_time}`);
        },
    },
    {
        accessorKey: 'schedule',
        header: () => h('div', { class: 'text-center' }, 'Service'),
        cell: ({ row }) => {
            const schedule = row.getValue('schedule') as VetAppointmentSchedule;

            return h('div', { class: 'text-center' }, schedule.service.name);
        },
    },
    {
        accessorKey: 'status',
        header: () => h('div', { class: 'text-center' }, 'Status'),
        cell: ({ row }) => h('div', { class: 'text-center' }, row.getValue('status')),
    },
    {
        accessorKey: 'created_at',
        header: () => h('div', { class: 'text-center' }, 'Booked at'),
        cell: ({ row }) => h('div', { class: 'text-center' }, row.getValue('created_at')),
    },
]);
</script>
