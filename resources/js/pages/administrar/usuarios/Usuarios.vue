<template>

    <Head title="Reporte Libro de Ventas" />
    <AppLayout :breadcrumbs="breadcrumbs" style="overflow-x: scroll;">
        <v-row class="pt-6 px-8 ma-1 align-center">
            <table class="px-2 mx-4 mb-4 w-full">
                <thead class="w-full">
                    <tr class="w-full">
                        <th class="text-center text-md cellTitle px-11 py-2" scope="row">ID</th>
                        <th class="text-center text-md cellTitle px-11 py-2">Cliente</th>
                        <th class="text-center text-md cellTitle px-11 py-2">E-mail</th>
                        <th class="text-center text-md cellTitle px-11 py-2">Rol</th>
                        <th class="text-center text-md cellTitle px-11 py-2">Creado en</th>
                        <th class="text-center text-md cellTitle px-11 py-2">Actualizado en</th>
                        <th class="text-center text-md cellTitle px-11 py-2">Editar</th>
                        <th class="text-center text-md cellTitle px-11 py-2">Eliminar</th>
                    </tr>
                </thead>
                <tbody class="w-full">
                    <tr v-for="item in queryData.items" :key="item.entry_id" class="cellRow w-full" >
                        <td class="text-center cellInnerField text-md">{{ item.id }}</td>
                        <td class="text-center cellInnerField text-md">{{ item.name }}</td>
                        <td class="text-center cellInnerField text-md">{{ item.email }}</td>
                        <td class="text-center cellInnerField text-md">{{ item.rol }}</td>
                        <td class="text-center cellInnerField text-md">{{ item.created_at }}</td>
                        <td class="text-center cellInnerField text-md">{{ item.updated_at }}</td>
                        <td class="cellInnerField">
                            <component :is="Pencil"/>
                        </td>
                        <td class="cellInnerField">
                            <component :is="Trash"/>
                        </td>
                    </tr>
                </tbody>
            </table>
        </v-row>
    </AppLayout>
</template>

<script setup>
import AppLayout from '@/layouts/AppLayout.vue';
import { Head } from '@inertiajs/vue3';
import axios from 'axios';
import { ref, onMounted } from 'vue';
import {formatedNumber, staticError} from '@/helpers';
import { Pencil, Trash } from 'lucide-vue-next';
import {adminUsers} from '@/routes';


const breadcrumbs = [
    {
        title: 'Administrar Usuarios',
        href: adminUsers().url,
    },
];

const queryData = ref({
    loading: false,
    loaded: false,
    items: [],
    msg: '',
})

onMounted(async () => {
    const url = '/api/users'
    try{
        queryData.value.loading = true
        const response = await axios.get(url)
            queryData.value.items = response.data.users
            queryData.value.loaded = true
    }
    catch{
        staticError('Introduzca una fecha valida')
    }
    finally{
        queryData.value.loading = false
    }
})

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

