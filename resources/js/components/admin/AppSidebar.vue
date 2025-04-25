<script setup lang="ts">
import AppLogo from '@/components/AppLogo.vue';
import Nav from '@/components/admin/Nav.vue';
import NavFooter from '@/components/admin/NavFooter.vue';
import NavMain from '@/components/admin/NavMain.vue';
import { Sidebar, SidebarContent, SidebarFooter, SidebarHeader, SidebarMenu, SidebarMenuButton, SidebarMenuItem } from '@/components/ui/sidebar';
import { type NavItem } from '@/types';
import { Link, usePage } from '@inertiajs/vue3';
import { AudioWaveform, BriefcaseMedical, Calendar, Calendar1, Layers, PawPrint, User, UserCog, Users, UsersRound } from 'lucide-vue-next';
import { ref } from 'vue';

const roles = ref<string[]>(usePage().props.auth.adminRoles);

const mainNavItems: NavItem[] = [
    {
        title: 'Veterinary',
        icon: AudioWaveform,
        items: [
            {
                title: 'Services',
                href: '/admin/vet-services',
                icon: BriefcaseMedical,
                isHidden: !roles.value.includes('Super Admin') && !roles.value.includes('Admin'),
            },
            {
                title: 'Services Types',
                href: '/admin/vet-service-types',
                icon: Layers,
                isHidden: !roles.value.includes('Super Admin') && !roles.value.includes('Admin'),
            },
            {
                title: 'Schedules',
                href: '/admin/vet-appointment-schedules',
                icon: Calendar,
                isHidden: !roles.value.includes('Super Admin') && !roles.value.includes('Admin'),
            },
            {
                title: 'Appointments',
                href: '/admin/vet-appointments',
                icon: Calendar1,
                isHidden: !roles.value.includes('Super Admin') && !roles.value.includes('Admin') && !roles.value.includes('Doctor'),
            },
        ],
    },
    {
        title: 'Inventory',
        href: '/admin/products',
        icon: PawPrint,
        isHidden: !roles.value.includes('Super Admin') && !roles.value.includes('Admin'),
    },
    {
        title: 'Accounts',
        icon: User,
        isHidden: !roles.value.includes('Super Admin') && !roles.value.includes('Admin'),
        items: [
            {
                title: 'Roles',
                href: '/admin/roles',
                icon: UserCog,
                isHidden: !roles.value.includes('Super Admin') && !roles.value.includes('Admin'),
            },
            {
                title: 'Admin Accounts',
                href: '/admin/admins',
                icon: Users,
                isHidden: !roles.value.includes('Super Admin') && !roles.value.includes('Admin'),
            },
            {
                title: 'User Accounts',
                href: '/admin/users',
                icon: UsersRound,
                isHidden: !roles.value.includes('Super Admin') && !roles.value.includes('Admin'),
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
