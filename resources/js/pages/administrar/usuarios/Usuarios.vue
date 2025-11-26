<template>

    <Head title="Reporte Libro de Ventas" />
    <AppLayout :breadcrumbs="breadcrumbs" style="overflow-x: scroll;">
        <v-row class="pt-6 px-5 align-center ma-1">
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
                    <tr v-for="item in queryData.items" :key="item.entry_id" class="cellRow w-100">
                        <td class="text-center cellInnerField text-md">{{ item.id }}</td>
                        <td class="text-center cellInnerField text-md">{{ item.name }}</td>
                        <td class="text-center cellInnerField text-md">{{ item.email }}</td>
                        <td class="text-center cellInnerField text-md">{{ item.rol_nombre }}</td>
                        <td class="text-center cellInnerField text-md">{{ item.created_at }}</td>
                        <td class="text-center cellInnerField text-md">{{ item.updated_at }}</td>
                        <td class="cellIcons">
                            <div class="icon-wrapper" @click="openModalClick(item.id)" style="cursor: pointer;">
                                <component :is="Pencil" style="cursor: pointer; " />
                            </div>
                            <v-dialog max-width="500">
                                <template v-slot:activator="{ props: activatorProps }">
                                    <v-btn id="openModalBtn" v-bind="activatorProps" style="display: none;"
                                        color="surface-variant" variant="flat"></v-btn>
                                </template>

                                <template v-slot:default="{ isActive }">
                                    <v-card title="Editar" class="pa-5" style="background: var(--background); color: var(--foreground);">
                                        <v-row class="px-2">
                                            <v-col cols="12" style="padding: 6%;">
                                                <v-label>Rol</v-label>
                                                <v-select :items="roles" return-object variant="outlined" item-title="nombre"
                                                    v-model="formData.role"
                                                    @update:model-value="asignarRol(item)"></v-select>
                                            </v-col>
                                        </v-row>
                                        <!--
                                        <v-row>
                                            <v-col cols="12" style="padding: 6%;">
                                                <v-label>Permisos</v-label>
                                                <v-select chips :items="permisos" v-model="formData.permissions"
                                                    item-title="nombre" return-object
                                                    @update:model-value="asignarPermiso()" multiple></v-select>

                                            </v-col>
                                        </v-row>
-->
                                        <v-btn class="mx-5" text="Cerrar" @click="isActive.value = false"></v-btn>
                                    </v-card>
                                </template>
                            </v-dialog>
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
import { staticError } from '@/helpers';
import { Pencil, Trash } from 'lucide-vue-next';
import { adminUsers } from '@/routes';
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

const formData = ref({
    user_id: '',
    role: {
        id: '',
        nombre: '',
    },
    //permissions: [],
})

const roles = ref([]);
//const permisos = ref([]);

const openModalClick = (id) => {
    const btn = document.getElementById('openModalBtn')
    const numero = `${id}`;
    console.log ('numero ID: ', numero);
    const user = queryData.value.items.find(item => item.id == numero);
    console.log(user);
    btn.click()
    // asignar userId seleccionado
    formData.value.user_id = user.id
    formData.value.role = {
        id: user.rol_id,
        nombre: user.rol_nombre,
    }
    //console.log(item, formData.value.role)
}

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
    }).then(async (result) => {
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

const asignarRol = async () => {
    const url = '/api/roles/asignar';
    console.log('rol seleccionado: ', formData.value.role)
    try {
        const response = await axios.post(url, {
            user_id: formData.value.user_id,
            role_id: formData.value.role.id,
        });
    }
    catch {
        //staticError('Error asignando rol');
    }
    finally {
        queryData.value.loading = false
    }

}
/*
const asigmiso = async () => {
    const url = '/api/permisos/asignar';
    try {
        const response = await axios.post(url, {
            user_id: formData.value.user_id,
            permisos: formData.value.permissions
        });
    }
    catch {
        //staticError('Error asignando permiso');
    }
    finally {
        queryData.value.loading = false
    }
}
*/

onMounted(async () => {
    const url = '/api/users'
    const rolesPermisosUrl = '/api/rolespermisos/consultar'
    //const permisosUrl = '/api/roles/permisos'
    try {
        queryData.value.loading = true
        const response = await axios.get(url)
        queryData.value.items = response.data.users
        //Roles y permisos
        const rolesPermisosResponse = await axios.post(rolesPermisosUrl);
        roles.value = rolesPermisosResponse.data.roles
        queryData.value.loaded = true

        console.log(queryData.value.items)
    }
    catch (error) {
        staticError('Error buscando usuarios')
        console.log(error)

    }
    finally {
        queryData.value.loading = false
    }
});
</script>
<style scoped>
table {
    border-collapse: separate;
    border: solid #616161 3px;
    border-radius: 10px;
    white-space: normal;
}

td,
th {
    border-top: solid black 1px;
}

th {
    border-top: none;
}

td:first-child,
th:first-child {
    border-left: none;
}

.cellRow {
    border-style: solid;
    border-color: #616161;
    border-width: 3px;
}

.cellInnerField {
    padding: 6px;
}

.cellIcons {
    padding: 6px;
}

.icon-wrapper {
    display: flex;
    justify-content: center;
}
</style>
