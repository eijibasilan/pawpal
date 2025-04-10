<template>
    <AlertDialog :open="visibility">
        <AlertDialogContent>
            <AlertDialogHeader>
                <AlertDialogTitle>{{ props.title }}</AlertDialogTitle>
                <AlertDialogDescription>
                    {{ props.description }}
                </AlertDialogDescription>
            </AlertDialogHeader>
            <AlertDialogFooter>
                <AlertDialogCancel @click="$emit('cancelled')">Cancel</AlertDialogCancel>
                <AlertDialogAction :disabled="loadingConfirmed" @click="$emit('confirmed')">
                    <Loader class="h-4 w-4 animate-spin" v-if="loadingConfirmed" />
                    Confirm
                </AlertDialogAction>
            </AlertDialogFooter>
        </AlertDialogContent>
    </AlertDialog>
</template>

<script setup lang="ts">
import {
    AlertDialog,
    AlertDialogAction,
    AlertDialogCancel,
    AlertDialogContent,
    AlertDialogDescription,
    AlertDialogFooter,
    AlertDialogHeader,
    AlertDialogTitle,
} from '@/components/ui/alert-dialog';
import { Loader } from 'lucide-vue-next';

const props = defineProps<{ visibility: boolean; title: string; description?: string; loadingConfirmed?: boolean }>();
defineEmits(['confirmed', 'cancelled']);
</script>
