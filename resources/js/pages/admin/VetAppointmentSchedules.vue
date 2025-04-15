<template>
    <div>
        appointment schedules

        <pre>
			{{ props?.doctors }}
		</pre
        >
    </div>
</template>

<script setup lang="ts">
import { Admin, PaginationResponse, VetAppointmentSchedule } from '@/types';

const props = defineProps<{ pagination: PaginationResponse<VetAppointmentSchedule>; doctors?: Admin[] }>();
</script>
