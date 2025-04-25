<template>
    <AdminLayout>
        <div class="m-3">
            <Heading :title="'Vet Appointments'" :description="'Your veterinary appointments.'" />

            <DataTable :columns="columns" :pagination="props.pagination" />
        </div>
        <Dialog :open="dialogVisibility" class="overflow-y-auto">
            <DialogContent class="max-h-[90dvh] overflow-y-auto sm:max-w-[425px]" @close-dialog="() => (dialogVisibility = false)">
                <form @submit.prevent="submit">
                    <DialogHeader>
                        <DialogTitle>Inventory Stocks</DialogTitle>
                        <DialogDescription> </DialogDescription>
                    </DialogHeader>
                    <div class="mt-2 grid grid-cols-1 gap-3">
                        <div v-if="selectedRow?.details">
                            <div class="my-2 text-xl font-bold">Appointment details:</div>
                            <div v-for="(value, key) in JSON.parse(selectedRow.details)" :key="value" class="flex">
                                <div class="mr-2 uppercase">{{ key }}:</div>
                                <div>{{ value }}</div>
                            </div>
                        </div>
                        <div class="grid gap-2">
                            <Label for="quantity">Desired Quantity</Label>
                            <Input
                                type="number"
                                id="name"
                                class="mt-1 block w-full"
                                v-model="form.quantity"
                                required
                                autocomplete="quantity"
                                placeholder="quantity"
                            />
                            <InputError class="mt-2" :message="form.errors.quantity" />
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
            :title="'Approve Appointment'"
            :loading-confirmed="approveProcessing"
            :description="'Are you sure you want to approve this appointment'"
            @cancelled="warningAlertVisibility = false"
            @confirmed="approveStatus()"
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
import ViewImageDialog from '@/components/user/ViewImageDialog.vue';
import WarningAlert from '@/components/WarningAlert.vue';
import AdminLayout from '@/layouts/admin/AdminLayout.vue';
import { PaginationResponse, Upload, User, VetAppointment, VetAppointmentSchedule } from '@/types';
import { router, useForm, usePage } from '@inertiajs/vue3';
import { Loader2 } from 'lucide-vue-next';

import Badge from '@/components/ui/badge/Badge.vue';
import { ColumnDef } from '@tanstack/vue-table';
import { h, ref } from 'vue';

const { toast } = useToast();

const approveProcessing = ref<boolean>(false);
const warningAlertVisibility = ref<boolean>(false);
const dialogVisibility = ref<boolean>(false);
const selectedRow = ref<VetAppointment>();
const roles = ref<string[]>(usePage().props.auth.adminRoles);

const form = useForm({
    quantity: 0,
});

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
                onUpdate: () => {
                    selectedRow.value = row.original as VetAppointment;

                    if (roles.value.includes('Business Admin') || roles.value.includes('Admin')) {
                        dialogVisibility.value = true;
                    } else {
                        warningAlertVisibility.value = true;
                    }
                },
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

const approveStatus = () => {
    approveProcessing.value = true;
    router.patch(
        `/admin/vet-appointments/approve/${selectedRow.value?.id}`,
        {},
        {
            onSuccess: () => {
                warningAlertVisibility.value = false;
                toast({
                    duration: 1000,
                    title: 'Success!!',
                    description: `The appointment status has been approve`,
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
        },
    );
};

const submit = () => {
    form.patch(`/admin/vet-appointments/${selectedRow.value?.id}`, {
        onSuccess: () => {
            dialogVisibility.value = false;
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
    });
};
</script>
