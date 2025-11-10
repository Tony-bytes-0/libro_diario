<template>
    <Head title="Registrar" />
    <AppLayout :breadcrumbs="breadcrumbs">
        <v-form class="d-flex" @submit.prevent="submit">
            <v-row class="pt-6 px-5 align-center ma-1">
                <v-col cols="9">
                    <v-autocomplete label="Libro" :items="bookTypes" v-model="formData.bookType" return-object
                        item-title="name" :rules="[rules.required('Este campo es requerido')]" @update:model-value="resetDocumentType"></v-autocomplete>
                </v-col>
                <v-col cols="3">
                    <v-date-input v-model="formData.registerDate" :display-format="format" label="Fecha" prepend-icon="" autocomplete="off"
                        :rules="[rules.required('Este campo es requerido')]"></v-date-input>
                </v-col>
                <v-col cols="6">
                    <v-autocomplete label="Nombre o Razon Social del cliente" :items="clientsList"
                        item-title="descripcion" return-object v-model="formData.client"
                        :rules="[rules.required('Este campo es requerido')]"></v-autocomplete>
                </v-col>
                <v-col cols="3">
                    <v-text-field label="RIF" disabled v-model="formData.client.rif"></v-text-field>
                </v-col>
                <v-col cols="3">
                    <v-autocomplete label="Tipo de Documento" :items="documentTypeList" v-model="formData.documentType"
                        return-object item-title="name"
                        :rules="[rules.required('Este campo es requerido')]"></v-autocomplete>
                </v-col>
                <v-expand-transition>
                    <v-row class="px-6" v-show="showingConditions">
                        <v-row v-if="showRetencionIva">
                            <v-col cols="6">
                                <v-text-field label="N° Factura (Compra, NC, ND)"  v-model="formData.numero_factura"></v-text-field>
                            </v-col>
                            <v-col cols="6">
                                <v-text-field label="Factura Afectada" v-model="formData.factura_afectada"></v-text-field>
                            </v-col>

                            <v-col cols="4">
                                <v-text-field label="Base Imponible Alic (Gen - Contrib.)"
                                    :rules="[rules.number('Este campo utiliza numeros')]" type="number"
                                    v-model="formData.base_imponible_alic_contribuyente"></v-text-field>
                            </v-col>
                            <v-col cols="2">
                                <v-select label="% I.V.A." v-model="formData.porcentaje_iva" :items="[8, 16, 31]">
                                </v-select>
                            </v-col>
                            <v-col cols="2">
                                <v-text-field label="Impuesto I.V.A." disabled v-model="impuesto_iva_contribuyente"></v-text-field>
                            </v-col>
                            <v-col cols="2">
                                <v-select label="% Retencion" v-model="formData.porcentaje_retencion"
                                    :items="[75, 100]">
                                </v-select>
                            </v-col>
                            <v-col cols="2">
                                <v-text-field label="Monto retencion" v-model="impuesto_retencion_contribuyente"
                                    disabled></v-text-field>
                            </v-col>
                        </v-row>
                        <v-row v-if="showFacturaVentas">
                            <v-col cols="3">
                                <v-text-field label="Registro Maquina Fiscal" v-model="formData.maquina_fiscal"></v-text-field>
                            </v-col>
                            <v-col cols="2">
                                <v-text-field label="Primera Factura" v-model="formData.primera_factura"></v-text-field>
                            </v-col>
                            <v-col cols="2">
                                <v-text-field label="Ultima Factura"  v-model="formData.ultima_factura"></v-text-field>
                            </v-col>
                            <v-col cols="3">
                                <v-text-field label="N° Factura (Compra, NC, ND)"  v-model="formData.numero_factura"></v-text-field>
                            </v-col>
                            <v-col cols="2">
                                <v-text-field label="Factura Afectada" v-model="formData.factura_afectada"></v-text-field>
                            </v-col>
                            <v-col cols="3">
                                <v-text-field :rules="[rules.number('Este campo utiliza numeros')]" type="number"
                                    label="Total Ventas (con I.V.A)" v-model="formData.total_ventas"></v-text-field>
                            </v-col>
                            <v-col cols="3">
                                <v-text-field :rules="[rules.number('Este campo utiliza numeros')]" type="number"
                                    label="Ventas Internas no Agravadas" v-model="formData.total_ventas_no_gravadas"></v-text-field>
                            </v-col>
                            <v-col cols="12">
                                <v-radio-group inline>
                                    <v-radio label="Contribuyente" value="one"
                                        @click="(expandContribuyentes = true) && (expandNoContribuyentes = false)"
                                        @focus="(base_imponible_alic_no_contribuyente = '', formData.porcentaje_iva = '', formData.porcentaje_retencion = '')"></v-radio>
                                    <v-radio label="No Contribuyente" value="two"
                                        @click="(expandNoContribuyentes = true) && (expandContribuyentes = false)"
                                        @focus="(formData.base_imponible_alic_contribuyente = '', formData.porcentaje_iva = '', formData.porcentaje_retencion = '')"></v-radio>
                                    <v-radio label="No Aplica" value="three" @click="(expandNoContribuyentes = false) && (expandContribuyentes = false)" @focus="(base_imponible_alic_no_contribuyente = null) && (base_imponible_alic_contribuyente = null)"></v-radio>
                                </v-radio-group>
                                <v-expand-transition>
                                    <v-row v-show="expandContribuyentes">
                                        <v-col cols="3">
                                            <v-text-field label="Base Imponible Alic (Gen - Contrib.)"
                                                :rules="[rules.number('Este campo utiliza numeros')]" type="number"
                                                v-model="formData.base_imponible_alic_contribuyente"></v-text-field>
                                        </v-col>
                                        <v-col cols="2">
                                            <v-select label="% I.V.A." v-model="formData.porcentaje_iva"
                                                :items="[8, 16, 31]"></v-select>
                                        </v-col>
                                        <v-col cols="2">
                                            <v-text-field label="Impuesto I.V.A. (Contrib.)" disabled v-model="impuesto_iva_contribuyente"></v-text-field>
                                        </v-col>
                                        <v-col cols="2">
                                            <v-select label="% Retencion" v-model="formData.porcentaje_retencion"
                                                :items="[75, 100]"></v-select>
                                        </v-col>
                                        <v-col cols="2">
                                            <v-text-field label="Monto retencion" v-model="impuesto_retencion_contribuyente"
                                                disabled></v-text-field>
                                        </v-col>
                                    </v-row>
                                </v-expand-transition>


                                <v-expand-transition>
                                    <v-row v-show="expandNoContribuyentes">
                                        <v-col cols="4">
                                            <v-text-field label="Base Imponible Alic (Gen - No Contrib.)"
                                                v-model="formData.base_imponible_alic_no_contribuyente"></v-text-field>
                                        </v-col>
                                        <v-col cols="2">
                                            <v-select label="% I.V.A." v-model="formData.porcentaje_iva"
                                                :items="[8, 16, 31]"></v-select>
                                        </v-col>
                                        <v-col cols="3">
                                            <v-text-field label="Impuesto I.V.A. (No Contrib.)" v-model="impuesto_iva_no_contribuyente"
                                                disabled></v-text-field>
                                        </v-col>
                                        <v-col cols="2">
                                            <v-select label="% Retencion" v-model="formData.porcentaje_retencion"
                                                :items="[75, 100]"></v-select>
                                        </v-col>
                                        <v-col cols="2">
                                            <v-text-field label="Monto retencion" v-model="impuesto_retencion_no_contribuyente"
                                                disabled></v-text-field>
                                        </v-col>
                                    </v-row>
                                </v-expand-transition>
                            </v-col>
                        </v-row>
                        <v-row v-if="showFacturaCompras">
                            <v-col cols="3">
                                <v-text-field label="N° Factura (Compra, NC, ND)"  v-model="formData.numero_factura"></v-text-field>
                            </v-col>
                            <v-col cols="2">
                                <v-text-field label="Factura Afectada" v-model="formData.factura_afectada"></v-text-field>
                            </v-col>
                            <v-col cols="3">
                                <v-text-field :rules="[rules.number('Este campo utiliza numeros')]" type="number"
                                    label="Total Ventas (con I.V.A)" v-model="formData.total_ventas"></v-text-field>
                            </v-col>
                            <v-col cols="3">
                                <v-text-field :rules="[rules.number('Este campo utiliza numeros')]" type="number"
                                    label="Ventas Internas no Agravadas" v-model="formData.total_ventas_no_gravadas"></v-text-field>
                            </v-col>
                            <v-col cols="12">
                                <v-radio-group inline>
                                    <v-radio label="Aplica Retencion" value="one"
                                        @click="(expandContribuyentes = true) && (expandNoContribuyentes = false)"
                                        @focus="(base_imponible_alic_no_contribuyente = '', formData.porcentaje_iva = '', formData.porcentaje_retencion = '')"></v-radio>
                                    <v-radio label="No Aplica Retencion" value="two"
                                        @click="(expandNoContribuyentes = true) && (expandContribuyentes = false)"
                                        @focus="(formData.base_imponible_alic_contribuyente = '', formData.porcentaje_iva = '', formData.porcentaje_retencion = '')"></v-radio>
                                </v-radio-group>
                                <v-expand-transition>
                                    <v-row v-show="expandContribuyentes">
                                        <v-col cols="4">
                                            <v-text-field label="Base Imponible Alic (Gen - Contrib.)"
                                                :rules="[rules.number('Este campo utiliza numeros')]" type="number"
                                                v-model="formData.base_imponible_alic_contribuyente"></v-text-field>
                                        </v-col>
                                        <v-col cols="2">
                                            <v-select label="% I.V.A." v-model="formData.porcentaje_iva"
                                                :items="[8, 16, 31]"></v-select>
                                        </v-col>
                                        <v-col cols="2">
                                            <v-text-field label="Impuesto I.V.A." disabled v-model="impuesto_iva_contribuyente"></v-text-field>
                                        </v-col>
                                        <v-col cols="2">
                                            <v-select label="% Retencion" v-model="formData.porcentaje_retencion"
                                                :items="[75, 100]"></v-select>
                                        </v-col>
                                        <v-col cols="2">
                                            <v-text-field label="Monto retencion" v-model="impuesto_retencion_contribuyente"
                                                disabled></v-text-field>
                                        </v-col>
                                        <v-col cols="12">
                                            <v-text-field label="Comprobante de Retencion" v-model="formData.ComprobanteRetencionCompra"
                                            ></v-text-field>
                                        </v-col>
                                    </v-row>
                                </v-expand-transition>
                                <v-expand-transition>
                                    <v-row v-show="expandNoContribuyentes">
                                        <v-col cols="4">
                                            <v-text-field label="Base Imponible Alic (Gen - No Contrib.)"
                                                v-model="formData.base_imponible_alic_no_contribuyente"></v-text-field>
                                        </v-col>
                                        <v-col cols="4">
                                            <v-select label="% I.V.A." v-model="formData.porcentaje_iva"
                                                :items="[8, 16, 31]"></v-select>
                                        </v-col>
                                        <v-col cols="4">
                                            <v-text-field label="Impuesto I.V.A. (No Contrib.)" v-model="impuesto_iva_no_contribuyente"
                                                disabled></v-text-field>
                                        </v-col>
                                    </v-row>
                                </v-expand-transition>
                            </v-col>
                        </v-row>
                    </v-row>

                    <!--v-row class="px-3" v-show="showingConditions">
                        <v-col cols="3">
                            <v-text-field label="Registro Maquina Fiscal" v-model="formData.maquina_fiscal"></v-text-field>
                        </v-col>
                        <v-col cols="2">
                            <v-text-field label="Primera Factura" v-model="formData.primera_factura"></v-text-field>
                        </v-col>
                        <v-col cols="2">
                            <v-text-field label="Ultima Factura"  v-model="formData.ultima_factura"></v-text-field>
                        </v-col>
                        <v-col cols="3">
                            <v-text-field label="N° Factura (Compra, NC, ND)"  v-model="formData.numero_factura"></v-text-field>
                        </v-col>
                        <v-col cols="2">
                            <v-text-field label="Factura Afectada" v-model="formData.factura_afectada"></v-text-field>
                        </v-col>
                        <v-col cols="3">
                            <v-text-field :rules="[rules.number('Este campo utiliza numeros')]" type="number"
                                label="Total Ventas (con I.V.A)" v-model="formData.total_ventas"></v-text-field>
                        </v-col>
                        <v-col cols="3">
                            <v-text-field :rules="[rules.number('Este campo utiliza numeros')]" type="number"
                                label="Ventas Internas no Agravadas" v-model="formData.total_ventas_no_gravadas"></v-text-field>
                        </v-col>
                        <v-col cols="12">
                            <v-radio-group inline>
                                <v-radio label="Contribuyente" value="one"
                                    @click="(expandContribuyentes = true) && (expandNoContribuyentes = false)"
                                    @focus="base_imponible_alic_no_contribuyente = null"></v-radio>
                                <v-radio label="No Contribuyente" value="two"
                                    @click="(expandNoContribuyentes = true) && (expandContribuyentes = false)"
                                    @focus="formData.base_imponible_alic_contribuyente = null"></v-radio>
                                <v-radio label="No Aplica" value="three" @click="(expandNoContribuyentes = false) && (expandContribuyentes = false)" @focus="(base_imponible_alic_no_contribuyente = null) && (base_imponible_alic_contribuyente = null)"></v-radio>
                            </v-radio-group>
                            <v-expand-transition>
                                <v-row v-show="expandContribuyentes">
                                    <v-col cols="3">
                                        <v-text-field label="Base Imponible Alic (Gen - Contrib.)"
                                            :rules="[rules.number('Este campo utiliza numeros')]" type="number"
                                            v-model="formData.base_imponible_alic_contribuyente"></v-text-field>
                                    </v-col>
                                    <v-col cols="2">
                                        <v-select label="% I.V.A." v-model="formData.porcentaje_iva"
                                            :items="[8, 16, 31]"></v-select>
                                    </v-col>
                                    <v-col cols="2">
                                        <v-text-field label="Impuesto I.V.A." disabled v-model="impuesto_iva_contribuyente"></v-text-field>
                                    </v-col>
                                    <v-col cols="2">
                                        <v-select label="% Retencion" v-model="formData.porcentaje_retencion"
                                            :items="[75, 100]"></v-select>
                                    </v-col>
                                    <v-col cols="2">
                                        <v-text-field label="Monto retencion" v-model="impuesto_retencion_contribuyente"
                                            disabled></v-text-field>
                                    </v-col>
                                </v-row>
                            </v-expand-transition>


                            <v-expand-transition>
                                <v-row v-show="expandNoContribuyentes">
                                    <v-col cols="4">
                                        <v-text-field label="Base Imponible Alic (Gen - No Contrib.)"
                                            v-model="formData.base_imponible_alic_no_contribuyente"></v-text-field>
                                    </v-col>
                                    <v-col cols="2">
                                        <v-text-field label="% I.V.A." v-model="formData.ivaPercent" disabled></v-text-field>
                                    </v-col>
                                    <v-col cols="3">
                                        <v-text-field label="Impuesto I.V.A. (No Contrib.)" v-model="impuesto_iva_no_contribuyente"
                                            disabled></v-text-field>
                                    </v-col>
                                    <v-col cols="2">
                                        <v-select label="% Retencion" v-model="formData.porcentaje_retencion"
                                            :items="[75, 100]"></v-select>
                                    </v-col>
                                    <v-col cols="2">
                                        <v-text-field label="Monto retencion" v-model="impuesto_retencion_no_contribuyente"
                                            disabled></v-text-field>
                                    </v-col>
                                </v-row>
                            </v-expand-transition>
                        </v-col>
                    </v-row-->
                </v-expand-transition>
                <v-col cols="2" offset="10" @click="submit()" class="mb-5">
                    <v-btn :disabled="registerDisabled" type="submit">Registrar</v-btn>
                </v-col>
            </v-row>
        </v-form>
        <v-btn @click="prueba">prueba</v-btn>
    </AppLayout>
