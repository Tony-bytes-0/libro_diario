<template>
    <Head title="Reporte" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <v-container class="bg-surface-variant">
            <v-row>
                <v-col>
                    <v-sheet class="pa-2 ma-2">
                    .v-col-auto
                    </v-sheet>
                </v-col>
                <v-col>
                    <v-sheet class="pa-2 ma-2">
                    .v-col-auto
                    </v-sheet>
                </v-col>
            </v-row>

            <v-row>
                <v-col>
                    <v-sheet class="pa-2 ma-2">
                    .v-col-auto
                    </v-sheet>
                </v-col>
                <v-col>
                    <v-sheet class="pa-2 ma-2">
                    .v-col-auto
                    </v-sheet>
                </v-col>
                <v-col>
                    <v-sheet class="pa-2 ma-2">
                    .v-col-auto
                    </v-sheet>
                </v-col>
            </v-row>

            <v-row >
                <v-col cols="2">
                    <v-sheet class="pa-2 ma-2">
                    .v-col-2
                    </v-sheet>
                </v-col>
                <v-col>
                    <v-sheet class="pa-2 ma-2">
                    .v-col-auto
                    </v-sheet>
                </v-col>
            </v-row>
        </v-container>
    </AppLayout>

</template>

<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { reporteLibroDiario } from '@/routes';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/vue3';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Reporte',
        href: reporteLibroDiario().url,
    },
];
</script>
