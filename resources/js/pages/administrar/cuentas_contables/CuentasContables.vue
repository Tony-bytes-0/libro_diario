    <template>

        <head title="Cuentas contables" />
        <AppLayout :breadcrumbs="breadcrumbs">
            <v-form style="padding: 10px;" @submit.prevent>
                <v-row class="pt-6 px-5 align-center ma-1">
                    <v-col cols="6">
                        <v-label>Código</v-label>
                        <v-text-field variant="outlined" v-model="formData.codigo" autocomplete="off"></v-text-field>
                    </v-col>
                    <v-col cols="6">
                        <v-label>Descripción</v-label>
                        <v-text-field variant="outlined" v-model="formData.descripcion" autocomplete="off"></v-text-field>
                    </v-col>
                </v-row>
                <v-row class="text-center">
                    <v-col cols="12" class="d-flex justify-center">
                        <v-btn class="boton_verde_submit w-50" type="submit" @click="submit()">Añadir</v-btn>
                    </v-col>
                </v-row>
            </v-form>
        </AppLayout>
    </template>
<script setup>
import { fastMsg, staticError } from '@/helpers';
import AppLayout from '@/layouts/AppLayout.vue';
import { reset } from '@/routes/password';
import axios from 'axios';
import { ref } from 'vue';

const breadcrumbs = [
    {
        title: 'Cuentas contables',
        //href: viewCreateClients().url,
    },
];
const formData = ref({
    codigo:"",
    descripcion:"",

})

function resetForm() {
    formData.value = {
        codigo:"",
        descripcion:"",
    }
};

const submit = async () => {
    const url = '/api/administrar/cuenta_contable/crear'
    try {
        const response = await axios.post(url, formData.value);
        fastMsg(response.data.msg);
        resetForm();
    } catch (error) {
        console.log(error);
        staticError('Error al crear cuenta');
    }
}
</script>

<style>
.boton_verde_submit {
    background-color: #2aa134;
    padding: 25px;
    display: flex;
    justify-content: center;
    align-items: center;
    color: rgb(236, 236, 236);
    font-size: medium;
}
</style>
