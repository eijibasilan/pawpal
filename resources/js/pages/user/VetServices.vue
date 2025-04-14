<template>
    <div class="m-3">
        <Heading :title="'Veterinary Services'" title-class="text-center" />

        <div class="grid grid-cols-1 gap-10 lg:grid-cols-2 lg:gap-7">
            <Card v-for="service in props.vetServices" :key="service.id">
                <CardHeader>
                    <CardTitle>{{ service.name }}</CardTitle>
                </CardHeader>

                <CardFooter>
                    <Button> Book an Appointment </Button>
                </CardFooter>
            </Card>
        </div>
    </div>
</template>

<script setup lang="ts">
import Heading from '@/components/Heading.vue';
import Button from '@/components/ui/button/Button.vue';
import { Card, CardFooter, CardHeader, CardTitle } from '@/components/ui/card';
import UserLayout from '@/layouts/user/UserLayout.vue';
import { BreadcrumbItem, LayoutOptions, VetService } from '@/types';
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
