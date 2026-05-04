<script setup>
import { SidebarProvider } from '@/components/ui/sidebar';
import AppContent from '@/components/AppContent.vue';
import AppSidebar from '@/components/AppSidebar.vue';
import AppSidebarHeader from '@/components/AppSidebarHeader.vue';

defineProps({
    breadcrumbs: {
        type: Array,
        default: () => [],
    },
});

//const isOpen = usePage().props.sidebarOpen;
</script>

<template>
    <v-app>
        <SidebarProvider :default-open="true">
            <AppSidebar />
            <AppContent variant="sidebar" class="my-2 elevation-4">
                <AppSidebarHeader :breadcrumbs="breadcrumbs" />
                <slot />
            </AppContent>
        </SidebarProvider>
    </v-app>
</template>
