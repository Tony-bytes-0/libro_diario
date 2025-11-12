<template>
        <v-row v-if="props.show" >
            <v-col cols="12">
                <v-label>Tipo de Documento</v-label>
                <v-autocomplete variant="outlined" autocomplete="off" :items="['a', 'b', 'c']"
                    v-model="selected" return-object item-title="name"></v-autocomplete>
            </v-col>
        </v-row>

</template>

<script setup>
import AppLayout from '@/layouts/AppLayout.vue';
import { ref } from 'vue';

const selected = ref({
    id:"", descripcion:""
})

const props = defineProps(['cuentasContables', 'selected', 'isLoading', 'show'])
const emits = defineEmits(['selectCuentaContable'])

</script>