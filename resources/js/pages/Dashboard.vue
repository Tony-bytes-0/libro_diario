<script setup>
import AppLayout from '@/layouts/AppLayout.vue';

const breadcrumbs = [
    {
        title: 'Dashboard',
        href: '/dashboard',
    },
];
</script>

<template>
    <v-app>
        <AppLayout :breadcrumbs="breadcrumbs">
            <h1>Example</h1>
        </AppLayout>
    </v-app>
</template>
