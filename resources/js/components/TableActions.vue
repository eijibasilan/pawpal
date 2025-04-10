<template>
    <div class="flex justify-center">
        <component
            v-for="(button, key) in buttons"
            v-on="button?.events ?? {}"
            :="button?.attributes"
            :class="button.class"
            :key="key"
            :is="button.component"
        />
    </div>
</template>

<script setup lang="ts">
import { Pencil, Trash } from 'lucide-vue-next';
import { ref } from 'vue';

const emits = defineEmits(['update', 'delete']);

interface ActionButtons {
    name: string;
    component: any;
    class?: string;
    attributes?: { [key: string]: any };
    events?: Record<string, (...args: any[]) => void>;
}

const buttons = ref<ActionButtons[]>([
    {
        name: 'Edit',
        class: 'cursor-pointer ml-2',
        component: Pencil,
        events: {
            click: () => {
                emits('update');
            },
        },
    },
    {
        name: 'Delete',
        component: Trash,
        class: 'cursor-pointer ml-2',
        events: {
            click: () => {
                emits('delete');
            },
        },
    },
]);
</script>
