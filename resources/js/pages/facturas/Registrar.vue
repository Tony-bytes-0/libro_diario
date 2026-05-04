<script setup>
import { ref, onMounted } from 'vue';
import { Head, useForm } from '@inertiajs/vue3';
import AppLayout from '@/layouts/AppLayout.vue';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
//import { Select, SelectContent, SelectItem, SelectTrigger, SelectValue } from '@/components/ui/select';
import { PlusCircle, Trash2, Save } from 'lucide-vue-next';

const props = defineProps({
    clientes: {
        type: Array,
        required: true,
    }
});

const formData = ref({
    items: [

    ]
});


const resetForm = () => {
    formData.value = {
        items: [
        ],
    };
};

const addItem = () => {
    formData.value.items.push({
        tipo: 'venta',
        fecha: new Date().toISOString().split('T')[0],
        cliente_id: '',
        numero_factura: '',
        numero_control: '',
        base_imponible: 0,
        porcentaje_iva: 16,
        impuesto_iva: 0,
        total_ventas: 0,
    });
};

const removeLine = (index) => {
    if (formData.value.items.length > 1) {
        formData.value.items.splice(index, 1);
    }
};

const calculateTotals = (index) => {
    const item = formData.value.facturas[index];
    const base = parseFloat(item.base_imponible) || 0;
    const iva = parseFloat(item.porcentaje_iva) || 0;

    item.impuesto_iva = (base * (iva / 100)).toFixed(2);
    item.total_ventas = (base + parseFloat(item.impuesto_iva)).toFixed(2);
};

const submit = () => {
    axios.post('/facturas/registrar', formData.value).then(() => {
        formData.reset();
    }).catch((error) => {
        console.log(error);
    });
    /*
    formData.value.post('/facturas/registrar', {
        preserveScroll: true,
        onSuccess: () => {
            formData.reset();
            // Restablecer a una línea vacía después de guardar
            formData.facturas = [{
                tipo: 'venta',
                fecha: new Date().toISOString().split('T')[0],
                cliente_id: '',
                numero_factura: '',
                numero_control: '',
                base_imponible: 0,
                porcentaje_iva: 16,
                impuesto_iva: 0,
                total_ventas: 0,
            }];
        },
    });
    */
};

const breadcrumbs = [
    { title: 'Dashboard', href: '/dashboard' },
    { title: 'Facturas', href: '#' },
    { title: 'Registrar', href: '/facturas/registrar' },
];
</script>

<template>
    <AppLayout :breadcrumbs="breadcrumbs">

        <Head title="Registrar Facturas" />

        <div class="flex flex-col gap-6 p-4">
            <div class="flex justify-between items-center">
                <h1 class="text-2xl font-bold">Registro Múltiple de Facturas</h1>
            </div>

            <form @submit.prevent="submit" class="bg-card text-card-foreground shadow-sm rounded-xl border p-6">

                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left">
                        <thead class="text-xs uppercase bg-muted/50 border-b">
                            <tr>
                                <th class="px-4 py-3">Tipo</th>
                                <th class="px-4 py-3">Fecha</th>
                                <th class="px-4 py-3 min-w-[200px]">Cliente/Prov.</th>
                                <th class="px-4 py-3">N° Factura</th>
                                <th class="px-4 py-3">N° Control</th>
                                <th class="px-4 py-3">Base Imponible</th>
                                <th class="px-4 py-3">% IVA</th>
                                <th class="px-4 py-3">Monto IVA</th>
                                <th class="px-4 py-3">Total</th>
                                <th class="px-4 py-3">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(item, index) in formData.items" :key="index" class="border-b">
                                <td class="px-2 py-2">
                                    <select v-model="item.tipo"
                                        class="flex h-10 w-full items-center justify-between rounded-md border border-input bg-background px-3 py-2 text-sm">
                                        <option value="venta">Venta</option>
                                        <option value="compra">Compra</option>
                                    </select>
                                </td>
                                <td class="px-2 py-2">
                                    <Input type="date" v-model="item.fecha" required />
                                </td>
                                <td class="px-2 py-2">
                                    <select v-model="item.cliente_id"
                                        class="flex h-10 w-full items-center justify-between rounded-md border border-input bg-background px-3 py-2 text-sm"
                                        required>
                                        <option value="" disabled>Seleccione...</option>
                                        <option v-for="cliente in clientes" :key="cliente.id" :value="cliente.id">
                                            {{ cliente.nombre_razon_social || cliente.nombre }} ({{ cliente.rif ||
                                                cliente.cedula }})
                                        </option>
                                    </select>
                                </td>
                                <td class="px-2 py-2">
                                    <Input type="text" v-model="item.numero_factura" placeholder="0001" required />
                                </td>
                                <td class="px-2 py-2">
                                    <Input type="text" v-model="item.numero_control" placeholder="00-0001" />
                                </td>
                                <td class="px-2 py-2">
                                    <Input type="number" step="0.01" v-model="item.base_imponible"
                                        @input="calculateTotals(index)" required />
                                </td>
                                <td class="px-2 py-2">
                                    <Input type="number" step="0.01" v-model="item.porcentaje_iva"
                                        @input="calculateTotals(index)" required />
                                </td>
                                <td class="px-2 py-2">
                                    <Input type="number" step="0.01" v-model="item.impuesto_iva" readonly
                                        class="bg-muted" />
                                </td>
                                <td class="px-2 py-2">
                                    <Input type="number" step="0.01" v-model="item.total_ventas" readonly
                                        class="bg-muted font-bold" />
                                </td>
                                <td class="px-2 py-2 text-center">
                                    <Button type="button" variant="ghost" size="icon" @click="removeLine(index)"
                                        :disabled="formData.items.length === 1" class="text-destructive">
                                        <Trash2 class="w-4 h-4" />
                                    </Button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="mt-4 flex justify-between">
                    <Button type="button" variant="outline" @click="addItem">
                        <v-icon>mdi-plus</v-icon>
                    </Button>

                    <Button type="submit" :disabled="formData.processing">
                        <Save class="w-4 h-4 mr-2" />
                        Guardar Facturas
                    </Button>
                </div>
            </form>
        </div>
    </AppLayout>
</template>
