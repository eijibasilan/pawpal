<template>
    <UserLayout :breadcrumbs="breadcrumbs">
        <div class="m-3">
            <Heading :title="'Veterinary Services'" title-class="text-center" />
            <Button class="mb-4" @click.prevent="openDialog">
                <Loader2 v-if="dialogLoading" class="h-4 w-4 animate-spin" /> Book an Appointment
            </Button>
            <div class="grid grid-cols-1 gap-10 lg:grid-cols-2 lg:gap-7">
                <Card v-for="service in props.vetServices" :key="service.id">
                    <CardHeader>
                        <CardTitle>{{ service.name }}</CardTitle>
                    </CardHeader>

                    <CardContent>
                        <Carousel
                            class="mx-auto max-w-md"
                            v-if="service.uploads.length"
                            :plugins="[
                                Autoplay({
                                    delay: 2000,
                                }),
                            ]"
                        >
                            <CarouselContent>
                                <CarouselItem v-for="(image, index) in service.uploads" :key="index">
                                    <img :src="`${usePage().props.appUrl}${image.url}`" alt="" class="max-w-[80%]" />
                                </CarouselItem>
                            </CarouselContent>
                            <CarouselPrevious />
                            <CarouselNext />
                        </Carousel>
                        {{ service.description }}
                    </CardContent>
                </Card>
            </div>
        </div>
        <Dialog :open="dialogVisibility">
            <DialogContent class="max-h-[90dvh] overflow-y-auto sm:max-w-[635px]" @close-dialog="() => (dialogVisibility = false)">
                <DialogHeader>
                    <DialogTitle>Book you appointment now!</DialogTitle>
                    <DialogDescription>
                        <InputError class="mt-1" :message="error" v-for="(error, key) in form.errors" :key="key" />
                    </DialogDescription>
                </DialogHeader>

                <Steppers :steps="steps" :stepIndex="stepIndex" />
                <form
                    @submit.prevent="
                        (e) => {
                            e.preventDefault();

                            if (stepIndex === steps.length) {
                                submit();
                            }
                        }
                    "
                >
                    <div class="mt-4 grid grid-cols-1 gap-3" v-if="stepIndex === 1">
                        <div class="grid gap-2">
                            <Label for="vetService">Vet Service</Label>
                            <Select v-model="form.vet_service_id">
                                <SelectTrigger>
                                    <SelectValue placeholder="Select a service" />
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
                        </div>
                        <div class="grid gap-2" v-if="selectedVetService?.types.length">
                            <Label for="vetService">{{ selectedVetService.name.toUpperCase() }} TYPE</Label>
                            <Select v-model="form.vet_service_type_id">
                                <SelectTrigger>
                                    <SelectValue />
                                </SelectTrigger>
                                <SelectContent>
                                    <SelectGroup>
                                        <SelectLabel>{{ selectedVetService.name.toUpperCase() }} types</SelectLabel>
                                        <SelectItem :value="type.id" v-for="type in selectedVetService.types" :key="type.id">
                                            {{ type.name }}
                                        </SelectItem>
                                    </SelectGroup>
                                </SelectContent>
                            </Select>
                        </div>
                        <div class="grid gap-2" v-if="form.vet_service_id !== 0">
                            <Label for="scheduled_date">Date</Label>
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
                                    <Calendar
                                        :is-date-disabled="isDateUnavailable"
                                        v-model="form.scheduled_date"
                                        initial-focus
                                        :min-value="today(getLocalTimeZone())"
                                    />
                                </PopoverContent>
                            </Popover>
                        </div>
                        <div class="grid gap-2" v-if="timeSlots?.length">
                            <Label for="time">Time</Label>
                            <Select v-model="form.time">
                                <SelectTrigger>
                                    <SelectValue />
                                </SelectTrigger>
                                <SelectContent>
                                    <SelectGroup>
                                        <SelectLabel>Time Slots:</SelectLabel>
                                        <SelectItem :value="slot.start_time" v-for="slot in timeSlots" :key="slot.id">
                                            {{ slot.start_time }} - {{ slot.end_time }}
                                        </SelectItem>
                                    </SelectGroup>
                                </SelectContent>
                            </Select>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 gap-3" v-if="stepIndex === 2">
                        <div class="my-5 flex justify-center">
                            <img class="max-w-[150px]" src="../../../assets/sample_qr_code.png" alt="" />
                        </div>
                        <div class="grid gap-2">
                            <Label for="images">Upload the proof of your transaction</Label>
                            <Input
                                id="images"
                                type="file"
                                class="block w-full"
                                required
                                accept="image/png, image/jpeg"
                                @change="handleFileUpload"
                                autocomplete="Proof of transaction"
                                placeholder="Proof of transaction"
                            />
                            <InputError class="mt-2" :message="form.errors.image" />
                        </div>
                    </div>

                    <DialogFooter class="mt-5">
                        <div class="flex items-center gap-4">
                            <Button :disabled="stepIndex === 1" variant="outline" size="sm" @click="stepIndex -= 1"> Back </Button>
                            <div class="flex items-center gap-3">
                                <Button v-if="stepIndex !== steps.length" type="submit" size="sm" @click="stepIndex += 1"> Next </Button>
                                <Button v-if="stepIndex === steps.length" size="sm" type="submit" :disabled="formProcessing">
                                    <Loader2 v-if="formProcessing"></Loader2>
                                    Submit
                                </Button>
                            </div>
                        </div>
                    </DialogFooter>
                </form>
            </DialogContent>
        </Dialog>
    </UserLayout>
