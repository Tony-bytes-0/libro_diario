<template>

    <Head title="Registrar" />
    <AppLayout :breadcrumbs="breadcrumbs">
        <v-form class="d-flex" @submit.prevent="submit" >
            <v-row class="pt-6 px-8 align-center ma-1">
                <v-col cols="12">
                    <v-autocomplete label="Libro"
                    :items="bookTypes"
                    v-model="bookType"
                    return-object
                    item-title="name"
                    :rules="[rules.required('Este campo es requerido')]"
                    ></v-autocomplete>
                </v-col>
                <v-col cols="4">
                    <v-date-input v-model="registerDate" :display-format="format" label="Fecha" prepend-icon=""
                    :rules="[rules.required('Este campo es requerido')]"></v-date-input>
                </v-col>
                <v-col cols="8">
                    <v-autocomplete label="Nombre o Razon Social del cliente"
                        :items="clientsList"
                        item-title="descripcion"
                        return-object
                        v-model="formData.client"
                        :rules="[rules.required('Este campo es requerido')]"
                        ></v-autocomplete>
                </v-col>
                <v-col cols="2">
                    <v-text-field label="RIF" disabled v-model="formData.client.rif" ></v-text-field>
                </v-col>
                <v-col cols="3" >
                    <v-autocomplete label="Tipo de Documento"
                    :items="documentTypeList"
                    v-model="documentType"
                    return-object
                    item-title="name"
                    :rules="[rules.required('Este campo es requerido')]"
                    ></v-autocomplete>
                </v-col>
                <v-col cols="3">
                    <v-text-field label="Registro Maquina Fiscal" v-model="maquina_fiscal"></v-text-field>
                </v-col>
                <v-col cols="2">
                    <v-text-field :rules="[rules.number('Este campo utiliza numeros')]" type="number" label="Primera Factura" v-model="primera_factura"></v-text-field>
                </v-col>
                <v-col cols="2">
                    <v-text-field :rules="[rules.number('Este campo utiliza numeros')]" type="number" label="Ultima Factura" v-model="ultima_factura"></v-text-field>
                </v-col>
                <v-col cols="3">
                    <v-text-field :rules="[rules.number('Este campo utiliza numeros')]" type="number" label="N° Factura (Compra, NC, ND)" v-model="numero_factura"></v-text-field>
                </v-col>
                <v-col cols="2">
                    <v-text-field :rules="[rules.number('Este campo utiliza numeros')]" type="number" label="Factura Afectada" v-model="factura_afectada"></v-text-field>
                </v-col>
                <v-col cols="3">
                    <v-text-field :rules="[rules.number('Este campo utiliza numeros')]" type="number" label="Total Ventas (con I.V.A)" v-model="total_ventas"></v-text-field>
                </v-col>
                <v-col cols="3">
                    <v-text-field :rules="[rules.number('Este campo utiliza numeros')]" type="number" label="Ventas Internas no Agravadas" v-model="total_ventas_no_gravadas"></v-text-field>
                </v-col>
                <v-col cols="12">
                    <v-radio-group inline>
                    <v-radio label="Contribuyente" value="one" @click="(expandContribuyentes = true) && (expandNoContribuyentes = false)" @focus="base_imponible_alic_no_contribuyente = null"></v-radio>
                    <v-radio label="No Contribuyente" value="two" @click="(expandNoContribuyentes = true) && (expandContribuyentes = false)" @focus="base_imponible_alic_contribuyente = null"></v-radio>
                    <v-radio label="No Aplica" value="three" @click="(expandNoContribuyentes = false) && (expandContribuyentes = false)" @focus="(base_imponible_alic_no_contribuyente = null) && (base_imponible_alic_contribuyente = null)"></v-radio>
                    </v-radio-group>
                        <v-expand-transition>
                            <v-row v-show="expandContribuyentes">
                                <v-col cols="4">
                                    <v-text-field label="Base Imponible Alic (Gen - Contrib.)" :rules="[rules.number('Este campo utiliza numeros')]" type="number" v-model="base_imponible_alic_contribuyente"></v-text-field>
                                </v-col>
                                <v-col cols="2">
                                    <v-text-field label="% I.V.A." v-model="ivaPercent" disabled></v-text-field>
                                </v-col>
                                <v-col cols="3">
                                    <v-text-field label="Impuesto I.V.A. (Contrib.)" v-model="impuesto_iva" disabled></v-text-field>
                                </v-col>
                                <v-col cols="3">
                                <v-text-field label="Retencion I.V.A. Soportada" v-model="retencion_iva_soportada" :disabled="retencionIvaComputed"></v-text-field>
                                </v-col>
                            </v-row>
                        </v-expand-transition>


                        <v-expand-transition>
                            <v-row v-show="expandNoContribuyentes">
                                <v-col cols="4">
                                <v-text-field label="Base Imponible Alic (Gen - No Contrib.)" v-model="base_imponible_alic_no_contribuyente"></v-text-field>
                                </v-col>
                                <v-col cols="2">
                                    <v-text-field label="% I.V.A." v-model="ivaPercent" disabled></v-text-field>
                                </v-col>
                                <v-col cols="3">
                                    <v-text-field label="Impuesto I.V.A. (No Contrib.)" v-model="impuesto_iva" disabled></v-text-field>
                                </v-col>
                                <v-col cols="3">
                                <v-text-field label="Retencion I.V.A. Soportada" v-model="retencion_iva_soportada"></v-text-field>
                                </v-col>
                            </v-row>
                        </v-expand-transition>

                </v-col>
                <v-col cols="2" offset="10" @click="submit" class="mb-5">
                    <v-btn :disabled="registerDisabled" type="submit" >Registrar</v-btn>
                </v-col>
            </v-row>
        </v-form>
        <!--v-btn @click="prueba">prueba</v-btn-->
    </AppLayout>
