    <template>

        <head title="Cuentas contables" />
        <AppLayout :breadcrumbs="breadcrumbs">
            <v-form @submit.prevent>
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
import readXlsxFile from 'read-excel-file';
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

const file = ref(null);

function resetForm() {
    formData.value = {
        codigo:"",
        descripcion:"",
    }
};

const submitAutoExcel = async () => {
    const excelFile = file.value;
    await readXlsxFile(excelFile, { sheet: 1 }).then(
        async (rows) => {
            console.log(rows.length);
            if (rows.length === 4) { /// verifica si hay datos en la primera fila despues de los encabezados
            console.log("El documento no posee datos");
            } else {
                for (let i = 4; i < rows.length; i++) {
                    const fila = rows[i].length;
                    for (let j = 0; j < fila; j++) {
                        if (rows[3][j] === "#date+reported") {
                            reportDate.value = rows[i][j];
                        }
                        if (rows[3][j] === "#date+month+cycle") {
                            reportedMonth.value = rows[i][j];
                        }
                    }
                    await axios.post("http://localhost:5000/project", {
                        reportDate: reportDate.value,
                        reportedMonth: reportedMonth.value,
                    })
                    .then(function (response) {
                        console.log(response);
                    })
                    .catch(function (error) {
                        console.log(error, "error en proyecto");
                    });
                }
            }
        }
    );
}



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
