<script setup lang="ts">
import UserLayout from '@/layouts/user/UserLayout.vue';
import { Button } from '@/components/ui/button';
import { ref } from 'vue';
import { useForm } from '@inertiajs/vue3';
import { Dialog, DialogContent, DialogHeader, DialogTitle } from '@/components/ui/dialog';
import { Calendar } from '@/components/ui/calendar';
import { format } from 'date-fns';

defineOptions({ layout: UserLayout });

const daycarePackages = [
    {
        title: 'STANDARD STAY (4-8 HOURS)',
        description: 'STANDARD STAY, DAILY MONITORING',
        price: '180'
    },
    {
        title: 'HALF-DAY STAY (5-6 HOURS)',
        description: 'STANDARD STAY, DAILY MONITORING MEAL',
        price: '250'
    },
    {
        title: 'FULL-DAY STAY (7-8 HOURS)',
        description: 'HALF DAY + MEAL, WALKS',
        price: '350'
    },
    {
        title: 'VIP DAYCARE (10 HOURS + GROOMING)',
        description: 'FULL DAY, MEAL, GROOMING & DOG WALK',
        price: '1000'
    }
];

const stayPackages = [
    {
        title: 'PREMIUM STAY',
        description: 'COZY KENNEL STAY, FRESH WATER, 2 MEALS, PLAYTIME',
        prices: {
            small: '500',
            large: '650'
        }
    },
    {
        title: 'VIP STAY',
        description: 'STANDARD STAY, LARGER KENNEL, SOFT BED, MEAL UPGRADE, DAILY WALKS',
        prices: {
            small: '900',
            large: '1100'
        }
    }
];

const showBookingForm = ref(false);
const selectedDate = ref<Date>();

const form = useForm({
    service: '',
    date: '',
    time: '',
    petName: '',
    petType: 'dog',
    notes: '',
});

const timeSlots = [
    '09:00 AM', '10:00 AM', '11:00 AM',
    '01:00 PM', '02:00 PM', '03:00 PM',
    '04:00 PM', '05:00 PM'
];

const bookHotel = (packageName: string) => {
    form.service = packageName;
    showBookingForm.value = true;
};

const submitBooking = () => {
    form.date = selectedDate.value ? format(selectedDate.value, 'yyyy-MM-dd') : '';
    form.post('/user/book-hotel', {
        onSuccess: () => {
            showBookingForm.value = false;
            form.reset();
            selectedDate.value = undefined;
        },
    });
};
</script>

<template>
    <div class="container mx-auto px-4 py-8">
        <h1 class="mb-8 text-3xl font-bold text-center">Dog Hotel Services</h1>

        <!-- Daycare Packages -->
        <div class="rounded-lg border bg-[#1e3851] text-white p-6 shadow-lg mb-8">
            <h2 class="text-2xl font-bold mb-6">DAYCARE PACKAGE</h2>
            <div class="space-y-4">
                <div v-for="pkg in daycarePackages" :key="pkg.title"
                     class="flex items-center justify-between border-b border-white/20 pb-4">
                    <div>
                        <h3 class="font-bold">{{ pkg.title }}</h3>
                        <p class="text-sm text-gray-300">{{ pkg.description }}</p>
                    </div>
                    <div class="text-right">
                        <p class="text-xl font-bold">₱{{ pkg.price }}</p>
                        <Button 
                            @click="bookHotel(pkg.title)"
                            class="mt-2 bg-[#00bfa5] hover:bg-[#00a693]"
                        >
                            Book Now
                        </Button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Stay Packages -->
        <div class="rounded-lg border bg-[#1e3851] text-white p-6 shadow-lg">
            <div v-for="pkg in stayPackages" :key="pkg.title" class="mb-8 last:mb-0">
                <h2 class="text-xl font-bold mb-4">{{ pkg.title }}</h2>
                <p class="mb-4 text-gray-300">{{ pkg.description }}</p>
                <div class="grid grid-cols-2 gap-4">
                    <div class="text-center p-4 border border-white/20 rounded-lg">
                        <h3 class="font-semibold mb-2">SMALL</h3>
                        <p class="text-2xl font-bold mb-2">₱{{ pkg.prices.small }}</p>
                        <p class="text-sm text-gray-300">per night</p>
                        <Button 
                            @click="bookHotel(`${pkg.title} - Small`)"
                            class="mt-4 w-full bg-[#00bfa5] hover:bg-[#00a693]"
                        >
                            Book Now
                        </Button>
                    </div>
                    <div class="text-center p-4 border border-white/20 rounded-lg">
                        <h3 class="font-semibold mb-2">LARGE</h3>
                        <p class="text-2xl font-bold mb-2">₱{{ pkg.prices.large }}</p>
                        <p class="text-sm text-gray-300">per night</p>
                        <Button 
                            @click="bookHotel(`${pkg.title} - Large`)"
                            class="mt-4 w-full bg-[#00bfa5] hover:bg-[#00a693]"
                        >
                            Book Now
                        </Button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Add this booking dialog -->
    <Dialog :open="showBookingForm" @update:open="showBookingForm = false">
        <DialogContent class="sm:max-w-[425px] max-h-[90vh] overflow-y-auto">
            <DialogHeader class="sticky top-0 bg-white z-10 pb-4">
                <DialogTitle>Book Hotel Stay</DialogTitle>
            </DialogHeader>
            <form @submit.prevent="submitBooking" class="space-y-4">
                <div>
                    <label class="block text-sm font-medium mb-1">Selected Service</label>
                    <input type="text" v-model="form.service" disabled class="w-full p-2 rounded bg-gray-100" />
                </div>

                <div>
                    <label class="block text-sm font-medium mb-1">Pet Name</label>
                    <input type="text" v-model="form.petName" class="w-full p-2 rounded border" required />
                </div>

                <div>
                    <label class="block text-sm font-medium mb-1">Date</label>
                    <Calendar
                        v-model="selectedDate"
                        :disabled-dates="{ before: new Date() }"
                        class="rounded border p-2"
                    />
                </div>

                <div>
                    <label class="block text-sm font-medium mb-1">Time</label>
                    <select v-model="form.time" class="w-full p-2 rounded border" required>
                        <option value="">Select time</option>
                        <option v-for="time in timeSlots" :key="time" :value="time">
                            {{ time }}
                        </option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium mb-1">Notes</label>
                    <textarea
                        v-model="form.notes"
                        rows="3"
                        class="w-full p-2 rounded border"
                        placeholder="Any special requirements?"
                    ></textarea>
                </div>

                <div class="flex justify-end gap-3">
                    <Button type="button" variant="outline" @click="showBookingForm = false">
                        Cancel
                    </Button>
                    <Button type="submit" :disabled="form.processing">
                        Book Now
                    </Button>
                </div>
            </form>
        </DialogContent>
    </Dialog>
</template>
<style scoped>
:deep(.dialog-content) {
    max-height: 90vh !important;
    overflow-y: auto !important;
}

:deep(.dialog-header) {
    position: sticky;
    top: 0;
    background: white;
    z-index: 10;
    padding-bottom: 1rem;
}
</style>