</template>

<script setup>
import AppLayout from '@/layouts/AppLayout.vue';
import { registroLibroDiario } from '@/routes';
//import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/vue3';
import axios from 'axios';
import { shallowRef, computed, ref, onMounted } from 'vue';
import { VDateInput } from 'vuetify/labs/VDateInput';
import { useDate } from 'vuetify';
import Swal from "sweetalert2";
import { useRules } from 'vuetify/labs/rules'

const rules = useRules();

const clientsList = ref([]);

const expandContribuyentes = ref(false);
const expandNoContribuyentes = ref(false);

const formData = ref({
    client:{
        rif:null,
        id:null,
        descripcion: null
    },
});

const bookTypes = ref([
    "libro de compras",
    "libro de ventas",
    "libro de inventario"
]
);

const documentTypeList = ref([
    {
        synonym: 'FACT',
        name: 'Factura'
    },
    {
        synonym: 'RIVA',
        name: 'Retención de I.V.A.'
    },
    {
        synonym: 'Z',
        name: 'Reporte Z'
    },
    {
        synonym: 'NCD',
        name: 'Nota de crédito'
    }
]);

const documentType = ref(null);
const maquina_fiscal = ref(null);
const primera_factura = ref(null);
const ultima_factura = ref(null);
const numero_factura = ref(null);
const factura_afectada = ref(null);
const total_ventas = ref(null);
const total_ventas_no_gravadas = ref(null);
const base_imponible_alic_contribuyente = ref(null);
const base_imponible_alic_no_contribuyente = ref(null);
const ivaPercent = ref('16%');
const bookType = ref(null);
const retencion_iva_soportada = ref(null);
//tienen que haber dos variables
//una para impuesto iva de contribuyentes, y otra para no contribuyentes
const impuesto_iva = computed (() => {
    if (base_imponible_alic_contribuyente.value > 0 || base_imponible_alic_contribuyente.value < 0 ){
      return (0.16 * base_imponible_alic_contribuyente.value).toFixed(2);
    } else if (base_imponible_alic_no_contribuyente.value > 0){
        return (0.16 * base_imponible_alic_no_contribuyente.value).toFixed(2);
    } else {
        return null;
    }
});

const retencionIvaComputed = computed(() => {
    if (base_imponible_alic_contribuyente.value !== null || base_imponible_alic_no_contribuyente.value !== null){
        return true;
    } else if (base_imponible_alic_contribuyente.value === '' || base_imponible_alic_no_contribuyente.value === ''){
        return true;
    } else {
        return false;
    }
});