</template>

<script setup>
import AppLayout from '@/layouts/AppLayout.vue';
import { registroLibroDiario } from '@/routes';
//import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/vue3';
import axios from 'axios';
import {computed, ref, onMounted } from 'vue';
import { VDateInput } from 'vuetify/labs/VDateInput';
import { useDate } from 'vuetify';
import Swal from "sweetalert2";
import { useRules } from 'vuetify/labs/rules'

const rules = useRules();

const clientsList = ref([]);

const expandContribuyentes = ref(false);
const expandNoContribuyentes = ref(false);

const showRetencionIva = ref(false);
const ShowReporteZ = ref(false);
const showNotadeCredito = ref(false);
const showNotadeDebito = ref(false);
const showFacturaCompras = ref(false);
const showFacturaVentas = ref(false);

/*const displayElements = ref({
    maquina_fiscal: false,
    primera_factura: false,
    ultima_factura: false,
    numero_factura: false,
    factura_afectada: false,
    total_ventas: false,
    total_ventas_no_gravadas: false,
    base_imponible_alic_contribuyente: false,
    base_imponible_alic_no_contribuyente: false,
    porcentaje_iva: false,
    porcentaje_retencion: false,
    retencion_iva_soportada: false,
})*/

const formData = ref({
    client: {
        rif: '',
        id: '',
        descripcion: ''
    },
    registerDate: '',
    bookType: '',
    documentType: {
      synonym:'',
      name:''
    },
    maquina_fiscal: '',
    primera_factura: '',
    ultima_factura: '',
    numero_factura: '',
    factura_afectada: '',
    total_ventas: '',
    total_ventas_no_gravadas: '',
    base_imponible_alic_contribuyente: '',
    base_imponible_alic_no_contribuyente: '',
    porcentaje_iva: '',
    porcentaje_retencion: '',
    retencion_iva_soportada: '',

    ComprobanteRetencionCompra:''
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
        name: 'Retención de IVA'
    },
    {
        synonym: 'Z',
        name: 'Reporte Z'
    },
    {
        synonym: 'NCD',
        name: 'Nota de Credito'
    },
    {
        synonym: 'NDT',
        name: 'Nota de Debito'
    }
]);


