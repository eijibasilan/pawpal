<template>
    <UserLayout>
        <div class="m-3">
            <Heading :title="'Notifications'" />

            <!--<DataTable :columns="columns" :pagination="props.pagination" />-->

            <Card v-for="(notification, key) in props.notifications" :key="key">
                <CardHeader>
                    <CardTitle>{{ notification.type }}</CardTitle>
                </CardHeader>

                <CardContent>
                    <div>Message: {{ notification.data?.message }}</div>
                </CardContent>
                <CardFooter class="flex justify-between px-6 pb-6"> Date: {{ formattedDate(notification.created_at) }} </CardFooter>
            </Card>
        </div>
    </UserLayout>
</template>

<script setup lang="ts">
//import DataTable from '@/components/DataTable.vue';
import Heading from '@/components/Heading.vue';
import { Card, CardContent, CardFooter, CardHeader, CardTitle } from '@/components/ui/card';
import UserLayout from '@/layouts/user/UserLayout.vue';
import { Notification } from '@/types';
import { format } from 'date-fns';

const props = defineProps<{ notifications: Notification[] }>();

const formattedDate = (data: string) => {
    const date = new Date(data);
    return format(date, 'MMMM dd, yyyy'); // Using date-fns
    // Or using Intl.DateTimeFormat (see option 2 below)
};

//const columns = ref<ColumnDef<Notification>[]>([
//    {
//        accessorKey: 'data',
//        header: () => h('div', { class: 'text-center' }, 'Message'),
//        cell: ({ row }) => h('div', { class: 'text-center' }, row.getValue('data')),
//    },
//]);
</script>