///////////////////////////////////////////////////////////////////
const adapter = useDate();
const registerDate = shallowRef(null);

  function format (date) {
    return adapter.toISO(date)
  };

const breadcrumbs = [
    {
        title: 'Registrar',
        href: registroLibroDiario().url,
    },
];

const resetFormData = () => {//limpiar formulario
    formData.value = {
        client: {
            rif: null,
            id: null,
            descripcion: null
        },

    }
    registerDate.value = null;
    bookType.value = null;
    documentType.value = null;
    maquina_fiscal.value = null;
    primera_factura.value = null;
    ultima_factura.value = null;
    numero_factura.value = null;
    factura_afectada.value = null;
    total_ventas.value = null;
    total_ventas_no_gravadas.value = null;
    base_imponible_alic_contribuyente.value = null;
    base_imponible_alic_no_contribuyente.value = null;
    retencion_iva_soportada.value = null;
    expandContribuyentes.value = false;
    expandNoContribuyentes.value = false;
}

async function submit() {
    const urlmovimientos = '/api/crear/movimientos';
    console.log('al hacer submit, formdata: ', formData.value)
    Swal.fire({
            theme: 'auto',
            icon: "question",
            title: `¿Esta seguro de guardar estos registros?`,
            text: "Asegurese antes de guardar",
            showCancelButton: true,
            cancelButtonText: "Verificar",
            showConfirmButton: true,
            confirmButtonText: "Confirmar",
            confirmButtonColor: "#00A603",
            allowOutsideClick: false,
        }).then(async (result) => {
            if (result.isConfirmed) {
                await axios.post(urlmovimientos, {
                    "movimientos":[{
                        "fecha": registerDate.value.toISOString().slice(0,10),
                        "cliente_id": formData.value.client.id,
                        "tipo_documento": documentType.value.name,
                        "maquina_fiscal": maquina_fiscal.value,
                        "primera_factura": primera_factura.value,
                        "ultima_factura": ultima_factura.value,
                        "numero_factura": numero_factura.value,
                        "factura_afectada": factura_afectada.value,
                        "total_ventas": total_ventas.value,
                        "total_ventas_no_gravadas": total_ventas_no_gravadas.value,
                        "base_imponible_alic_contribuyente": base_imponible_alic_contribuyente.value,
                        "base_imponible_alic_no_contribuyente": base_imponible_alic_no_contribuyente.value,
                        "impuesto_iva": impuesto_iva.value,
                        "retencion_iva_soportada": retencion_iva_soportada.value
                    }],
                    "libro_movimiento": {
                        "tipo_documento": bookType.value,
                        "rif": formData.value.client.rif,
                        "descripcion": formData.value.client.descripcion,
                        "periodo": registerDate.value.toISOString().slice(0,10),
                    }
                }).then((response) => {
                    console.log(response, "movimientos creado" );

                });
                Swal.fire({
                    theme: 'auto',
                    icon: "success",
                    title: `¡Registro Exitoso!`,
                    text: "¡Los registros han sido creados con exito!",
                    showConfirmButton: true,
                    confirmButtonText: "Confirmar",
                    confirmButtonColor: "#00A603",
                    allowOutsideClick: false
                }).then(() => {
                    resetFormData()
                    //no recargar la pagina
                    /*
                    if (result.isConfirmed) {
                        window.location.href = "http://localhost:8000/reportes/libro/ventas";
                    }
                    */
                });
            }
        });
};

const registerDisabled = computed(() => {
    if ((documentType.value !== null) && (registerDate.value !== null) && (bookType.value !== null) && (formData.value.client.id !== null)) {
        return false;
    } else {
        return true;
    }
});


/*function prueba() {
    console.log(documentType.value.name); console.log(registerDate.value);  console.log(bookType.value); console.log(formData.value.client.id);
    };*/

onMounted( async () => {
    //consultar clientes
    const urlClients = '/api/clientes';
    const clientsResponse = await axios.get(urlClients);
    clientsList.value = clientsResponse.data.clientes;
})
</script>
