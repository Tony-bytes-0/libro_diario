    <template>

        <head title="Cuentas contables" />
        <AppLayout :breadcrumbs="breadcrumbs">
            <v-form @submit.prevent >
                <v-row class="px-5 align-center ma-1">
                    <v-col cols="12">
                        <v-label>Importar desde archivo Excel</v-label>
                        <v-file-input accept=".xlsx, .xls" variant="outlined" placeholder="Seleccione un archivo Excel" v-model="file">
                            <template v-slot:append>
                                <v-btn class="boton_verde_submit" @click="submitAutoExcel()">Importar</v-btn>
                            </template>
                        </v-file-input>
                    </v-col>
                </v-row>
                    <v-divider thickness="2" class="border-opacity-100 mx-10">Registro manual de cuentas</v-divider>
                <v-row class="px-5 align-center ma-1">
                    <v-col cols="5">
                        <v-label>Descripción</v-label>
                        <v-text-field variant="outlined" v-model="formData.descripcion" autocomplete="off"></v-text-field>
                    </v-col>
                    <v-col cols="5">
                        <v-label>Código</v-label>
                        <v-text-field variant="outlined" v-model="formData.codigo" autocomplete="off"></v-text-field>
                    </v-col>
                    <v-col cols="2" class="d-flex justify-center">
                        <v-btn class="boton_verde_submit w-100" type="submit" @click="submit()">Añadir</v-btn>
                    </v-col>
                </v-row>
                <v-divider thickness="2" class="border-opacity-100 mx-10">Cuentas Registradas</v-divider>
                <v-row class="w-full justify-center px-2 mb-4 mt-5">
                    <div class="table-container ml-10 mr-2 mb-10 elevation-4 px-3">
                        <table class="w-100">
                            <thead>
                                <tr>
                                    <th class="text-center text-md pa-2 cellTitle">ID</th>
                                    <th class="text-center text-md pa-2 cellTitle">Descripcion</th>
                                    <th class="text-center text-md pa-2 cellTitle">Codigo</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="item in cuentasContables.list" :key="item.id" class="cellRow">
                                    <td class="text-center cellInnerField px-15 text-md">{{ item.id }}</td>
                                    <td class="text-center cellInnerField px-15 text-md">{{ item.descripcion }}</td>
                                    <td class="text-center cellInnerField px-15 text-md">{{ item.codigo }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </v-row>
            </v-form>

            <v-overlay :model-value="isLoading" class="align-center justify-center">
                <v-progress-circular
                    indeterminate
                    color="primary"
                    size="64"
                ></v-progress-circular>
            </v-overlay>
        </AppLayout>
    </template>
<script setup>
import { fastMsg, staticError } from '@/helpers';
import readXlsxFile from 'read-excel-file';
import AppLayout from '@/layouts/AppLayout.vue';
import { reset } from '@/routes/password';
import axios from 'axios';
import { ref, onMounted } from 'vue';

onMounted(async () => {
    await consultarCuentasContables();
});

const consultarCuentasContables = async () => {
    cuentasContables.value.list = [];
    const urlCuentasContables = '/api/cuentas_contables'
    const cuentasContablesResponse = await axios.get(urlCuentasContables)
    cuentasContables.value.list = cuentasContablesResponse.data.cuentas_contables
};

const cuentasContables = ref({
    list: []
});

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

const isLoading = ref(false);

const file = ref();

function resetForm() {
    formData.value = {
        codigo:"",
        descripcion:"",
    }

    file.value = null;
};

const submitAutoExcel = async () => {
    isLoading.value = true;
    const url = '/api/administrar/cuenta_contable/crear'
    const excelFile = file.value;
    console.log(excelFile);
    await readXlsxFile(excelFile).then(
       async (rows) => {
            console.log(rows.length, "cantidad de filas");
            for (let i = 0; i < rows.length; i++) {
                const fila = rows[i].length;
                for (let j = 0; j < fila; j++) {
                    if (j === 0) {
                        formData.value.descripcion = rows[i][j];
                    }
                    if (j === 1) {
                        formData.value.codigo = rows[i][j].toString();
                    }
                }
                try {
                    const response = await axios.post(url, formData.value);
                    console.log(response.data.msg);
                } catch (error) {
                    console.log(error);
                    staticError('Error al crear cuenta');
                }
            }
            resetForm();
            isLoading.value = false;
            fastMsg('Importación finalizada con éxito');
            consultarCuentasContables();
        }
    );
}



const submit = async () => {
    const url = '/api/administrar/cuenta_contable/crear'
    try {
        const response = await axios.post(url, formData.value);
        fastMsg(response.data.msg);
        resetForm();
        consultarCuentasContables();
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
    color: #ececec;
    font-size: medium;
}

table {
    border-collapse:separate;

    /* width: 100%; */ /* Se reemplaza por la clase w-100 de Vuetify */
    table-layout: fixed; /* Asegura que las columnas se distribuyan equitativamente */
}

td, th {
    border-top:solid black 1px;
}

th {
    border-top: none;
    position: sticky;
    top: 0;
    z-index: 1;
    background-color: var(--sidebar-background);
    color: var(--foreground);
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

.table-container {
    max-height: 400px; /* Puedes ajustar esta altura según tus necesidades */
    overflow-y: auto;
    width: 100%;
}

</style>