</template>

<script setup lang="ts">
import Heading from '@/components/Heading.vue';
import InputError from '@/components/InputError.vue';
import Steppers from '@/components/Steppers.vue';
import Button from '@/components/ui/button/Button.vue';
import { Calendar } from '@/components/ui/calendar';
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';
import { Carousel, CarouselContent, CarouselItem, CarouselNext, CarouselPrevious } from '@/components/ui/carousel';
import { Dialog, DialogContent, DialogDescription, DialogFooter, DialogHeader, DialogTitle } from '@/components/ui/dialog';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { Popover, PopoverContent, PopoverTrigger } from '@/components/ui/popover';
import { Select, SelectContent, SelectGroup, SelectItem, SelectLabel, SelectTrigger, SelectValue } from '@/components/ui/select';
import { useToast } from '@/components/ui/toast/use-toast';
import { useDateFormat } from '@/composables/useDateFormat';
import UserLayout from '@/layouts/user/UserLayout.vue';
import { BreadcrumbItem, StepperItemData, VetAppointmentSchedule, VetService } from '@/types';
import { router, useForm, usePage } from '@inertiajs/vue3';
import { DateFormatter, type DateValue, getLocalTimeZone, today } from '@internationalized/date';
import Autoplay from 'embla-carousel-autoplay';
import { CalendarIcon, Loader2 } from 'lucide-vue-next';
import { type CalendarRootProps } from 'reka-ui';
import { computed, ComputedRef, ref, watch } from 'vue';

const props = defineProps<{ vetServices: VetService[]; vetAppointmentSchedules?: VetAppointmentSchedule[] }>();

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Vet Services',
        href: '/user/vet-services',
    },
];

const { toast } = useToast();
const formProcessing = ref<boolean>(false);
const dialogVisibility = ref<boolean>(false);
const dialogLoading = ref<boolean>(false);

const stepIndex = ref<number>(1);
const steps = ref<StepperItemData[]>([
    {
        step: 1,
        title: 'Pick service and date time',
        description: 'Select your preferred service and check for available dates',
    },
    {
        step: 2,
        title: 'Proceed with the payment',
        description: 'Pay via the QR and upload the proof of transaction',
    },
]);

const selectedVetService: ComputedRef<VetService | undefined> = computed(() => {
    return props?.vetServices?.find((vetService) => vetService?.id == form.vet_service_id);
});

const timeSlots: ComputedRef<VetAppointmentSchedule[] | undefined> = computed(() => {
    return props?.vetAppointmentSchedules?.filter(
        (row) =>
            row?.service.id === selectedVetService.value?.id && row.scheduled_date === useDateFormat(form.scheduled_date.toDate(getLocalTimeZone())),
    );
});

const isDateUnavailable: CalendarRootProps['isDateDisabled'] = (date) => {
    const selectedVetServiceSchedules = props?.vetAppointmentSchedules?.filter((row) => row.service.id == selectedVetService.value?.id);

    const dates: { year: number; month: number; day: number }[] = [];

    if (selectedVetServiceSchedules)
        for (const row of selectedVetServiceSchedules) {
            const dateObject = new Date(row.scheduled_date + 'T00:00:00');

            const year = dateObject.getFullYear();
            const month = dateObject.getMonth() + 1;
            const day = dateObject.getDate();

            dates.push({ day: day, year: year, month: month });
        }

    return !dates.some((row) => row.year === date.year && row.month === date.month && row.day === date.day);
};

const form = useForm<{
    scheduled_date: DateValue;
    vet_service_id: number;
    time: string;
    vet_service_type_id?: number;
    image: File | null;
    [key: string]: any;
}>({
    scheduled_date: today(getLocalTimeZone()),
    time: '',
    vet_service_id: 0,
    vet_service_type_id: 0,
    image: null,
});

const handleFileUpload = (event: Event) => {
    const target = event.target as HTMLInputElement;
    const files: FileList | null = target.files;

    if (files) {
        form.image = files[0];
    }
};

const dateFormatter = new DateFormatter('en-US', {
    dateStyle: 'long',
});

const openDialog = () => {
    dialogLoading.value = true;

    router.reload({
        only: ['vetAppointmentSchedules'],
        onSuccess: () => {
            dialogLoading.value = false;
            dialogVisibility.value = true;
        },
    });
};

const submit = () => {
    const payload: any = { ...form };
    payload['scheduled_date'] = useDateFormat(form.scheduled_date.toDate(getLocalTimeZone()));

    if (!selectedVetService.value?.types.length) {
        delete payload['vet_service_type_id'];
    }

    formProcessing.value = true;

    router.post(`/user/vet-appointments`, payload, {
        onSuccess: () => {
            toast({
                duration: 1000,
                title: 'Success!!',
                description: `You have successfully booked your appointment`,
                variant: 'default',
            });
            dialogVisibility.value = false;
        },
        onError: (errors) => {
            form.errors = { ...errors };
            toast({
                duration: 1000,
                title: 'Uh oh! Something went wrong.',
                description: 'There was a problem with your request.',
                variant: 'destructive',
            });
        },
        onFinish: () => {
            form.reset('scheduled_date', 'vet_service_id', 'vet_service_type_id', 'time');
            formProcessing.value = false;
            stepIndex.value = 1;
        },
    });
};

watch(
    () => form.vet_service_id,
    (val) => {
        if (val) form.vet_service_type_id = undefined;
    },
    { deep: true },
);
</script>
