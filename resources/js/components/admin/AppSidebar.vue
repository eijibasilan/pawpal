<script setup lang="ts">
import AppLogo from '@/components/AppLogo.vue';
import Nav from '@/components/admin/Nav.vue';
import NavFooter from '@/components/admin/NavFooter.vue';
import NavMain from '@/components/admin/NavMain.vue';
import { Sidebar, SidebarContent, SidebarFooter, SidebarHeader, SidebarMenu, SidebarMenuButton, SidebarMenuItem } from '@/components/ui/sidebar';
import { type NavItem } from '@/types';
import { Link } from '@inertiajs/vue3';
import { AudioWaveform, BriefcaseMedical, Calendar, Calendar1, Layers, LayoutGrid, PawPrint, User, UserCog, Users } from 'lucide-vue-next';

const mainNavItems: NavItem[] = [
    {
        title: 'Dashboard',
        href: '/admin/dashboard',
        icon: LayoutGrid,
    },
    {
        title: 'Veterinary',
        icon: AudioWaveform,
        items: [
            {
                title: 'Services',
                href: '/admin/vet-services',
                icon: BriefcaseMedical,
            },
            {
                title: 'Services Types',
                href: '/admin/vet-service-types',
                icon: Layers,
            },
            {
                title: 'Schedules',
                href: '/admin/vet-appointment-schedules',
                icon: Calendar,
            },
            {
                title: 'Appointments',
                href: '/admin/vet-appointments',
                icon: Calendar1,
            },
        ],
    },
    {
        title: 'Inventory',
        href: '/admin/products',
        icon: PawPrint,
    },
    {
        title: 'Admin',
        icon: User,
        items: [
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
        ],
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
