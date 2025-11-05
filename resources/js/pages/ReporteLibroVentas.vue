<template>

    <Head title="Registrar" />
    <AppLayout :breadcrumbs="breadcrumbs">
        <v-form class="d-flex">
            <v-row class="pt-6 px-8 align-center ma-1">
                
            </v-row>
        </v-form>
        <!--v-btn @click="prueba">prueba</v-btn-->
    </AppLayout>
</template>

<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { reporteLibroVentas } from '@/routes';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/vue3';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Reportes del Libro de Ventas',
        href: reporteLibroVentas().url,
    },
];
</script>
