<script setup lang="ts">
import AppLogo from '@/components/AppLogo.vue';
import NavAdmin from '@/components/admin/NavAdmin.vue';
import NavAdminFooter from '@/components/admin/NavAdminFooter.vue';
import NavAdminMain from '@/components/admin/NavAdminMain.vue';
import { Sidebar, SidebarContent, SidebarFooter, SidebarHeader, SidebarMenu, SidebarMenuButton, SidebarMenuItem } from '@/components/ui/sidebar';
import { type NavItem } from '@/types';
import { Link } from '@inertiajs/vue3';
import { LayoutGrid } from 'lucide-vue-next';

const mainNavItems: NavItem[] = [
    {
        title: 'Dashboard',
        href: '/admin/dashboard',
        icon: LayoutGrid,
    },
];

const footerNavItems: NavItem[] = [
    //{
    //    title: 'Github Repo',
    //    href: 'https://github.com/laravel/vue-starter-kit',
    //    icon: Folder,
    //},
    //{
    //    title: 'Documentation',
    //    href: 'https://laravel.com/docs/starter-kits',
    //    icon: BookOpen,
    //},
];
</script>

<template>
    <Sidebar collapsible="icon" variant="inset">
        <SidebarHeader>
            <SidebarMenu>
                <SidebarMenuItem>
                    <SidebarMenuButton size="lg" as-child>
                        <Link :href="route('admin.login')">
                            <AppLogo />
                        </Link>
                    </SidebarMenuButton>
                </SidebarMenuItem>
            </SidebarMenu>
        </SidebarHeader>

        <SidebarContent>
            <NavAdminMain :items="mainNavItems" />
        </SidebarContent>

        <SidebarFooter>
            <NavAdminFooter :items="footerNavItems" />
            <NavAdmin />
        </SidebarFooter>
    </Sidebar>
    <slot />
</template>
