<template>

    <Head title="Reporte Libro de Ventas" />
    <AppLayout :breadcrumbs="breadcrumbs">
        <v-row class="pt-6 px-8 ma-1">
            <v-col cols="5">
                <v-select label="Mes" :items="allowedDates.months" v-model="filterData.month">
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
                <v-select label="Año" :items="allowedDates.years" v-model="filterData.year"></v-select>
            </v-col>
            <v-col cols="3" class="">
                <v-btn width="100%" height="70%" variant="outlined" :loading="queryData.loading" @click="submit()">
                    Buscar</v-btn>
            </v-col>
        </v-row>
        <v-divider thickness="3"></v-divider>

        <table>
            <thead>
                <tr>
                    <th class="text-center text-xs cellTitle pa-2">Fecha</th>
                    <th class="text-center text-xs cellTitle pa-2">Nombre o razón social</th>
                    <th class="text-center text-xs cellTitle pa-2">Rif</th>
                    <th class="text-center text-xs cellTitle pa-2">Tipo documento</th>
                    <th class="text-center text-xs cellTitle pa-2">Maquina fiscal</th>
                    <th class="text-center text-xs cellTitle pa-2">Primera y ultima factura</th>
                    <th class="text-center text-xs cellTitle pa-2">Factura afectada</th>
                    <th class="text-center text-xs cellTitle pa-2">Total ventas</th>
                    <th class="text-center text-xs cellTitle pa-2">Ventas internas no gravadas</th>
                    <th class="text-center text-xs cellTitle pa-2">Base imponible ALIC GEN contribuyente</th>
                    <th class="text-center text-xs cellTitle pa-2">% IVA</th>
                    <th class="text-center text-xs cellTitle pa-2">Impuesto IVA</th>
                    <th class="text-center text-xs cellTitle pa-2">Base imponible ALIC GEN NO contribuyente</th>
                    <th class="text-center text-xs cellTitle pa-2">% IVA</th>
                    <th class="text-center text-xs cellTitle pa-2">Impuesto IVA</th>
                    <th class="text-center text-xs cellTitle pa-2">Retencion IVA soportada</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="item in queryData.items" :key="item.entry_id" class="cellRow">
                    <td class="text-center cellInnerField text-sm">{{ item.fecha }}</td>
                    <td class="text-center cellInnerField text-sm">{{ item.cliente_descripcion }}</td>
                    <td class="text-center cellInnerField text-sm">{{ item.cliente_rif }}</td>
                    <td class="text-center cellInnerField text-sm">{{ item.tipo_documento }}</td>
                    <td class="text-center cellInnerField text-sm">{{ item.maquina_fiscal }}</td>
                    <td class="text-center cellInnerField text-sm">{{ item.primera_factura }} - {{ item.ultima_factura }}</td>
                    <td class="text-center cellInnerField text-sm">{{ item.numero_factura }}</td>
                    <td class="text-center cellInnerField text-sm">{{ formatedNumber( item.total_ventas) }}</td>
                    <td class="text-center cellInnerField text-sm">{{ formatedNumber( item.total_ventas_no_gravadas) }}</td>
                    <td class="text-center cellInnerField text-sm">{{ formatedNumber( item.base_imponible_alic_contribuyente) }}</td>
                    <td class="text-center cellInnerField text-sm">{{ item.porcentaje_iva_contribuyente }}%</td>
                    <td class="text-center cellInnerField text-sm">{{ formatedNumber(item.impuesto_iva) }}</td>
                    <td class="text-center cellInnerField text-sm">{{ formatedNumber(item.base_imponible_alic_no_contribuyente)}}</td>
                    <td class="text-center cellInnerField text-sm">{{ formatedNumber(item.porcentaje_iva_no_contribuyente) }}</td>
                    <td class="text-center cellInnerField text-sm">{{ formatedNumber(item.impuesto_iva) }}</td>
                    <td class="text-center cellInnerField text-sm">{{ item.retencion_iva_soportada }}</td>
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
import {viewLibroVentas} from '@/routes';

const breadcrumbs = [
    {
        title: 'Libro de ventas',
        href: viewLibroVentas().url,
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
    const url = '/api/reporte/libro/ventas'
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
.cellTitle {
    color: #e7e7e7;
}
.cellRow{
    border-style: solid;
    border-color: #616161;
    border-width: 3px;

}
.cellInnerField{
    padding:8px;

}
</style>
