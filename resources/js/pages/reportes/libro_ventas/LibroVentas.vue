<template>

    <AppLayout :breadcrumbs="breadcrumbs">
        <v-row style="margin-top: 1%; margin-left: auto; margin-right: auto;">
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
            <v-col cols="3" style="flex">
                <v-btn width="100%" height="70%" variant="outlined" :loading="queryData.loading" @click="submit()">
                    Buscar</v-btn>
            </v-col>
        </v-row>

        <v-divider thickness="3"></v-divider>

        <v-table>
            <thead>
                <tr>
                    <th class="text-center">
                        Fecha
                    </th>
                    <th class="text-center">Nombre o razón social</th>
                    <th class="text-center">Rif</th>
                    <th class="text-center">Tipo documento</th>
                    <th class="text-center">Maquina fiscal</th>
                    <th class="text-center">Primera y ultima factura</th>
                    <th class="text-center">Factura afectada</th>
                    <th class="text-center">Total ventas</th>
                    <th class="text-center">Ventas internas no gravadas</th>
                    <th class="text-center">Base imponible ALIC GEN contribuyente</th>
                    <th class="text-center">% IVA</th>
                    <th class="text-center">Impuesto IVA</th>
                    <th class="text-center">Base imponible ALIC GEN NO contribuyente</th>
                    <th class="text-center">% IVA</th>
                    <th class="text-center">Impuesto IVA</th>
                    <th class="text-center">Retencion IVA soportada</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="item in queryData.items" :key="item.entry_id">
                    <td class="text-center">{{ item.fecha }}</td>
                    <td class="text-center">{{ item.cliente_descripcion }}</td>
                    <td class="text-center">{{ item.cliente_rif }}</td>
                    <td class="text-center">{{ item.tipo_documento }}</td>
                    <td class="text-center">{{ item.maquina_fiscal }}</td>
                    <td class="text-center">{{ item.primera_factura }} - {{ item.ultima_factura }}</td>
                    <td class="text-center">{{ item.numero_factura }}</td>
                    <td class="text-center">{{ formatedNumber( item.total_ventas) }}</td>
                    <td class="text-center">{{ formatedNumber( item.total_ventas_no_gravadas) }}</td>
                    <td class="text-center">{{ formatedNumber( item.base_imponible_alic_contribuyente) }}</td>
                    <td class="text-center">{{ item.porcentaje_iva_contribuyente }}%</td>
                    <td class="text-center">{{ formatedNumber(item.impuesto_iva) }}</td>
                    <td class="text-center">{{ formatedNumber(item.base_imponible_alic_no_contribuyente) }}</td>
                    <td class="text-center">{{ formatedNumber(item.porcentaje_iva_no_contribuyente) }}</td>
                    <td class="text-center">{{ formatedNumber(item.impuesto_iva) }}</td>
                    <td class="text-center">{{ item.retencion_iva_soportada }}</td>

                </tr>
            </tbody>
        </v-table>
    </AppLayout>
</template>

<script setup>
import AppLayout from '@/layouts/AppLayout.vue';
import axios from 'axios';
import { ref } from 'vue';
import {formatedNumber, notNullString} from '@/helpers'
const breadcrumbs = ['Reporte libro de ventas']

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
    queryData.value.loading = true
    const response = await axios.post(url, {
        anio: filterData.value.year,
        mes: filterData.value.month
    })
    try{
        queryData.value.items = response.data.movimientos
        queryData.value.loaded = true
    }
    catch{
        console.log('Error en busqueda');
    }
    finally{
        queryData.value.loading = false
    }
}

</script>
<style scoped></style>