//tienen que haber dos variables
//una para impuesto iva de contribuyentes, y otra para no contribuyentes
//no exactamente, nunca se usan ambas
const impuesto_iva_contribuyente = computed(() => {
    if (formData.value.base_imponible_alic_contribuyente > 0 ) {
        const porcentaje = formData.value.porcentaje_iva;
        const base_imponible = formData.value.base_imponible_alic_contribuyente;
        const result = (base_imponible * porcentaje) / 100
        return result.toFixed(2);
    } else {
        return 0;
    }
});

const impuesto_retencion_contribuyente = computed(() => {
    if (impuesto_iva_contribuyente.value > 0 || formData.value.porcentaje_retencion !== null || formData.value.porcentaje_retencion !== ''){
        const porcentaje = formData.value.porcentaje_retencion
        const base = impuesto_iva_contribuyente.value
        const result = (base * porcentaje) / 100;
        return result.toFixed(2);
    } else {
        return 0;
    }
});

const impuesto_iva_no_contribuyente = computed(() => {
    if (impuesto_iva_contribuyente.value > 0 || formData.value.porcentaje_retencion !== null || formData.value.porcentaje_retencion !== '') {
        const porcentaje = formData.value.porcentaje_iva;
        const base_imponible = formData.value.base_imponible_alic_no_contribuyente;
        const result = (base_imponible * porcentaje) / 100
        return result.toFixed(2);
    } else {
        return 0;
    }
})

