<template>
    <AppLayout :breadcrumbs="breadcrumbs" style="background-color: #454545">

        <head />
        <v-form style="padding: 10px;">
            <v-row class="text-center">
                <v-col cols="12">Administrar clientes</v-col>
                <v-col cols="2">
                    <v-label>Tipo</v-label>
                    <v-select :items="['V', 'J', 'G']"></v-select>
                </v-col>
                <v-col cols=" 4">
                    <v-label>Rif o cedula</v-label>
                    <v-text-field></v-text-field>
                </v-col>
                <v-col cols="4">
                    <v-label>Nombre completo o descrpción</v-label>
                    <v-text-field></v-text-field>
                </v-col>

            </v-row>
            <v-divider thickness="4" class="mt-10">Informacion adicional</v-divider>
            <v-row>
                <v-col cols="4">
                    <v-label>Nombre</v-label>
                    <v-text-field></v-text-field>
                </v-col>
                <v-col cols="4">
                    <v-label>Apellido</v-label>
                    <v-text-field></v-text-field>
                </v-col>
                <v-col cols="4">
                    <v-label>Teléfono</v-label>
                    <v-text-field></v-text-field>
                </v-col>
                <v-col cols="4">
                    <v-label>Correo</v-label>
                    <v-text-field></v-text-field>
                </v-col>
            </v-row>
        </v-form>
    </AppLayout>
</template>
<script setup>
import AppLayout from '@/layouts/AppLayout.vue';

</script>