<script setup>
import NavMain from '@/components/NavMain.vue';
import NavUser from '@/components/NavUser.vue';
import {
    Sidebar,
    SidebarContent,
    SidebarFooter,
    SidebarHeader,
    SidebarMenu,
    SidebarMenuButton,
    SidebarMenuItem,
} from '@/components/ui/sidebar';
import { Link } from '@inertiajs/vue3';
import { LayoutGrid, Pencil, BookOpenCheck, UserSearch, ListCollapse, Users } from 'lucide-vue-next';
import AppLogo from './AppLogo.vue';

const navGroups = [
    {
        title: 'Dashboard',
        href: '/dashboard',
        icon: LayoutGrid,
    },
    {
        title: 'Registro',
        icon: Pencil,
        items: [
            {
                title: 'Libro Diario',
                href: '/libro-diario/registrar',
            },
        ],
    },
    {
        title: 'Reportes',
        icon: BookOpenCheck,
        items: [
            {
                title: 'Libro de Ventas',
                href: '/reportes/libro-ventas',
            },
            {
                title: 'Libro de Compras',
                href: '/reportes/libro-compras',
            },
        ],
    },
    {
        title: 'Administrar',
        icon: ListCollapse,
        items: [
            {
                title: 'Clientes',
                href: '/administrar/clientes',
                icon: UserSearch,
            },
            {
                title: 'Cuentas Contables',
                href: '/administrar/cuentas-contables',
                icon: ListCollapse,
            },
            {
                title: 'Usuarios',
                href: '/administrar/usuarios',
                icon: Users,
            },
        ],
    },
];
</script>

<template>
    <Sidebar collapsible="icon" variant="inset" class="pr-2 pb-3">
        <SidebarHeader class="pa-4">
            <SidebarMenu>
                <SidebarMenuItem>
                    <SidebarMenuButton size="lg" as-child>
                        <Link href="/dashboard">
                            <AppLogo />
                        </Link>
                    </SidebarMenuButton>
                </SidebarMenuItem>
            </SidebarMenu>
        </SidebarHeader>

        <SidebarContent class="pa-3">
            <NavMain :items="navGroups" />
        </SidebarContent>

        <SidebarFooter>
            <NavUser class="pa-4" />
        </SidebarFooter>
    </Sidebar>
    <slot />
</template>
