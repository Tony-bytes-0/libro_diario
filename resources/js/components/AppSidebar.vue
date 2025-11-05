<script setup lang="ts">
//import NavFooter from '@/components/NavFooter.vue';
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
import { dashboard, registroLibroDiario, reporteLibroVentas } from '@/routes';
import { type NavItem } from '@/types';
import { Link } from '@inertiajs/vue3';
import { /*BookOpen, Folder,*/ LayoutGrid, Pencil, BookOpenCheck } from 'lucide-vue-next';
import AppLogo from './AppLogo.vue';

const mainNavItems: NavItem[] = [
    {
        title: 'Dashboard',
        href: dashboard(),
        icon: LayoutGrid,
    },
    {
        title: 'Registrar',
        href: registroLibroDiario(),
        icon: Pencil,
    },
    {
        title: 'Reporte Libro Ventas',
        href: reporteLibroVentas(),
        icon: BookOpenCheck,
    },
    {
        title:'Reporte libro ventas',
        href:'reportes/libro/ventas',
        icon: BookOpenCheck,
    }
];

/*const footerNavItems: NavItem[] = [
    {
        title: 'Github Repo',
        href: 'https://github.com/laravel/vue-starter-kit',
        icon: Folder,
    },
    {
        title: 'Documentation',
        href: 'https://laravel.com/docs/starter-kits#vue',
        icon: BookOpen,
    },
];*/
</script>

<template>
    <Sidebar collapsible="icon" variant="inset" class="pa-2">
        <SidebarHeader class="pa-4">
            <SidebarMenu>
                <SidebarMenuItem>
                    <SidebarMenuButton size="lg" as-child>
                        <Link :href="dashboard()">
                            <AppLogo />
                        </Link>
                    </SidebarMenuButton>
                </SidebarMenuItem>
            </SidebarMenu>
        </SidebarHeader>

        <SidebarContent class="pa-3">
            <NavMain :items="mainNavItems" />
        </SidebarContent>

        <SidebarFooter>
            <!--NavFooter :items="footerNavItems" /-->
            <NavUser class="pa-3"/>
        </SidebarFooter>
    </Sidebar>
    <slot />
</template>
