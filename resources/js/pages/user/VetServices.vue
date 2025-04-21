<template>
    <div class="m-3">
        <Heading :title="'Veterinary Services'" title-class="text-center" />
        <Button class="mb-4"> Book an Appointment </Button>
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
</template>

<script setup lang="ts">
import Heading from '@/components/Heading.vue';
import Button from '@/components/ui/button/Button.vue';
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';
import { Carousel, CarouselContent, CarouselItem, CarouselNext, CarouselPrevious } from '@/components/ui/carousel';
import UserLayout from '@/layouts/user/UserLayout.vue';
import { BreadcrumbItem, LayoutOptions, VetService } from '@/types';
import { usePage } from '@inertiajs/vue3';
import Autoplay from 'embla-carousel-autoplay';
import { h } from 'vue';

const props = defineProps<{ vetServices: VetService[] }>();

defineOptions({
    layout: h(UserLayout, {
        breadcrumbs: [
            {
                title: 'Vet Services',
                href: '/user/vet-services',
            },
        ] as BreadcrumbItem[],
    }),
} as LayoutOptions);
</script>
