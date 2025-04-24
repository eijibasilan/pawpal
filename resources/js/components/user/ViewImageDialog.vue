<template>
    <Dialog>
        <DialogTrigger as-child>
            <Button variant="ghost" size="icon">
                <Eye class="h-4 w-4" />
            </Button>
        </DialogTrigger>
        <DialogContent class="sm:max-w-md">
            <DialogHeader>
                <DialogTitle>{{ title ?? 'View' }}</DialogTitle>
                <DialogDescription>{{ description }} </DialogDescription>
            </DialogHeader>
            <div class="flex items-center space-x-2">
                <img :src="`${usePage().props.appUrl}${upload.url}`" alt="" />
            </div>
        </DialogContent>
    </Dialog>
</template>

<script setup lang="ts">
import { Button } from '@/components/ui/button';
import { Dialog, DialogContent, DialogDescription, DialogHeader, DialogTitle, DialogTrigger } from '@/components/ui/dialog';
import { Upload } from '@/types';
import { usePage } from '@inertiajs/vue3';
import { Eye } from 'lucide-vue-next';

defineProps<{ upload: Upload; title?: string; description?: string }>();
</script>
