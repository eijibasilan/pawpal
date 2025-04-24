<template>
    <UserLayout>
        <div class="m-3">
            <Heading :title="'Our Products'" title-class="text-center" />
            <div class="grid grid-cols-1 gap-10 lg:grid-cols-2 lg:gap-7">
                <Card v-for="product in props.products" :key="product.id">
                    <CardHeader>
                        <CardTitle>{{ product.name }}</CardTitle>
                    </CardHeader>

                    <CardContent>
                        <Carousel
                            class="mx-auto max-w-md"
                            v-if="product.uploads.length"
                            :plugins="[
                                Autoplay({
                                    delay: 2000,
                                }),
                            ]"
                        >
                            <CarouselContent>
                                <CarouselItem v-for="(image, index) in product.uploads" :key="index">
                                    <img :src="`${usePage().props.appUrl}${image.url}`" alt="" class="max-w-[80%]" />
                                </CarouselItem>
                            </CarouselContent>
                            <CarouselPrevious />
                            <CarouselNext />
                        </Carousel>
                        {{ product.description }}
                    </CardContent>
                    <CardFooter class="flex justify-between px-6 pb-6"> ₱ {{ product.price }} </CardFooter>
                </Card>
            </div>
        </div>
    </UserLayout>
</template>

<script setup lang="ts">
import Heading from '@/components/Heading.vue';
import { Card, CardContent, CardFooter, CardHeader, CardTitle } from '@/components/ui/card';
import { Carousel, CarouselContent, CarouselItem, CarouselNext, CarouselPrevious } from '@/components/ui/carousel';
import UserLayout from '@/layouts/user/UserLayout.vue';
import { Product } from '@/types';
import { usePage } from '@inertiajs/vue3';
import Autoplay from 'embla-carousel-autoplay';

const props = defineProps<{ products: Product[] }>();
</script>
