<template>
    <v-row v-if="props.show" class="w-full">
        <v-col cols="8">
            <v-label>Cuenta contable</v-label>
            <v-autocomplete variant="outlined" autocomplete="off" :items="props.list" v-model="selected" return-object
                item-title="descripcion" key="id"></v-autocomplete>
        </v-col>
        <v-col cols="2">
            <v-label>Tipo</v-label>
            <v-select :items="['debe', 'haber']" v-model="accType">

            </v-select>
        </v-col>
        <v-col cols="2" class="flex items-center">
            <v-btn class="boton_registrar" @click="addToList()">+</v-btn>
        </v-col>
    </v-row>
    <v-row class="w-full">
        {{ selectedList }}
    </v-row>

</template>

<script setup>
import { ref } from 'vue';

const selected = ref({
    id: "",
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
        emit('selectCuentaContable', sharedValue)
        resetForm();
    }
}

const resetForm = () => {
    selected.value = {
        id: "",
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
</style>