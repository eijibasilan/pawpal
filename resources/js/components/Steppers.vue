<template>
    <Stepper
        v-model="stepperIndexModel"
        orientation="vertical"
        class="mx-auto flex w-full max-w-md flex-col justify-start gap-10 md:flex-row md:items-start md:justify-center"
    >
        <StepperItem
            v-for="step in steps"
            :key="step.step"
            v-slot="{ state }"
            class="relative flex w-full items-start gap-6 md:flex-col md:items-center md:justify-center md:gap-2"
            :step="step.step"
        >
            <StepperSeparator
                v-if="step.step !== steps[steps.length - 1].step"
                class="absolute left-[18px] top-[38px] block h-[105%] w-0.5 shrink-0 rounded-full bg-muted group-data-[state=completed]:bg-primary md:left-[calc(50%+20px)] md:right-[calc(-50%+10px)] md:top-5 md:h-0.5 md:w-full"
            />
            <StepperTrigger as-child>
                <Button
                    :variant="state === 'completed' || state === 'active' ? 'default' : 'outline'"
                    size="icon"
                    class="pointer-events-none z-10 shrink-0 rounded-full"
                    :class="[state === 'active' && 'ring-2 ring-ring ring-offset-2 ring-offset-background']"
                >
                    <Check v-if="state === 'completed'" class="size-5" />
                    <Circle v-if="state === 'active'" />
                    <Dot v-if="state === 'inactive'" />
                </Button>
            </StepperTrigger>

            <div class="flex flex-col gap-1 md:mt-5 md:items-center md:gap-0 md:text-center">
                <StepperTitle :class="[state === 'active' && 'text-primary']" class="text-sm font-semibold transition lg:text-base">
                    {{ step.title }}
                </StepperTitle>
                <StepperDescription
                    :class="[state === 'active' && 'text-primary']"
                    class="sr-only text-xs text-muted-foreground transition md:not-sr-only lg:text-sm"
                >
                    {{ step.description }}
                </StepperDescription>
            </div>
        </StepperItem>
        <slot />
    </Stepper>
</template>

<script setup lang="ts">
import Button from '@/components/ui/button/Button.vue';
import { Stepper, StepperDescription, StepperItem, StepperSeparator, StepperTitle, StepperTrigger } from '@/components/ui/stepper';
import { StepperItemData } from '@/types';
import { Check, Circle, Dot } from 'lucide-vue-next';
import { ref, watch } from 'vue';

const stepperIndexModel = ref<number>();

const props = defineProps<{ steps: StepperItemData[]; stepIndex: number }>();

watch(
    () => props.stepIndex,
    (val: number) => {
        stepperIndexModel.value = val;
    },
);
</script>
