<template>

    <Head title="Registrar" />
    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="d-flex">
            <v-row class="py-4 pr-6">
                <v-col cols="4">
                    <v-date-input v-model="registerDate" label="Fecha"></v-date-input>
                </v-col>
                <v-col cols="8">
                    <v-autocomplete label="Nombre o Razon Social del cliente" :items="clientsList" item-title="descripcion"
                        return-object v-model="formData.client"></v-autocomplete>
                </v-col>
                <v-col cols="4">
                    esto va a ser parte del cliente, el campo se queda pero inhabilitado
                    <v-text-field label="RIF" disabled ></v-text-field>
                </v-col>
                <v-col cols="4" >
                    <v-autocomplete label="Tipo de Documento" 
                    :items="documentTypeList" 
                    v-model="formData.documentType"
                    return-object
                    item-title="name"
                    ></v-autocomplete>
                </v-col>
                <v-row>
                    <v-col>
                        <v-text-field label="Registro Maquina Fiscal"></v-text-field>
                    </v-col>
                    <v-col>
                        <v-text-field label="Primera Factura"></v-text-field>
                    </v-col>
                    <v-col>
                        <v-text-field label="Ultima Factura"></v-text-field>
                    </v-col>
                    <v-col>
                        <v-text-field label="N° Factura (Compra, NC, ND)"></v-text-field>
                    </v-col>
                    <v-col>
                        <v-text-field label="Factura Afectada"></v-text-field>
                    </v-col>
                    <v-col>
                        <v-text-field label="Total Ventas (con I.V.A)"></v-text-field>
                    </v-col>
                    <v-col>
                        <v-text-field label="Ventas Internas no Agravadas"></v-text-field>
                    </v-col>
                    <v-col>
                        <v-text-field label="Base Imponible Alic (Gen - Contrib.)"></v-text-field>
                    </v-col>
                    <v-col>
                        <v-text-field label="% IVA"></v-text-field>
                    </v-col>
                    <v-col>
                        <v-text-field label="Impuesto I.V.A. (Contrib.)"></v-text-field>
                    </v-col>
                    <v-col>
                        <v-text-field label="Base Imponible Alic (Gen - No Contrib.)"></v-text-field>
                    </v-col>
                    <v-col>
                        <v-text-field label="% I.V.A."></v-text-field>
                    </v-col>
                    <v-col>
                        <v-text-field label="Impuesto I.V.A. (No Contrib.)"></v-text-field>
                    </v-col>
                    <v-col>
                        <v-text-field label="Retencion I.V.A. Soportada"></v-text-field>
                    </v-col>
                </v-row>
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
        name: 'Retención de iva'
    },
    {
        synonym: 'Z',
        name: 'Reporte Z'
    },
    {
        synonym: 'NCD',
        name: 'Nota de crédito'
    }]);

  const clients = [
    'AKERMED C.A.',
    'AK GYM C.A.',
    'NAVIERA RASSI C.A.',
    'LICOMARKET C.A.',
    'FABRICA DE TABACOS BERMUDEZ C.A.',
    'MS DILO C.A.',
    'RED POINT AUTOPARTS C.A.',
    'AUTOPARTES EL VENEZOLANO C.A.',
    'ADMINISTRADORA SOL Y MAR, SRL',
    'INSTALACIONES ELECTROHIDRAULICAS C.A.',
    'FUNDACION TEATRO LUIS MARIANO RIVERA',
    'R&R DIAGNOSTICO C.A.',
    'ALCALDIA BOLIVARIANA DEL MUNICIPIO MEJIA',
    'TRANSPORTE "EL FAMOSO"',
    'CORPORACION SOCIALISTA DE DESARROLLO DEL ESTADO SUCRE',
    'SERVINAVE C.A.',
    'ATENCION FAMILIAR MEDICO INTEGRAL C.A.',
    'PROYMO C.A.',
    'LACTEOS EMBUTIDOS LA QUINTA ORIENTAL C.A.',
    'IMPRECOPIAS GRAFICAS C.A.',
    'FUNDACION PARA EL DESARROLLO DE LA CIENCIA Y TECNOLOGIA EN EL ESTADO SUCRE',
    'ATIMED C.A.',
    'METALURGICA MANZANARES C.A.',
    'MASCOTIENDA CLINICA VETERINARIA C.A.',
    'SB, SA INGENIERA',
    'U.E. INSTITUTO LIBERTADOR',
    'U.E. INSTITUTO SAN LAZARO',
    'ALUMINIOS PIPO C.A.',
    'DISTRIBUIDORA LEMN C.A.',
    'CONTRALORIA MUNICIPIO CRUZ SALMERON ACOSTA',
    'MC VZLA',
    'ECONOQUESOS PLAZA C.A.',
    'DIORKA ORIENTE C.A.',
    'LA PRIMOGENITA 6101, C.A.',
    'HAKKO ENERGY C.A.',
    'COSTO SUPERMARKET C.A.',
    'CC CUMANA PLAZA C.A.',
    'DEPILASER VE 2023 C.A.',
    'RESUMEN DIARIO DE VENTAS'
];

const values = ref('');

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
})
</script>
