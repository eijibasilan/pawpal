<template>
    <UserLayout :breadcrumbs="breadcrumbs">
        <div class="m-3">
            <Heading :title="'Veterinary Services'" title-class="text-center" />
            <Button class="mb-4" @click.prevent="dialogVisibility = true"> Book an Appointment </Button>
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
            <DialogContent class="max-h-[90dvh] overflow-y-auto sm:max-w-[425px]" @close-dialog="() => (dialogVisibility = false)">
                <form @submit.prevent="submit">
                    <DialogHeader>
                        <DialogTitle>Book you appointment now!</DialogTitle>
                        <DialogDescription> </DialogDescription>
                    </DialogHeader>
                    <div class="grid grid-cols-1 gap-3">
                        <div class="grid gap-2">
                            <Label for="name">Name</Label>
                            <Input id="name" class="mt-1 block w-full" v-model="form.name" required autocomplete="name" placeholder="name" />
                            <InputError class="mt-2" :message="form.errors.name" />
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
    </UserLayout>
</template>

<script setup lang="ts">
import Heading from '@/components/Heading.vue';
import InputError from '@/components/InputError.vue';
import Button from '@/components/ui/button/Button.vue';
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';
import { Carousel, CarouselContent, CarouselItem, CarouselNext, CarouselPrevious } from '@/components/ui/carousel';
import { Dialog, DialogContent, DialogDescription, DialogFooter, DialogHeader, DialogTitle } from '@/components/ui/dialog';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import UserLayout from '@/layouts/user/UserLayout.vue';
import { BreadcrumbItem, VetService } from '@/types';
import { useForm, usePage } from '@inertiajs/vue3';
import Autoplay from 'embla-carousel-autoplay';
import { Loader2 } from 'lucide-vue-next';
import { ref } from 'vue';

const props = defineProps<{ vetServices: VetService[] }>();

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Vet Services',
        href: '/user/vet-services',
    },
];

const dialogVisibility = ref<boolean>(false);

const form = useForm<{ name: string; description?: string; images: File[]; _method?: string }>({
    name: '',
    description: '',
    images: [],
    _method: '',
});

const submit = () => {};
</script>
