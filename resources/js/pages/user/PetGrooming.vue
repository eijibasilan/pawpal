<script setup lang="ts">
import UserLayout from '@/layouts/user/UserLayout.vue';
import { ref } from 'vue';
import { Button } from '@/components/ui/button';
import { Link } from '@inertiajs/vue3';

defineOptions({ layout: UserLayout });

const selectedPetType = ref('');
const petImage = ref(null);
const petName = ref('');

const handleImageUpload = (event: any) => {
    const file = event.target.files[0];
    if (file) {
        petImage.value = URL.createObjectURL(file);
    }
};

const bookGrooming = () => {
    // Handle booking logic here
    console.log('Booking for:', petName.value, 'Type:', selectedPetType.value);
};
</script>

<template>
    <div class="container mx-auto px-4 py-8">
        <h1 class="mb-8 text-3xl font-bold text-center">Pet Grooming Services</h1>

        <div class="mb-12 grid gap-6 md:grid-cols-2">
            <div class="flex flex-col items-center">
                <div class="relative cursor-pointer rounded-lg border-2 p-6 transition-all mb-4">
                    <div class="aspect-square overflow-hidden rounded-lg">
                        <img src="/images/grooming/dog-grooming.jpg" alt="Dog Grooming" class="h-full w-full object-cover" />
                    </div>
                </div>
                <Link 
                    href="/user/dog-grooming"
                    class="w-3/4"
                >
                    <Button 
                        class="w-full text-lg py-3"
                        variant="default"
                    >
                        Dog Grooming
                    </Button>
                </Link>
            </div>

            <div class="flex flex-col items-center">
                <div class="relative cursor-pointer rounded-lg border-2 p-6 transition-all mb-4">
                    <div class="aspect-square overflow-hidden rounded-lg">
                        <img src="/images/grooming/cat-grooming.jpg" alt="Cat Grooming" class="h-full w-full object-cover" />
                    </div>
                </div>
                <Link 
                    href="/user/cat-grooming"
                    class="w-3/4"
                >
                    <Button 
                        class="w-full text-lg py-3"
                        variant="default"
                    >
                        Cat Grooming
                    </Button>
                </Link>
            </div>
        </div>

        <!-- Services Section (shown after pet type selection) -->
        <div v-if="selectedPetType" class="space-y-8">
            <div class="rounded-lg border bg-card p-6">
                <h3 class="mb-4 text-xl font-semibold">Book a Grooming Session</h3>
                
                <div class="space-y-4">
                    <div>
                        <label class="mb-2 block text-sm font-medium">Pet's Name</label>
                        <input 
                            v-model="petName"
                            type="text"
                            class="w-full rounded-md border p-2"
                            placeholder="Enter your pet's name"
                        />
                    </div>

                    <div>
                        <label class="mb-2 block text-sm font-medium">Upload Pet Photo</label>
                        <div class="mt-2 flex items-center gap-4">
                            <input
                                type="file"
                                accept="image/*"
                                @change="handleImageUpload"
                                class="hidden"
                                id="pet-photo"
                            />
                            <label
                                for="pet-photo"
                                class="cursor-pointer rounded-md border border-dashed border-gray-300 p-4 hover:border-primary"
                            >
                                <div v-if="!petImage" class="text-center">
                                    <span class="text-sm text-gray-500">Click to upload photo</span>
                                </div>
                                <img v-else :src="petImage" class="h-32 w-32 object-cover" />
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Service Options -->
            <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                <div v-for="(service, index) in selectedPetType === 'dog' ? dogServices : catServices" 
                     :key="index"
                     class="rounded-lg border bg-card p-6 shadow-sm">
                    <div class="mb-4 text-4xl">{{ service.icon }}</div>
                    <h3 class="mb-2 text-xl font-semibold">{{ service.name }}</h3>
                    <p class="mb-4 text-muted-foreground">{{ service.description }}</p>
                    <p class="mb-4 text-2xl font-bold">₱{{ service.price }}</p>
                    <Button @click="bookGrooming" class="w-full">Book Now</Button>
                </div>
            </div>
        </div>
    </div>
</template>

<script lang="ts">
const dogServices = [
    {
        icon: '✂️',
        name: 'Basic Dog Grooming',
        description: 'Bath, brush, and basic trim for your dog',
        price: '600'
    },
    {
        icon: '🛁',
        name: 'Premium Dog Spa',
        description: 'Luxury bath, massage, and premium grooming',
        price: '900'
    },
    {
        icon: '💅',
        name: 'Nail & Teeth Care',
        description: 'Nail trimming and dental cleaning',
        price: '300'
    }
];

const catServices = [
    {
        icon: '✂️',
        name: 'Basic Cat Grooming',
        description: 'Bath, brush, and nail trim for your cat',
        price: '500'
    },
    {
        icon: '🛁',
        name: 'Premium Cat Spa',
        description: 'Luxury treatment with specialized cat products',
        price: '800'
    },
    {
        icon: '💅',
        name: 'Nail & Fur Care',
        description: 'Nail trimming and fur detangling',
        price: '250'
    }
];
</script>
