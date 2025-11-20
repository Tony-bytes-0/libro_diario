<template>

    <Head title="Reporte Libro de Ventas" />
    <AppLayout :breadcrumbs="breadcrumbs" style="overflow-x: scroll;">
        <v-row class="pt-6 px-8 ma-1 align-center">
            <table class="px-2 mx-4 mb-4 w-full">
                <thead>
                    <tr class="w-100">
                        <th class="text-center text-md cellTitle px-4 py-2" scope="row">ID</th>
                        <th class="text-center text-md cellTitle px-11 py-2">Cliente</th>
                        <th class="text-center text-md cellTitle px-11 py-2">E-mail</th>
                        <th class="text-center text-md cellTitle px-6 py-2">Rol</th>
                        <th class="text-center text-md cellTitle px-11 py-2">Creado en</th>
                        <th class="text-center text-md cellTitle px-11 py-2">Actualizado en</th>
                        <th class="text-center text-md cellTitle px-4 py-2">Editar</th>
                        <!-- <th class="text-center text-md cellTitle px-4 py-2">Eliminar</th> -->
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="item in queryData.items" :key="item.entry_id" class="cellRow w-100" >
                        <td class="text-center cellInnerField text-md">{{ item.id }}</td>
                        <td class="text-center cellInnerField text-md">{{ item.name }}</td>
                        <td class="text-center cellInnerField text-md">{{ item.email }}</td>
                        <td class="text-center cellInnerField text-md">{{ item.rol }}</td>
                        <td class="text-center cellInnerField text-md">{{ item.created_at }}</td>
                        <td class="text-center cellInnerField text-md">{{ item.updated_at }}</td>
                        <td class="cellIcons">
                            <div class="icon-wrapper" @click="EditarUsuario(item.id)" style="cursor: pointer;">
                                <component :is="Pencil" style="cursor: pointer; "/>
                            </div>
                        </td>
   <!--                      <td class="cellIcons">
                            <div class="icon-wrapper" @click="BorrarUsuario(item.id)" style="cursor: pointer;">
                                <component :is="Trash"/>
                            </div>
                        </td> -->
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
import {staticError} from '@/helpers';
import { Pencil, Trash } from 'lucide-vue-next';
import {adminUsers} from '@/routes';
import Swal from 'sweetalert2';


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
});

const BorrarUsuario = async (id) => {
    const url = `/api/borrar/usuarios/${id}`
    Swal.fire({
        theme: 'auto',
        title: "¿Esta seguro de eliminar este usuario?",
        text: "Asegurese antes de continuar",
        icon: "question",
        showCancelButton: true,
        cancelButtonText: "Cancelar",
        showConfirmButton: true,
        confirmButtonText: "Borrar",
        confirmButtonColor: "#a60000ff",
        allowOutsideClick: false,
    }).then( async (result) => {
        if (result.isConfirmed) {
            try {
                const response = await axios.delete(url);
                Swal.fire({
                    theme: 'auto',
                    title: "Listo!",
                    text: response.data.msg,
                    icon: "success",
                    timer: 3000,
                    showConfirmButton: false
                });
                window.location.reload()
            } catch (error) {
                console.log(error);
                staticError('Error al borrar usuario');
            }
        }
    });
};

</script>
<style scoped>

table {
    border-collapse:separate;
    border:solid #616161 3px;
    border-radius:10px;
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

.cellIcons{
    padding: 6px;
}

.icon-wrapper {
    display: flex;
    justify-content: center;
}
</style>
