<template>

    <Head title="Registrar" />
    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="d-flex">
            <v-row class="py-4 px-8">
                <v-col cols="12" >
                    <v-autocomplete label="Libro"
                    :items="bookTypes"
                    v-model="bookType"
                    return-object
                    item-title="name"
                    ></v-autocomplete>
                </v-col>
                <v-col cols="4">
                    <v-date-input v-model="registerDate" :display-format="format" label="Fecha"></v-date-input>
                </v-col>
                <v-col cols="8">
                    <v-autocomplete label="Nombre o Razon Social del cliente"
                        :items="clientsList"
                        item-title="descripcion"
                        return-object
                        v-model="formData.client"></v-autocomplete>
                </v-col>
                <v-col cols="2">
                    <v-text-field label="RIF" disabled v-model="formData.client.rif" ></v-text-field>
                </v-col>
                <v-col cols="3" >
                    <v-autocomplete label="Tipo de Documento"
                    :items="documentTypeList"
                    v-model="formData.documentType"
                    return-object
                    item-title="name"
                    ></v-autocomplete>
                </v-col>
                <v-col cols="3">
                    <v-text-field label="Registro Maquina Fiscal" v-model="maquina_fiscal"></v-text-field>
                </v-col>
                <v-col cols="2">
                    <v-text-field label="Primera Factura" v-model="primera_factura"></v-text-field>
                </v-col>
                <v-col cols="2">
                    <v-text-field label="Ultima Factura" v-model="ultima_factura"></v-text-field>
                </v-col>
                <v-col cols="3">
                    <v-text-field label="N° Factura (Compra, NC, ND)" v-model="numero_factura"></v-text-field>
                </v-col>
                <v-col cols="2">
                    <v-text-field label="Factura Afectada" v-model="factura_afectada"></v-text-field>
                </v-col>
                <v-col cols="3">
                    <v-text-field label="Total Ventas (con I.V.A)" v-model="total_ventas"></v-text-field>
                </v-col>
                <v-col cols="3">
                    <v-text-field label="Ventas Internas no Agravadas" v-model="total_ventas_no_gravadas"></v-text-field>
                </v-col>
                <v-col cols="12">
                    <v-radio-group inline>
                    <v-radio label="Contribuyente" value="one" @click="(expandContribuyentes = true) && (expandNoContribuyentes = false)" @focus="base_imponible_alic_no_contribuyente = null"></v-radio>
                    <v-radio label="No Contribuyente" value="two" @click="(expandNoContribuyentes = true) && (expandContribuyentes = false)" @focus="base_imponible_alic_contribuyente = null"></v-radio>
                    <v-radio label="No Aplica" value="three" @click="(expandNoContribuyentes = false) && (expandContribuyentes = false)" @focus="(base_imponible_alic_no_contribuyente = null) && (base_imponible_alic_contribuyente = null)"></v-radio>
                    </v-radio-group>

                    <div>
                    <v-expand-transition>
                        <v-row v-show="expandContribuyentes">
                            <v-col cols="4">
                                <v-text-field label="Base Imponible Alic (Gen - Contrib.)" v-model="base_imponible_alic_contribuyente"></v-text-field>
                            </v-col>
                            <v-col cols="2">
                                <v-text-field label="% I.V.A." v-model="ivaPercent" disabled></v-text-field>
                            </v-col>
                            <v-col cols="3">
                                <v-text-field label="Impuesto I.V.A. (Contrib.)" v-model="impuesto_iva" disabled></v-text-field>
                            </v-col>
                            <v-col cols="3">
                            <v-text-field label="Retencion I.V.A. Soportada" v-model="retencion_iva_soportada"></v-text-field>
                            </v-col>
                        </v-row>
                    </v-expand-transition>
                    </div>
                    <div>
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
                    </div>
                </v-col>
                <v-col cols="2" offset="10" @click="submit">
                    <v-btn>Registrar</v-btn>
                </v-col>
                <v-btn @click="prueba">probar</v-btn>
            </v-row>
        </div>
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

const clientsList = ref([]);
//const expand = ref(false)

const expandContribuyentes = ref(false);
const expandNoContribuyentes = ref(false);

const formData = ref({
    registerDate: '',
    client:{
        rif:'',
        id:'',
        descripcion: ''
    },
    documentType: '',
});

const bookTypes = ref([
    "Libro de Compras",
    "Libro de Ventas",
    "Libro de Inventario"
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

const maquina_fiscal = ref('');
const primera_factura = ref('');
const ultima_factura = ref('');
const numero_factura = ref('');
const factura_afectada = ref('');
const total_ventas = ref('');
const total_ventas_no_gravadas = ref('');
const base_imponible_alic_contribuyente = ref('');
const base_imponible_alic_no_contribuyente = ref('');
const ivaPercent = ref('16%');
const bookType = ref('');
//tienen que haber dos variables
//una para impuesto iva de contribuyentes, y otra para no contribuyentes
const impuesto_iva = computed (() => {
    if (base_imponible_alic_contribuyente.value > 0){
      return (0.16 * base_imponible_alic_contribuyente.value).toFixed(2);
    } else if (base_imponible_alic_no_contribuyente.value > 0){
        return (0.16 * base_imponible_alic_no_contribuyente.value).toFixed(2);
    } else {
        return null;
    }
});
///////////////////////////////////////////////////////////////////
const retencion_iva_soportada = ref('');

    const adapter = useDate()
    const registerDate = shallowRef(adapter);

  function format (date) {
    return adapter.toISO(date)
  }

const breadcrumbs = [
    {
        title: 'Registrar',
        href: registroLibroDiario().url,
    },
];

async function submit() {
    const urlmovimientos = '/api/crear/movimientos';
    await axios.post(urlmovimientos, {
    "movimientos":[
        {
        "fecha": registerDate.value.toISOString().slice(0,10),
        "cliente_id": formData.value.client.id,
        "tipo_documento": formData.value.documentType.name,
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
}).then(
    (response) => {
        console.log(response, "movimientos creado" );
    },
    ).catch(
        (error) => {
            console.log(error, "error al crear movimientos");
        }
    );
};

function prueba() {
    /*for (let index = 0; index < documentTypeList.value.length; index++) {
        const element = documentTypeList.value[index].name;
        console.log(element);
    }*/
    console.log (expandContribuyentes.value)
};


onMounted( async () => {
    //consultar clientes
    const urlClients = '/api/clientes';
    const clientsResponse = await axios.get(urlClients);
    clientsList.value = clientsResponse.data.clientes;
})
</script>
