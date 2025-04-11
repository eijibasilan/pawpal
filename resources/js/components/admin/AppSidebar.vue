<script setup lang="ts">
import AppLogo from '@/components/AppLogo.vue';
import Nav from '@/components/admin/Nav.vue';
import NavFooter from '@/components/admin/NavFooter.vue';
import NavMain from '@/components/admin/NavMain.vue';
import { Sidebar, SidebarContent, SidebarFooter, SidebarHeader, SidebarMenu, SidebarMenuButton, SidebarMenuItem } from '@/components/ui/sidebar';
import { type NavItem } from '@/types';
import { Link } from '@inertiajs/vue3';
import { LayoutGrid, PawPrint, UserCog, Users } from 'lucide-vue-next';

const mainNavItems: NavItem[] = [
    {
        title: 'Dashboard',
        href: '/admin/dashboard',
        icon: LayoutGrid,
    },
    {
        title: 'Inventory',
        href: '/admin/products',
        icon: PawPrint,
    },
    {
        title: 'Roles',
        href: '/admin/roles',
        icon: UserCog,
    },
    {
        title: 'Admin Accounts',
        href: '/admin/accounts',
        icon: Users,
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
                        <Link :href="route('admin.index')">
                            <AppLogo />
                        </Link>
                    </SidebarMenuButton>
                </SidebarMenuItem>
            </SidebarMenu>
        </SidebarHeader>

        <SidebarContent>
            <NavMain :items="mainNavItems" />
        </SidebarContent>

        <SidebarFooter>
            <NavFooter :items="footerNavItems" />
            <Nav />
        </SidebarFooter>
    </Sidebar>
    <slot />
</template>
