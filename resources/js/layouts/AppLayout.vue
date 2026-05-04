<script setup>
import { SidebarProvider } from '@/components/ui/sidebar';
import AppContent from '@/components/AppContent.vue';
import AppSidebar from '@/components/AppSidebar.vue';
import AppSidebarHeader from '@/components/AppSidebarHeader.vue';
import { usePage } from '@inertiajs/vue3';

defineProps({
    breadcrumbs: {
        type: Array,
        default: () => [],
    },
});

const isOpen = usePage().props.sidebarOpen;
</script>

<template>
    <v-app>
        <SidebarProvider :default-open="isOpen">
            <AppSidebar />
            <AppContent variant="inset" class="my-2 elevation-4">
                <AppSidebarHeader :breadcrumbs="breadcrumbs" />
                <slot />
            </AppContent>
        </SidebarProvider>
    </v-app>
</template>
