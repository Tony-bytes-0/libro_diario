<template>
    <Head title="Registrar" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <h1>Registro de libro diario</h1>
    </AppLayout>

</template>

<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { registroLibroDiario } from '@/routes';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/vue3';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Registrar',
        href: registroLibroDiario().url,
    },
];
</script>
