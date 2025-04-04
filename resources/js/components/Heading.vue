<script setup lang="ts">
interface Props {
    title: string;
    description?: string;
    titleClass?: string;
    descriptionClass?: string;
}

defineProps<Props>();
</script>

<template>
    <div class="mb-8 space-y-0.5">
        <h2 :class="`${titleClass ?? ''} text-xl font-semibold tracking-tight`">{{ title }}</h2>
        <p v-if="description" :class="`${descriptionClass ?? ''} text-sm text-muted-foreground`">
            {{ description }}
        </p>
    </div>
</template>
