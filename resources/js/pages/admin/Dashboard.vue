<template>
    <AdminLayout>
        <div class="m-3">
            <Heading :title="'Sales'" />

            <div class="w-full">
                <canvas id="sales" class="max-w-[90%]"></canvas>
            </div>
        </div>
    </AdminLayout>
</template>

<script setup lang="ts">
import Heading from '@/components/Heading.vue';
import AdminLayout from '@/layouts/admin/AdminLayout.vue';
import Chart from 'chart.js/auto';
import { onMounted } from 'vue';

onMounted(() => {
    const data = [
        { services: 'Vaccination', count: 10 },
        { services: 'Medication', count: 20 },
        { services: 'Deworming', count: 15 },
        { services: 'Spray & Neuter', count: 25 },
    ];

    new Chart(document.getElementById('sales'), {
        type: 'bar',
        data: {
            labels: data.map((row) => row.services),
            datasets: [
                {
                    label: 'Sales',
                    data: data.map((row) => row.count),
                },
            ],
        },
    });
});
</script>
