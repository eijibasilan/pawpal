<script setup lang="ts">
import UserLayout from '@/layouts/user/UserLayout.vue';
import { Button } from '@/components/ui/button';
import { ref } from 'vue';
import { useForm } from '@inertiajs/vue3';
import { Dialog, DialogContent, DialogHeader, DialogTitle } from '@/components/ui/dialog';
import { Calendar } from '@/components/ui/calendar';
import { format } from 'date-fns';

defineOptions({ layout: UserLayout });

const selectedPackage = ref('');

const packages = [
    {
        title: 'CAT ALL-IN-ONE GROOM',
        price: '900',
        services: [
            'BASIC TRIMMING',
            'CALMING BATH',
            'NAIL CLIPPING',
            'TEAR STAIN TREATMENT',
            'TEETH BRUSHING',
            'NAIL FILING'
        ]
    },
    {
        title: 'PREMIUM GROOM',
        price: '1,100',
        services: [
            'FULL GROOMING',
            'CALMING BATH',
            'NAIL CLIPPING',
            'TEAR STAIN TREATMENT',
            'TEETH BRUSHING',
            'NAIL FILING',
            'COZY DRYER BOX SESSION'
        ]
    },
    {
        title: 'VIP GROOM',
        price: '1,300',
        services: [
            'COMPLETE PACKAGE + STYLED GROOM',
            'CALMING BATH & MASSAGE',
            'NAIL CLIPPING',
            'TEAR STAIN TREATMENT',
            'PAW MOISTURIZING',
            'COZY DRYER BOX SESSION'
        ]
    }
];

const alaCarteServices = {
    title: 'ALA CARTE SERVICES',
    services: [
        { name: 'EAR CLEANING', prices: { small: '200', medium: '200', large: '250' } },
        { name: 'PAW MOISTURIZING', prices: { small: '200', medium: '200', large: '250' } },
        { name: 'NAIL CLIPPING', prices: { small: '200', medium: '200', large: '250' } }
    ]
};

// Remove these lines completely
// const bookGrooming = (packageName: string) => {
//     selectedPackage.value = packageName;
//     // Add booking logic here
// };

const showBookingForm = ref(false);
const selectedDate = ref<Date>();

const form = useForm({
    service: '',
    date: '',
    time: '',
    petName: '',
    petType: 'cat',
    notes: '',
});

const timeSlots = [
    '09:00 AM', '10:00 AM', '11:00 AM',
    '01:00 PM', '02:00 PM', '03:00 PM',
    '04:00 PM', '05:00 PM'
];

const bookGrooming = (packageName: string) => {
    form.service = packageName;
    showBookingForm.value = true;
};

const submitBooking = () => {
    form.date = selectedDate.value ? format(selectedDate.value, 'yyyy-MM-dd') : '';
    form.post('/user/book-grooming', {
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
        <h1 class="mb-8 text-3xl font-bold text-center">Cat Grooming Services</h1>

        <!-- Package Cards -->
        <div class="grid gap-6 md:grid-cols-3 mb-12">
            <div v-for="pkg in packages" :key="pkg.title" 
                 class="rounded-lg border bg-[#1e3851] text-white p-6 shadow-lg">
                <h2 class="text-xl font-bold mb-4">{{ pkg.title }}</h2>
                <ul class="mb-6 space-y-2">
                    <li v-for="service in pkg.services" :key="service" 
                        class="flex items-center">
                        <span class="mr-2">•</span>
                        {{ service }}
                    </li>
                </ul>
                <div class="text-2xl font-bold mb-4">₱{{ pkg.price }}</div>
                <Button 
                    @click="bookGrooming(pkg.title)"
                    class="w-full bg-[#00bfa5] hover:bg-[#00a693]"
                >
                    Book Now
                </Button>
            </div>
        </div>

        <!-- Ala Carte Services -->
        <div class="rounded-lg border bg-[#1e3851] text-white p-6 shadow-lg">
            <h2 class="text-xl font-bold mb-4">{{ alaCarteServices.title }}</h2>
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="border-b">
                            <th class="text-left py-2">Service</th>
                            <th class="text-center py-2">SMALL/MEDIUM</th>
                            <th class="text-center py-2">LARGE</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="service in alaCarteServices.services" 
                            :key="service.name" 
                            class="border-b last:border-0">
                            <td class="py-3">{{ service.name }}</td>
                            <td class="text-center">₱{{ service.prices.small }}</td>
                            <td class="text-center">₱{{ service.prices.large }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Add this at the end of your template -->
    <Dialog :open="showBookingForm" @update:open="showBookingForm = false">
        <DialogContent class="sm:max-w-[425px] max-h-[90vh] overflow-y-auto">
            <DialogHeader class="sticky top-0 bg-white z-10 pb-4">
                <DialogTitle>Book Grooming Service</DialogTitle>
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
.container {
    max-width: 1200px;
}

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