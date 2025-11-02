<template>

    <AppLayout :breadcrumbs="breadcrumbs">
        <v-row style="margin-top: 1%; margin-left: auto; margin-right: auto;">
            <v-col cols="5">
                <v-select label="Mes" :items="allowedDates.months" v-model="filterData.month"></v-select>
            </v-col>
            <v-col cols="4">
                <v-select label="Año" :items="allowedDates.years" v-model="filterData.year"></v-select>
            </v-col>
            <v-col cols="3" style="flex">
                <v-btn width="100%" height="70%" variant="outlined">Buscar</v-btn>
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
                <tr v-for="item in queryData.items" :key="item.id">
                    <td class="text-center">{{ item.name }}</td>
                    <td>{{ item.calories }}</td>
                </tr>
            </tbody>
        </v-table>
    </AppLayout>
</template>

<script setup>
import AppLayout from '@/layouts/AppLayout.vue';
import { ref } from 'vue';
const breadcrumbs = ['Reporte libro de ventas']

const queryData = ref({
    loading: false,
    loaded: false,
    items: [],
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
        month: '', year: ''
    })
const allowedDates = ref({
    months: [
        { title: 'Enero', value: 1 },
        { title: 'Febrero', value: 2 },
        { title: 'Marzo', value: 3 },
        { title: 'Abril', value: 4 },
        { title: 'Mayo', value: 5 },
        { title: 'Junio', value: 6 },
        { title: 'Julio', value: 7 },
        { title: 'Agosto', value: 8 },
        { title: 'Septiembre', value: 9 },
        { title: 'Octubre', value: 10 },
        { title: 'Noviembre', value: 11 },
        { title: 'Diciembre', value: 12 }
    ],
    years: generateYears()
});

</script>
<style scoped >

</style>