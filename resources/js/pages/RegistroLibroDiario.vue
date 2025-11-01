<template>

    <Head title="Registrar" />
    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="d-flex">
            <v-row class="py-4 px-6">
                <v-col cols="4">
                    <v-date-input v-model="formData.registerDate" label="Fecha"></v-date-input>
                </v-col>
                <v-col cols="8">
                    <v-autocomplete label="Nombre o Razon Social del cliente" :items="clientsList" item-title="descripcion"
                        return-object v-model="formData.client"></v-autocomplete>
                </v-col>


                <v-col cols="2">
                    <v-text-field label="RIF" :disabled="rifDisable" v-model="formData.client" ></v-text-field>
                </v-col>
                <v-col cols="3" >
                    <v-autocomplete label="Tipo de Documento"
                    :items="documentTypeList"
                    v-model="formData.documentType"
                    return-object
                    item-title="name"
                    ></v-autocomplete>
                </v-col>
                <v-col cols="3">
                    <v-text-field label="Registro Maquina Fiscal"></v-text-field>
                </v-col>
                <v-col cols="2">
                    <v-text-field label="Primera Factura"></v-text-field>
                </v-col>
                <v-col cols="2">
                    <v-text-field label="Ultima Factura"></v-text-field>
                </v-col>
                <v-col cols="3">
                    <v-text-field label="N° Factura (Compra, NC, ND)"></v-text-field>
                </v-col>
                <v-col cols="2">
                    <v-text-field label="Factura Afectada"></v-text-field>
                </v-col>
                <v-col cols="3">
                    <v-text-field label="Total Ventas (con I.V.A)"></v-text-field>
                </v-col>
                <v-col cols="3">
                    <v-text-field label="Ventas Internas no Agravadas"></v-text-field>
                </v-col>
                <v-col cols="4">
                    <v-text-field label="Base Imponible Alic (Gen - Contrib.)"></v-text-field>
                </v-col>
                <v-col cols="2">
                    <v-text-field label="% I.V.A."></v-text-field>
                </v-col>
                <v-col cols="3">
                    <v-text-field label="Impuesto I.V.A. (Contrib.)"></v-text-field>
                </v-col>
                <v-col cols="4">
                    <v-text-field label="Base Imponible Alic (Gen - No Contrib.)"></v-text-field>
                </v-col>
                <v-col cols="2">
                    <v-text-field label="% I.V.A."></v-text-field>
                </v-col>
                <v-col cols="3">
                    <v-text-field label="Impuesto I.V.A. (No Contrib.)"></v-text-field>
                </v-col>
                <v-col cols="3">
                    <v-text-field label="Retencion I.V.A. Soportada"></v-text-field>
                </v-col>
            </v-row>
        </div>
    </AppLayout>
</template>

<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { registroLibroDiario } from '@/routes';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/vue3';
import axios from 'axios';
import { shallowRef, computed, ref, onMounted } from 'vue'
import { VDateInput } from 'vuetify/labs/VDateInput'
//import { useDate } from 'vuetify'

    const registerDate = shallowRef(null);

    const formData = ref({
        registerDate: null,
        client: null,
        documentType: null,
    })

    const clientsList = ref([]);

    const documentTypeList = ref([
        {
            synonym: 'FACT',
            name: 'Factura'
        },
        {
            synonym: 'RIVA',
            name: 'Retención de I.V.A.'
        },
        {
            synonym: 'Z',
            name: 'Reporte Z'
        },
        {
            synonym: 'NCD',
            name: 'Nota de crédito'
        }]);

    const rifDisable = clientsList.value.rif != null ? true : false;


    const console = computed(()=>{
        console.log
    })
//const values = ref('');

  const date = computed(() => {
    console.log(registerDate.value);
    return registerDate.value;
  });



const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Registrar',
        href: registroLibroDiario().url,
    },
];

onMounted( async () => {
    //consultar clientes
    const urlClients = '/api/clientes';
    const clientsResponse = await axios.get(urlClients);
    clientsList.value = clientsResponse.data.clientes;
    console.log(clientsList.value)
})
</script>
