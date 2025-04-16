<template>
    <AdminLayout>
        <div class="m-3">
            <Heading :title="'Appointment Schedules'" :description="'Manage your schedules here.'" />

            <Button variant="ghost" size="icon" @click="openUpsertDialog('insert')">
                <Loader2 class="h-4 w-4 animate-spin" v-if="dialogLoading" />
                <Plus class="h-4 w-4" v-else />
            </Button>

            <DataTable :columns="columns" :data="props.pagination.data" />
        </div>

        <Dialog :open="dialogVisibility">
            <DialogContent class="sm:max-w-[425px]" @close-dialog="() => (dialogVisibility = false)">
                <form @submit.prevent="submit">
                    <DialogHeader>
                        <DialogTitle>{{ selectedAction.toUpperCase() }} SCHEDULE</DialogTitle>
                        <DialogDescription> </DialogDescription>
                    </DialogHeader>
                    <div class="grid grid-cols-1 gap-3">
                        <div class="grid gap-2">
                            <Popover>
                                <PopoverTrigger as-child>
                                    <Button
                                        variant="outline"
                                        :class="`justify-start text-left font-normal ${!form.scheduled_date && 'text-muted-foreground'}`"
                                    >
                                        <CalendarIcon class="mr-2 h-4 w-4" />
                                        {{
                                            form.scheduled_date ? dateFormatter.format(form.scheduled_date.toDate(getLocalTimeZone())) : 'Pick a date'
                                        }}
                                    </Button>
                                </PopoverTrigger>
                                <PopoverContent class="w-auto p-0">
                                    <Calendar v-model="form.scheduled_date" initial-focus :min-value="today(getLocalTimeZone())" />
                                </PopoverContent>
                            </Popover>
                        </div>

                        <div class="grid gap-2">
                            <Label for="unit">Doctors</Label>
                            <Select v-model="form.doctor_id">
                                <SelectTrigger>
                                    <SelectValue placeholder="Assign a doctor" />
                                </SelectTrigger>
                                <SelectContent>
                                    <SelectGroup>
                                        <SelectLabel>Doctor</SelectLabel>
                                        <SelectItem :value="doctor.id" v-for="doctor in props.doctors" :key="doctor.id">
                                            {{ doctor.name }}
                                        </SelectItem>
                                    </SelectGroup>
                                </SelectContent>
                            </Select>
                            <InputError class="mt-2" :message="form.errors.doctor_id" />
                        </div>

                        <div class="grid gap-2">
                            <Label for="unit">Vet Service</Label>
                            <Select v-model="form.vet_service_id">
                                <SelectTrigger>
                                    <SelectValue placeholder="Assign a doctor" />
                                </SelectTrigger>
                                <SelectContent>
                                    <SelectGroup>
                                        <SelectLabel>Vet Service</SelectLabel>
                                        <SelectItem :value="vetService.id" v-for="vetService in props.vetServices" :key="vetService.id">
                                            {{ vetService.name }}
                                        </SelectItem>
                                    </SelectGroup>
                                </SelectContent>
                            </Select>
                            <InputError class="mt-2" :message="form.errors.doctor_id" />
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
            :title="'Delete Schedule'"
            :loading-confirmed="form.processing"
            :description="'Are you sure you want to delete this schedule'"
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
import { Calendar } from '@/components/ui/calendar';
import { Dialog, DialogContent, DialogDescription, DialogFooter, DialogHeader, DialogTitle } from '@/components/ui/dialog';
import { Label } from '@/components/ui/label';
import { Popover, PopoverContent, PopoverTrigger } from '@/components/ui/popover';
import { Select, SelectContent, SelectGroup, SelectItem, SelectLabel, SelectTrigger, SelectValue } from '@/components/ui/select';
import { useToast } from '@/components/ui/toast/use-toast';
import WarningAlert from '@/components/WarningAlert.vue';
import { useDateFormat } from '@/composables/useDateFormat';
import AdminLayout from '@/layouts/admin/AdminLayout.vue';
import { Admin, PaginationResponse, UpsertAction, VetAppointmentSchedule, VetService } from '@/types';
import { router, useForm } from '@inertiajs/vue3';
import { DateFormatter, type DateValue, getLocalTimeZone, today } from '@internationalized/date';
import { ColumnDef } from '@tanstack/vue-table';
import { CalendarIcon, Loader2, Plus } from 'lucide-vue-next';

import { h, ref } from 'vue';

const dateFormatter = new DateFormatter('en-US', {
    dateStyle: 'long',
});

const { toast } = useToast();
const selectedAction = ref<UpsertAction>('insert');
const selectedRow = ref<VetAppointmentSchedule>();
const dialogLoading = ref<boolean>(false);
const warningAlertVisibility = ref<boolean>(false);

const props = defineProps<{ pagination: PaginationResponse<VetAppointmentSchedule>; vetServices?: VetService[]; doctors?: Admin[] }>();

const dialogVisibility = ref<boolean>(false);

const columns = ref<ColumnDef<VetAppointmentSchedule>[]>([
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
                onUpdate: () => openUpsertDialog('update', row.original as VetAppointmentSchedule),
                onDelete: () => {
                    selectedRow.value = row.original as VetAppointmentSchedule;
                    warningAlertVisibility.value = true;
                },
            }),
    },
]);

const form = useForm<{
    scheduled_date: DateValue;
    doctor_id: number;
    vet_service_id: number;
    [key: string]: any; // Add this index signature
}>({
    scheduled_date: today(getLocalTimeZone()),
    doctor_id: 0,
    vet_service_id: 0,
});

const openUpsertDialog = (action: UpsertAction, data?: VetAppointmentSchedule) => {
    if (data) selectedRow.value = data;

    form.scheduled_date = data?.scheduled_date ?? today(getLocalTimeZone());

    dialogLoading.value = true;
    selectedAction.value = action;
    router.reload({
        only: ['vetServices', 'doctors'],
        onSuccess: () => {
            dialogLoading.value = false;
            dialogVisibility.value = true;
        },
    });
};

const submit = () => {
    const payload: any = { ...form };
    payload['scheduled_date'] = useDateFormat(form.scheduled_date.toDate(getLocalTimeZone()));

    const method = selectedAction.value === 'insert' ? 'post' : 'patch';
    const routeParams = selectedAction.value === 'update' ? `/${selectedRow.value?.id}` : '';

    router[method](`/admin/vet-appointment-schedules${routeParams}`, payload, {
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
            form.reset('scheduled_date');
            dialogVisibility.value = false;
        },
    });
};

const deleteRow = () => {
    form.delete(`/admin/vet-appointment-schedules/${selectedRow.value?.id}`, {
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
