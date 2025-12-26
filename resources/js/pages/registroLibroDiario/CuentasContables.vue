<template>
    <v-row v-if="props.show" class="w-full align-center px-3">
        <v-col cols="5">
            <v-label>Cuenta contable</v-label>
            <v-autocomplete variant="outlined" autocomplete="off" :items="props.list" v-model="selected" return-object
                item-title="descripcion" item-subtitle="codigo" key="id">
                <template v-slot:item="{ props, item }">
                    <v-list-item
                    v-bind="props"
                    :title="item.raw.descripcion"
                    :subtitle="item.raw.codigo"
                    ></v-list-item>
                </template>
            </v-autocomplete>
        </v-col>
        <v-col cols="3">
            <v-label>Tipo</v-label>
            <v-select variant="outlined" :items="['debe', 'haber']" v-model="accType">
            </v-select>
        </v-col>
        <v-col cols="3">
            <v-label>Monto</v-label>
            <v-text-field variant="outlined" type="number" v-model.number="montoContable" autocomplete="off">
            </v-text-field>
        </v-col>
        <v-col cols="1" class="flex justify-center">
            <v-btn class="boton_registrar" @click="addToList()" :disabled="accType !== '' && montoContable !== 0 ? false : true">+</v-btn>
        </v-col>
    </v-row>

    <v-divider class="border-opacity-100 mx-1" thickness="1">Cuentas Seleccionadas</v-divider>

    <v-row class="w-full justify-center mt-2" v-if="props.selectedList.length > 0">
        <table class=" mb-4">
            <thead>
                <tr>
                    <th class="text-center text-md pa-2 cellTitle">ID</th>
                    <th class="text-center text-md pa-2 cellTitle">Codigo</th>
                    <th class="text-center text-md pa-2 cellTitle">Descripcion</th>
                    <th class="text-center text-md pa-2 cellTitle">Tipo</th>
                    <th class="text-center text-md pa-2 cellTitle">Monto</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="item in selectedList" :key="item.id" class="cellRow">
                    <td class="text-center cellInnerField px-10 text-md">{{ item.id }}</td>
                    <td class="text-center cellInnerField px-10 text-md">{{ item.codigo }}</td>
                    <td class="text-center cellInnerField px-10 text-md">{{ item.descripcion }}</td>
                    <td class="text-center cellInnerField px-10 text-md">{{ item.tipo }}</td>
                    <td class="text-center cellInnerField px-10 text-md">{{ item.monto }}</td>
                    <td class="cellIcons px-10 ">
                        <div class="icon-wrapper" @click="deleteFromList(item.id)" style="cursor: pointer;">
                            <component :is="Trash" style="cursor: pointer; " />
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </v-row>
</template>

<script setup>
import { ref } from 'vue';
import { Trash } from 'lucide-vue-next';

const selected = ref({
    id: "",
    codigo:"",
    descripcion: "",
    tipo: "",
    monto: 0
})
const accType = ref('');

const montoContable = ref(0);

const props = defineProps(['list', 'isLoading', 'show', 'selectedList']);

const emit = defineEmits(['selectCuentaContable', 'deselectCuentaContable']);

const addToList = () => {
    //para añadir un item, comprobar que ambos valores tengan datos
    const sharedValue = { ...selected.value };
    const amount = Number(montoContable.value);
    console.log(typeof amount);
    console.log(sharedValue);
    const accountType = accType.value
    if (sharedValue.tipo !== '' && accountType !== '' && amount !== 0) {
        sharedValue.tipo = accountType;
        sharedValue.monto = amount;
        emit('selectCuentaContable', sharedValue)
        resetForm();
    }
}

const deleteFromList = (item) => {
    console.log('Eliminar item ID: ', item);
    emit('deselectCuentaContable', item)
}

const resetForm = () => {
    selected.value = {
        id: "",
        codigo: "",
        descripcion: "",
        tipo: "",
        monto: 0,
    }
    accType.value = '';
    montoContable.value = 0;
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
