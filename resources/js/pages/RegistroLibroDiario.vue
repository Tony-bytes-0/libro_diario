<template>
    <Head title="Registrar" />
    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="d-flex py-4">
            <v-row>
                <v-col>
                    <v-date-input
                    v-model="registerDate"
                    label="Indique la fecha"
                    max-width="368"
                    ></v-date-input>
                </v-col>
                <v-col>
                    <v-autocomplete
                    label="Nombre o Razon Social"
                    :items="clientsList"
                    item-title="descripcion"
                    return-object
                    ></v-autocomplete>
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
    clients: null
  })

  const clientsList = ref([]);

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
    'AKERMED C.A.',
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
    'U.E. INSTITUTO LIBERTADOR'
];

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
