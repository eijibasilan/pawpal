<script setup lang="ts">
import UserLayout from '@/layouts/user/UserLayout.vue';
import { Button } from '@/components/ui/button';
import { Link } from '@inertiajs/vue3';

defineOptions({ layout: UserLayout });
</script>

<template>
    <div class="container mx-auto px-4 py-8">
        <h1 class="mb-8 text-3xl font-bold text-center">Pet Hotel Services</h1>

        <div class="mb-12 grid gap-6 md:grid-cols-2">
            <div class="flex flex-col items-center">
                <div class="relative cursor-pointer rounded-lg border-2 p-6 transition-all mb-4">
                    <div class="aspect-square overflow-hidden rounded-lg">
                        <img src="/images/hotel/dog-hotel.jpg" alt="Dog Hotel" class="h-full w-full object-cover" />
                    </div>
                </div>
                <Link 
                    href="/user/dog-hotel"
                    class="w-3/4"
                >
                    <Button 
                        class="w-full text-lg py-3"
                        variant="default"
                    >
                        Dog Hotel
                    </Button>
                </Link>
            </div>

            <div class="flex flex-col items-center">
                <div class="relative cursor-pointer rounded-lg border-2 p-6 transition-all mb-4">
                    <div class="aspect-square overflow-hidden rounded-lg">
                        <img src="/images/hotel/cat-hotel.jpg" alt="Cat Hotel" class="h-full w-full object-cover" />
                    </div>
                </div>
                <Link 
                    href="/user/cat-hotel"
                    class="w-3/4"
                >
                    <Button 
                        class="w-full text-lg py-3"
                        variant="default"
                    >
                        Cat Hotel
                    </Button>
                </Link>
            </div>
        </div>
    </div>
</template>