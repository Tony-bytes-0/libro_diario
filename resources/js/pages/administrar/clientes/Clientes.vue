<template>
    <head title="Administrar Clientes" />
    <AppLayout :breadcrumbs="breadcrumbs">
        <v-form style="padding: 10px;" @submit.prevent="submit">
            <v-row class="pt-6 px-5 align-center ma-1">
                <v-col cols="2">
                    <v-label>Tipo</v-label>
                    <v-select variant="outlined" :items="['V', 'J', 'G']" v-model="formData.tipo"></v-select>
                </v-col>
                <v-col cols=" 4">
                    <v-label>Rif o cedula</v-label>
                    <v-text-field variant="outlined" v-model="formData.rif"></v-text-field>
                </v-col>
                <v-col cols="4">
                    <v-label>Nombre completo o descrpción</v-label>
                    <v-text-field variant="outlined" v-model="formData.descripcion"></v-text-field>
                </v-col>

            </v-row>
            <v-divider thickness="2" class="mt-10">Informacion adicional</v-divider>
            <v-row class="px-5 align-center ma-1">
                <v-col cols="4">
                    <v-label>Nombre</v-label>
                    <v-text-field variant="outlined" v-model="formData.nombre"></v-text-field>
                </v-col>
                <v-col cols="4">
                    <v-label>Apellido</v-label>
                    <v-text-field variant="outlined" v-model="formData.apellido"></v-text-field>
                </v-col>
                <v-col cols="4">
                    <v-label>Teléfono</v-label>
                    <v-text-field variant="outlined" v-model="formData.telefono"></v-text-field>
                </v-col>
                <v-col cols="12">
                    <v-label>Correo</v-label>
                    <v-text-field variant="outlined" v-model="formData.correo"></v-text-field>
                </v-col>
            </v-row>
            <v-row class="text-center">
                <v-col cols="12" class="d-flex justify-center">
                    <v-btn class="boton_verde_submit w-50" type="submit" @click="submit()">Añadir</v-btn>
                </v-col>
            </v-row>
        </v-form>
    </AppLayout>
</template>
<script setup>
import { fastMsg, staticError } from '@/helpers';
import AppLayout from '@/layouts/AppLayout.vue';
import axios from 'axios';
import { ref } from 'vue';
import {viewCreateClients} from '@/routes';

const breadcrumbs = [
    {
        title: 'Administrar Clientes',
        href: viewCreateClients().url,
    },
];

const formData = ref({
    tipo: "",
    rif: "",
    descripcion: "",
    nombre: "",
    apellido: "",
    telefono: "",
    correo: ""
})

const submit = async () => {
    const url = '/api/administrar/clientes/crear'
    try {
        const response = await axios.post(url, formData.value)
        fastMsg(response.data.msg);
    } catch (error) {
        console.log(error);
        staticError('Error al registrar cliente');
    }

}
</script>
<style>
.boton_verde_submit{
    background-color: #2aa134;
        padding: 25px;
        display: flex;
        justify-content: center;
        align-items: center;
        color: rgb(236, 236, 236);
        font-size: medium;
}
</style>
