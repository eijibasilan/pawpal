<template>
    <Collapsible class="group/collapsible" v-if="item.items?.length">
        <SidebarMenuItem>
            <CollapsibleTrigger asChild>
                <SidebarMenuButton :tooltip="item.title">
                    <component :is="item.icon" />
                    <span>{{ item.title }}</span>
                </SidebarMenuButton>
            </CollapsibleTrigger>
            <CollapsibleContent class="ml-4 space-y-1">
                <SidebarMenuSub>
                    <RecursiveSidebarItem :item="item" v-for="(item, key) in item?.items" :key="key" />
                </SidebarMenuSub>
            </CollapsibleContent>
        </SidebarMenuItem>
    </Collapsible>
    <SidebarMenuItem :class="item.isHidden ? 'hidden' : ''" v-else>
        <SidebarMenuButton as-child :is-active="item.href === page.url" :tooltip="item.title">
            <Link :href="item.href">
                <component :is="item.icon" />
                <span>{{ item.title }}</span>
            </Link>
        </SidebarMenuButton>
    </SidebarMenuItem>
</template>

<script setup lang="ts">
import { Link, usePage } from '@inertiajs/vue3';
import Collapsible from '../ui/collapsible/Collapsible.vue';
import CollapsibleContent from '../ui/collapsible/CollapsibleContent.vue';
import CollapsibleTrigger from '../ui/collapsible/CollapsibleTrigger.vue';
import SidebarMenuButton from '../ui/sidebar/SidebarMenuButton.vue';
import SidebarMenuItem from '../ui/sidebar/SidebarMenuItem.vue';
import SidebarMenuSub from '../ui/sidebar/SidebarMenuSub.vue';

import { type NavItem, type SharedData } from '@/types';
const page = usePage<SharedData>();
defineProps<{
    item: NavItem;
}>();
</script>
