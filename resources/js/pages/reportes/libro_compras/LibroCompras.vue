<template>

    <Head title="Reporte Libro de Compras" />
    <AppLayout :breadcrumbs="breadcrumbs" style="overflow-x: scroll;">
        <v-row class="pt-6 px-8 ma-1 align-center">
            <v-col cols="5">
                <v-label>Mes</v-label>
                <v-select :items="allowedDates.months" variant="outlined" v-model="filterData.month">
                    <template v-slot:item="{ props, item }">
                        <v-list-item v-bind="props">
                            <template v-slot:title>
                                {{ item.raw.title }} - {{ item.raw.value }}
                            </template>
                        </v-list-item>
                    </template>
                </v-select>
            </v-col>
            <v-col cols="4">
                <v-label>Año</v-label>
                <v-select :items="allowedDates.years" variant="outlined" v-model="filterData.year"></v-select>
            </v-col>
            <v-col cols="3">
                <v-btn class="pb-4 pt-5 h-100 w-100" :loading="queryData.loading" @click="submit()" style="background-color: #2aa134; color: white;">
                    Buscar</v-btn>
            </v-col>
        </v-row>

        <v-divider thickness="3"></v-divider>

        <table class="px-2 mx-4 mb-4">
            <thead>
                <tr>
                    <th class="text-center text-xs pa-2">Fecha</th>
                    <th class="text-center text-xs pa-2 cellTitle">Cliente</th>
                    <th class="text-center text-xs pa-2 cellTitle">Rif</th>
                    <th class="text-center text-xs pa-2 cellTitle">Tipo documento</th>
                    <th class="text-center text-xs pa-2 cellTitle">Maquina fiscal</th>
                    <th class="text-center text-xs pa-2 cellTitle">Primera y ultima factura</th>
                    <th class="text-center text-xs pa-2 cellTitle">Factura afectada</th>
                    <th class="text-center text-xs pa-2 cellTitle">Comprobante retención</th>
                    <th class="text-center text-xs pa-2 cellTitle">Total ventas</th>
                    <th class="text-center text-xs pa-2 cellTitle">Ventas internas no gravadas</th>
                    <th class="text-center text-xs pa-2 cellTitle">Base imponible ALIC GEN contribuyente</th>
                    <th class="text-center text-xs pa-2 cellTitle">% IVA</th>
                    <th class="text-center text-xs pa-2 cellTitle">Impuesto IVA</th>
                    <th class="text-center text-xs pa-2 cellTitle">Base imponible ALIC GEN NO contribuyente</th>
                    <th class="text-center text-xs pa-2 cellTitle">% IVA</th>
                    <th class="text-center text-xs pa-2 cellTitle">Impuesto IVA</th>
                    <th class="text-center text-xs pa-2 cellTitle">Retencion IVA soportada</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="item in queryData.items" :key="item.entry_id" class="cellRow">
                    <td class="text-center cellInnerField text-xs">{{ item.fecha }}</td>
                    <td class="text-center cellInnerField text-xs">{{ item.cliente_descripcion }}</td>
                    <td class="text-center cellInnerField text-xs">{{ item.cliente_rif }}</td>
                    <td class="text-center cellInnerField text-xs">{{ item.tipo_documento }}</td>
                    <td class="text-center cellInnerField text-xs">{{ item.maquina_fiscal }}</td>
                    <td class="text-center cellInnerField text-xs">{{ item.primera_factura }} - {{ item.ultima_factura }}</td>
                    <td class="text-center cellInnerField text-xs">{{ item.numero_factura }}</td>
                    <td class="text-center cellInnerField text-xs">{{ item.comprobante_retencion }}</td>
                    <td class="text-center cellInnerField text-xs">{{ formatedNumber( item.total_ventas) }}</td>
                    <td class="text-center cellInnerField text-xs">{{ formatedNumber( item.total_ventas_no_gravadas) }}</td>
                    <td class="text-center cellInnerField text-xs">{{ formatedNumber(item.base_imponible_alic_contribuyente) }}</td>
                    <td class="text-center cellInnerField text-xs">{{ item.porcentaje_iva_contribuyente }}%</td>
                    <td class="text-center cellInnerField text-xs">{{ formatedNumber(item.impuesto_iva) }}</td>
                    <td class="text-center cellInnerField text-xs">{{ formatedNumber(item.base_imponible_alic_no_contribuyente)}}</td>
                    <td class="text-center cellInnerField text-xs">{{ formatedNumber(item.porcentaje_iva_no_contribuyente) }}</td>
                    <td class="text-center cellInnerField text-xs">{{ formatedNumber(item.impuesto_iva) }}</td>
                    <td class="text-center cellInnerField text-xs">{{ item.retencion_iva_soportada }}</td>
                </tr>
            </tbody>
        </table>
    </AppLayout>
</template>

<script setup>
import AppLayout from '@/layouts/AppLayout.vue';
import { Head } from '@inertiajs/vue3';
import axios from 'axios';
import { ref } from 'vue';
import {formatedNumber, staticError} from '@/helpers'
import {viewLibroCompras} from '@/routes';

const breadcrumbs = [
    {
        title: 'Libro de compras',
        href: viewLibroCompras().url,
    },
];

const queryData = ref({
    loading: false,
    loaded: false,
    items: [],
    msg: '',
})

const generateYears = () => {
    const anioActual = new Date().getFullYear();
    const anios = [];
    for (let i = anioActual - 10; i <= anioActual + 10; i++) {
        anios.push({ title: i.toString(), value: i });
    }
    return anios;
}

const filterData = ref({
    month: '',
    year: new Date().getFullYear()
})
const allowedDates = ref({
    months: [
        { title: 'Enero', value: '01' },
        { title: 'Febrero', value: '02' },
        { title: 'Marzo', value: '03' },
        { title: 'Abril', value: '04' },
        { title: 'Mayo', value: '05' },
        { title: 'Junio', value: '06' },
        { title: 'Julio', value: '07' },
        { title: 'Agosto', value: '08' },
        { title: 'Septiembre', value: '09' },
        { title: 'Octubre', value: '10' },
        { title: 'Noviembre', value: '11' },
        { title: 'Diciembre', value: '12' }
    ],
    years: generateYears()
});

const submit = async () => {
    const url = '/api/reporte/libro/compras'
    try{
    queryData.value.loading = true

    const response = await axios.post(url, {
        anio: filterData.value.year,
        mes: filterData.value.month
    })
        queryData.value.items = response.data.movimientos
        queryData.value.loaded = true
    }
    catch{
        staticError('Introduzca una fecha valida')
    }
    finally{
        queryData.value.loading = false
    }
}

</script>
<style scoped>
table {
    border-collapse:separate;
    border:solid #616161 3px;
    border-radius:10px;
    display: block;
    overflow-x:auto;
    overflow-y: scroll;
    white-space: normal;
}

td, th {
    border-top:solid black 1px;
}

th {
    border-top: none;
}

td:first-child, th:first-child {
     border-left: none;
}

.cellRow{
    border-style: solid;
    border-color: #616161;
    border-width: 3px;
}
.cellInnerField{
    padding:6px;
}
</style>