const impuesto_retencion_no_contribuyente = computed(() => {
    return 200;
})


///////////////////////////////////////////////////////////////////
const adapter = useDate();
//const registerDate = shallowRef(null);

function format(date) {
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
            rif: '',
            id: '',
            descripcion: ''
        },
        registerDate: '',
        bookType: '',
        documentType: {
            synonym: '',
            name: ''
        },
        maquina_fiscal: '',
        primera_factura: '',
        ultima_factura: '',
        numero_factura: '',
        factura_afectada: '',
        total_ventas: '',
        total_ventas_no_gravadas: '',
        base_imponible_alic_contribuyente: '',
        base_imponible_alic_no_contribuyente: '',
        retencion_iva_soportada: '',
    }
}

function resetDocumentType () {
    formData.value.documentType = {
        synonym: '',
        name: ''
    }
};


const showingConditions = computed(() => {
    if(formData.value.bookType === "libro de ventas" && formData.value.documentType.name === "Factura"){
        showRetencionIva.value = false;
        ShowReporteZ.value = false;
        showNotadeCredito.value = false;
        showNotadeDebito.value = false;
        showFacturaCompras.value = false;
        showFacturaVentas.value = true;
        return true;
    } else {
        if (formData.value.bookType === "libro de ventas" && formData.value.documentType.name === "Retención de IVA") {
            ShowReporteZ.value = false;
            showNotadeCredito.value = false;
            showNotadeDebito.value = false;
            showFacturaCompras.value = false;
            showFacturaVentas.value = false;
            showRetencionIva.value = true;
            return true;
        } else {
            if(formData.value.bookType === "libro de ventas" && formData.value.documentType.name === "Reporte Z"){
                showNotadeCredito.value = false;
                showNotadeDebito.value = false;
                showFacturaCompras.value = false;
                showFacturaVentas.value = false;
                showRetencionIva.value = false;
                ShowReporteZ.value = true;
                return true;
            } else {
                if (formData.value.bookType === "libro de ventas" && formData.value.documentType.name === "Nota de Credito"){
                    showNotadeDebito.value = false;
                    showFacturaCompras.value = false;
                    showFacturaVentas.value = false;
                    showRetencionIva.value = false;
                    ShowReporteZ.value = false;
                    showNotadeCredito.value = true;
                    return true;
                } else {
                    if(formData.value.bookType === "libro de ventas" && formData.value.documentType.name === "Nota de Debito"){
                        showFacturaCompras.value = false;
                        showFacturaVentas.value = false;
                        showRetencionIva.value = false;
                        ShowReporteZ.value = false;
                        showNotadeCredito.value = false;
                        showNotadeDebito.value = true;
                        return true;
                    } else {
                        if (formData.value.bookType === "libro de compras" && formData.value.documentType.name === "Factura"){
                            showFacturaVentas.value = false;
                            showRetencionIva.value = false;
                            ShowReporteZ.value = false;
                            showNotadeCredito.value = false;
                            showNotadeDebito.value = false;
                            showFacturaCompras.value = true;
                            return true;
                        } else {
                            showFacturaCompras.value = false;
                            showFacturaVentas.value = false;
                            showRetencionIva.value = false;
                            ShowReporteZ.value = false;
                            showNotadeCredito.value = false;
                            showNotadeDebito.value = false;
                            return false;
                        }
                    }
                }
            }
        }
    }
});

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
            let impuesto_iva = 0
            let impuesto_retencion = 0
            if(expandContribuyentes.value){
                //impuesto_iva = impuesto_iva_contribuyente;
                //impuesto_retencion = impuesto_retencion_contribuyente
            }
            else if(expandNoContribuyentes.value){
                //impuesto_iva = impuesto_iva_no_contribuyente;
                //impuesto_retencion = impuesto_retencion_no_contribuyente;
            }
            await axios.post(urlmovimientos, {
                "movimientos": [{
                    "fecha": formData.value.registerDate.toISOString().slice(0, 10),
                    "cliente_id": formData.value.client.id,
                    "tipo_documento": formData.value.documentType.name,
                    "maquina_fiscal": formData.value.maquina_fiscal,
                    "primera_factura": formData.value.primera_factura,
                    "ultima_factura": formData.value.ultima_factura,
                    "numero_factura": formData.value.numero_factura,
                    "factura_afectada": formData.value.factura_afectada,
                    "total_ventas": formData.value.total_ventas,
                    "total_ventas_no_gravadas": formData.value.total_ventas_no_gravadas,
                    "base_imponible_alic_contribuyente": formData.value.base_imponible_alic_contribuyente,
                    "porcentaje_iva_aplicado": formData.value.porcentaje_iva,
                    "porcentaje_retencion_aplicado": formData.value.porcentaje_retencion,
                    "base_imponible_alic_no_contribuyente": formData.value.base_imponible_alic_no_contribuyente,
                    //dependiendo si es contribuyente o no, pasar la variable correcpondiente
                    //ver operadores condicionales ternarios
                    "impuesto_iva": expandContribuyentes.value ?
                    impuesto_iva_contribuyente.value :
                    impuesto_iva_no_contribuyente.value,
                    "retencion_iva_soportada": expandContribuyentes.value ?
                    impuesto_retencion_contribuyente.value :
                    impuesto_retencion_no_contribuyente.value,
                    "contribuyente": expandContribuyentes.value
                }],
                "libro_movimiento": {
                    "tipo_documento": formData.value.bookType,
                    "rif": formData.value.client.rif,
                    "descripcion": formData.value.client.descripcion,
                    "periodo": formData.value.registerDate.toISOString().slice(0, 10),
                }
            }).then((response) => {
                console.log(response, "movimientos creado");

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
    /* //bypass para pruebas
    if ((formData.value.documentType.value !== null) && (formData.value.registerDate !== null) && (formData.value.bookType.value !== null) && (formData.value.client.id !== null)) {
        return false;
    } else {
        return true;
    }
    */
       return false
});


function prueba() {
    console.log(formData.value.porcentaje_iva);
    console.log(formData.value.porcentaje_retencion);
};

onMounted(async () => {
    //consultar clientes
    const urlClients = '/api/clientes';
    const clientsResponse = await axios.get(urlClients);
    clientsList.value = clientsResponse.data.clientes;
})
</script>
