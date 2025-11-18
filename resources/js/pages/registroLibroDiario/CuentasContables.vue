<template>
    <v-row v-if="props.show" class="w-full align-center px-3">
        <v-col cols="8">
            <v-label>Cuenta contable</v-label>
            <v-autocomplete variant="outlined" autocomplete="off" :items="props.list" v-model="selected" return-object
                item-title="descripcion" key="id"></v-autocomplete>
        </v-col>
        <v-col cols="3">
            <v-label>Tipo</v-label>
            <v-select variant="outlined" :items="['debe', 'haber']" v-model="accType">

            </v-select>
        </v-col>
        <v-col cols="1" class="flex justify-center">
            <v-btn class="boton_registrar" @click="addToList()">+</v-btn>
        </v-col>
    </v-row>

    <v-divider class="border-opacity-100 py-5" thickness="2">Cuentas Seleccionadas</v-divider>

    <v-row class="w-full justify-center" v-if="props.selectedList.length > 0">
        <table class="px-2 mx-4 mb-4">
                <thead>
                    <tr>
                        <th class="text-center text-md pa-2 cellTitle">ID</th>
                        <th class="text-center text-md pa-2 cellTitle">Codigo</th>
                        <th class="text-center text-md pa-2 cellTitle">Descripcion</th>
                        <th class="text-center text-md pa-2 cellTitle">Tipo</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="item in selectedList" :key="item.id" class="cellRow">
                        <td class="text-center cellInnerField px-15 text-md">{{ item.id }}</td>
                        <td class="text-center cellInnerField px-15 text-md">{{ item.codigo }}</td>
                        <td class="text-center cellInnerField px-15 text-md">{{ item.descripcion }}</td>
                        <td class="text-center cellInnerField px-15 text-md">{{ item.tipo }}</td>
                    </tr>
                </tbody>
            </table>
    </v-row>
</template>

<script setup>
import { ref } from 'vue';

const selected = ref({
    id: "",
    codigo:"",
    descripcion: "",
    tipo: "",
})
const accType = ref('')

const props = defineProps(['list', 'isLoading', 'show', 'selectedList'])

const emit = defineEmits(['selectCuentaContable'])

const addToList = () => {
    //para añadir un item, comprobar que ambos valores tengan datos
    const sharedValue = selected.value
    const accountType = accType.value
    if (sharedValue.tipo !== '' && accountType !== '') {
        sharedValue.tipo = accountType;
        emit('selectCuentaContable', sharedValue)
        resetForm();
    }
}

const resetForm = () => {
    selected.value = {
        id: "",
        codigo: "",
        descripcion: "",
        tipo: "",
    }
    accType.value = ''
}
</script>
<style>
.boton_registrar {
    background-color: #2aa134;
    padding: 25px;
    display: flex;
    justify-content: center;
    color: rgb(236, 236, 236);
    font-size: medium;
}

table {
    border-collapse:separate;
    border-radius:10px;

    overflow-x:auto;

}

td, th {

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
