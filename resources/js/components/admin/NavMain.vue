<script setup lang="ts">
import { SidebarGroup, SidebarMenu } from '@/components/ui/sidebar';
import { type NavItem } from '@/types';
import RecursiveSidebarItem from './RecursiveSidebarItem.vue';

defineProps<{
    items: NavItem[];
    groupLabel?: string;
}>();
</script>

<template>
    <SidebarGroup class="px-2 py-0">
        <SidebarGroup v-if="groupLabel">{{ groupLabel }}</SidebarGroup>
        <SidebarMenu>
            <RecursiveSidebarItem :item="item" v-for="(item, key) in items" :key="key" />
        </SidebarMenu>
    </SidebarGroup>
</template>
